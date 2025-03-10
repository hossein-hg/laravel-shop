@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش مشتری </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>

            <li class="breadcrumb-item font-size-12 " > <a href="#">مشتریان</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مشتری جدید</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش مشتری
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.customer.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.user.customer.update',[$user->id])}}">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام </label>
                                    <input value="{{old('first_name',$user->first_name)}}" type="text" class="form-control form-control-sm" name="first_name">
                                    @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام خانوادگی </label>
                                    <input type="text" class="form-control form-control-sm" name="last_name" value="{{old('last_name',$user->last_name)}}">
                                    @error('last_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input value="{{old('profile_photo_path')}}" type="file" class="form-control form-control-sm" name="profile_photo_path">

                                    <img width="100" height="80" src="{{asset($user->profile_photo_path)}}"  alt="">

                                    @error('profile_photo_path')
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
