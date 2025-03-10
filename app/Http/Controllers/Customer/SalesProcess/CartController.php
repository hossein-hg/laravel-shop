<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        if (Auth::check()) {

            $cartItems = CartItem::query()->where('user_id', Auth::user()->id)->get();
            if ($cartItems->count() > 0){
                $related = Product::all();
                return view('customer.market.sales-process.cart', compact('related', 'cartItems'));
            }

            return redirect()->back()->with('swal-error','سبد خرید شما خالی است');
        }
        return redirect()->route('auth.customer.login-register-form');
    }

    public function updateCart(Request $request)
    {
        $inputs = $request->all();


        $cartItems = CartItem::query()->where('user_id',Auth::user()->id)->get();
        foreach ($cartItems as $key => $item){
//            echo "<pre>";
        if (isset($inputs['number'][$item->id])) {
           $item->number = $inputs['number'][$item->id];
           $item->save();
        }
        }

        return redirect()->route('customer.sales-process.address-and-delivery');
    }

    public function addToCart(Product $product,Request $request)
    {

        if (Auth::check()){
            $request->validate([
                'color'=>'nullable|exists:product_colors,id',
                'guarantee'=>'nullable|exists:guarantees,id',
                'number'=>'required|min:1|max:5',
            ]);
            $user = Auth::user();
            $cartItems = CartItem::query()->where('user_id',$user->id)->where('product_id',$product->id)->get();
           if (!isset($request->color)){
               $request->color = null;
           }
            if (!isset($request->guarantee)){
                $request->guarantee = null;
            }
            foreach ($cartItems as $item){
                if ($item->color_id == $request->color and $item->guarantee_id == $request->guarantee){
                    if ($item->number != $request->number){
                        $item->number = $request->number;
                        $item->save();
                    }
                    return back();
                }



            }
            CartItem::query()->create([
                'product_id'=>$product->id,
                'guarantee_id'=>$request->guarantee,
                'color_id'=>$request->color,
                'number'=>$request->number,
                'user_id'=>$user->id,
            ]);
            return back()->with('swal-success','محصول با موفقیت به سبد خرید اضافه شد');
        }
        else{
            return redirect()->route('auth.customer.login-register-form');
        }
    }

    public function removeFromCart(CartItem $cartItem)
    {
        if ($cartItem->user_id == Auth::user()->id){
            $cartItem->delete();
        }

        return response()->json([
            'status'=>true
        ]);
    }
}
