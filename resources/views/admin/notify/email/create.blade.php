@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد ایمیل </title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">ایمیل</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد ایمیل </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد ایمیل
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.notify.email.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.notify.email.store')}}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان ایمیل</label>
                                    <input name="subject" value="{{old('subject')}}" type="text" class="form-control form-control-sm">
                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ ارسال </label>
                                    <input id="published_at" name="published_at" type="hidden" class="form-control form-control-sm">
                                    <input id="published_at_view"  type="text" class="form-control form-control-sm">
                                    @error('published_at')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">متن ایمیل  </label>
                                    <textarea name="body"  type="text" id="body" class="form-control form-control-sm">{{old('body')}}</textarea>
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
    <script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}">

    </script>
    <script>
        CKEDITOR.replace('body')
    </script>

    <script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>
    <script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(()=>{
            $('#published_at_view').persianDatepicker({
                altField: '#published_at',
                format:"YYYY/MM/DD",
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            });
        })

    </script>
@endsection

