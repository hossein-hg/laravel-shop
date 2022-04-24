@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش اطلاعیه ایمیلی</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">

@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه ایمیلی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش اطلاعیه ایمیلی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.notify.email.update',[$email->id])}}" method="post">
                    @method('put')
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان ایمیل</label>
                                <input type="text" name="subject" class="form-control form-control-sm" value="{{old('subject',$email->subject)}}">
                                @error('subject')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="text" id="published_at" name="published_at" class="form-control form-control-sm d-none"  value="{{$email->published_at}}">
                                <input type="text" id="published_at_view"  class="form-control form-control-sm" value="{{$email->published_at}}">
                                @error('published_at')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">متن ایمیل</label>
                                <textarea name="body" id="body"  class="form-control form-control-sm" rows="6">{{old('body',$email->body)}}</textarea>
                                @error('body')
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
@section('script')


    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}">

    </script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}">

    </script>

    <script>

        $(document).ready(function (){

            $('#published_at_view').persianDatepicker({
                format : 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled : true,
                    meridiem:{
                        enabled: true
                    }
                }
            })
        })

    </script>
@endsection
