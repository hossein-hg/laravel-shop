<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function answers()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }

    protected $fillable = ['body','commentable_id','commentable_type','status','approved','seen','author_id','parent_id'];

}
