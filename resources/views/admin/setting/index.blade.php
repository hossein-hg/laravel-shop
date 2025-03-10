@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تنظیمات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        تنظیمات
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="" class="btn btn-info btn-sm disabled">ایجاد ویژگی جدید</a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان </th>
                                <th>لوگو </th>
                                <th>آیکون </th>
                                <th>توضیحات </th>
                                <th>کلمات کلیدی </th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>{{$setting->title}}</td>
                                <td><img src={{ $setting->logo }} class="max-height-2rem" alt=""> </td>
                                <td><img src={{ $setting->icon }} class="max-height-2rem" alt=""> </td>
                                <td>{{\Illuminate\Support\Str::limit($setting->description,20)}} </td>
                                <td>{{$setting->keywords}} </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.setting.edit',[$setting->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <button type="submit"  class="btn btn-danger btn-sm disabled"><i class="fa fa-trash-alt"></i> حذف</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </section>

            </section>
        </section>
    </section>
@endsection
