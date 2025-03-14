<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class,'province_id');
    }
}
