<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>'title'
            ]
        ];
    }
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }
    protected $table = 'pages';
    protected $fillable = ['title','body','slug','status','tags'];

}
