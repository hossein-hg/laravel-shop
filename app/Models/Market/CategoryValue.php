<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryValue extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['value','type','product_id','category_attribute_id'];

    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class,'category_attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
