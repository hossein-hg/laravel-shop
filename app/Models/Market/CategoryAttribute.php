<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttribute extends Model
{
    use HasFactory;
    protected $table = 'category_attributes';
    protected $fillable = ['name','type','unit','category_id'];
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
