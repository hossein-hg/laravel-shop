<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductColorRequest;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $colors = ProductColor::query()->where('product_id',$product->id)->get();

        return view('admin.market.product-color.index',compact(['product','colors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $products = Product::all();
        return view('admin.market.product-color.create',compact(['product','products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductColorRequest $request,Product $product)
    {
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        ProductColor::query()->create($inputs);
        return  redirect()->route('admin.market.product-color.index',[$product->id])->with('swal-success','رنگ با موفقیت ساخته شد');
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
    public function edit(ProductColor $color)
    {
        $products = Product::all();
        return view('admin.market.product-color.edit',compact(['color','products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductColorRequest $request, ProductColor $color)
    {
        $inputs = $request->all();

        $color->update($inputs);
        return  redirect()->route('admin.market.product-color.index',[$color->product_id])->with('swal-success','رنگ با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductColor $color)
    {
        $color->delete();
        return back()->with('swal-success','رنگ با موفقیت حذف شد');
    }

    public function status(ProductColor $color)
    {
        $color->status = $color->status == 0 ? 1 : 0;
        $result = $color->save();
        if ($result)
        {
            if ($color->status == 0)
            {
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
                'status'=>false,
            ]);
        }
    }
}
