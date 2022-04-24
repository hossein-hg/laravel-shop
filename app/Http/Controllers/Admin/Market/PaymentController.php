<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::query()->latest()->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function offline()
    {
        $payments = Payment::query()->where('type',1)->latest()->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function online()
    {
        $payments = Payment::query()->where('type',0)->latest()->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function cash()
    {
        $payments = Payment::query()->where('type',2)->latest()->get();
        return view('admin.market.payment.index',compact('payments'));
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return back()->with('swal-success','تغییر شما با موفقیت انجام شد');
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return back()->with('swal-success','تغییر شما با موفقیت انجام شد');
    }
    public function confirm()
    {
        return view('admin.market.payment.index');
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show',compact('payment'));
    }
}
