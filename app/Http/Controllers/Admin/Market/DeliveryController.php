<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;
use App\Models\Market\Delivery;
use App\Models\User\Role;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_methods = Delivery::all();
        return view('admin.market.delivery.index',compact('delivery_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        $inputs = $request->all();
        $create = Delivery::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.market.delivery.index')->with('swal-success','روش ارسال با موفقیت ایجاد شد');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        return view('admin.market.delivery.edit',compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $inputs = $request->all();
        $update = $delivery->update($inputs);
        if ($update){
            return redirect()->route('admin.market.delivery.index')->with('swal-success','روش ارسال با موفقیت ویرایش شد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(Delivery $delivery)
    {
        $delivery->status = $delivery->status == 0 ? 1 : 0;
        $result = $delivery->save();
        if ($result){
            if ($delivery->status == 0){
                return response()->json([
                    'status'=>true,
                    'checked'=>false
                ]);
            }
            else{
                return response()->json([
                    'status'=>true,
                    'checked'=>true
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>false
            ]);
        }

    }
}
