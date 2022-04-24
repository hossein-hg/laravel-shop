@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.user.admin-user.update',[$admin->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input id="name" type="text" class="form-control form-control-sm" name="first_name" value="{{old('first_name',$admin->first_name)}}">
                                @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="last_name">نام خانوادگی</label>
                                <input id="last_name" type="text" class="form-control form-control-sm" name="last_name" value="{{old('last_name',$admin->last_name)}}">
                                @error('last_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
                                    <option @if(old('activation',$admin->activation) == 0) selected @endif value="0">غیر فعال</option>
                                    <option @if(old('activation',$admin->activation) == 1) selected @endif value="1">فعال</option>
                                </select>
                                @error('activation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">آپدیت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
