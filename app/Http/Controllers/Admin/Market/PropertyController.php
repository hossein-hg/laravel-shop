<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $category_attributes = CategoryAttribute::query()->orderBy('created_at','desc')->simplePaginate();
        return view('admin.market.property.index',compact(['category_attributes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.market.property.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        $categoryAttribute = CategoryAttribute::query()->create($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success','فرم کالا با موفقیت ثبت شد');
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
    public function edit(CategoryAttribute $attribute)
    {
        $categories = ProductCategory::all();
        return view('admin.market.property.edit',compact(['categories','attribute']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryAttributeRequest $request, CategoryAttribute $attribute)
    {
        $inputs = $request->all();
        $categoryAttribute = $attribute->update($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success','فرم کالا با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $attribute)
    {
        $attribute->delete();
        return response()->json([
            'status'=>true,

        ]);
    }
}
