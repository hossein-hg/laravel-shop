@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش  پرداخت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">پرداخت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        نمایش پرداخت
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.payment.index')}}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                           {{$payment->user->fullName}}  - {{$payment->user->id}}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title"> نوع پرداخت : {{$payment->paymentStatus()}}</h5>
                        <p class="card-text">مقدار: {{$payment->amount}}</p>
                        <p class="card-text">بانک: {{$payment->paymentable->gate_way ?? '-'}}</p>
                        <p class="card-text">دریافت کننده مبلغ: {{$payment->paymentable->cash_receiver ?? '-'}}</p>
                        <p class="card-text">تاریخ پرداخت: {{\App\Helpers\jalaliDate($payment->paymentable->pay_date) ?? '-'}}</p>
                    </section>
                </section>


            </section>
        </section>
    </section>
@endsection
