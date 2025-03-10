<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::query()->orderBy('created_at','desc')->where('commentable_type','App\Models\Content\Post')->get();

        return view('admin.content.comment.index',compact('comments'));

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {

        $comment->seen = 1;
        $comment->save();
        return view('admin.content.comment.show',compact('comment'));
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
    public function destroy($id)
    {
        //
    }

    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 1 ? 0 : 1;
        $result = $comment->save();
        if ($result){
            if ($comment->status == 1){
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

    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 1 ? 0 : 1;
        $result = $comment->save();
        if ($result){
            if ($comment->approved == 1){
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

    public function answer(CommentRequest $request,Comment $comment)
    {
        $inputs = $request->all();
        $inputs['author_id'] = 2;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        $inputs['seen'] = 1;
        $inputs['parent_id'] = $comment->id;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;
        $create = Comment::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.content.comment.index')->with('swal-success','نظر با موفقیت پاسخ داده شد');
        }
        else{
            return redirect()->route('admin.content.comment.index')->with('swal-error','خطایی رخ داد!');
        }

    }
}
