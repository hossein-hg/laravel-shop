@extends('customer.layouts.master-one-col')
@section('head-tag')
    <title>فروشگاه آمازون</title>
@endsection
@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                <aside id="sidebar" class="sidebar col-md-3">
                    @include('customer.layouts.partials.sidebar')
                </aside>

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            @if(request()->search)
                            <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span class="badge bg-info text-dark">"  {{request()->search}}"</span></span>
                            @endif
                            @if(request()->brands)
                            <span class="d-inline-block border p-1 rounded bg-light">برند :
                                @foreach($brands as $singleBrand)
                                    @if(in_array($singleBrand->id,request()->brands))
                                <span class="badge bg-info text-dark">

                                    "{{ $singleBrand->persian_name }}"

                                </span>
                                    @endif
                                @endforeach
                            </span>

                            @endif
                            @if(request()->search)
                            <span class="d-inline-block border p-1 rounded bg-light">دسته : <span class="badge bg-info text-dark">"کتاب"</span></span>
                            @endif
                            @if(request()->min_price)
                            <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span class="badge bg-info text-dark">{{\App\Helpers\priceFormat(request()->min_price)}} تومان</span></span>
                            @endif
                            @if(request()->max_price)
                            <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span class="badge bg-info text-dark">{{\App\Helpers\priceFormat(request()->max_price)}}  تومان</span></span>
                            @endif

                        </section>
                        <section class="sort ">
                            <span>مرتب سازی بر اساس : </span>
                            <a href="{{route('customer.products',['search'=>request()->search,'sort'=>1,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,request()->category ? request()->category->id : ''])}}" class="btn {{request()->sort == 1 ? "btn-info" : ''}} btn-sm px-1 py-0" >جدیدترین</a>
                            <a href="{{route('customer.products',['search'=>request()->search,'sort'=>2,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,request()->category ? request()->category->id : ''])}}" class="btn {{request()->sort == 2 ? "btn-info" : ''}}  btn-sm px-1 py-0" >گران ترین</a>
                            <a href="{{route('customer.products',['search'=>request()->search,'sort'=>3,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,request()->category ? request()->category->id : ''])}}" class="btn {{request()->sort == 3 ? "btn-info" : ''}}  btn-sm px-1 py-0" >ارزان ترین</a>
                            <a href="{{route('customer.products',['search'=>request()->search,'sort'=>4,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,request()->category ? request()->category->id : ''])}}" class="btn {{request()->sort == 4 ? "btn-info" : ''}}  btn-sm px-1 py-0" >پربازدیدترین</a>
                            <a href="{{route('customer.products',['search'=>request()->search,'sort'=>5,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,request()->category ? request()->category->id : ''])}}" class="btn {{request()->sort == 5 ? "btn-info" : ''}}  btn-sm px-1 py-0" >پرفروش ترین</a>
                        </section>


                        <section class="main-product-wrapper row my-4" >
                        @forelse($products as $product)
                            <section class="col-md-3 p-0">
                                <section class="product">
                                    <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                    <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a></section>
                                    <a class="product-link" href="#">
                                        <section class="product-image">
                                            <img class="" src="{{asset($product->image['indexArray']['large'])}}" alt="">
                                        </section>
                                        <section class="product-colors"></section>
                                        <section class="product-name"><h3>    {{$product->name}}   </h3></section>
                                        <section class="product-price-wrapper">
                                            <section class="product-price">{{\App\Helpers\priceFormat($product->price)}} تومان</section>
                                        </section>
                                    </a>
                                </section>
                            </section>
                            @empty
                            <h4 class="text-danger">محصولی یافت نشد!</h4>
                        @endforelse
                            <section class="col-12">
                                <section class="my-4 d-flex justify-content-center border-0">
                                        {{$products->links()}}
                                </section>
                            </section>

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection



