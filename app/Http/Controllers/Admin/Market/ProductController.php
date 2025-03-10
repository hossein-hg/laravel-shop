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
        $products = Product::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create',compact(['categories','brands']));

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

        $request->published_at = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$request->published_at);
        if ($request->hasFile('image')){

            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.market.product.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        DB::transaction(function ()use($request,$inputs){
            $product = Product::query()->create($inputs);
            if($request->meat_key[0] != null and $request->meat_value[0] != null) {
                $meats = array_combine($request->meat_key, $request->meat_value);
                foreach ($meats as $key => $value) {
                    $meta = ProductMeta::query()->create([
                        'meat_key' => $key,
                        'meat_value' => $value,
                        'product_id' => $product->id,
                    ]);
                }
            }
        });


            return redirect()->route('admin.market.product.index')->with('swal-success','محصول با موفقیت اضافه شد');



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
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit',compact(['categories','brands','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,ImageService $imageService,Product $product)
    {
        $inputs = $request->all();

        $request->published_at = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$request->published_at);
        if ($request->hasFile('image')){

            if (!empty($product->image)){
                $imageService->deleteDirectoryAndFiles($product->image['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.market.product.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        else{
            if (isset($inputs['currentImage']) and !empty($product->image)){
                $image = $product->image;

                $image['currentImage'] = $inputs['currentImage'];

                $inputs['image'] = $image;
            }
        }
        DB::transaction(function ()use($request,$inputs,$product){
            $product->update($inputs);
            if($request->meat_value[0] != null) {
                $meats = array_combine($request->meat_key, $request->meat_value);
                $meta_keys = $request->meat_key;
                $meta_values = $request->meat_value;
                $meta_ids = array_keys($request->meat_key);


                $meats = array_map(function ($meta_id,$meta_key,$meta_value){
                    return array_combine(
                        ['meat_id','meat_key','meat_value'],
                        [$meta_id,$meta_key,$meta_value]
                    );
                },$meta_ids,$meta_keys,$meta_values);
                $metas2 = ProductMeta::query()->where('product_id',$product->id)->get();
                foreach ($metas2 as $meat) {
                    $meat->delete();
                }
                foreach ($meats as $meat) {


                    ProductMeta::query()->create([
                        'meat_key'=>$meat['meat_key'],
                        'meat_value'=>$meat['meat_value'],
                        'product_id'=>$product->id,
                    ]);
                }
            }
        });

            return redirect()->route('admin.market.product.index')->with('swal-success','محصول با موفقیت ویرایش شد');

    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(Product $product)
    {
        $product->status = $product->status == 0 ? 1 : 0;
        $result = $product->save();
        if ($result){
            if ($product->status == 0){
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

    public function marketAble(Product $product)
    {
        $product->marketable = $product->marketable == 0 ? 1 : 0;
        $result = $product->save();
        if ($result){
            if ($product->marketable == 0){
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
