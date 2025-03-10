@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش تخفیف شگفت انگیز</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">تخفیف ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تخفیف شگفت انگیز</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش تخفیف شگفت انگیز
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.discount.amazingSale')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.market.discount.amazingUpdate',[$amazingSale->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">محصول </label>
                                    <select name="product_id"  type="text" class="form-control form-control-sm">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($products as $product)
                                            <option {{old('product_id',$amazingSale->product_id) == $product->id ? 'selected' : ''}} value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('product_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">درصد تخفیف  </label>
                                    <input name="percentage" value="{{old('percentage',$amazingSale->percentage)}}"  type="text" class="form-control form-control-sm">
                                    @error('percentage')
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

