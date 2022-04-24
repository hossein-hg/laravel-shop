@extends('admin.layouts.master')

@section('head-tag')
<title>جزئیات سفارش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزئیات سفارش</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    جزئیات سفارش
                </h5>
            </section>



            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>درصد فروش فوق العاده</th>
                            <th>مبلغ فروش فوق العاده</th>
                            <th>تعداد</th>
                            <th>جمع قیمت محصول</th>
                            <th>مبلغ نهایی</th>
                            <th>رنگ</th>
                            <th>گارانتی</th>
                            <th>ویژگی ها </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderItems as $key => $item)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$item->productName->name}}</td>
                            <td>{{$item->amazingSale->percentage ?? '-'}} %</td>
                            <td>{{$item->amazing_sale_discount_amount}} </td>
                            <td>{{$item->number}} </td>
                            <td>{{$item->final_product_price}} </td>
                            <td>{{$item->final_total_price}} </td>
                            <td>{{$item->color->color_name ?? '-'}} </td>
                            <td>{{$item->guarantee->name ?? '-'}} </td>
                            <td class="width-8-rem text-left">
                                @if($item->orderItemSelectedAttributes)
                                    @foreach($item->orderItemSelectedAttributes as $attribute)
                                        {{$attribute->categoryAttribute->name ?? '-'}} : {{json_decode($attribute->categoryValue->value)->value ?? '-'}}
                                @endforeach
                                @endif
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
