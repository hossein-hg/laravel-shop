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
        $files =$email->files()->orderBy('created_at','desc')->paginate(15);

        return view('admin.notify.email-file.index',compact(['email','files']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        return view('admin.notify.email-file.create',compact(['email']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request,Email $email,FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')){
            $fileService->setExclusiveDirectory('files'.DIRECTORY_SEPARATOR.'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            $result = $fileService->moveToPublic($request->file('file'));
            $fileFormat = $fileService->getFileFormat();
            if (!$result){
                return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error','فایل آپلود نشد!');
            }
            $inputs['public_mail_id'] = $email->id;
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;

            $create = EmailFile::query()->create($inputs);
            if ($create){
                return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-success','فایل با موفقیت ساخته شد');
            }
            return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error','خطایی رخ داد!');

        }
        else{
            return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error','خطایی رخ داد!');
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
    public function edit(EmailFile $file)
    {
        return view('admin.notify.email-file.edit',compact(['file']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, EmailFile $file,FileService $fileService)
    {

        $email = $file->email;
        $inputs = $request->all();
        if ($request->hasFile('file')){
            if (!empty($file->file_path)){
                $fileService->deleteFile($file->file_path);
            }

            $fileService->setExclusiveDirectory('files'.DIRECTORY_SEPARATOR.'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            $result = $fileService->moveToPublic($request->file('file'));
            $fileFormat = $fileService->getFileFormat();
            if (!$result){
                return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error','فایل آپلود نشد!');
            }
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;

            $upadte = $file->update($inputs);
            if ($upadte){
                return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-success','فایل با موفقیت آپدیت شد');
            }
            return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error','خطایی رخ داد!');


        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $file)
    {
        $result = $file->delete();
        if ($result){
            return response()->json([
                'status'=>1,

            ]);
        }
    }

    public function status(EmailFile $file)
    {
        $file->status = $file->status == 1 ? 0 : 1;
        $result = $file->save();
        if ($result){
            if ($file->status == 1){
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
