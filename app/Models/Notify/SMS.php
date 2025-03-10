<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMS extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title','body','status','published_at'];
    protected $table = 'public_sms';
}
