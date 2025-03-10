<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;
use App\Models\Content\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::query()->orderBy('created_at','desc')->paginate(15);
        return view('admin.content.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.page.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $create = Page::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.content.page.index')->with('swal-success','صفحه با موفقیت ساخته شد');
        }
        else{
            return redirect()->route('admin.content.page.index')->with('swal-error','خطایی رخ داد!');
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
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.content.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();
        $update = $page->update($inputs);
        if ($update){
            return redirect()->route('admin.content.page.index')->with('swal-success','صفحه با موفقیت ویرایش شد');
        }
        else{
            return redirect()->route('admin.content.page.index')->with('swal-error','خطایی رخ داد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $result = $page->delete();
        if ($result){
            return response()->json([
                'status'=>1,

            ]);
        }
    }

    public function status(Page $page)
    {
        $page->status = $page->status == 1 ? 0 : 1;
        $result = $page->save();
        if ($result){
            if ($page->status == 1){
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
