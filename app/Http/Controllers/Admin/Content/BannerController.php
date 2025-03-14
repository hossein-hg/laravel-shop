<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\BannerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::query()->orderBy('created_at','desc')->simplePaginate(15);
        $positions = Banner::$positions;

        return view('admin.content.banner.index',compact(['banners','positions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.create',compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){

            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'banner');
            $result = $imageService->save($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.banner.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        Banner::query()->create($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success','تصویر با موفقیت آپلود شد');
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
    public function edit(Banner $banner)
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.edit',compact('banner','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, Banner $banner,ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')){

            if (!empty($banner->image)){
                $imageService->deleteImage($banner->image);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'banner');
            $result = $imageService->save($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.banner.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        else{
            unset($inputs['image']);
        }

        $banner->update($inputs);
        return redirect()->route('admin.content.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(Banner $banner)
    {
        $banner->status = $banner->status == 0 ? 1 : 0;
        $result = $banner->save();
        if ($result){
            if ($banner->status == 0){
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
