@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>انتخاب آدرس</title>
@endsection

@section('content')
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">

                            @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                            @endif

                        <section class="col-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب آدرس و مشخصات گیرنده
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <secrion>
                                        پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                    </secrion>
                                </section>


                                <section class="address-select">

                                    @foreach($addresses as $key => $address)
                                    <input form="myForm" type="radio" name="address_id" value="{{$address->id}}" id="a{{$address->id}}"/> <!--checked="checked"-->
                                    <label for="a{{$address->id}}" class="address-wrapper mb-2 p-2">
                                        <section class="mb-2">
                                            <i class="fa fa-map-marker-alt mx-1"></i>
                                            آدرس : {{$address->address ?? '-'}}
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-user-tag mx-1"></i>
                                            گیرنده :  {{$address->recipient_first_name.' '.$address->recipient_last_name ?? '-'}}
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-mobile-alt mx-1"></i>
                                            موبایل گیرنده : {{$address->mobile ?? '-'}}
                                        </section>
                                        <a class="" data-bs-toggle="modal" data-bs-target="#edit-address-{{$address->id}}" id="edit-address-label" ><i class="fa fa-edit"></i> ویرایش آدرس</a>
                                        <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                    </label>


                                    <!-- start edit address Modal -->
                                        <section class="modal fade" id="edit-address-{{$address->id}}" tabindex="-1" aria-labelledby="edit-address-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <form class="row" action="{{route('customer.sales-process.update-address',[$address->id])}}" method="post">
                                                    <section class="modal-content">
                                                        <section class="modal-header">
                                                            <h5 class="modal-title" id="edit-address-label"><i class="fa fa-plus"></i> ویرایش آدرس </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </section>

                                                        <section class="modal-body">

                                                            @csrf
                                                            @method('put')
                                                            <section class="col-12 mb-2">
                                                                <label for="province" class="form-label mb-1">استان</label>
                                                                <select class="form-select form-select-sm" id="province" name="province_id">

                                                                    @foreach($provinces as $province)                                 <option {{$address->province_id == $province->id ? 'selected' : ''}} id="province-{{$province->id}}" onclick="getCities1({{$province->id}})" value="{{$province->id}}" data-url="{{route('customer.sales-process.get-cities',[$province->id])}}"> {{$province->name}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </section>

                                                            <section  class="col-12 mb-2">
                                                                <label for="city" class="form-label mb-1">شهر</label>
                                                                <select  id="city1" class="form-select form-select-sm city1"  name="city_id">
                                                                    <option selected>شهر را انتخاب کنید</option>

                                                                </select>
                                                            </section>
                                                            <section class="col-12 mb-2">
                                                                <label for="address" class="form-label mb-1">نشانی</label>
                                                                <input type="text" class="form-control form-control-sm" name="address" value="{{old('address',$address->address)}}" id="address" placeholder="نشانی">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                                <input name="postal_code" value="{{old('postal_code',$address->postal_code)}}" type="text" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                                <input type="text" class="form-control form-control-sm" value="{{old('no',$address->no)}}" name="no" id="no" placeholder="پلاک">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                                <input name="unit" type="text" class="form-control form-control-sm" value="{{old('unit',$address->unit)}}" id="unit" placeholder="واحد">
                                                            </section>

                                                            <section class="border-bottom mt-2 mb-3"></section>

                                                            <section class="col-12 mb-2">
                                                                <section class="form-check">
                                                                    <input class="form-check-input" type="checkbox" {{$address->recipient_first_name ? 'checked' : ''}} name="receiver" id="receiver">
                                                                    <label class="form-check-label" for="receiver">
                                                                        گیرنده سفارش خودم نیستم
                                                                    </label>
                                                                </section>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="first_name" class="form-label mb-1">نام گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm" value="{{old('recipient_first_name',$address->recipient_first_name)}}" name="recipient_first_name" id="first_name" placeholder="نام گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="last_name" class="form-label mb-1" >نام خانوادگی گیرنده</label>
                                                                <input name="recipient_last_name" type="text" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده" value="{{old('recipient_last_name',$address->recipient_last_name)}}">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                                <input type="text" class="form-control  form-control-sm" value="{{old('mobile',$address->mobile)}}" id="mobile" name="mobile" placeholder="شماره موبایل">
                                                            </section>



                                                        </section>

                                                        <section class="modal-footer py-1">
                                                            <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                        </section>

                                                    </section>
                                                </form>
                                            </section>
                                        </section>
                                        <!-- end edit address Modal -->

                                    @endforeach
                                    <section class="address-add-wrapper">
                                        <button class="address-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-address" ><i class="fa fa-plus"></i> ایجاد آدرس جدید</button>
                                        <!-- start add address Modal -->
                                        <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <form class="row" action="{{route('customer.sales-process.add-address')}}" method="post">
                                                <section class="modal-content">
                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </section>

                                                    <section class="modal-body">

                                                            @csrf
                                                            <section class="col-12 mb-2">
                                                                <label for="province" class="form-label mb-1">استان</label>
                                                                <select class="form-select form-select-sm" id="province" name="province_id">
                                                                    <option selected>استان را انتخاب کنید</option>
                                   @foreach($provinces as $province)                                 <option id="province{{$province->id}}" onclick="getCities({{$province->id}})" value="{{$province->id}}" data-url="{{route('customer.sales-process.get-cities',[$province->id])}}"> {{$province->name}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </section>

                                                            <section  class="col-12 mb-2">
                                                                <label for="city" class="form-label mb-1">شهر</label>
                                                                <select class="form-select form-select-sm" id="city" name="city_id">
                                                                    <option selected>شهر را انتخاب کنید</option>

                                                                </select>
                                                            </section>
                                                            <section class="col-12 mb-2">
                                                                <label for="address" class="form-label mb-1">نشانی</label>
                                                                <input type="text" class="form-control form-control-sm" name="address" id="address" placeholder="نشانی">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                                <input name="postal_code" type="text" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                                <input type="text" class="form-control form-control-sm" name="no" id="no" placeholder="پلاک">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                                <input name="unit" type="text" class="form-control form-control-sm" id="unit" placeholder="واحد">
                                                            </section>

                                                            <section class="border-bottom mt-2 mb-3"></section>

                                                            <section class="col-12 mb-2">
                                                                <section class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="receiver" id="receiver">
                                                                    <label class="form-check-label" for="receiver">
                                                                        گیرنده سفارش خودم نیستم
                                                                    </label>
                                                                </section>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="first_name" class="form-label mb-1">نام گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm" name="recipient_first_name" id="first_name" placeholder="نام گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="last_name" class="form-label mb-1" >نام خانوادگی گیرنده</label>
                                                                <input name="recipient_last_name" type="text" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                                <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="شماره موبایل">
                                                            </section>



                                                    </section>

                                                    <section class="modal-footer py-1">
                                                        <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                    </section>

                                                </section>
                                                </form>
                                            </section>
                                        </section>
                                        <!-- end add address Modal -->
                                    </section>

                                </section>
                            </section>


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نحوه ارسال
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="delivery-select ">

                                    <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر بگیرید.
                                        </secrion>
                                    </section>

                                    @foreach($deliveries as $delivery)
                                    <input  form="myForm" type="radio" name="delivery_id" value="{{$delivery->id}}" id="d{{$delivery->id}}"/>
                                    <label for="d{{$delivery->id}}" class="col-4 delivery-wrapper mb-2 pt-2">
                                        <section class="mb-2">
                                            <i class="fa fa-shipping-fast mx-1"></i>
                                            {{$delivery->name}}
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            تامین کالا از {{$delivery->delivery_time}} {{$delivery->delivery_time_unit}} کاری آینده
                                        </section>
                                    </label>
                                    @endforeach



                                </section>
                            </section>




                        </section>
                        <section class="col-3">
                            @php
                                $totalProductPrice = 0;
                                $totalDiscount = 0;
                            @endphp

                            @foreach($cartItems as $cartItem)
                                @php
                                    $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->number;
                                    $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->number;

                                @endphp
                            @endforeach
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها (2)</p>
                                    <p class="text-muted">{{\App\Helpers\priceFormat($totalProductPrice)}} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder">{{\App\Helpers\priceFormat($totalDiscount)}} تومان</p>
                                </section>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder">{{ \App\Helpers\priceFormat($totalProductPrice - $totalDiscount) }} تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">هزینه ارسال</p>
                                    <p class="text-warning">54,000 تومان</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                </p>

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">مبلغ قابل پرداخت</p>
                                    <p class="fw-bold">374,000 تومان</p>
                                </section>

                                <section class="">

                                    <section class="">
                                        <form action="{{route('customer.sales-process.choose-address-and-delivery')}}" id="myForm" method="post">
                                            @csrf
                                        <button type="submit" class="btn btn-danger d-block w-100">تکمیل فرآیند خرید</button>
                                        </form>
                                    </section>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>




    </section>
    <!-- end cart -->
@endsection

@section('script')
    <script>
        function getCities1(id){

            var addresses = {!! auth()->user()->addresses !!}
            addresses.map(address =>{
                let province_id = address.province_id
                if (province_id === id){
                    let option = $('#province-'+id)

                    let url = option.attr('data-url')

                    $.ajax({
                        url,
                        type : 'GET',
                        success:(res)=>{
                            if (res.status){
                                let cities = res.cities
                                $('.city1').empty()

                                cities.map(city=>{

                                    $('.city1').append($('<option/>').val(city.id).text(city.name))
                                })
                            }
                        }
                    })
                }


            })



        }

        function getCities(id){
            let option = $('#province'+id)
            let url = option.attr('data-url')
            $.ajax({
                url,
                type : 'GET',
                success:(res)=>{
                    if (res.status){
                        let cities = res.cities
                        $('#city').empty()
                        cities.map(city=>{
                            $('#city').append($('<option/>').val(city.id).text(city.name))
                        })
                    }
                }
            })
        }






    </script>
@endsection
