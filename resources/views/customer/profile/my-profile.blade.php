@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>پروفایل کاربری</title>
@endsection

@section('content')

    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
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
                                    <span>اطلاعات حساب</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        <section class="d-flex justify-content-end my-4">
                            <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" data-bs-toggle="modal" data-bs-target="#add-address"><i class="fa fa-edit px-1"></i>ویرایش حساب</a>
                        </section>


                        <section class="row">
                            <section class="col-6 border-bottom mb-2 py-2">
                                <section class="field-title">نام</section>
                                <section class="field-value">{{$user->first_name ?? '-'}}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">نام خانوادگی</section>
                                <section class="field-value">{{$user->last_name ?? '-'}}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">شماره تلفن همراه</section>
                                <section class="field-value">{{$user->mobile ?? '-'}}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">ایمیل</section>
                                <section class="field-value">{{$user->email ?? '-'}}</section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">کد ملی</section>
                                <section class="field-value">{{$user->national_code ?? '-'}}</section>
                            </section>



                        </section>




                    </section>


                    <!-- start add address Modal -->
                    <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                        <section class="modal-dialog">
                            <form class="row" action="{{route('customer.profile.my-profile.update')}}" method="post">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ویرایش حساب کاربری</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </section>

                                    <section class="modal-body">

                                        @csrf
                                        @method('put')
                                        <section class="col-6 mb-2">
                                            <label for="first_name" class="form-label mb-1">نام کاربر</label>
                                            <input value="{{old('first_name',$user->first_name)}}" name="first_name" type="text" class="form-control form-control-sm" id="first_name" placeholder="نام کاربر">
                                        </section>

                                        <section class="col-6 mb-2">
                                            <label for="last_name" class="form-label mb-1">نام خانوادگی کاربر</label>
                                            <input name="last_name" type="text" class="form-control form-control-sm" id="last_name" value="{{old('last_name',$user->last_name)}}" placeholder="نام خانوادگی کاربر">
                                        </section>




                                        <section class="col-6 mb-2">
                                            <label for="national_code" class="form-label mb-1">کد ملی</label>
                                            <input name="national_code" type="text" class="form-control form-control-sm" id="national_code" value="{{old('national_code',$user->national_code)}}" placeholder="کد ملی">
                                        </section>


                                    </section>

                                    <section class="modal-footer py-1">
                                        <button type="submit" class="btn btn-sm btn-primary">ویرایش حساب</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                    </section>

                                </section>
                            </form>
                        </section>
                    </section>
                    <!-- end add address Modal -->



                </main>
            </section>
        </section>
    </section>


@endsection
