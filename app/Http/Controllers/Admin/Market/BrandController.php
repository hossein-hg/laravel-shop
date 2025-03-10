<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.brand.index',compact('brands'));
    }

    public function create()
    {
        return view('admin.market.brand.create');
    }

    public function store(BrandRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')){

            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if (!$result){
                return redirect()->route('admin.market.brand.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['logo'] = $result;
        }
        $create = Brand::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.market.brand.index')->with('swal-success','برند محصول با موفقیت ساخته شد');
        }
    }

    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit',compact('brand'));
    }

    public function update(ImageService $imageService,Brand $brand,BrandRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')){

            if (!empty($brand->image)){
                $imageService->deleteDirectoryAndFiles($brand->image['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if (!$result){
                return redirect()->route('admin.market.brand.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['logo'] = $result;
        }
        else{
            if (isset($inputs['currentImage']) and !empty($brand->logo)){
                $image = $brand->logo;

                $image['currentImage'] = $inputs['currentImage'];

                $inputs['logo'] = $image;
            }
        }
        $update = $brand->update($inputs);
        if ($update){
            return redirect()->route('admin.market.brand.index')->with('swal-success','برند با موفقیت ویرایش شد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 0 ? 1 : 0;
        $result = $brand->save();
        if ($result){
            if ($brand->status == 0){
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
