<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $type = request()->type;
        if (isset($type)){
            $orders = auth()->user()->orders()->where('order_status',$type)->get();
        }
        else{
            $orders = auth()->user()->orders;
        }


        return view('customer.profile.my-orders',compact('orders'));
    }
}
