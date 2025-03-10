<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','logo','icon','keywords'];
    protected $casts = ['logo'=>'array','icon'=>'array'];
}
