<?php

namespace App\Http\Controllers\admin\notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Models\Notify\Email;
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
        $emails = Email::query()->latest()->get();
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
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        Email::query()->create($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success','ایمیل با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success','ایمیل با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->route('admin.notify.email.index')->with('swal-success','ایمیل با موفقیت حذف شد');
    }

    public function status(Email $email)
    {
        $email->status = $email->status == 1 ? 0 : 1;
        $result = $email->save();
        if ($result)
        {
            if ( $email->status == 1){
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
