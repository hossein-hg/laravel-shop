<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','address_id','address_object','payment_id','payment_object','payment_type','payment_status','delivery_id','delivery_object','delivery_amount','delivery_status','delivery_date','order_final_amount','order_discount_amount','coupon_id','coupon_id_object','order_coupon_discount_amount','common_discount_id','common_discount_object','order_common_discount_amount','order_total_products_discount_amount','order_status'];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentStatus()
    {
        switch ($this->payment_status){
            case 0:
                return 'پرداخت نشده';
            case 1:
                return 'پرداخت شده';
            case 2:
                return 'باطل شده';
            case 3:
                return 'برگشت داده شده';
        }
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class,'common_discount_id');
    }

    public function paymentType()
    {
        switch ($this->payment_type){
            case 0:
                return 'آنلاین';
            case 1:
                return 'آفلاین';
            case 2:
                return 'در محل';

        }
    }

    public function deliveryStatus()
    {
        switch ($this->delivery_status){
            case 0:
                return 'ارسال نشده';
            case 1:
                return 'در حال ارسال';
            case 2:
                return 'ارسال شده';
            case 3:
                return 'تحویل شده';
        }
    }

    public function orderStatus()
    {
        switch ($this->order_status){
            case 0:
                return 'در انتظار تایید';
            case 1:
                return 'تایید نشده';
            case 2:
                return 'تایید شده';
            case 3:
                return 'باطل شده';
            case 4:
                return 'مرجوعی';
            case 5:
                return 'بررسی نشده';

        }
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);

    }
}
