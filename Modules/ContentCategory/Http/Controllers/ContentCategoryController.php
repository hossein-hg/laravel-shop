<?php

namespace Modules\ContentCategory\Http\Controllers;

use Modules\ContentCategory\Http\Requests\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use Modules\ContentCategory\Entities\PostCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $postCategories = PostCategory::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('contentcategory::index',compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('contentcategory::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostCategoryRequest $request
     * @param ImageService $imageService
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request,ImageService $imageService)
    {

        $inputs = $request->all();

        if ($request->hasFile('image')){

            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.category.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }

        $postCategory = PostCategory::query()->create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی با موفقیت اضافه شد')->with('toast-success','دسته بندی با موفقیت اضافه شد');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('contentcategory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(PostCategory $category)
    {
        return view('contentcategory::edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PostCategoryRequest $request, PostCategory $category,ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')){

            if (!empty($category->image)){
                $imageService->deleteDirectoryAndFiles($category->image['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.category.index')->with('swal-error','عکس آپلود نشد!');
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
        $category->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $category)
    {
        $category->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(PostCategory $category)
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
}
