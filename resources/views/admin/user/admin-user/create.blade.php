@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کاربر ادمین</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>

            <li class="breadcrumb-item font-size-12 " > <a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد کاربر ادمین
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.admin-user.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.user.admin-user.store')}}">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام </label>
                                    <input value="{{old('first_name')}}" type="text" class="form-control form-control-sm" name="first_name">
                                    @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام خانوادگی </label>
                                    <input type="text" class="form-control form-control-sm" name="last_name" value="{{old('last_name')}}">
                                    @error('last_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">ایمیل </label>
                                    <input value="{{old('email')}}" type="text" class="form-control form-control-sm" name="email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">شماره موبایل </label>
                                    <input value="{{old('mobile')}}" type="text" class="form-control form-control-sm" name="mobile">
                                    @error('mobile')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">کلمه عبور </label>
                                    <input type="password" class="form-control form-control-sm" name="password" value="{{old('password')}}">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تکرار کلمه عبور </label>
                                    <input type="password" class="form-control form-control-sm" name="password_confirmation" value="{{old('password_confirmation')}}">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input value="{{old('profile_photo_path')}}" type="file" class="form-control form-control-sm" name="profile_photo_path">
                                    @error('profile_photo_path')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت کاربر </label>
                                    <select type="text" class="form-control form-control-sm" name="status">
                                        <option {{old('status') == 0 ? 'selected' : ''}} value="0">غیرفعال   </option>
                                        <option {{old('status') == 1 ? 'selected' : ''}} value="1">فعال   </option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت فعالسازی </label>
                                    <select type="text" class="form-control form-control-sm" name="activation">
                                        <option {{old('activation') == 0 ? 'selected' : ''}} value="0">غیرفعال   </option>
                                        <option {{old('activation') == 1 ? 'selected' : ''}} value="1">فعال   </option>
                                    </select>
                                    @error('activation')
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
