<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::query()->where('user_type',1)->get();
        return view('admin.ticket.admin.index',compact('admins'));
    }

    public function set(User $admin)
    {

        if ($admin->ticketAdmin)
        {
            $admin->ticketAdmin->delete();
            return redirect()->route('admin.ticket.admin.index')->with('swal-success','ادمین با موفقیت از لیست ادمین های تیکت حذف شد');
        }
        else{
            TicketAdmin::query()->create([
                'user_id'=>$admin->id,
            ]);
            return redirect()->route('admin.ticket.admin.index')->with('swal-success','ادمین با موفقیت به لیست ادمین های تیکت اضافه شد');
        }
    }

}
