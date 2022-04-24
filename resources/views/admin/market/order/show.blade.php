@extends('admin.layouts.master')

@section('head-tag')
<title>فاکتور سفارش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> فاکتور</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    فاکتور
                </h5>
            </section>



            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px" id="printable">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$order->id}}</td>
                            <td class="width-8-rem text-left">
                                <a id="print" class="btn btn-dark btn-sm text-white" href=""><i class="fa fa-print"></i> چاپ
                                </a>
                                <a class="btn btn-warning btn-sm" href="{{route('admin.market.order.show.detail',[$order->id])}}"><i class="fa fa-book"></i> جزئیات
                                </a>
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>نام مشتری</td>
                            <td class="text-left">{{$order->user->fullName ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>آدرس</td>
                            <td class="text-left">{{$order->address->address ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>شهر</td>
                            <td class="text-left">{{$order->address->city->name ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>کد پستی</td>
                            <td class="text-left">{{$order->address->postal_code ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>شماره پلاک</td>
                            <td class="text-left">{{$order->address->no ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>نام گیرنده</td>
                            <td class="text-left">{{$order->address->recipient_first_name ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>نام خانوادگی گیرنده</td>
                            <td class="text-left">{{$order->address->recipient_last_name ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>موبایل</td>
                            <td class="text-left">{{$order->address->mobile ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>نوع پرداخت</td>
                            <td class="text-left">
                                {{$order->payment_type_value}}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>وضعیت پرداخت</td>
                            <td class="text-left">
                                {{$order->payment_status_value}}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>مبلغ ارسال</td>
                            <td class="text-left">{{$order->delivery_amount ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>وضعیت ارسال</td>
                            <td class="text-left">
                                {{$order->delivery_status_value}}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>تاریخ ارسال</td>
                            <td class="text-left">{{jalaliDate($order->delivery_date) ?? '-'}}</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>مجموع مبلغ سفارش (بدون تخفیف)</td>
                            <td class="text-left">{{$order->order_final_amount ?? '-'}} تومان</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>مجموع تمامی مبلغ تخفیف تخفیفات</td>
                            <td class="text-left">{{$order->order_discount_amount ?? '-'}} تومان</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>مبلغ تخفیف همه محصولات</td>
                            <td class="text-left">{{$order->order_total_products_discount_amount ?? '-'}} تومان</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>مبلغ نهایی</td>
                            <td class="text-left">{{$order->order_final_amount - $order->order_discount_amount ?? '-'}} تومان</td>
                        </tr>

                        <tr class="border-bottom">
                            <td>بانک</td>
                            <td class="text-left">{{$order->payment->paymentable->gateway ?? '-'}} </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>کوپن استفاده شده</td>
                            <td class="text-left">{{$order->coupon->code ?? '-'}} </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>میزان تخفیف کد کوپن</td>
                            <td class="text-left">{{$order->order_coupon_discount_amount ?? '-'}} </td>
                        </tr>

                        <tr class="border-bottom">
                            <td> تخفیف عمومی</td>
                            <td class="text-left">{{$order->commonDiscount->title ?? '-'}} </td>
                        </tr>

                        <tr class="border-bottom">
                            <td> مبلغ تخفیف عمومی</td>
                            <td class="text-left">{{$order->order_common_discount_amount ?? '-'}} </td>
                        </tr>

                        <tr class="border-bottom">
                            <td>وضعیت سفارش</td>
                            <td class="text-left">
                                {{$order->order_status_value}}
                            </td>
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
        let printBtn = document.getElementById('print');
        printBtn.addEventListener('click',function (){
            printContent('printable')
        })

        function printContent(el)
        {
            let restorePage = $('body').html();
            let printContent = $('#'+el).clone();
            $('body').empty().html(printContent);
            window.print()
            $('body').html(restorePage);
        }
    </script>
@endsection
