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
            <li class="breadcrumb-item font-size-12 " > <a href="#">تخفیف ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تخفیف عمومی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش تخفیف عمومی
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.discount.commonDiscount')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.market.discount.commonUpdate',[$commonDiscount->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">درصد تخفیف  </label>
                                    <input name="percentage" value="{{old('percentage',$commonDiscount->percentage)}}"  type="text" class="form-control form-control-sm">
                                    @error('percentage')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">حداکثر تخفیف  </label>
                                    <input name="discount_ceiling" value="{{old('discount_ceiling',$commonDiscount->discount_ceiling)}}" type="text" class="form-control form-control-sm">
                                    @error('discount_ceiling')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان مناسبت  </label>
                                    <input type="text" name="title" value="{{old('title',$commonDiscount->title)}}" class="form-control form-control-sm">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">حداقل مبلغ خرید  </label>
                                    <input value="{{old('minimal_order_amount',$commonDiscount->minimal_order_amount)}}" name="minimal_order_amount" type="text" class="form-control form-control-sm">
                                    @error('minimal_order_amount')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for=""> تاریخ شروع </label>
                                    <input name="start_date" value="{{old('start_date')}}"  id="start_date" type="hidden" class="form-control form-control-sm">
                                    <input id="start_date_view"  type="text" class="form-control form-control-sm">
                                    @error('start_date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ پایان  </label>
                                    <input name="end_date" value="{{old('end_date')}}" id="end_date" type="hidden" class="form-control form-control-sm">
                                    <input id="end_date_view"  type="text" class="form-control form-control-sm">
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
    <script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>

    <script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js')}}"></script>

    <script>
        $(document).ready(()=>{
            $('#start_date_view').persianDatepicker({
                altField: '#start_date',
                format:"YYYY/MM/DD"
            });
        })

        $(document).ready(()=>{
            $('#end_date_view').persianDatepicker({
                altField: '#end_date',
                format:"YYYY/MM/DD"
            });
        })
    </script>
@endsection
