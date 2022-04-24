<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflinePayment extends Model
{
    use HasFactory;
    protected $fillable = ['amount','user_id','gateway','transaction_id','pay_date','status'];
    public function payments()
    {
        return $this->morphMany(Payment::class,'paymentable');
    }
}
