<?php

namespace Modules\Post\Http\Controllers;
use App\Http\Services\Image\ImageService;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Post;
use Modules\ContentCategory\Entities\PostCategory;
use Modules\Post\Http\Requests\PostRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('post::index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = PostCategory::all();
        return view('post::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @param ImageService $imageService
     * @return void
     */
    public function store(PostRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.post.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        $inputs['author_id'] = Auth::user()->id;
        $request->published_at = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$request->published_at);
        $inputs['status'] = 1;
        $store = Post::query()->create($inputs);
        if ($store){
            return redirect()->route('admin.content.post.index')->with('swal-success','پست با موفقیت ساخته شد');
        }
        else{
            return back()->with('swal-error','خطایی رخ داد');
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        return view('post::edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @param ImageService $imageService
     * @return void
     */
    public function update(PostRequest $request, Post $post,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){
            if (!empty($post->image)){
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.post.index')->with('swal-error','عکس آپلود نشد!');
            }
            $inputs['image'] = $result;
        }
        else{
            if (isset($inputs['currentImage']) and !empty($post->image)){
                $image = $post->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $inputs['author_id'] = Auth::user()->id;
        $request->published_at = substr($request->published_at,0,10);
        $inputs['published_at'] = date('Y-m-d H:i:s',(int)$request->published_at);
        $inputs['status'] = 1;
        $update = $post->update($inputs);
        if ($update){
            return redirect()->route('admin.content.post.index')->with('swal-success','پست با موفقیت ساخته شد');
        }
        else{
            return back()->with('swal-error','خطایی رخ داد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();
        if ($result){
            return response()->json([
                'status'=>1,

            ]);
        }

    }

    public function status(Post $post)
    {
        $post->status = $post->status == 1 ? 0 : 1;
        $result = $post->save();
        if ($result){
            if ($post->status == 1){
                return response()->json([
                    'status'=>1,
                    'checked'=>1,
                ]);
            }
            else{
                return response()->json([
                    'status'=>1,
                    'checked'=>0,
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>0,
            ]);
        }

    }
}
