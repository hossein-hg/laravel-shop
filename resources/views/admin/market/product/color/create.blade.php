@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد رنگ</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">محصولات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد رنگ</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد رنگ
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.color.index',[$product->id])}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form enctype="multipart/form-data" action="{{route('admin.market.color.store',[$product->id])}}" id="form" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام رنگ</label>
                                    <input name="color_name" value="{{old('color_name')}}" type="text" class="form-control form-control-sm">
                                    @error('color_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for=""> رنگ</label>
                                    <input name="color" value="{{old('color')}}" type="color" class="form-control form-control-sm">
                                    @error('color')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label for="">افزایش قیمت</label>
                                    <input name="price_increase" value="{{old('price_increase')}}" type="text" class="form-control form-control-sm">
                                    @error('price_increase')
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


