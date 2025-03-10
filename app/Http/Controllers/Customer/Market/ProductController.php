<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use App\Models\Market\Compare;
use App\Models\Market\Product;
use App\Models\Market\ProductUser;
use App\Models\Market\Rating;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product(Product $product)
    {

        $stars = Rating::query()->where('rateable_id',$product->id)->avg('value');
        $starsCount = Rating::query()->where('rateable_id',$product->id)->count();
        $relatedProducts = Product::query()->with('category')->whereHas('category',function ($q)use ($product){
            $q->where('id',$product->category->id);
        })->get()->except($product->id);
        return view('customer.market.product.product',compact('product','relatedProducts','stars','starsCount'));
    }

    public function addComment(Product $product,Request $request)
    {
        $request->validate([
            'body'=>'required|max:1000'
        ]);
        $inputs['body'] = str_replace(PHP_EOL,'<br/>',$request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        Comment::query()->create($inputs);
        return redirect()->route('customer.market.product',[$product->slug])->with('swal-success','نظر شما با موفقیت ثبت شد');
    }

    public function addToFavorite(Product $product)
    {
        if (!Auth::check()){
            return response()->json([
                'status'=>3
            ]);
        }
        $favorite = ProductUser::query()->where('product_id',$product->id)->where('user_id',Auth::user()->id)->first();
        if ($favorite == null){
            ProductUser::query()->create([
                'product_id'=>$product->id,
                'user_id'=>Auth::user()->id,
            ]);
            return response()->json([
                'status'=>1
            ]);
        }
        else{
            $favorite->where('product_id',$product->id)->delete();
            return response()->json([
                'status'=>2
            ]);
        }

    }

    public function addToCompare(Product $product)
    {
        if (!Auth::check()){
            return response()->json([
                'status'=>3
            ]);
        }
        $user = Auth::user();
        if ($user->compare()->count() > 0){
            $userCompareList = $user->compare;
        }
        else{
            $userCompareList = Compare::query()->create([
                'user_id'=>$user->id,
            ]);
        }
        $product->compares()->toggle($userCompareList->id);
        if ($product->compares->contains($userCompareList->id)){
            return response()->json([
                'status'=>1
            ]);
        }
        else{
            return response()->json([
                'status'=>2
            ]);
        }


    }

    public function addRate(Request $request,Product $product)
    {
        $request->validate([
            'rating'=>'required'
        ]);
        $rate = Rating::query()->where('model_id',\auth()->user()->id)->first();
        $user = Auth::user();
        if (\auth()->check() and $user->isUserPurchedProduct($product->id) > 0) {
            if ($rate == null) {
                Rating::query()->create([
                    'model_id' => \auth()->user()->id,
                    'model_type' => User::class,

                    'rateable_id' => $product->id,
                    'rateable_type' => Product::class,
                    'value' => $request->rating,
                ]);
            } else {
                $rate->update([
                    'value' => $request->rating,
                ]);
            }
            return back()->with('swal-success','امتیاز با موفقیت ثبت شد');
        }
        else{

            return back()->with('swal-error','ابتدا باید محصول را سفارش دهید');
        }


    }

    public function viewApi()
    {
        return view('api.products');
    }
}
