<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Expression;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryAttribute $categoryAttribute)
    {
        $values = CategoryValue::query()->where('category_attribute_id',$categoryAttribute->id)->get();
        return view('admin.market.property.value.index',compact('categoryAttribute','values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryAttribute $categoryAttribute)
    {
        $products = $categoryAttribute->category->products;
        return view('admin.market.property.value.create',compact('categoryAttribute','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValueRequest $request,CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        CategoryValue::query()->create($inputs);
        return redirect()->route('admin.market.value.index',[$categoryAttribute->id])->with('swal-success','مقدار فرم کالا با موفقیت افزوده شد');
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
    public function edit(CategoryValue $categoryValue)
    {
        $categoryAttribute = $categoryValue->attribute;

        $products = $categoryAttribute->category->products;

        return view('admin.market.property.value.edit',compact('categoryValue','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValueRequest $request, CategoryValue $categoryValue)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryValue->attribute->id;
        $categoryValue->update($inputs);
        return redirect()->route('admin.market.value.index',[$categoryValue->attribute->id])->with('swal-success','مقدار فرم کالا با موفقیت افزوده شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryValue $categoryValue)
    {
        $categoryValue->delete();
        return back()->with('swal-success','مقدار فرم کالا با موفقیت حذف شد');
    }
}
