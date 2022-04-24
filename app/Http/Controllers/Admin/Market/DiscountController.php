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
    public function coupon()
    {
        $coupons = Coupon::query()->latest()->simplePaginate(15);
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
        $inputs['start_date'] = substr($inputs['start_date'],0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$inputs['start_date']);

        $inputs['end_date'] = substr($inputs['end_date'],0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$inputs['end_date']);

        $inputs['type'] == 1 ? $inputs['user_id'] = $request->user_id : $inputs['user_id'] = null;
        Coupon::query()->create($inputs);
        return redirect()->route('admin.market.discount.coupon')->with('swal-success','کوپن با موفقیت ساخته شد');
    }
    public function couponEdit(Coupon $coupon)
    {
        $users = User::all();
        return view('admin.market.discount.coupon-edit',compact('coupon','users'));
    }
    public function couponUpdate(CouponRequest $request,Coupon $coupon)
    {
        $inputs = $request->all();
        $inputs['start_date'] = substr($inputs['start_date'],0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$inputs['start_date']);

        $inputs['end_date'] = substr($inputs['end_date'],0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$inputs['end_date']);

        $inputs['type'] == 1 ? $inputs['user_id'] = $request->user_id : $inputs['user_id'] = null;
        $coupon->update($inputs);
        return redirect()->route('admin.market.discount.coupon')->with('swal-success','کوپن با موفقیت ویرایش شد');
    }
    public function couponDestroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('swal-success','کوپن با موفقیت حذف شد');
    }

    public function couponStatus(Coupon $coupon)
    {
        $coupon->status = $coupon->status == 0 ? 1 : 0;
        $result = $coupon->save();
        if ($result)
        {
            if ($coupon->status == 0)
            {
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
                'status'=>false,
            ]);
        }
    }
    public function commonDiscount()
    {
        $commonDiscount = CommonDiscount::query()->latest()->get();
        return view('admin.market.discount.common',compact('commonDiscount'));
    }
    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-create');
    }


    public function amazingSale()
    {
        $amazingSales = AmazingSale::query()->latest()->simplePaginate(15);
        return view('admin.market.discount.amazing',compact('amazingSales'));
    }
    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-create',compact('products'));
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-edit',compact('amazingSale','products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request,AmazingSale $amazingSale)
    {
        $inputs = $request->all();
        $inputs['start_date'] = substr($inputs['start_date'],0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$inputs['start_date']);

        $inputs['end_date'] = substr($inputs['end_date'],0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$inputs['end_date']);

        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success','فروش شگفت انگیز با موفقیت ویرایش شد');
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $inputs['start_date'] = substr($inputs['start_date'],0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$inputs['start_date']);

        $inputs['end_date'] = substr($inputs['end_date'],0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$inputs['end_date']);

        AmazingSale::query()->create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success','فروش شگفت انگیز با موفقیت ساخته شد');
    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return back()->with('swal-success','فروش شگفت انگیز با موفقیت حذف شد');
    }
    public function commonDiscountEdit(CommonDiscount $discount)
    {
        return view('admin.market.discount.common-edit',compact('discount'));
    }

    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        $inputs['start_date'] = substr($inputs['start_date'],0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$inputs['start_date']);

        $inputs['end_date'] = substr($inputs['end_date'],0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$inputs['end_date']);

        CommonDiscount::query()->create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی با موفقیت ساخته شد');
    }

    public function commonDiscountUpdate(CommonDiscountRequest $request,CommonDiscount $discount)
    {
        $inputs = $request->all();
        $inputs['start_date'] = substr($inputs['start_date'],0,10);
        $inputs['start_date'] = date('Y-m-d H:i:s',(int)$inputs['start_date']);

        $inputs['end_date'] = substr($inputs['end_date'],0,10);
        $inputs['end_date'] = date('Y-m-d H:i:s',(int)$inputs['end_date']);

        $discount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success','تخفیف عمومی با موفقیت ویرایش شد');
    }

    public function commonDiscountDestroy(CommonDiscount $discount)
    {
        $discount->delete();
        return back()->with('swal-success','تخفیف عمومی با موفقیت حذف شد');
    }

    public function amazingSaleStatus(AmazingSale $amazingSale)
    {
        $amazingSale->status = $amazingSale->status == 0 ? 1 : 0;
        $result = $amazingSale->save();
        if ($result)
        {
            if ($amazingSale->status == 0)
            {
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
                'status'=>false,
            ]);
        }
    }
    public function commonDiscountStatus(CommonDiscount $discount)
    {
        $discount->status = $discount->status == 0 ? 1 : 0;
        $result = $discount->save();
        if ($result)
        {
            if ($discount->status == 0)
            {
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
                'status'=>false,
            ]);
        }
    }
}
