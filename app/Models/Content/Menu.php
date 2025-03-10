<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['url','parent_id','name','status'];
    protected $table = 'menus';

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id')->with('parent');
    }


}
