<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;

use App\Http\Services\Message\SMS\SmsService;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\UserLogined;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use App\Http\Services\Message\MessageService;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        if (filter_var($inputs['id'],FILTER_VALIDATE_EMAIL)){
            $type = 1;
            $user = User::query()->where('email',$inputs['id'])->first();
            if (empty($user)){
                $newUser['email'] = $inputs['id'];
            }
        }

        elseif(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])){
            $type = 0;

            $inputs['id'] = ltrim($inputs['id'],'0');
            $inputs['id'] = substr($inputs['id'],0,2) == '98' ? substr($inputs['id'],2) : $inputs['id'];
            $inputs['id'] = str_replace('+98','',$inputs['id']);
            $user = User::query()->where('mobile',$inputs['id'])->first();
            if (empty($user)){
                $newUser['mobile'] = $inputs['id'];
            }
        }

        else{
            $errorText = 'شناسه ورودی شما نه موبایل است نه ایمیل';
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>$errorText]);
        }

        if (empty($user)){
            $newUser['password'] = '88888888';
            $newUser['activation'] = 1;
            $user = User::query()->create($newUser);
        }
        $otp_code = rand(111111,999999);
        $token = Str::random(60);
        $otpInput = [
            'login_id'=>$inputs['id'],
            'user_id'=>$user->id,
            'token'=>$token,
            'type'=>$type,
            'otp_code'=>$otp_code,
        ];
        Otp::query()->create($otpInput);
        if($type == 0){
            //send sms

            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo('0' . $user->mobile);
            $smsService->setText("مجموعه آمازون \n  کد تایید : $otp_code");
            $smsService->setIsFlash(true);
            $smsService->fire();


        }
        elseif($type == 1){

            $user->notify(new UserLogined($otp_code));
        }

        return redirect()->route('auth.customer.login-confirm-form',[$token]);



    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::query()->where('token',$token)->first();
        if (empty($otp)){
            return  redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>'آدرس وارد شده نامعتبر می باشد']);
        }
        return view('customer.auth.login-confirm',compact(['token','otp']));
    }

    public function loginConfirm($token,LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        $otp = Otp::query()->where('token',$token)->where('used',0)->where('created_at','>=',Carbon::now()->subMinutes(5)->toDateTimeString())->first();
        if (empty($otp)){
            return  redirect()->route('auth.customer.login-register-form',$token)->withErrors(['id'=>'آدرس وارد شده نامعتبر می باشد']);
        }
        if ($otp->otp_code !== $inputs['otp']){
            return  redirect()->route('auth.customer.login-confirm-form',$token)->withErrors(['otp'=>'کد وارد شده نامعتبر می باشد']);
        }
        $otp->used = 1;
        $otp->save();
        $user = $otp->user()->first();
        if ($otp->type == 0 and empty($user->mobile_verified_at)){
            $user->mobile_verified_at = Carbon::now();
            $user->save();
        }
        elseif ($otp->type == 1 and empty($user->email_verified_at)){
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
        Auth::login($user);
        return redirect()->route('customer.home');
    }

    public function loginResendOtp($token)
    {
        $otp = Otp::query()->where('token',$token)->where('created_at','<=',\Carbon\Carbon::now()->subMinutes(5))->first();
        if (empty($otp)){
            return redirect()->route('auth.customer.login-confirm',[$token])->withErrors(['id'=>'آدرس وارد شده نامعتبر است']);
        }
        $user = $otp->user()->first();
        $otp_code = rand(111111,999999);
        $token = Str::random(60);
        $otpInput = [
            'login_id'=>$otp->login_id,
            'user_id'=>$user->id,
            'token'=>$token,
            'type'=>$otp->type,
            'otp_code'=>$otp_code,
        ];
        $type = $otp->type;
        Otp::query()->create($otpInput);
        if($type == 0){
            //send sms

            $smsService = new SmsService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo('0' . $user->mobile);
            $smsService->setText("مجموعه آمازون \n  کد تایید : $otp_code");
            $smsService->setIsFlash(true);
            $smsService->fire();




        }
        elseif($type == 1){

            $user->notify(new UserLogined($otp_code));
        }

        return redirect()->route('auth.customer.login-confirm-form',[$token]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
