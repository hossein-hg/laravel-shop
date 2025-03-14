<?php

namespace App\Models;

use App\Models\Market\Address;
use App\Models\Market\Compare;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Product;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Traits\Permissions\HasPermissionsTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;


class User extends Authenticatable
{

    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Sluggable;
    use HasPermissionsTrait;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'last_name'
            ]
        ];
    }

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class,'user_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'status',
        'mobile',
        'national_code',
        'first_name',
        'last_name',
        'slug',
        'activation',
        'activation_date',
        'user_type',
        'profile_photo_path',
        'email_verified_at',
        'mobile_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function isUserPurchedProduct($product_id)
    {
        $productIDs = collect();
        $orderItems = $this->orderItems;
        foreach ($orderItems->where('product_id',$product_id) as $item){
                $productIDs->push($item->product_id);
        }
        $productIDs = $productIDs->unique();
        return $productIDs->count();
    }

    public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class,Order::class);
    }

    public function compare()
    {
        return $this->hasOne(Compare::class);
    }


}
