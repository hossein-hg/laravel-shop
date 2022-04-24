<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use Illuminate\Http\Request;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email)
    {
        return view('admin.notify.email-file.index',compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        return view('admin.notify.email-file.create',compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request,Email $email,FileService $fileService)
    {
        $file = $request->file('file');
        $inputs = $request->all();
        if ($file)
        {
            $fileService->setExclusiveDirectory('files'.DIRECTORY_SEPARATOR.'email-file');
            $fileService->setFileSize($file);
            $fileSize = $fileService->getFileSize();
            $result = $fileService->moveToPublic($file);
            $fileFormat = $fileService->getFileFormat();
            if (!$result)
            {
                return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error','آپلود عکس با خطا مواجه شد');
            }
            $inputs['public_mail_id'] = $email->id;
            $inputs['file_type'] = $fileFormat;
            $inputs['file_size'] = $fileSize;
            $inputs['file_path'] = $result;
            EmailFile::query()->create($inputs);
            return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-success','فایل با موفقیت آپلود شد');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailFile $emailFile)
    {

        return view('admin.notify.email-file.edit',compact('emailFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailFile $emailFile,FileService $fileService)
    {
        $file = $request->file('file');
        $inputs = $request->all();
        if ($file)
        {

            $fileService->deleteFile($emailFile->file_path);
            $fileService->setExclusiveDirectory('files'.DIRECTORY_SEPARATOR.'email-file');
            $fileService->setFileSize($file);
            $fileSize = $fileService->getFileSize();
            $result = $fileService->moveToPublic($file);
            $fileFormat = $fileService->getFileFormat();
            if (!$result)
            {
                return redirect()->route('admin.notify.email-file.index',[$emailFile->email->id])->with('swal-error','آپلود عکس با خطا مواجه شد');
            }
            $inputs['file_type'] = $fileFormat;
            $inputs['file_size'] = $fileSize;
            $inputs['file_path'] = $result;
        }

        $inputs['public_mail_id'] = $emailFile->email->id;

        $emailFile->update($inputs);
        return redirect()->route('admin.notify.email-file.index',[$emailFile->email->id])->with('swal-success','فایل با موفقیت آپلود شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $emailFile)
    {
        $emailFile->delete();
        return  back()->with('swal-success','فایل با موفقیت حذف شد');
    }

    public function status(EmailFile $emailFile)
    {
        $emailFile->status = $emailFile->status == 1 ? 0 : 1;
        $result = $emailFile->save();
        if ($result)
        {
            if ( $emailFile->status == 1){
                return response()->json([
                    'status'=>true,
                    'checked'=>true,
                ]);
            }
            else{
                return response()->json([
                    'status'=>true,
                    'checked'=>false,
                ]);
            }

        }
        else{
            return response()->json([
                'status'=>false,
                'checked'=>false,
            ]);
        }
    }
}
