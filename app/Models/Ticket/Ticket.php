<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['subject','description','status','seen','author_id','reference_id','category_id','priority_id','ticket_id'];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class,'reference_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function parent()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
