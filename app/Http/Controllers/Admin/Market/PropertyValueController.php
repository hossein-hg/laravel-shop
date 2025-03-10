<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    public function index(CategoryAttribute $attribute)
    {
        return view('admin.market.property.value.index',compact('attribute'));
    }

    public function create(CategoryAttribute $attribute)
    {
        $products = Product::query()->where('category_id',$attribute->category_id)->get();
        return view('admin.market.property.value.create',compact(['attribute','products']));
    }

    public function store(CategoryValueRequest $request,CategoryAttribute $attribute)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value'=>$request->value,'price_increase'=>$request->price_increase]);

        $inputs['category_attribute_id'] = $attribute->id;
        $value = CategoryValue::query()->create($inputs);
        return redirect()->route('admin.market.value.index',[$attribute->id])->with('swal-success','مقدار فرم کالا با موفقیت ساخته شد');

    }

    public function edit(CategoryAttribute $attribute,CategoryValue $value)
    {
        $products = Product::query()->where('category_id',$attribute->category_id)->get();
        return view('admin.market.property.value.edit',compact(['attribute','products','value']));
    }

    public function update(CategoryAttribute $attribute,CategoryValue $value,Request $request)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value'=>$request->value,'price_increase'=>$request->price_increase]);

        $value->update($inputs);
        return redirect()->route('admin.market.value.index',[$attribute->id])->with('swal-success','مقدار فرم کالا با موفقیت ویرایش شد');
    }

    public function destroy(CategoryValue $value)
    {
        $value->delete();
        return response()->json([
            'status'=>true,

        ]);
    }
}
