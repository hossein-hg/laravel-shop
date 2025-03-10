<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::query()->where('ticket_id',null)->orderBy('created_at','desc')->paginate(15);
        return view('admin.ticket.index',compact('tickets'));
    }

    public function newTickets()
    {
        $tickets = Ticket::query()->orderBy('created_at','desc')->where('seen',0)->paginate(15);
        return view('admin.ticket.index',compact('tickets'));

    }

    public function openTickets()
    {
        $tickets = Ticket::query()->orderBy('created_at','desc')->where('status',0)->paginate(15);
        return view('admin.ticket.index',compact('tickets'));

    }

    public function closeTickets()
    {
        $tickets = Ticket::query()->orderBy('created_at','desc')->where('status',1)->paginate(15);
        return view('admin.ticket.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticket->seen = 1;
        $ticket->save();
        return view('admin.ticket.show',compact('ticket'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $result = $ticket->save();
        if ($result){
            if ($ticket->status == 0){
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

    public function answer(TicketRequest $request,Ticket $ticket)
    {
        $user = Auth::user();

        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['status'] = 0;
        $inputs['seen'] = 1;
        $inputs['user_id'] = $ticket->user_id;
        $inputs['reference_id'] = $user->ticketAdmin->id;
        $inputs['category_id'] = $ticket->category->id;
        $inputs['priority_id'] = $ticket->priority->id;
        $inputs['ticket_id'] = $ticket->id;
        $create = Ticket::query()->create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success','تیکت با موفقیت پاسخ داده شد');

    }
}
