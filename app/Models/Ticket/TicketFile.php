<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketFile extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
