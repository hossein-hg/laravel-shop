<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;

class TicketPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketPriorities = TicketPriority::query()->latest()->paginate(15);
        return view('admin.ticket.priority.index',compact('ticketPriorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketPriorityRequest $request)
    {
        $inputs = $request->all();
        TicketPriority::query()->create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success','اولویت با موفقیت افزوده شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketPriority $priority)
    {
        return view('admin.ticket.priority.edit',compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketPriorityRequest $request, TicketPriority $priority)
    {
        $inputs = $request->all();
        $priority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success','اولویت با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketPriority $priority)
    {
        $priority->delete();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success','اولویت با موفقیت حذف شد');
    }

    public function status(TicketPriority $priority)
    {
        $priority->status = $priority->status == 0 ? 1 : 0;
        $result = $priority->save();
        if ($result)
        {
            if ($priority->status == 0)
            {
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
                'status'=>false,
            ]);
        }
    }
}
