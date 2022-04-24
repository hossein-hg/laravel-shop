<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['images','product_id'];
    protected $table = 'product_images';
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $casts = ['images'=>'array'];
}
