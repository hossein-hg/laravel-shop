<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name','url','status','parent_id'];

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id','id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Menu::class,'parent_id','id')->with('children');
    }
}
