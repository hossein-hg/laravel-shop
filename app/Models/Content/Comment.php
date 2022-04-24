<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['body','status','seen','approved','parent_id','author_id','commentable_id','commentable_type'];

    public function user()
    {
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }


    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }

}
