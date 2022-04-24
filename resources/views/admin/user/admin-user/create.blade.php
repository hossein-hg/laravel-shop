@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.user.admin-user.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input id="name" type="text" class="form-control form-control-sm" name="first_name" value="{{old('first_name')}}">
                                @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="last_name">نام خانوادگی</label>
                                <input id="last_name" type="text" class="form-control form-control-sm" name="last_name" value="{{old('last_name')}}">
                                @error('last_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <input id="email" type="text" class="form-control form-control-sm" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                     <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="mobile"> شماره موبایل</label>
                                <input id="mobile" type="text" class="form-control form-control-sm" name="mobile" value="{{old('mobile')}}">
                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                     <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="password">کلمه عبور</label>
                                <input id="password" type="password" class="form-control form-control-sm" name="password" value="{{old('password')}}">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">تکرار کلمه عبور</label>
                                <input id="password_confirmation" type="password" class="form-control form-control-sm" name="password_confirmation" value="{{old('password_confirmation')}}">
                            </div>
                        </section>
                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image">
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">وضعیت فعالسازی</label>
                                <select name="activation" id="" class="form-control form-control-sm">
                                    <option @if(old('activation') == 0) selected @endif value="0">غیر فعال</option>
                                    <option @if(old('activation') == 1) selected @endif value="1">فعال</option>
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
