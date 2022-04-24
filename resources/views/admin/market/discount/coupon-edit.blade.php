@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش کوپن تخفیف</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">برند</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کوپن تخفیف</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش کوپن تخفیف
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.discount.coupon') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.discount.coupon.update',[$coupon->id])}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">کد کوپن</label>
                                <input name="code" value="{{old('code',$coupon->code)}}" type="text" class="form-control form-control-sm">
                                @error('code')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="" >نوع کوپن</label>
                                <select name="type"  id="type" class="form-control form-control-sm">
                                    <option value="0" @if(old('type',$coupon->type) == 0) selected @endif>عمومی</option>
                                    <option value="1" @if(old('type',$coupon->type) == 1) selected @endif>خصوصی</option>
                                </select>
                                @error('type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">کاربر</label>
                                <select name="user_id" id="user" class="form-control form-control-sm" {{$coupon->type == 0 ? 'disabled' : ''}}>
                                    @foreach($users as $user)
                                    <option @if(old('user_id',$coupon->user_id) == $user->id) selected @endif value="{{$user->id}}">{{$user->fullName}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="amount_type" >نوع تخفیف</label>
                                <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                    <option @if(old('amount_type',$coupon->amount_type) == 0) selected @endif value="0">درصدی</option>
                                    <option @if(old('amount_type',$coupon->amount_type) == 1) selected @endif value="1">عددی</option>
                                </select>
                                @error('amount_type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">میزان تخفیف</label>
                                <input name="amount" value="{{old('amount',$coupon->amount)}}" type="text" class="form-control form-control-sm">
                                @error('amount')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="discount_ceiling">حداکثر تخفیف</label>
                                <input id="discount_ceiling" name="discount_ceiling" type="text" class="form-control form-control-sm" value="{{old('discount_ceiling',$coupon->discount_ceiling)}}">
                                @error('discount_ceiling')
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

    <script>
        $('#type').change(function (){

            if ($('#type').find(':selected').val() === '1')
            {

                $('#user').removeAttr('disabled')
            }
            else if ($('#type').find(':selected').val() === '0'){
                $('#user').prop('disabled', true);
            }
        })

    </script>
@endsection
