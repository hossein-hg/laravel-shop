@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش تخفیف عمومی</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">برند</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تخفیف عمومی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش تخفیف عمومی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.discount.commonDiscount.update',[$discount->id])}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">



                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">درصد تخفیف</label>
                                <input name="percentage" type="text" class="form-control form-control-sm" value="{{old('percentage',$discount->percentage)}}">
                                @error('percentage')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="discount_ceiling">حداکثر تخفیف</label>
                                <input id="discount_ceiling" name="discount_ceiling" type="text" class="form-control form-control-sm" value="{{old('discount_ceiling',$discount->discount_ceiling)}}">
                                @error('discount_ceiling')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="minimal_order_amount">حداقل مقدار خرید</label>
                                <input id="minimal_order_amount" name="minimal_order_amount" type="text" class="form-control form-control-sm" value="{{old('minimal_order_amount',$discount->minimal_order_amount)}}">
                                @error('minimal_order_amount')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title">عنوان مناسبت</label>
                                <input value="{{old('title',$discount->title)}}" id="title" name="title" type="text" class="form-control form-control-sm">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date_view">تاریخ شروع</label>
                                <input name="start_date" id="start_date" type="hidden" class="form-control form-control-sm" value="{{old('start_date',$discount->start_date)}}">
                                <input  id="start_date_view" type="text" class="form-control form-control-sm">
                                @error('start_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="end_date_view">تاریخ پایان</label>
                                <input name="end_date" id="end_date" type="hidden" class="form-control form-control-sm" value="{{old('end_date',$discount->end_date)}}">
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
