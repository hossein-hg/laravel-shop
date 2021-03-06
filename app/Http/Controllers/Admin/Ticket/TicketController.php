<?php

namespace App\Http\Controllers\admin\ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function newTickets()
    {
        $tickets = Ticket::query()->where('seen',0)->get();
        foreach ($tickets as $ticket)
        {
            $ticket->seen = 1;
            $ticket->save();
        }
        return view('admin.ticket.index',compact('tickets'));
    }

    public function openTickets()
    {
        $tickets = Ticket::query()->where('status',0)->get();
        return view('admin.ticket.index',compact('tickets'));
    }

    public function closeTickets()
    {
        $tickets = Ticket::query()->where('status',1)->get();
        return view('admin.ticket.index',compact('tickets'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::query()->latest()->paginate(15);

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
    public function show (Ticket $ticket)
    {
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

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status ? 0 : 1;
        $ticket->save();
        return back()->with('toast-success','?????????? ???????? ???? ???????????? ?????????? ??????');
    }

    public function answer(Ticket $ticket,TicketRequest $request)
    {

        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['seen'] = 1;
        $inputs['author_id'] = 5;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::query()->create($inputs);
        return redirect()->route('admin.ticket.index')->with('toast-success',' ???????? ???? ????????????  ???????? ???????? ????');
    }
}
