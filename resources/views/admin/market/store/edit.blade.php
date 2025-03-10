@extends('admin.layouts.master')

@section('head-tag')
    <title>اصلاح موجودی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اصلاح موجودی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        اصلاح موجودی
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.store.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form method="post" action="{{route('admin.market.store.update',[$product->id])}}">
                        @csrf
                        @method('put')
                        <section class="row">





                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد قابل فروش  </label>
                                    <input value="{{old('marketable_number',$product->marketable_number)}}" name="marketable_number" type="text" class="form-control form-control-sm">
                                    @error('marketable_number')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد فروخته شده  </label>
                                    <input value="{{old('sold_number',$product->sold_number)}}" name="sold_number" type="text" class="form-control form-control-sm">
                                    @error('sold_number')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد رزرو شده  </label>
                                    <input value="{{old('frozen_number',$product->frozen_number)}}" name="frozen_number" type="text" class="form-control form-control-sm">
                                    @error('frozen_number')
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
