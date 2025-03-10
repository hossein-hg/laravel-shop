<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::query()->with('parent')->orderBy('created_at','desc')->paginate(15);
        return view('admin.content.menu.index',compact('menus'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::query()->where('parent_id',null)->get();
        return view('admin.content.menu.create',compact('menus'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $create = Menu::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.content.menu.index')->with('swal-success','منو با موفقیت ساخته شد');
        }
        else{
            return redirect()->route('admin.content.menu.index')->with('swal-error','خطایی رخ داد!');
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
     * @param Menu $menu
     * @return void
     */
    public function edit(Menu $menu)
    {
        $menus = Menu::query()->where('parent_id',null)->whereNotIn('id',[$menu->id])->get();
//        $menus = Menu::all();


        return view('admin.content.menu.edit',compact(['menu','menus']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $update = $menu->update($inputs);
        if ($update){
            return redirect()->route('admin.content.menu.index')->with('swal-success','منو با موفقیت ویرایش شد');
        }
        else{
            return redirect()->route('admin.content.menu.index')->with('swal-error','خطایی رخ داد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(Menu $menu)
    {
        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();
        if ($result){
            if ($menu->status == 0){
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
