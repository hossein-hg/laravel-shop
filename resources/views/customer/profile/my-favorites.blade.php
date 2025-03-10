@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>علاقه مندی ها</title>
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
                                    <span>لیست علاقه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        @forelse($favorites as $favorite)
                        <section id="section{{$favorite->id}}" class="cart-item d-flex py-3">
                            <section class="cart-img align-self-start flex-shrink-1"><img src="{{asset($favorite->image['indexArray']['medium'])}}" alt=""></section>
                            <section class="align-self-start w-100">
                                <p class="fw-bold"> {{$favorite->name}}</p>
                                @if($favorite->colors != null)
                                    @foreach($favorite->colors as $color)
                                <p><span style="background-color: {{$color->color}};" class="cart-product-selected-color me-1"></span> <span>  {{$color->color_name}}</span></p>
                                    @endforeach
                                @endif


                                @if($favorite->guarantees != null)
                                    @foreach($favorite->guarantees as $guarantee)
                                        <p><span  class=""></span> <span>  {{$guarantee->name}}</span></p>
                                    @endforeach
                                @endif
                                <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span></p>
                                <section>
                                    <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-favorite',[$favorite->slug])}}" id="favorite{{$favorite->id}}" data-bs-toggle="tooltip" data-bs-placement="left"  onclick="addToFavorite({{$favorite->id}})">
                                        <i class="fa fa-heart"></i>
                                        {{$favorite->users == null ? 'افزودن به علاقه مندی ها' : 'حذف از علاقه مندی ها'}}</a>
                                </section>
                            </section>
                            <section class="align-self-end flex-shrink-1">
                                <section class="text-nowrap fw-bold">{{\App\Helpers\priceFormat($favorite->price)}} تومان</section>
                            </section>
                        </section>
                        @empty
                            <section class="order-item">
                                <section class="d-flex justify-content-between">
                                    <p>
                                        محصولی یافت نشد
                                    </p>
                                </section>
                            </section>
                        @endforelse


                    </section>
                </main>
            </section>
        </section>
    </section>
@endsection

@section('script')
    <script>
        function addToFavorite(id){
            let favorite = $('#favorite'+id)
            let section = $('#section'+id)
            let icon = $('#fa'+id)
            let url = favorite.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status} = res;

                    if (status === 1){

                        icon.addClass('text-danger')
                        icon.removeClass('text-dark')
                        favorite.attr('data-bs-original-title','حذف از علاقه مندی ها')

                    }
                    else if (status === 2) {
                        section.remove()
                        icon.addClass('text-dark')
                        icon.removeClass('text-danger')
                        favorite.attr('data-bs-original-title','افزودن به علاقه مندی ها')


                    }

                    else if (status === 3) {

                        $('.toast').toast('show')

                    }
                },
                error:()=>{


                }

            })

        }
    </script>
@endsection
