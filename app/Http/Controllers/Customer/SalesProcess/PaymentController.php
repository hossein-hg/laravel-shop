<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Coupon;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('profileCompletion');
    }

    public function payment()
    {
        $user = auth()->user();
        $cartItems = CartItem::query()->where('user_id',$user->id)->get();
        $order = Order::query()->where('user_id',Auth::user()->id)->where('order_status',0)->first();
        return view('customer.market.sales-process.payment',compact('cartItems','order'));
    }

    public function couponDiscount(Request $request)
    {
        $request->validate([
            'code'=>'required'
        ]);
        $coupon = Coupon::query()->where([['start_date','<',Carbon::now()],['code',$request->code],['end_date','>',Carbon::now()],['status',1]])->first();
        if ($coupon == null){
            return redirect()->back()->withErrors(['code'=>'کد نامعتبر است']);
        }
        if ($coupon->user_id != null){
            $coupon = Coupon::query()->where([['start_date','<',Carbon::now()],['code',$request->code],['end_date','>',Carbon::now()],['status',1],['user_id',Auth::user()->id]])->first();
            if ($coupon == null){
                return redirect()->back();
            }

        }
        $order = Order::query()->where('user_id',Auth::user()->id)->where('order_status',0)->where('coupon_id',null)->first();
        if ($order){
            if ($coupon->amount_type == 0){
                $couponDiscountAmount = $order->order_final_amount * ($coupon->amount / 100);
                if ($couponDiscountAmount > $coupon->discount_ceiling){
                    $couponDiscountAmount = $coupon->discount_ceiling;
                }
            }
            else{
                $couponDiscountAmount = $coupon->amount;
                if ($couponDiscountAmount > $coupon->discount_ceiling){
                    $couponDiscountAmount = $coupon->discount_ceiling;
                }
            }
            $order->order_final_amount = $order->order_final_amount - $couponDiscountAmount;
            $order->coupon_id= $coupon->id;
            $order->order_coupon_discount_amount = $couponDiscountAmount;
            $order->order_total_products_discount_amount += $couponDiscountAmount;
            $order->save();
        }
        return redirect()->back()->with(['coupon'=>'کد تخفیف با موفقیت اعمال شد']);

    }

    public function paymentSubmit(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'payment_type'=>'required'
        ]);
        $order = Order::query()->where('user_id',Auth::user()->id)->where('order_status',0)->first();
        $cash_receiver = null;
        $cartItems = CartItem::query()->where('user_id',$user->id)->get();
        switch ($request->payment_type){
            case '1':
                $target = OnlinePayment::class;
                $type = 0;
                break;
            case '2':
                $target = OfflinePayment::class;
                $type = 1;
                break;
            case '3':
                $target = CashPayment::class;
                $type = 2;
                $cash_receiver = $request->cash_receiver ?? null;
                break;
            default:
                return redirect()->back();
        }
        $paymented = $target::create([
            'amount'=>$order->order_final_amount,
            'user_id'=>$user->id,
            'cash_receiver'=>$request->cash_receiver,
            'pay_date'=>now(),
            'status'=>1,
        ]);

        $payment = Payment::query()->create([
            'amount'=>$order->order_final_amount,
            'user_id'=>$user->id,
            'type'=>$type,
            'paymentable_id'=>$paymented->id,
            'paymentable_type'=>$target,
            'status'=>1,
        ]);

        $order->order_status = 2;
        $order->save();
        foreach ($cartItems as $cartItem){
            OrderItem::query()->create([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->product_id,
                'product'=>$cartItem->product,
                'amazing_sale_id'=>$cartItem->product->activeAmazingSales()->id ?? null,
                'amazing_sale_object'=>$cartItem->product->activeAmazingSales() ?? null,
                'amazing_sale_discount_amount'=>$cartItem->cartItemProductDiscount() ?? 0,
                'number'=>$cartItem->number,
                'final_product_price'=>($cartItem->cartItemProductPrice()) - ($cartItem->product->activeAmazingSales() ? $cartItem->cartItemProductPrice() * $cartItem->product->activeAmazingSales()->percentage / 100 : 0) ,
                'final_total_price'=>(($cartItem->cartItemProductPrice()) - ($cartItem->product->activeAmazingSales() ? $cartItem->cartItemProductPrice() * $cartItem->product->activeAmazingSales()->percentage / 100 : 0) * $cartItem->number),
                'color_id'=>$cartItem->color_id,
                'guarantee_id'=>$cartItem->guarantee_id,
            ]);
            $cartItem->delete();
        }

        return redirect()->route('customer.home')->with('swal-success','سفارش شما با موفقیت ثبت شد');


    }
}
