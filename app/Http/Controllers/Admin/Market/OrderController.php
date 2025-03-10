<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $orders = Order::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));
    }

    public function newOrders()
    {
        $orders = Order::query()->where('order_status',5)->orderBy('created_at','desc')->simplePaginate(15);
        foreach ($orders as $order){
            $order->order_status = 0;
            $order->save();
        }

        return view('admin.market.order.index',compact('orders'));

    }

    public function sending()
    {
        $orders = Order::query()->where('delivery_status',1)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));

    }

    public function unpaid()
    {
        $orders = Order::query()->where('payment_status',0)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));

    }

    public function canceled()
    {
        $orders = Order::query()->where('order_status',3)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));

    }

    public function returned()
    {
        $orders = Order::query()->where('order_status',4)->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.order.index',compact('orders'));

    }

    public function changeSendStatus(Order $order)
    {
        switch ($order->delivery_status){
            case 0:
                 $order->delivery_status = 1;
                 break;
            case 1:
                 $order->delivery_status = 2;
                break;
            case 2:
                 $order->delivery_status = 3;
                break;
            case 3:
                 $order->delivery_status = 0;
                break;

        }
        $order->save();
        return back();
    }

    public function changeOrderStatus(Order $order)
    {

        switch ($order->order_status){
            case 0:
                $order->order_status = 1;
                break;
            case 1:
                $order->order_status = 2;
                break;
            case 2:
                $order->order_status = 3;
                break;
            case 3:
                $order->order_status = 4;
                break;
            case 4:
                $order->order_status = 5;
                break;
            case 5:
                $order->order_status = 0;
                break;

        }
        $order->save();
        return back();
    }

    public function cancelOrder(Order $order)
    {
        $order->order_status = 3;
        $order->save();
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.market.order.show',compact('order'));
    }

    public function detail(Order $order)
    {
        return view('admin.market.order.detail',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
