<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSms = SMS::query()->orderBy('created_at','desc')->paginate(15);
        return view('admin.notify.sms.index',compact('allSms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.sms.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SMSRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $date = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$date);
        $create = SMS::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.notify.sms.index')->with('swal-success','پیامک با موفقیت ساخته شد');
        }
        else{
            return redirect()->route('admin.notify.sms.index')->with('swal-error','خطایی رخ داد!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param SMS $sms
     * @return \Illuminate\Http\Response
     */
    public function show(SMS $sms)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SMS $sms
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit',compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();
        $date = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$date);
        $update = $sms->update($inputs);
        if ($update){
            return redirect()->route('admin.notify.sms.index')->with('swal-success','پیامک با موفقیت ویرایش شد');
        }
        else{
            return redirect()->route('admin.notify.sms.index')->with('swal-error','خطایی رخ داد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SMS $sms
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sms)
    {
        $result = $sms->delete();
        if ($result){
            return response()->json([
                'status'=>1,

            ]);
        }
    }

    public function status(SMS $sms)
    {
        $sms->status = $sms->status == 1 ? 0 : 1;
        $result = $sms->save();
        if ($result){
            if ($sms->status == 1){
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
}
