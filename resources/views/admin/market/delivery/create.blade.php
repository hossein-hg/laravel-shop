@extends('admin.layouts.master')

@section('head-tag')
<title> ایجاد روش ارسال</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">روش های ارسال</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد روش ارسال</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد روش ارسال
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.delivery.store')}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام روش ارسال</label>
                                <input id="name" type="text" class="form-control form-control-sm" value="{{old('name')}}" name="name">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="amount">هزینه روش ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="amount" value="{{old('amount')}}" id="amount">
                                @error('amount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="delivery_time">زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm" id="delivery_time" name="delivery_time" value="{{old('delivery_time')}}">
                                @error('delivery_time')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="delivery_time_unit">واحد زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm" id="delivery_time_unit" name="delivery_time_unit" value="{{old('delivery_time_unit')}}">
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
