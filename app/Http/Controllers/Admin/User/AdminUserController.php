<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins =  User::query()->where('user_type',1)->get();
        return view('admin.user.admin-user.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('image'))
        {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'profile');

            $result = $imageService->save($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;

        User::query()->create($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','کاربر ادمین با موفقیت ساخته شد');
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
    public function edit($id)
    {
        $admin = User::query()->find($id);

        return view('admin.user.admin-user.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, ImageService $imageService)
    {
        $admin = User::query()->find($id);

        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            if(!empty($admin->profile_photo_path))
            {
                $imageService->deleteImage($admin->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'profile');

            $result = $imageService->save($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);


        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','کاربر ادمین با موفقیت ویرایش ساخته شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','کاربر ادمین با موفقیت حذف ساخته شد');
    }

    public function activation($id)
    {
        $admin = User::query()->find($id);
        $admin->activation = $admin->activation == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result)
        {
            if ($admin->activation == 0)
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

    public function status($id)
    {
        $admin = User::query()->find($id);
        $admin->status = $admin->status == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result)
        {
            if ($admin->status == 0)
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
