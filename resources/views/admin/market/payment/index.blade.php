@extends('admin.layouts.master')

@section('head-tag')
    <title>پرداخت ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        پرداخت ها
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.category.create')}}" class="btn btn-info btn-sm disabled">ایجاد پرداخت </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>مقدار</th>
                            <th>کد تراکنش</th>
                            <th>بانک </th>
                            <th>پرداخت کننده </th>
                            <th>وضعیت پرداخت</th>
                            <th>نوع پرداخت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key => $payment)
                        <tr>
                            <th>{{++$key}}</th>
                            <th>{{$payment->amount}}</th>
                            <td>نمایشگر</td>
                            <td>{{$payment->paymentable->gate_way ?? '-'}}</td>
                            <td>{{$payment->user->fullName}}</td>
                            <td>{{$payment->paymentStatus()}}</td>
                            <td>{{$payment->typePayment()}}</td>
                            <td class="width-22-rem text-left">
                        
                                <a href="{{route('admin.market.payment.show',[$payment->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
                                <a href="{{route('admin.market.payment.canceled',[$payment->id])}}"  class="btn btn-warning btn-sm {{ $payment->status == 2 ? 'disabled' : '' }}"><i class="fa fa-clock"></i> باطل کردن</a>
                                <a   href="{{route('admin.market.payment.returned',[$payment->id])}}"  class="btn btn-danger btn-sm  {{ $payment->status == 3 ? 'disabled' : '' }}"><i class="fa fa-reply"></i> برگرداندن</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </section>

            </section>
        </section>
    </section>
@endsection
