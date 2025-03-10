@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد فایل ایمیل </title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">ایمیل</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">فایل ایمیل</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد فایل ایمیل </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد فایل ایمیل
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.notify.email-file.index',[$email->id])}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form enctype="multipart/form-data" action="{{route('admin.notify.email-file.store',[$email->id])}}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">فایل </label>
                                    <input name="file" value="{{old('file')}}" type="file" class="form-control form-control-sm">
                                    @error('file')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>







                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>

                        </section>
                    </form>

                </section>

            </section>
        </section>
    </section>
@endsection



