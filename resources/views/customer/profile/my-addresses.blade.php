@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>آدرس ها</title>
@endsection




@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        <!-- start sidebar nav-->
                    @include('customer.layouts.partials.profile-sidebar')
                        <!--end sidebar nav-->
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>آدرس های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif


                        <section class="my-addresses">

                            @foreach($addresses as $address)

                            <section class="my-address-wrapper mb-2 p-2">
                                <section class="mb-2">
                                    <i class="fa fa-map-marker-alt mx-1"></i>
                                    آدرس : {{$address->address}}
                                </section>
                                <section class="mb-2">
                                    <i class="fa fa-user-tag mx-1"></i>
                                    گیرنده : {{$address->recipient_first_name.' '.$address->recipient_last_name ?? '-'}}
                                </section>
                                <section class="mb-2">
                                    <i class="fa fa-mobile-alt mx-1"></i>
                                    موبایل گیرنده : {{$address->mobile ?? '-'}}
                                </section>
                                <a class="" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#edit-address-{{$address->id}}" id="edit-address-label"><i class="fa fa-edit"></i> ویرایش آدرس</a>
                                <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                            </section>

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
                                        <section class="modal-content">
                                            <section class="modal-header">
                                                <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </section>
                                            <section class="modal-body">

                                                @csrf
                                                <section class="col-5 mb-2">
                                                    <label for="province" class="form-label mb-1">استان</label>
                                                    <select form="myForm" class="form-select form-select-sm" id="province" name="province_id">
                                                        <option selected>استان را انتخاب کنید</option>
                                                        @foreach($provinces as $province)                                 <option id="province{{$province->id}}" onclick="getCities({{$province->id}})" value="{{$province->id}}" data-url="{{route('customer.sales-process.get-cities',[$province->id])}}"> {{$province->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </section>

                                                <section  class="col-12 mb-2">
                                                    <label for="city" class="form-label mb-1">شهر</label>
                                                    <select form="myForm" class="form-select form-select-sm" id="city" name="city_id">
                                                        <option selected>شهر را انتخاب کنید</option>

                                                    </select>
                                                </section>
                                                <section class="col-12 mb-2">
                                                    <label for="address" class="form-label mb-1">نشانی</label>
                                                    <input form="myForm" type="text" class="form-control form-control-sm" name="address" id="address" placeholder="نشانی">
                                                </section>

                                                <section class="col-12 mb-2">
                                                    <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                    <input form="myForm" name="postal_code" type="text" class="form-control form-control-sm" id="postal_code" placeholder="کد پستی">
                                                </section>

                                                <section class="col-12 mb-2">
                                                    <label for="no" class="form-label mb-1">پلاک</label>
                                                    <input form="myForm" type="text" class="form-control form-control-sm" name="no" id="no" placeholder="پلاک">
                                                </section>

                                                <section class="col-12 mb-2">
                                                    <label for="unit" class="form-label mb-1">واحد</label>
                                                    <input form="myForm" name="unit" type="text" class="form-control form-control-sm" id="unit" placeholder="واحد">
                                                </section>

                                                <section class="border-bottom mt-2 mb-3"></section>

                                                <section class="col-12 mb-2">
                                                    <section class="form-check">
                                                        <input form="myForm" class="form-check-input" type="checkbox" name="receiver" id="receiver">
                                                        <label class="form-check-label" for="receiver">
                                                            گیرنده سفارش خودم نیستم
                                                        </label>
                                                    </section>
                                                </section>

                                                <section class="col-12 mb-2">
                                                    <label for="first_name" class="form-label mb-1">نام گیرنده</label>
                                                    <input form="myForm" type="text" class="form-control form-control-sm" name="recipient_first_name" id="first_name" placeholder="نام گیرنده">
                                                </section>

                                                <section class="col-12 mb-2">
                                                    <label for="last_name" class="form-label mb-1" >نام خانوادگی گیرنده</label>
                                                    <input form="myForm" name="recipient_last_name" type="text" class="form-control form-control-sm" id="last_name" placeholder="نام خانوادگی گیرنده">
                                                </section>

                                                <section class="col-12 mb-2">
                                                    <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                    <input form="myForm" type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="شماره موبایل">
                                                </section>



                                            </section>

                                            <section class="modal-footer py-1">
                                                <button onclick="document.getElementById('myForm').submit()" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                            </section>
                                        </section>

                                    </section>

                                </section>

                                <!-- end add address Modal -->




                            </section>

                        </section>

                        <form action="{{route('customer.profile.my-addresses.store')}}" id="myForm" method="post">
                            @csrf
                        </form>
                    </section>
                </main>
            </section>
        </section>
    </section>
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
