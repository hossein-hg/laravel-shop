<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'faqs';

    protected $fillable = ['question','answer','slug','tags','status'];
    use SoftDeletes;
    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>'question'
            ]
        ];
    }
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }
}
