@extends('admin.layouts.master')

@section('head-tag')
<title>افزودن به فروش شگفت انگیز</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">برند</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> افزودن به فروش شگفت انگیز</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    افزودن به فروش شگفت انگیز
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.discount.amazingSale') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.discount.amazingSale.store')}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام کالا</label>
                                <select name="product_id" class="form-control form-control-sm" id="">
                                    <option value="">انتخاب کنید ...</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" {{old('product_id') == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">درصد تخفیف</label>
                                <input name="percentage" type="text" class="form-control form-control-sm" value="{{old('percentage')}}">
                                @error('percentage')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date_view">تاریخ شروع</label>
                                <input name="start_date" id="start_date" type="hidden" class="form-control form-control-sm" value="{{old('start_date_view')}}">
                                <input  id="start_date_view" type="text" class="form-control form-control-sm">
                                @error('start_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="end_date_view">تاریخ پایان</label>
                                <input name="end_date" id="end_date" type="hidden" class="form-control form-control-sm" value="{{old('end_date_view')}}">
                                <input  id="end_date_view" type="text" class="form-control form-control-sm">
                                @error('end_date')
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

            $('#start_date_view').persianDatepicker({
                format : 'YYYY/MM/DD',
                altField: '#start_date',
                timePicker: {
                    enabled : true,
                    meridiem:{
                        enabled: true
                    }
                }
            })

            $('#end_date_view').persianDatepicker({
                format : 'YYYY/MM/DD',
                altField: '#end_date',
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
