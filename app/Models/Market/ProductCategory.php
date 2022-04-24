<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    protected $table = 'product_categories';
    protected $fillable = ['name','slug','description','image','tags','status','show_in_menu','parent_id'];

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

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class,'parent_id')->with('parent');
    }
    protected $casts = ['image'=>'array'];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
