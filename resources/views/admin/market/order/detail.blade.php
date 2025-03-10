@extends('admin.layouts.master')

@section('head-tag')
    <title>جزییات سفارش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزییات سفارش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        جزییات سفارش
                    </h5>
                </section>



                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>رنگ محصول</th>
                            <th>ضمانت محصول</th>
                            <th>تعداد سفارش</th>
                            <th>مبلغ نهایی تک محصول</th>
                            <th>مبلغ نهایی کل</th>
                            <th>میزان تخفیف شگفت انگیز</th>
                            <th>درصد تخفیف شگفت انگیز</th>
                            <th>ویژگی ها</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->orderItems as $item)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $item->singleProduct->name }}</th>
                                <th>{{ $item->color->color_name ?? '-' }}</th>
                                <th>{{ $item->guarantee->name ?? '-' }}</th>
                                <th>{{ $item->number }}</th>
                                <th>{{ $item->final_product_price }} تومان</th>
                                <th>{{ $item->final_total_price }} تومان</th>
                                <th>{{ $item->amazing_sale_discount_amount ?? '-'}} تومان</th>
                                <th>{{ $item->amazingSale->percentage ?? '-'}}</th>
                                <th>
                                    @foreach($item->orderItemAttributes as $selected)
                                        {{$selected->categoryAttribute->name ?? '-'}} :
                                        {{json_decode($selected->categoryValue->value)->value ?? '-'}}
                                        <br>
                                    @endforeach
                                </th>

                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection
