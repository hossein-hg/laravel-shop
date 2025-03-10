<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['amount','user_id','status','type','paymentable_id','paymentable_type'];

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function typePayment()
    {
        switch ($this->type){
            case 0:
                return 'آنلاین';
            case 1:
                return 'آفلاین';
            case 2:
                return 'نقدی';
        }
    }

    public function paymentStatus()
    {
        switch ($this->status){
            case 0:
                return 'پرداخت نشده';
            case 1:
                return 'پرداخت شده';
            case 2:
                return 'کنسل شده';
            case 3:
                return 'مرجوع شده';
        }
    }
}
