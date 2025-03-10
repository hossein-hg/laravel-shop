@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کوپن</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">تخفیف ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش کوپن
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.discount.coupon')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.market.discount.couponUpdate',[$coupon->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">کد کوپن </label>
                                    <input name="code" value="{{old('code',$coupon->code)}}" type="text" class="form-control form-control-sm">
                                    @error('code')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نوع کوپن </label>
                                    <select name="amount_type"  type="text" class="form-control form-control-sm">
                                        <option {{old('amount_type',$coupon->amount_type) == 0 ? 'selected' : ''}} value="0">درصدی</option>
                                        <option {{old('amount_type',$coupon->amount_type) == 1 ? 'selected' : ''}} value="1">مقداری</option>
                                    </select>
                                    @error('amount_type')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نوع کوپن (شخصی یا عمومی) </label>
                                    <select id="type" name="type"  type="text" class="form-control form-control-sm">
                                        <option {{old('type',$coupon->type) == 0 ? 'selected' : ''}} value="0">عمومی</option>
                                        <option {{old('type',$coupon->type) == 1 ? 'selected' : ''}} value="1">خصوصی</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">کاربر </label>
                                    <select id="user_id" name="user_id"  type="text" class="form-control form-control-sm">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($users as $user)
                                        <option {{old('user_id',$coupon->user_id) == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->fullName}}</option>
                                        @endforeach

                                    </select>
                                    @error('user_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">میزان تخفیف  </label>
                                    <input name="amount" value="{{old('amount',$coupon->amount)}}" type="text" class="form-control form-control-sm">
                                    @error('amount')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">حداکثر تخفیف  </label>
                                    <input name="discount_ceiling" value="{{old('discount_ceiling',$coupon->discount_ceiling)}}" type="text" class="form-control form-control-sm">
                                    @error('discount_ceiling')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for=""> تاریخ شروع </label>
                                    <input name="start_date" value="{{old('start_date',$coupon->start_date)}}"  id="start_date" type="hidden" class="form-control form-control-sm">
                                    <input id="start_date_view"  type="text" class="form-control form-control-sm">
                                    @error('start_date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ پایان  </label>
                                    <input name="end_date" value="{{old('end_date',$coupon->end_date)}}" id="end_date" type="hidden" class="form-control form-control-sm">
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

    <script>
        let type = $('#type');
        type.change(function (){

            if(type.find(':selected').val() === '1'){
                console.log('hi')
                $('#user_id').removeAttr('disabled')
            }
            else {
                $('#user_id').attr('disabled','disabled')
            }
        })


    </script>
@endsection
