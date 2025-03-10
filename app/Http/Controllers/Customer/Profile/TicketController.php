<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;

use App\Http\Services\File\FileService;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketFile;
use App\Models\Ticket\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\Customer\Profile\TicketRequest;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::query()->where('ticket_id',null)->where('user_id',Auth::user()->id)->get();
        return view('customer.profile.tickets.my-tickets',compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('customer.profile.tickets.my-tickets-show',compact('ticket'));
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

        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['status'] = 0;
        $inputs['seen'] = 0;
        $inputs['user_id'] = Auth::user()->id;

        $inputs['category_id'] = $ticket->category->id;
        $inputs['priority_id'] = $ticket->priority->id;
        $inputs['ticket_id'] = $ticket->id;
        $create = Ticket::query()->create($inputs);
        return redirect()->back()->with('swal-success','تیکت با موفقیت پاسخ داده شد');
    }

    public function create()
    {
        $categories = TicketCategory::all();
        $priorities = TicketPriority::all();
        return view('customer.profile.tickets.create',compact('categories','priorities'));
    }

    public function store(TicketRequest $request,FileService $fileService)
    {
        $inputs = $request->all();

        DB::transaction(function ()use ($inputs,$request,$fileService){
            $ticket = Ticket::query()->create([
                'priority_id'=>$inputs['priority_id'],
                'category_id'=>$inputs['category_id'],
                'subject'=>$inputs['subject'],
                'description'=>$inputs['description'],
                'user_id'=>Auth::user()->id,
                'seen'=>0,
            ]);

            if ($request->hasFile('file')){
                $fileService->setExclusiveDirectory('files'.DIRECTORY_SEPARATOR.'ticket-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
                $fileFormat = $fileService->getFileFormat();
                if (!$result){
                    return redirect()->back()->with('swal-error','فایل آپلود نشد!');
                }
                $fileInputs['ticket_id'] = $ticket->id;
                $fileInputs['file_path'] = $result;
                $fileInputs['file_size'] = $fileSize;
                $fileInputs['file_type'] = $fileFormat;
                $fileInputs['user_id'] = Auth::user()->id;

                $create = TicketFile::query()->create($fileInputs);
                if (!$create){
                    return redirect()->back()->with('swal-error','خطایی رخ داد!');
                }
            }
        });

        return to_route('customer.profile.my-tickets');


    }
}
