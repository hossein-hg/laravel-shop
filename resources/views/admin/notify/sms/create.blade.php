@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد اطلاعیه پیامکی</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">

@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه پیامکی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد اطلاعیه پیامکی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد اطلاعیه پیامکی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.sms.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.notify.sms.store')}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان پیامک</label>
                                <input type="text" name="title" class="form-control form-control-sm" value="{{old('title')}}">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="text" id="published_at" name="published_at" class="form-control form-control-sm d-none"  value="{{old('published_at')}}">
                                <input type="text" id="published_at_view"  class="form-control form-control-sm">
                                @error('published_at')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">متن پیامک</label>
                                <textarea name="body" id="body"  class="form-control form-control-sm" rows="6">{{old('body')}}</textarea>
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
