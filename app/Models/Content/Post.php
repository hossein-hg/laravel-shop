<?php

namespace App\Models\Content;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,Sluggable;
    protected $table = 'posts';
    protected $fillable = ['title','body','image','summary','status','tags','commentable','slug','published_at','author_id','category_id'];

    public function category()
    {
        return $this->belongsTo(PostCategory::class,'category_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

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

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }



    protected $casts = ['image'=>'array'];
    use SoftDeletes;
}
