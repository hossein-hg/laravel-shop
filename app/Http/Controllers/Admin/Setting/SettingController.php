<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::query()->first();
        if (!$setting){

            $default = new SettingSeeder();
            $default->run();
        }
        $setting = Setting::query()->first();

        return view('admin.setting.index',compact('setting'));
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
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @param Setting $setting
     * @param ImageService $imageService
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')){
            if (!empty($setting->logo)){
                $imageService->deleteDirectoryAndFiles($setting->logo['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'setting');
            $imageService->setImageName('logo');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if (!$result){
                return redirect()->route('admin.setting.index')->with('swal-error','لوگو آپلود نشد!');
            }
            $inputs['logo'] = $result;
        }

        if ($request->hasFile('icon')){
            if (!empty($setting->icon)){
                $imageService->deleteDirectoryAndFiles($setting->icon['directory']);
            }
            $imageService->setExclusiveDirectory('image'.DIRECTORY_SEPARATOR.'setting');
            $imageService->setImageName('icon');
            $result = $imageService->createIndexAndSave($request->file('icon'));
            if (!$result){
                return redirect()->route('admin.setting.index')->with('swal-error','آیکون آپلود نشد!');
            }
            $inputs['icon'] = $result;
        }

        $update = $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success','تنظیمات با موفقیت ساخته شد');

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
}
