@extends('admin.layouts.master')

@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">انبار</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اضافه کردن به انبار</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        اضافه کردن به انبار
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.store.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.market.store.store',[$product->id])}}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام تحویل گیرنده</label>
                                    <input name="receiver" value="{{old('receiver')}}" type="text" class="form-control form-control-sm">
                                    @error('receiver')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام تحویل دهنده</label>
                                    <input name="deliverer" value="{{old('deliverer')}}" type="text" class="form-control form-control-sm">
                                    @error('deliverer')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد  </label>
                                    <input value="{{old('marketable_number')}}" name="marketable_number" type="text" class="form-control form-control-sm">
                                    @error('marketable_number')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <textarea name="description" class="form-control" >{{old('description')}}</textarea>
                                    @error('description')
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
