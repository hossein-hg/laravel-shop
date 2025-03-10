@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پیامک </title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">پیامک</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پیامک </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش پیامک
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.notify.sms.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.notify.sms.update',[$sms->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان پیامک</label>
                                    <input name="title" value="{{old('title',$sms->title)}}" type="text" class="form-control form-control-sm">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ ارسال </label>
                                    <input value="{{old('title',$sms->published_at)}}" id="published_at" name="published_at" type="hidden" class="form-control form-control-sm">
                                    <input value="{{old('title',$sms->published_at)}}" id="published_at_view"  type="text" class="form-control form-control-sm">
                                    @error('published_at')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">متن پیامک  </label>
                                    <textarea name="body"  type="text" id="body" class="form-control form-control-sm">{{old('body',$sms->body)}}</textarea>
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



