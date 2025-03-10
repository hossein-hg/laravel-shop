<?php

namespace Modules\Post\Entities;

use App\Models\Content\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ContentCategory\Entities\PostCategory;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class,'category_id');
    }
    protected $fillable = ['title','summary','body','slug','image','status','tags','commentable','author_id','category_id','published_at'];
    protected $casts = ['image'=>'array'];
}
