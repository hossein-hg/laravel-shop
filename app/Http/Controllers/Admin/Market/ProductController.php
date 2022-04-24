<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->latest()->simplePaginate(15);
        return view('admin.market.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create',compact(['productCategories','brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);

        if ($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result)
            {
                return redirect()->route('admin.market.product.index')->with('swal-success','آپلود تصویر با مشکل مواجه شد');
            }
            $inputs['image'] = $result;

            DB::transaction(function ()use ($inputs,$request){
                $product = Product::query()->create($inputs);
                $meta = array_combine($request->meta_key,$request->meta_value);

                foreach ($meta as $key => $value) {
                    ProductMeta::query()->create([
                        'meta_key' => $key,
                        'meta_value' => $value,
                        'product_id'=>$product->id

                    ]);
                }
            });
            return redirect()->route('admin.market.product.index')->with('toast-success','محصول جدید با موفقیت ثبت شد');

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
    public function edit(Product $product)
    {

        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit',compact(['productCategories','brands','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product,ImageService $imageService)
    {

        $inputs = $request->all();
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        if($request->hasFile('image'))
        {
            if(!empty($product->image))
            {
                $imageService->deleteDirectoryAndFiles($product->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($product->image))
            {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        DB::transaction(function ()use ($inputs,$request,$product) {
            $product->update($inputs);
            $meta = array_combine($request->meta_key, $request->meta_value);


            foreach (ProductMeta::query()->where('product_id', $product->id)->get() as $meta1) {
                $meta1->delete();
            }

            foreach ($meta as $key => $value) {
                ProductMeta::query()->create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id'=>$product->id

                ]);
            }

        });



        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return  redirect()->route('admin.market.product.index')->with('swal-success','محصول با موفقیت حذف شد');
    }
}
