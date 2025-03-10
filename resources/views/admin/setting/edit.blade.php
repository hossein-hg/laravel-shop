@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش تنظیمات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تنظیمات</a></li>

            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش تنظیمات
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.setting.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form enctype="multipart/form-data" action="{{route('admin.setting.update',[$setting->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان سایت</label>
                                    <input value="{{old('title',$setting->title)}}" name="title" type="text" class="form-control form-control-sm">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">کلمات کلیدی سایت</label>
                                    <input  value="{{old('keywords',$setting->keywords)}}" name="keywords" type="text" class="form-control form-control-sm">
                                    @error('keywords')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">توضیحات سایت</label>
                                    <input value="{{old('description',$setting->description)}}" name="description" type="text" class="form-control form-control-sm">
                                    @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">لوگو </label>
                                    <input  name="logo"  type="file" class="form-control form-control-sm">
                                    @error('logo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">آیکون </label>
                                    <input  name="icon"  type="file" class="form-control form-control-sm">
                                    @error('icon')
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
