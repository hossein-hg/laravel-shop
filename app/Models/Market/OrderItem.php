<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function productName()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function amazingSale()
    {
        return $this->belongsTo(AmazingSale::class,'amazing_sale_id');
    }

    public function orderItemSelectedAttributes()
    {
        return $this->hasMany(OrderItemSelectedAttribute::class,'order_item_id');
    }

    
}
