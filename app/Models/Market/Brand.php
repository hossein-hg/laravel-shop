<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>'persian_name'
            ]
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }

    protected $casts = ['logo'=>'array'];
    protected $fillable = ['persian_name','original_name','status','logo','slug','tags'];


}
