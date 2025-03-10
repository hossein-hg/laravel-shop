@extends('admin.layouts.master')

@section('head-tag')
    <title>فاکتور سفارش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فاکتور سفارش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        فاکتور سفارش
                    </h5>
                </section>



                <section class="table-responsive">
                    <table class="table table-striped  h-150px" id="printable">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>


                            <tr class="table-primary">
                                <td>{{$order->id}}</td>
                                <td class="text-left">
                                    <a id="print" class="btn btn-dark btn-sm text-white">
                                        <i class="fa fa-print"></i>
                                        چاپ
                                    </a>
                                    <a href="{{route('admin.market.order.detail',[$order->id])}}" class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-book"></i>
                                        جزییات
                                    </a>
                                </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>نام مشتری</th>
                                <td class="text-left font-weight-bolder">{{$order->user->fullName ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>نشانی</th>
                                <td class="text-left font-weight-bolder">{{$order->address->address ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>شهر</th>
                                <td class="text-left font-weight-bolder">{{$order->address->city->name ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>کد ملی</th>
                                <td class="text-left font-weight-bolder">{{$order->address->postal_code ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>پلاک</th>
                                <td class="text-left font-weight-bolder">{{$order->address->no ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>واحد</th>
                                <td class="text-left font-weight-bolder">{{$order->address->unit ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>نام گیرنده</th>
                                <td class="text-left font-weight-bolder">{{$order->address->recipient_first_name ?? '-'}} {{$order->address->recipient_last_name ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>موبایل</th>
                                <td class="text-left font-weight-bolder">{{$order->address->mobile ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>نوع پرداخت</th>
                                <td class="text-left font-weight-bolder">{{$order->paymentType() ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>وضعیت پرداخت</th>
                                <td class="text-left font-weight-bolder">{{$order->paymentStatus() ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>مبلغ سفارش</th>
                                <td class="text-left font-weight-bolder">{{$order->delivery_amount ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>وضعیت ارسال</th>
                                <td class="text-left font-weight-bolder">{{$order->deliveryStatus() ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>تاریخ ارسال</th>
                                <td class="text-left font-weight-bolder">{{\App\Helpers\jalaliDate($order->delivery_date) ?? '-'}}</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>مجموع مبلغ سفارش (بدون تخفیف)</th>
                                <td class="text-left font-weight-bolder">{{ $order->order_final_amount ?? '-' }} تومان</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>مجموع تمامی مبلغ تخفیفات</th>
                                <td class="text-left font-weight-bolder">{{ $order->order_discount_amount ?? '-' }} تومان</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>مبلغ تخفیف همه محصولات</th>
                                <td class="text-left font-weight-bolder">{{ $order->order_total_products_discount_amount ?? '-' }} تومان</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>مبلغ نهایی</th>
                                <td class="text-left font-weight-bolder">{{ $order->order_final_amount -  $order->order_discount_amount ?? '-' }} تومان</td>
                            </tr>

                            <tr class="border-bottom">
                                <th>بانک</th>
                                <td class="text-left font-weight-bolder">{{$order->payment->paymentable->gateway ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>کوپن استفاده شده</th>
                                <td class="text-left font-weight-bolder">{{$order->coupon->code ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>میزان تخفیف کوپن</th>
                                <td class="text-left font-weight-bolder">{{$order->order_coupon_discount_amount ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>عنوان تخفیف عمومی</th>
                                <td class="text-left font-weight-bolder">{{$order->commonDiscount->title ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>میزان تخفیف عمومی</th>
                                <td class="text-left font-weight-bolder">{{$order->order_common_discount_amount ?? '-'}} </td>
                            </tr>

                            <tr class="border-bottom">
                                <th>وضعیت سفارش</th>
                                <td class="text-left font-weight-bolder">{{$order->orderStatus() ?? '-'}} </td>
                            </tr>

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')
    <script>
        let print = document.getElementById('print')
        print.addEventListener('click',function (){
            printContent('printable')
        })

        function printContent(el){
            let restorePage = $('body').html()
            let printContent = $('#'+el).clone()
            $('body').empty().html(printContent)
            window.print()
            $('body').html(restorePage)
        }
    </script>
@endsection
