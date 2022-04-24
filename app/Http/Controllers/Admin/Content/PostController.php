<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::query()->latest()->get();
        return view('admin.content.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::all();
        return view('admin.content.post.create',compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ImageService $imageService)
    {

        $file = $request->file('image');
        $inputs = $request->all();
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        if ($file)
        {
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result)
            {
                return redirect()->route('admin.content.post.index')->with('swal-error','آپلود تصویر با مشکل مواجه شد');
            }
            $inputs['image'] = $result;
            $inputs['author_id'] = 1;
            $post = Post::query()->create($inputs);
            return redirect()->route('admin.content.post.index')->with('toast-success','پست جدید با موفقیت ثبت شد');
        }
        else{
            return redirect()->route('admin.content.post.index')->with('swal-error','آپلود تصویر با مشکل مواجه شد');
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
    public function edit(Post $post)
    {

        $postCategories = PostCategory::all();
        return view('admin.content.post.edit',compact(['postCategories','post']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
        $file = $request->file('image');
        $inputs = $request->all();
        $inputs['published_at'] = substr($inputs['published_at'],0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$inputs['published_at']);
        if ($file)
        {
            if(!empty($postCategory->image))
            {
                $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

        }

        else{
            if(isset($inputs['currentImage']) && !empty($post->image))
            {
                $image = $post->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $inputs['author_id'] = 1;
        $post->update($inputs);
        return redirect()->route('admin.content.post.index')->with('toast-success','پست جدید با موفقیت آپدیت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('swal-success','پست  با موفقیت حذف شد');
    }

    public function commentable(Post $post)
    {
        $post->commentable = $post->commentable == 1 ? 0 : 1;
        $result = $post->save();
        if ($result)
        {
            if ($post->commentable == 0)
            {
                return response()->json([
                    'status'=>true,
                    'checked'=>false,
                ]);
            }
            else{
                return response()->json([
                    'status'=>true,
                    'checked'=>true,
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>false,
                'checked'=>false,
            ]);
        }
    }

    public function status(Post $post)
    {
        $post->status = $post->status == 1 ? 0 : 1;
        $result = $post->save();
        if ($result)
        {
            if ($post->status == 0)
            {
                return response()->json([
                    'status'=>true,
                    'checked'=>false,
                ]);
            }
            else{
                return response()->json([
                    'status'=>true,
                    'checked'=>true,
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>false,
                'checked'=>false,
            ]);
        }

    }
}
