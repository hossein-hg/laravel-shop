<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlinePayment extends Model
{
    use HasFactory,SoftDeletes;
    public function payments()
    {
        return $this->morphMany(Payment::class,'paymentable');
    }
    protected $fillable = ['amount','transaction_id','pay_date','status','user_id','gate_way','bank_first_response','bank_second_response'];
}
