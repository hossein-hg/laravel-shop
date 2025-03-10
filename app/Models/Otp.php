<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $fillable = ['login_id','user_id','token','type','otp_code','used'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
