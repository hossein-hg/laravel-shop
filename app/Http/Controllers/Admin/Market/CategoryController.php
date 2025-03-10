<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.category.index',compact('productCategories'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.market.category.create',compact('categories'));
    }

    public function store(ProductCategoryRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){

            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.market.category.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        $create = ProductCategory::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.market.category.index')->with('swal-success','دسته بندی محصول با موفقیت ساخته شد');
        }

    }

    public function edit(ProductCategory $category)
    {
        $categories = ProductCategory::query()->whereNotIn('id',[$category->id])->get();

        return view('admin.market.category.edit',compact(['category','categories']));
    }

    public function update(Request $request,ImageService $imageService,ProductCategory $category)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){

            if (!empty($category->image)){
                $imageService->deleteDirectoryAndFiles($category->image['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.market.category.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        else{
            if (isset($inputs['currentImage']) and !empty($category->image)){
                $image = $category->image;

                $image['currentImage'] = $inputs['currentImage'];

                $inputs['image'] = $image;
            }
        }
        $update = $category->update($inputs);
        if ($update){
            return redirect()->route('admin.market.category.index')->with('swal-success','دسته بندی محصول با موفقیت ساخته شد');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(ProductCategory $category)
    {
        $category->status = $category->status == 0 ? 1 : 0;
        $result = $category->save();
        if ($result){
            if ($category->status == 0){
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

    public function showInMenu(ProductCategory $category)
    {
        $category->show_in_menu = $category->show_in_menu == 0 ? 1 : 0;
        $result = $category->save();
        if ($result){
            if ($category->show_in_menu == 0){
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
