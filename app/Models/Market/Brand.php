<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['persian_name','original_name','slug','logo','tags','status'];
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'persian_name',
            ]
        ];
    }
    protected $casts = ['logo'=>'array'];
}
