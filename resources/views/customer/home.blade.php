@extends('customer.layouts.master-one-col')
@section('head-tag')
    <title>فروشگاه آمازون</title>
@endsection
@section('content')

    <section>
    <!-- start slideshow -->
    <section class="container-xxl my-4">
        <section class="row">

            <section class="col-md-8 pe-md-1 ">

                <section id="slideshow" class="owl-carousel owl-theme">

                    @foreach ($slideShowImages as $slideShowImage)

                        <section class="item">
                            <a class="w-100 d-block h-auto text-decoration-none" href="{{ urldecode($slideShowImage->url) }}">
                                <img class="w-100 rounded-2 d-block h-auto" src="{{ asset($slideShowImage->image) }}" alt="{{$slideShowImage->title}}">
                            </a>
                        </section>

                    @endforeach

                </section>

            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($topBanners as $top)
                <section class="mb-2"><a href="#" class="d-block"><img class="w-100 rounded-2" src="{{asset($top->image)}}" alt="{{$top->title}}"></a></section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end slideshow -->



    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{route('customer.products',['sort'=>4])}}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                            @foreach($mostVisitedProducts as $mostVisited)
                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            <section class="product-add-to-cart"><a  data-bs-toggle="tooltip" data-bs-placement="left"   title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                            @guest
                                            <section class="product-add-to-favorite">
                                                <a  data-url="{{route('customer.market.add-to-favorite',[$mostVisited->slug])}}" id="favorite{{$mostVisited->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" onclick="addToFavorite({{$mostVisited->id}})">
                                                    <i id="fa" class="fa fa-heart text-dark"></i>
                                                </a>
                                            </section>
                                            @endguest

                                            @auth
                                                @if($mostVisited->users->contains(auth()->user()->id))
                                                    <section class="product-add-to-favorite">
                                                        <a  data-url="{{route('customer.market.add-to-favorite',[$mostVisited->slug])}}" id="favorite{{$mostVisited->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" onclick="addToFavorite({{$mostVisited->id}})">
                                                            <i id="fa{{$mostVisited->id}}" class="fa fa-heart text-danger"></i>
                                                        </a>
                                                    </section>
                                                @else
                                                    <section class="product-add-to-favorite">
                                                        <a  data-url="{{route('customer.market.add-to-favorite',[$mostVisited->slug])}}" id="favorite{{$mostVisited->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" onclick="addToFavorite({{$mostVisited->id}})">
                                                            <i id="fa{{$mostVisited->id}}" class="fa fa-heart text-dark"></i>
                                                        </a>
                                                    </section>
                                                @endif

                                            @endauth
                                            <a class="product-link" href="{{route('customer.market.product',[$mostVisited->slug])}}">
                                                <section class="product-image">
                                                    <img class="" src="{{asset($mostVisited->image['indexArray']['medium'])}}" alt="{{$mostVisited->name}}">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name"><h3>      {{$mostVisited->name}}   </h3></section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-discount">
                                                        <span class="product-old-price">6,895,000 </span>
                                                        <span class="product-discount-amount">10%</span>
                                                    </section>
                                                    <section class="product-price">6,264،000 تومان</section>
                                                </section>
                                                <section class="product-colors">
                                                    @foreach($mostVisited->colors as $color)
                                                        <section class="product-colors-item" style="background-color: {{$color->color}};"></section>
                                                    @endforeach

                                                </section>
                                            </a>
                                        </section>
                                    </section>
                                </section>
                              @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->



    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                @foreach($middleBanners as $middle)
                <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100" src="{{asset($middle->image)}}" alt="{{$middle->name}}"></section>
                @endforeach
            </section>

        </section>
    </section>
    <!-- end ads section -->


    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد آمازون به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="{{route('customer.products',['sort'=>5])}}">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                            @foreach($offerProducts as $offer)

                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                            @guest
                                            <section class="product-add-to-favorite">
                                                <a  data-url="{{route('customer.market.add-to-favorite',[$offer->slug])}}" id="favorite1{{$offer->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="{{$offer->users == null ? 'افزودن به علاقه مندی ها' : 'حذف از علاقه مندی ها'}}" onclick="addToFavorite1({{$offer->id}})">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </section>
                                            @endguest
                                            @auth
                                                @if($offer->users->contains(auth()->user()->id))
                                                <section class="product-add-to-favorite">
                                                    <a  data-url="{{route('customer.market.add-to-favorite',[$offer->slug])}}" id="favorite1{{$offer->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی ها" onclick="addToFavorite1({{$offer->id}})">
                                                        <i id="fa1{{$offer->id}}" class="fa fa-heart text-danger"></i>
                                                    </a>
                                                </section>
                                                @else
                                                    <section class="product-add-to-favorite">
                                                        <a  data-url="{{route('customer.market.add-to-favorite',[$offer->slug])}}" id="favorite1{{$offer->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی ها" onclick="addToFavorite1({{$offer->id}})">
                                                            <i id="fa1{{$offer->id}}" class="fa fa-heart text-dark"></i>
                                                        </a>
                                                    </section>
                                                @endif
                                            @endauth
                                            <a class="product-link" href="{{route('customer.market.product',[$offer->slug])}}">
                                                <section class="product-image">
                                                    <img class="" src="{{$offer->image['indexArray']['medium']}}" alt="{{$offer->name}}">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name"><h3>{{\Illuminate\Support\Str::limit($offer->name,20)}}</h3></section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-discount">
                                                        <span class="product-old-price">{{\App\Helpers\priceFormat($offer->price)}} </span>
                                                        <span class="product-discount-amount">22%</span>
                                                    </section>
                                                    <section class="product-price">{{\App\Helpers\priceFormat($offer->price)}} تومان</section>
                                                </section>
                                                <section class="product-colors">
                                                    @foreach($offer->colors as $color)
                                                    <section class="product-colors-item" style="background-color: {{$color->color}};"></section>
                                                    @endforeach
                                                </section>
                                            </a>
                                        </section>
                                    </section>
                                </section>
                            @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->


    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- one column -->
            <section class="row py-4">
                <section class="col"><img class="d-block rounded-2 w-100" src="{{$bottomBanner->image}}" alt="{{$bottomBanner->name}}"></section>
            </section>

        </section>
    </section>
    <!-- end ads section -->



    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4" >
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach($brands as $brand)
                            <section class="item">
                                <section class="brand-item">
                                    <a href="{{route('customer.products',['brands[]'=>$brand->id])}}"><img class="rounded-2" src="{{$brand->logo['indexArray']['medium']}}" alt="{{$brand->persian_name}}"></a>
                                </section>
                            </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->

    <section class="position-fixed p-4 flex-row-reverse" style="z-index: 9999;right: 0;top:3rem;width: 26rem;max-width: 80%">
        <section class="toast" data-delay="7000">
            <section class="toast-body py-3 d-flex text-dark bg-info">
                <strong class="ml-auto">
                    برای افزودن کالا به لیست علاقه مندی ها باید ابتدا وارد حساب کاربری خود شوید
                    <br>
                    <a href="{{route('auth.customer.login-register-form')}}" class="text-dark">
                        ثبت نام / ورود
                    </a>
                </strong>
                <button type="button" class="ml-2 mb-1 close btn btn-danger" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </section>
        </section>
    </section>
    </section>


@endsection

@section('script')
    <script>

        function addToFavorite(id){
            let favorite = $('#favorite'+id)
            let icon = $('#fa'+id)
            let url = favorite.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status} = res;
                    console.log(status)
                    if (status === 1){

                            icon.addClass('text-danger')
                            icon.removeClass('text-dark')
                            favorite.attr('data-bs-original-title','حذف از علاقه مندی ها')

                    }
                    else if (status === 2) {

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
        function addToFavorite1(id){
            let icon = $('#fa1'+id)

            let favorite = $('#favorite1'+id)
            let url = favorite.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status} = res;
                    if (status === 1){
                        icon.addClass('text-danger')
                        icon.removeClass('text-dark')
                        favorite.attr('data-bs-original-title','حذف از علاقه مندی')

                    }
                    else if (status === 2) {

                        icon.addClass('text-dark')
                        icon.removeClass('text-danger')
                        favorite.attr('data-bs-original-title','اضافه به علاقه مندی')

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
