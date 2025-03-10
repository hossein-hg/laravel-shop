<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    public function index()
    {
        $admins = User::query()->where('user_type',1)->get();
        return view('admin.ticket.admin.index',compact('admins'));
    }

    public function set(User $admin)
    {
        if (TicketAdmin::query()->where('user_id',$admin->id)->first()){

            TicketAdmin::query()->where('user_id',$admin->id)->forceDelete();
            return response()->json([
                'status'=>true,
                'toggle'=>false
            ]);
        }
        else{

            TicketAdmin::query()->create([
                'user_id'=>$admin->id
            ]);
            return response()->json([
                'status'=>true,
                'toggle'=>true
            ]);
        }

    }
}
