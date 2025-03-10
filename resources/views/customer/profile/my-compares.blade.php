@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>مقایسه محصولات </title>
@endsection




@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        @include('customer.layouts.partials.profile-sidebar')
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>لیست مقایسه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->


@if($products->count() > 0)
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>نام محصول</td>
                                    @foreach($products as $product)
                                    <td class="product{{$product->id}}">{{$product->name}}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td>قیمت محصول</td>
                                    @foreach($products as $product)
                                        <td class="product{{$product->id}}" >{{\App\Helpers\priceFormat($product->price)}} تومان   </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td>عکس محصول</td>
                                    @foreach($products as $product)
                                        <td class="product{{$product->id}}"><img src="{{asset($product->image['indexArray']['small'])}}" alt=""></td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td></td>
                                    @foreach($products as $product)
                                        <td class="product{{$product->id}}">
                                            @if($product->compares->contains(auth()->user()->compare->id))
                                                <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-compare',[$product->slug])}}" id="compare{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از مقایسه" onclick="addToCompare({{$product->id}})">
                                                    <i id="co1{{$product->id}}" class="fa fa-industry text-danger mx-1"></i><span id="span-delete1">حذف از مقایسه</span>
                                                </a>
                                            @else
                                                <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-compare',[$product->slug])}}" id="compare{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به مقایسه" onclick="addToCompare({{$product->id}})">
                                                    <i id="co1{{$product->id}}" class="fa fa-industry text-dark mx-1"></i><span id="span-add1">افزودن به مقایسه</span>
                                                </a>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        @else
                        <h3>محصولی برای مقایسه یافت نشد!</h3>
@endif

                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection



@section('script')
    <script>

        function addToCompare(id){
            let tr = $('.product'+id)

            let compare = $('#compare'+id)
            let url = compare.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status} = res;
                    console.log(status)

                     if (status === 2) {

                         tr.remove()

                    }

                    else if (status === 3) {

                        $('.toast').toast('show')

                    }
                },
                error:()=>{
                    errorToast('ارتباط برقرار نشد!')

                }

            })

        }
    </script>
@endsection
