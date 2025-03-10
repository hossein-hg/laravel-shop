<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CouponRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Coupon;
use App\Models\Market\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon()
    {
        $coupons = Coupon::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.coupon',compact('coupons'));
    }

    public function couponCreate()
    {
        $users = User::all();
        return view('admin.market.discount.coupon-create',compact('users'));
    }

    public function couponStore(CouponRequest $request)
    {
        $inputs = $request->all();
        $request->start_date = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$request->start_date);

        $request->end_date = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$request->end_date);

        $coupon = Coupon::query()->create($inputs);
        return redirect()->route('admin.market.discount.coupon')->with('swal-success','کوپن با موفقیت ساخته شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCoupon(Coupon $coupon)
    {
        $users = User::all();
        return view('admin.market.discount.coupon-edit',compact(['users','coupon']));
    }



    public function couponUpdate(Coupon $coupon,CouponRequest $request)
    {
        $inputs = $request->all();
        $request->start_date = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$request->start_date);

        $request->end_date = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$request->end_date);

        $coupon->update($inputs);
        return redirect()->route('admin.market.discount.coupon')->with('swal-success','کوپن با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function couponDestroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json([
            'status'=>true
        ]);
    }

    public function couponStatus(Coupon $coupon)
    {
        $coupon->status = $coupon->status == 0 ? 1 : 0;
        $result = $coupon->save();
        if ($result){
            if ($coupon->status == 0){
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

    public function commonDiscount()
    {
        $commonsDiscounts = CommonDiscount::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.common',compact('commonsDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commonStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        $request->start_date = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$request->start_date);

        $request->end_date = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$request->end_date);
        $common = CommonDiscount::query()->create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی با موفقیت ساخته شد');

    }

    public function editCommon(CommonDiscount $commonDiscount)
    {

        return view('admin.market.discount.common-edit',compact('commonDiscount'));
    }

    public function commonUpdate(CommonDiscount $commonDiscount,CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        $request->start_date = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$request->start_date);

        $request->end_date = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$request->end_date);
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی با موفقیت ویرایش شد');
    }

    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
        return response()->json([
            'status'=>true
        ]);
    }

    public function commonDiscountStatus(CommonDiscount $commonDiscount)
    {
        $commonDiscount->status = $commonDiscount->status == 0 ? 1 : 0;
        $result = $commonDiscount->save();
        if ($result){
            if ($commonDiscount->status == 0){
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

    public function amazingSale()
    {
        $amazingSales = AmazingSale::query()->orderBy('created_at','desc')->simplePaginate(15);
        return view('admin.market.discount.amazing',compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-create',compact('products'));
    }

    public function amazingStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $request->start_date = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$request->start_date);

        $request->end_date = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$request->end_date);
        $amazing = AmazingSale::query()->create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success','تخفیف شگفت انگیز با موفقیت ساخته شد');
    }

    public function editAmazing(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-edit',compact(['products','amazingSale']));
    }

    public function amazingUpdate(AmazingSale $amazingSale,AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $request->start_date = substr($request->start_date,0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$request->start_date);

        $request->end_date = substr($request->end_date,0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$request->end_date);
        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success','تخفیف شگفت انگیز با موفقیت ویرایش شد');
    }





    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return response()->json([
            'status'=>true
        ]);
    }





    public function amazingSaleStatus(AmazingSale $amazingSale)
    {
        $amazingSale->status = $amazingSale->status == 0 ? 1 : 0;
        $result = $amazingSale->save();
        if ($result){
            if ($amazingSale->status == 0){
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
