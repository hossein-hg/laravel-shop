@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش روش ارسال</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">روش ارسال</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش روش ارسال</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش روش ارسال
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.delivery.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form method="post" action="{{route('admin.market.delivery.update',[$delivery->id])}}">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام روش ارسال</label>
                                    <input value="{{old('name',$delivery->name)}}" name="name" type="text" class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">هزینه ارسال</label>
                                    <input value="{{old('amount',$delivery->amount)}}" name="amount" type="text" class="form-control form-control-sm">
                                    @error('amount')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">زمان ارسال</label>
                                    <input value="{{old('delivery_time',$delivery->delivery_time)}}" name="delivery_time" type="text" class="form-control form-control-sm">
                                    @error('delivery_time')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">واحد زمان ارسال</label>
                                    <input value="{{old('delivery_time_unit',$delivery->delivery_time_unit)}}" name="delivery_time_unit" type="text" class="form-control form-control-sm">
                                    @error('delivery_time_unit')
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
