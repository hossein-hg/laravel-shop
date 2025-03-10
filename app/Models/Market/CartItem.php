<?php

namespace App\Models\Market;

use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','product_id','guarantee_id','number','color_id'];

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItemProductPrice()
    {
        $guaranteePriceIncrease = empty($this->guarantee_id) ? '0' : $this->guarantee->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? '0' : $this->color->price_increase;
        $productPrice = $this->product->price;
        return $guaranteePriceIncrease+$colorPriceIncrease+$productPrice;
    }

    public function cartItemProductDiscount()
    {
        $cartItemProductPrice = $this->cartItemProductPrice();
        $productDiscount = empty($this->product->activeAmazingSales()) ? 0 : $this->product->activeAmazingSales()->percentage;

        return $productDiscount != 0 ? $cartItemProductPrice * ($productDiscount / 100) : 0;
    }

    public function cartItemProductFinalPrice()
    {
        $number = $this->number;

        return $number * ($this->cartItemProductPrice() - $this->cartItemProductDiscount());
    }

    public function cartItemProductFinalDiscount()
    {
        $number = $this->number;
        return $number * ($this->cartItemProductDiscount());
    }


}
