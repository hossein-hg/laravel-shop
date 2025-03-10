@extends('admin.layouts.master')

@section('head-tag')
    <title>انبار</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> انبار</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        انبار
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="" class="btn btn-info btn-sm disabled">ایجاد انبار </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام  کالا</th>
                                <th>تصویر کالا</th>
                                <th>تعداد فروخته شده </th>
                                <th> تعداد رزرو شده</th>
                                <th> تعداد قابل فروش </th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <th>{{++$key}}</th>
                                <td>{{$product->name}}</td>
                                <td><img src="{{asset($product->image['indexArray']['small'])}}" class="max-height-2rem" alt=""></td>
                                <td>{{$product->sold_number}}</td>
                                <td>{{$product->frozen_number}}</td>
                                <td>{{$product->marketable_number}}</td>
                                <td class="width-22-rem text-left">

                                    <a href="{{route('admin.market.store.addToStore',[$product->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                    <a href="{{route('admin.market.store.edit',[$product->id])}}"  class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> اصلاح موجودی</a>
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
