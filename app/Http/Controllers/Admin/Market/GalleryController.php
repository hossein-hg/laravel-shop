<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Gallery;
use App\Models\Market\Product;
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
        $images = Gallery::all();
        return view('admin.market.gallery.index',compact('product','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.market.gallery.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product,ImageService $imageService)
    {
        $request->validate([
            'images'=>'required|mimes:png,jpeg,jpg,gif'
        ]);
        $inputs = $request->all();
        if ($request->hasFile('images')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-galleries');
            $result = $imageService->createIndexAndSave($request->file('images'));
            if (!$result) {
                return redirect()->route('admin.market.gallery.index', [$product->id])->with('swal-success', 'آپلود تصویر با مشکل مواجه شد');
            }
            $inputs['images'] = $result;
            $inputs['product_id'] = $product->id;
            Gallery::query()->create($inputs);

        }

        return redirect()->route('admin.market.gallery.index', [$product->id])->with('swal-success', ' تصویر با موفقیت آپلود شد');
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
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back()->with('swal-success','تصویر با موفقیت حذف شد');

    }
}
