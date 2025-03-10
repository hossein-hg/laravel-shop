<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index',compact('product'));
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
    public function store(Request $request,ImageService $imageService,Product $product)
    {
        $request->validate(['image'=>'required|image|mimes:png,jpg,jpeg,gif']);
        if ($request->hasFile('image')){
            $name = $product->name;
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$name);
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.market.product.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;

        }
        $inputs['product_id'] = $product->id;
        $image = ProductImage::query()->create($inputs);
        return redirect()->route('admin.market.gallery.index',[$product->id])->with('swal-success','تصویر با موفقیت افزوده شد');

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
    public function destroy(ProductImage $image)
    {
        $image->delete();
        return response()->json([
            'status'=>true,

        ]);
    }
}
