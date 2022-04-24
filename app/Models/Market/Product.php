<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>'name'
            ]
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }
    protected $fillable= ['name','introduction','slug','image','weight','length','width','height','price','status','sold_number','frozen_number','marketable_number','marketable','tags','brand_id','category_id','published_at'];
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
    protected $casts = ['image'=>'array'];

    public function metas()
    {
        return $this->hasMany(ProductMeta::class,'product_id');
    }
}
