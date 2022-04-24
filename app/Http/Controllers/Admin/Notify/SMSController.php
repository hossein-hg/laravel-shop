<?php

namespace App\Http\Controllers\admin\notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allSms = SMS::query()->latest()->paginate(15);
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
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        SMS::query()->create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success','پیامک با موفقیت ایجاد شد');

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
     * @param  int  $id
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
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success','پیامک با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sms)
    {
        $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('swal-success','پیامک با موفقیت حذف شد');
    }

    public function status(SMS $sms)
    {
        $sms->status = $sms->status == 1 ? 0 : 1;
        $result = $sms->save();
        if ($result)
        {
            if ( $sms->status == 1){
                return response()->json([
                    'status'=>true,
                    'checked'=>true,
                ]);
            }
            else{
                return response()->json([
                    'status'=>true,
                    'checked'=>false,
                ]);
            }

        }
        else{
            return response()->json([
                'status'=>false,
                'checked'=>false,
            ]);
        }
    }
}
