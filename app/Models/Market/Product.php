<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
    protected $fillable = ['name','slug','status','tags','introduction','sold_number','frozen_number','marketable_number','marketable','image','weight','length','height','price','category_id','brand_id','published_at','width'];
    protected $casts = ['image'=>'array'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class,'product_id');
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class,'product_id');
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class,'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function activeAmazingSales()
    {
        return $this->amazingSales()->where('start_date','<=',Carbon::now())->where('end_date','>=',Carbon::now())->where('status',1)->first();
    }

    public function approvedComments()
    {
        return $this->comments()->whereNull('parent_id')->where('approved',1)->get();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function compares()
    {
        return $this->belongsToMany(Compare::class);
    }


}
