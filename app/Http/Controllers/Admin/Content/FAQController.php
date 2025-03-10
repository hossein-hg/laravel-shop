<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FaqRequest;
use App\Models\Content\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::query()->orderBy('created_at','desc')->paginate(15);
        return view('admin.content.faq.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.faq.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $create = Faq::query()->create($inputs);
        if ($create){
            return redirect()->route('admin.content.faq.index')->with('swal-success','پرسش با موفقیت اضافه شد');
        }
        else{
            return redirect()->route('admin.content.faq.index')->with('swal-error','خطایی رخ داد');
        }
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
     * @param Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.content.faq.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FaqRequest $request
     * @param Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $inputs = $request->all();

        $update = $faq->update($inputs);
        if ($update){
            return redirect()->route('admin.content.faq.index')->with('swal-success','پرسش با موفقیت ویرایش شد');
        }
        else{
            return redirect()->route('admin.content.faq.index')->with('swal-error','خطایی رخ داد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faq $faq
     * @return void
     */
    public function destroy(Faq $faq)
    {
        $delete = $faq->delete();
        if ($delete){
            return response()->json([
                'status'=>true,
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
            ]);
        }

    }

    public function status(Faq $faq)
    {
        $faq->status = $faq->status == 1 ? 0 : 1;
        $result = $faq->save();
        if ($result){
            if ($faq->status == 1){
                return response()->json([
                    'status'=>1,
                    'checked'=>1,
                ]);
            }
            else{
                return response()->json([
                    'status'=>1,
                    'checked'=>0,
                ]);
            }
        }
        else{
            return response()->json([
                'status'=>0,
            ]);
        }
    }
}
