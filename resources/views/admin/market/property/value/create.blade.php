@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد مقدار فرم کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">فرم کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد مقدار فرم کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد مقدار فرم کالا
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.value.index',[$attribute->id])}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.market.value.store',[$attribute->id])}}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">مقدار فرم کالا</label>
                                    <input name="value" value="{{old('value')}}" type="text" class="form-control form-control-sm">
                                    @error('value')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام محصول </label>
                                    <select name="product_id" type="text" class="form-control form-control-sm">
                                        <option value="">محصول را انتخاب کنید</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" {{$product->id == old('product_id') ? 'selected' : ''}}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نوع </label>
                                    <select name="type" type="text" class="form-control form-control-sm">
                                        <option value="">نوع را انتخاب کنید</option>

                                            <option value="0" {{0 == old('type') ? 'selected' : ''}}>ساده</option>
                                            <option value="1" {{1 == old('type') ? 'selected' : ''}}>چند انتخابی</option>

                                    </select>
                                    @error('type')
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
