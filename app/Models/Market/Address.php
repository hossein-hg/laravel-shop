<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','province_id','user_id','city_id','postal_code','no','unit','recipient_first_name','recipient_last_name','mobile','address','status'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
