<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code','amount','amount_type','discount_ceiling','type','status','user_id','start_date','end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
