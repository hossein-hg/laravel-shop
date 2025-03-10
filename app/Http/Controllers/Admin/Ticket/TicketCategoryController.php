<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $categories = TicketCategory::query()->orderBy('created_at','desc')->paginate(15);
        return view('admin.ticket.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.ticket.category.create');
    }

    public function store(TicketCategoryRequest $request)
    {
        $inputs = $request->all();
        $create = TicketCategory::query()->create($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success','دسته بندی با موفقیت ساخته شد');
    }

    public function edit(TicketCategory $category)
    {
        return view('admin.ticket.category.edit',compact('category'));
    }

    public function update(TicketCategoryRequest $request,TicketCategory $category)
    {
        $inputs = $request->all();
        $update = $category->update($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success','دسته بندی با موفقیت ویرایش شد');
    }

    public function destroy(TicketCategory $category)
    {
        $category->delete();
        return response()->json([
            'status'=>true,

        ]);
    }

    public function status(TicketCategory $category)
    {
        $category->status = $category->status == 0 ? 1 : 0;
        $result = $category->save();
        if ($result){
            if ($category->status == 0){
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
