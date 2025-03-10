<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;

class TicketPriorityController extends Controller
{
    public function index()
    {
        $priorities = TicketPriority::query()->orderBy('created_at','desc')->paginate(15);
        return view('admin.ticket.priority.index',compact('priorities'));
    }

    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    public function store(TicketPriorityRequest $request)
    {
        $inputs = $request->all();
        $create = TicketPriority::query()->create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success','اولویت با موفقیت ساخته شد');
    }

    public function edit(TicketPriority $priority)
    {
        return view('admin.ticket.priority.edit',compact('priority'));
    }

    public function update(TicketPriorityRequest $request,TicketPriority $priority)
    {
        $inputs = $request->all();
        $update = $priority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success','اولویت با موفقیت ویرایش شد');
    }

    public function destroy(TicketPriority $priority)
    {
        $priority->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(TicketPriority $priority)
    {
        $priority->status = $priority->status == 0 ? 1 : 0;
        $result = $priority->save();
        if ($result){
            if ($priority->status == 0){
                return response()->json([
                    'status'=>true,
                    'checked'=>false
                ]);
            }
            else{
                return response()->json([
                    'status'=>true,
                    'checked'=>true
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>false
            ]);
        }

    }
}
