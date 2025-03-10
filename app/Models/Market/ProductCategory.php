<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory,SoftDeletes;

    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $fillable = ['name','description','slug','image','status','tags','show_in_menu','parent_id'];
    protected $casts = ['image'=>'array'];

    protected $table = 'product_categories';

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class,'parent_id')->with('parent');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

}
