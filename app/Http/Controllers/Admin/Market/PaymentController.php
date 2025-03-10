<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function online()
    {
        $payments = Payment::query()->where('paymentable_type','App\Models\Market\OnlinePayment')->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function offline()
    {
        $payments = Payment::query()->where('paymentable_type','App\Models\Market\OfflinePayment')->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));

    }

    public function cash()
    {
        $payments = Payment::query()->where('paymentable_type','App\Models\Market\CashPayment')->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.payment.index',compact('payments'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        //
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->back()->with('swal-success','تغییر شما با موفقیت انجام شد');
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->back()->with('swal-success','تغییر شما با موفقیت انجام شد');
    }
}
