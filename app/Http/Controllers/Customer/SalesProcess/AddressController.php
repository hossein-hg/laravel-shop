<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\ChooseAddressAndDeliveryRequest;
use App\Http\Requests\Customer\SalesProcess\StoreAddressRequest;
use App\Http\Requests\Customer\SalesProcess\UpdateAddressRequest;
use App\Models\Market\Address;
use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use App\Models\Market\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\convertArabicToEnglish;
use function App\Helpers\convertPersianToEnglish;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('profileCompletion');
    }
    public function addressAndDelivery()
    {
        $user = Auth::user();
        if (empty(CartItem::query()->where('user_id',$user->id)->count())){
            return redirect()->route('customer.sales-process.cart');
        }
        $cartItems = CartItem::query()->where('user_id',$user->id)->get();
        $addresses = Address::query()->where('user_id',$user->id)->orderBy('created_at','desc')->simplePaginate(15);
        $provinces = Province::all();
        $deliveries = Delivery::query()->where('status',1)->get();
        return view('customer.market.sales-process.address',compact('user','cartItems','addresses','provinces','deliveries'));
    }

    public function addAddress(StoreAddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['postal_code'] = convertPersianToEnglish($request->postal_code);
        $inputs['postal_code'] = convertArabicToEnglish($inputs['postal_code']);

        Address::query()->create($inputs);
        return redirect()->back();
    }

    public function getCities(Province $province)
    {
        $cities = $province->cities()->get();
        if ($cities){
            return response()->json([
                'cities'=>$cities,
                'status'=>true
            ]);
        }
        else{
            return response()->json([
                'cities'=>null,
                'status'=>false
            ]);
        }


    }

    public function updateAddress(Address $address,UpdateAddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['postal_code'] = convertPersianToEnglish($request->postal_code);
        $inputs['postal_code'] = convertArabicToEnglish($inputs['postal_code']);

        $address->update($inputs);
        return redirect()->back();
    }

    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request)
    {
        $user = Auth::user();

        $cartItems = CartItem::query()->where('user_id',$user->id)->get();
        $totalProductPrice = 0;
        $totalDiscount = 0;
        $totalFinalPrice = 0;
        $totalFinalDiscountPriceWithNumbers = 0;

        foreach ($cartItems as $cartItem){
            $totalProductPrice += $cartItem->cartItemProductPrice();
            $totalDiscount += $cartItem->cartItemProductDiscount();
            $totalFinalPrice += $cartItem->cartItemProductFinalPrice();
            $totalFinalDiscountPriceWithNumbers += $cartItem->cartItemProductFinalDiscount();
        }

        $commonDiscount = CommonDiscount::query()->where('status',1)->where('end_date','>',Carbon::now())->where('start_date','<',Carbon::now())->first();

        if ($commonDiscount){
            $commonPercentageDiscountAmount = $totalFinalPrice * ($commonDiscount->percentage / 100);
            if ($commonPercentageDiscountAmount > $commonDiscount->discount_ceiling){
                $commonPercentageDiscountAmount = $commonDiscount->discount_ceiling;
            }

        }
        else{
            $commonPercentageDiscountAmount = 0;
        }

        if ($commonDiscount != null and $totalFinalPrice >= $commonDiscount->minimal_order_amount){
            $finalPrice = $totalFinalPrice - $commonPercentageDiscountAmount;

        }
        else{
            $finalPrice = $totalFinalPrice;
        }

        $order = Order::query()->updateOrCreate(
            [
                'user_id'=>$user->id,
                'order_status'=>0
            ]
            ,
            [
                 'address_id'=>$request->address_id,
                 'common_discount_id'=>$commonDiscount->id,
                 'user_id'=>$user->id,
                 'delivery_id'=>$request->delivery_id,
                 'order_final_amount'=>$finalPrice,
                 'order_discount_amount'=>$totalFinalDiscountPriceWithNumbers,
                 'order_common_discount_amount'=>$commonPercentageDiscountAmount,
                 'order_total_products_discount_amount'=>$commonPercentageDiscountAmount+$totalFinalDiscountPriceWithNumbers,
             ]
        );
        return redirect()->route('customer.sales-process.payment');
    }
}
