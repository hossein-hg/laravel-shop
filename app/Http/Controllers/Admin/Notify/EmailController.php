<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Jobs\SendEmailToUsers;
use App\Models\Notify\Email;
use App\Models\User;
use App\Notifications\AdminEmailSend;
use App\Notifications\UserLogined;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::query()->orderBy('created_at','desc')->paginate(15);
        return view('admin.notify.email.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.email.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $date = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$date);
        $create = Email::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.notify.email.index')->with('swal-success','ایمیل با موفقیت ساخته شد');
        }
        else{
            return redirect()->route('admin.notify.email.index')->with('swal-error','خطایی رخ داد!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Email $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, Email $email)
    {
        $inputs = $request->all();
        $date = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$date);
        $update = $email->update($inputs);
        if ($update){
            return redirect()->route('admin.notify.email.index')->with('swal-success','پیامک با موفقیت ویرایش شد');
        }
        else{
            return redirect()->route('admin.notify.email.index')->with('swal-error','خطایی رخ داد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Email $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $result = $email->delete();
        if ($result){
            return response()->json([
                'status'=>1,

            ]);
        }
    }

    public function status(Email $email)
    {
        $email->status = $email->status == 1 ? 0 : 1;
        $result = $email->save();
        if ($result){
            if ($email->status == 1){
                return response()->json([
                    'status'=>1,
                    'checked'=>1,
                ]);
            }
            else{
                return response()->json([
                    'status'=>1,
                    'checked'=>0,
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>0,
            ]);
        }
    }

    public function sendMail(Email $email)
    {

        SendEmailToUsers::dispatch($email);
        return back()->with('swal-success','ایمیل با موفقیت ارسال شد');
    }
}
