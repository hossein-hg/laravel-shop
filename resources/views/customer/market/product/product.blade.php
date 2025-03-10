@extends('customer.layouts.master-one-col')
@section('head-tag')

    <title>{{$product->name}}</title>
    <style>
        .rating-box {
            display: inline-block;
        .rating-container {
            direction: rtl !important;
        label {
            display: inline-block;
            margin: 15px 0;
            color: #d4d4d4;
            cursor: pointer;
            font-size: 50px;
            transition: color 0.2s;
        }
        input {
            display: none;
        }
        label:hover, label:hover ~ label, input:checked ~ label  {
            color: gold;
        }



    </style>
@endsection
@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>{{$product->name}} </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <form action="{{route('customer.sales-process.add-to-cart',[$product->slug])}}" method="post">
                        @csrf
                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery">
                                    @php
                                        $imagesGallery = $product->images;
                                        $mainImage = $product->image;
                                        $images = collect();
                                        
                                        $images->push($mainImage);
                                    
                                        foreach ($imagesGallery as $singleImage){
                                            $images->push($singleImage->image);
                                        }

                                        $colors = $product->colors;
                                        $values = $product->values;

                                        $guarantees = $product->guarantees;
                                        $amazingSale = $product->activeAmazingSales();

                                        if ($amazingSale != null){
                                            $discountAmount =   $product->price * ($amazingSale->percentage/100);

                                        }


                                    @endphp


                                    <section class="product-gallery-selected-image mb-3">
                                        <img src="{{asset($images->first()['indexArray']['medium'])}}"   alt="">
                                    </section>


                                    <section class="product-gallery-thumbs">

                                        @foreach($images as $key=>$image)

                                        <img class="product-gallery-thumb" src="{{asset($image['indexArray']['small'])}}" alt="{{$image['indexArray']['small'].'-'.$key}}" data-input="{{asset($image['indexArray']['large'])}}">
                                        @endforeach
                                    </section>

                                </section>


                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{$product->name}}
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-info">
                                    @if($colors->count() != 0)
                                    <p><span>رنگ انتخابی : <span id="selected_color_name">{{$colors->first()->color_name}}</span></span></p>
                                    <p>
                                        @foreach($colors as $key => $color)
                                            <label for="{{"color_".$color->id}}" style="background-color: {{$color->color}};" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$color->color_name}}"></label>
                                            <input value="{{$color->id}}" class="d-none" type="radio" name="color" id="{{"color_".$color->id}}" data-color-name="{{$color->color_name}}" data-color-price="{{$color->price_increase}}" @if($key == 0) checked @endif>
                                        @endforeach

                                    </p>
                                    @endif
                                    @if($guarantees->count() != 0)

                                    <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                        <select name="guarantee" id="guarantee" class="p-1 ">
                                            @foreach($guarantees as $key => $guarantee)
                                            <option  @if($key == 0) selected @endif value="{{$guarantee->id}}" data-guarantee-price="{{$guarantee->price_increase}}">{{$guarantee->name}}</option>
                                            @endforeach
                                        </select>
                                    </p>

                                        @endif
                                    <p>
                                        @if($product->marketable_number > 0)
                                        <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                        <span>کالا موجود در انبار</span>
                                        @else
                                            <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                            <span>کالا ناموجود</span>
                                        @endif
                                    </p>


                                    <div class="d-flex">
                                        @guest
                                            <a style="cursor: pointer" data-url="{{route('customer.market.add-to-favorite',[$product->slug])}}" id="favorite1{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید" onclick="addToFavorite1({{$product->id}})">
                                                <i class="fa fa-heart mx-1"></i>افزودن به علاقه مندی ها
                                            </a>
                                        @endguest
                                        @auth
                                                @if($product->users->contains(auth()->user()->id))
                                                    <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-favorite',[$product->slug])}}" id="favorite1{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی ها" onclick="addToFavorite1({{$product->id}})">
                                                        <i id="fa1{{$product->id}}" class="fa fa-heart text-danger mx-1"></i><span id="span-delete">حذف از علاقه مندی ها</span>
                                                    </a>
                                                @else
                                                    <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-favorite',[$product->slug])}}" id="favorite1{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها" onclick="addToFavorite1({{$product->id}})">
                                                         <i id="fa1{{$product->id}}" class="fa fa-heart text-dark mx-1"></i><span id="span-add">افزودن به علاقه مندی ها</span>
                                                    </a>
                                                @endif
                                        @endauth


{{--compares--}}
                                            @guest
                                                <a style="cursor: pointer" data-url="{{route('customer.market.add-to-compare',[$product->slug])}}" id="compare{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به مقایسه" onclick="addToCompare({{$product->id}})">
                                                    <i class="fa fa-industry mx-1"></i>افزودن به مقایسه
                                                </a>
                                            @endguest
                                            @auth
                                                @if($product->compares->contains(auth()->user()->compare->id))
                                                    <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-compare',[$product->slug])}}" id="compare{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از مقایسه" onclick="addToCompare({{$product->id}})">
                                                        <i id="co1{{$product->id}}" class="fa fa-industry text-danger mx-1"></i><span id="span-delete1">حذف از مقایسه</span>
                                                    </a>
                                                @else
                                                    <a style="cursor: pointer"  data-url="{{route('customer.market.add-to-compare',[$product->slug])}}" id="compare{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به مقایسه" onclick="addToCompare({{$product->id}})">
                                                        <i id="co1{{$product->id}}" class="fa fa-industry text-dark mx-1"></i><span id="span-add1">افزودن به مقایسه</span>
                                                    </a>
                                                @endif
                                            @endauth

                                    </div>

                                    <section>
                                        <section class="cart-product-number d-inline-block ">
                                            <button class="cart-number cart-number-down" type="button">-</button>
                                            <input class="" name="number" type="number" id="number" min="1" max="5" step="1" value="1" readonly="readonly">
                                            <button class="cart-number cart-number-up" type="button">+</button>
                                        </section>
                                    </section>
                                    <p class="mb-3 mt-5">
                                        <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                    </p>
                                </section>
                            </section>

                        </section>
                        <!-- end product info -->

                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">

                                    <p class="text-muted">قیمت کالا</p>
                                    <p  class="text-muted"><span id="price" data-price="{{$product->price}}">{{\App\Helpers\priceFormat($product->price)}} </span><span class="small"> تومان </span></p>
                                </section>
                            @if($amazingSale != null)
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالا</p>
                                    <p class="text-danger fw-bolder"><span id="product_discount_price" data-discount="{{$discountAmount}}">{{\App\Helpers\priceFormat($discountAmount)}}</span> <span class="small">تومان</span></p>
                                </section>
                                @endif

                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-end align-items-center">
                                    <p class="fw-bolder" id="final_price">
                                        @if($amazingSale != null)
                                            {{\App\Helpers\priceFormat($product->price - $discountAmount)}}
                                        @else
                                            {{\App\Helpers\priceFormat($product->price)}}
                                        @endif
                                        <span class="small">تومان</span></p>
                                </section>
                                @if($product->marketable_number > 0)
                                <section class="">

                                    <button type="submit" id="next-level"  class="btn btn-danger d-block form-control">افزودن به سبد خرید</button>

                                </section>
                                @else
                                    <section class="">
                                        <a id="next-level" href="#" class="btn btn-danger d-block disabled">محصول موجود نیست</a>
                                    </section>
                                @endif

                            </section>
                        </section>
                    </section>
                    </form>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->



    <!-- start product lazy load -->
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    @if($relatedProducts->count() > 0)
                    <section class="content-wrapper bg-white p-3 rounded-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper" >
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                            @foreach($relatedProducts as $related)
                                <section class="item">
                                    <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                            @guest
                                                <section class="product-add-to-favorite">
                                                    <a  data-url="{{route('customer.market.add-to-favorite',[$related->slug])}}" id="favorite{{$related->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" onclick="addToFavorite({{$related->id}})">
                                                        <i id="fa" class="fa fa-heart text-dark"></i>
                                                    </a>
                                                </section>
                                            @endguest

                                            @auth
                                                @if($related->users->contains(auth()->user()->id))
                                                    <section class="product-add-to-favorite">
                                                        <a  data-url="{{route('customer.market.add-to-favorite',[$related->slug])}}" id="favorite{{$related->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" onclick="addToFavorite({{$related->id}})">
                                                            <i id="fa{{$related->id}}" class="fa fa-heart text-danger"></i>
                                                        </a>
                                                    </section>
                                                @else
                                                    <section class="product-add-to-favorite">
                                                        <a  data-url="{{route('customer.market.add-to-favorite',[$related->slug])}}" id="favorite{{$related->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" onclick="addToFavorite({{$related->id}})">
                                                            <i id="fa{{$related->id}}" class="fa fa-heart text-dark"></i>
                                                        </a>
                                                    </section>
                                                @endif

                                            @endauth
                                            <a class="product-link" href="#">
                                                <section class="product-image">
                                                    <img class="" src="{{asset($related->image['indexArray']['medium'])}}" alt="">
                                                </section>
                                                <section class="product-name"><h3>  {{$related->name}} </h3></section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-price">{{\App\Helpers\priceFormat($related->price)}} تومان</section>
                                                </section>
                                                <section class="product-colors">
                                                    @foreach($related->colors as $color)
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
                    @endif
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#rating">امتیاز ها</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">
                              {!! $product->introduction !!}
                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">
                                @foreach($values as $value)
                                    <tr>
                                        <td>{{$value->attribute->name}}</td>
                                        <td>{{ json_decode($value->value)->value }} {{$value->attribute->unit}}</td>
                                    </tr>

                                    @endforeach

                                    @foreach($product->metas as $meta)
                                        <tr>
                                            <td>{{$meta->meat_key}}</td>
                                            <td>{{$meta->meat_value}}</td>
                                        </tr>

                                    @endforeach
                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4">
                                @auth
                                <section class="comment-add-wrapper">
                                    <button class="comment-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-comment" ><i class="fa fa-plus"></i> افزودن دیدگاه</button>
                                    <!-- start add comment Modal -->
                                    <section class="modal fade" id="add-comment" tabindex="-1" aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <form method="post" class="row" action="{{route('customer.market.add-comment',[$product->slug])}}">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label"><i class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">

                                                        @csrf

                                                        <section class="col-12 mb-2">
                                                            <label for="comment" class="form-label mb-1" >دیدگاه شما</label>
                                                            <textarea class="form-control form-control-sm" id="comment" placeholder="دیدگاه شما ..." name="body" rows="4"></textarea>
                                                            @error('body')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </section>


                                                </section>
                                                <section class="modal-footer py-1">
                                                    <button type="submit" class="btn btn-sm btn-primary">ثبت دیدگاه</button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                </section>
                                            </section>
                                            </form>
                                        </section>
                                    </section>
                                </section>
                                @endauth

                                @foreach($product->approvedComments() as $comment)
                                <section class="product-comment">
                                    <section class="product-comment-header d-flex justify-content-start">
                                        <section class="product-comment-date">{{\App\Helpers\jalaliDate($comment->creted_at)}}  </section>
                                        <section class="product-comment-title">
                                            @if(empty($comment->user->first_name and $comment->user->last_name))
                                                ناشناس
                                            @else
                                                {{$comment->user->fullName}}
                                            @endif
                                        </section>
                                    </section>
                                    <section class="product-comment-body @if($comment->answers->count() > 0) border-bottom  @endif" >
                                       {!! $comment->body !!}
                                    </section>
                                    @foreach($comment->answers as $comment)
                                        <section class="product-comment p-3">
                                            <section class="product-comment-header d-flex justify-content-start">
                                                <section class="product-comment-date">{{\App\Helpers\jalaliDate($comment->creted_at)}}  </section>
                                                <section class="product-comment-title">
                                                    @if(empty($comment->user->first_name and $comment->user->last_name))
                                                        ناشناس
                                                    @else
                                                        {{$comment->user->fullName}}
                                                    @endif
                                                </section>
                                            </section>
                                            <section class="product-comment-body " >
                                                {!! $comment->body !!}
                                            </section>
                                        </section>

                                    @endforeach
                                </section>

                                @endforeach


                            </section>

                           @auth
                               @if(auth()->user()->isUserPurchedProduct($product->id) > 0)
                               <!-- start rating -->
                                   <section id="rating" class="content-header mt-2 mb-4">
                                       <section class="d-flex justify-content-between align-items-center">
                                           <h2 class="content-header-title content-header-title-small">
                                               امتیاز ها
                                           </h2>
                                           <section class="content-header-link">

                                           </section>

                                       </section>

                                   </section>
                                   <section class="product-comments " >


                                       <form class="rating-box" method="get" action="{{route('customer.market.add-rate',[$product->slug])}}">
                                           <div class="rating-container">
                                               <input type="radio" name="rating" value="5" id="star-5"> <label for="star-5">&#9733;</label>

                                               <input type="radio" name="rating" value="4" id="star-4"> <label for="star-4">&#9733;</label>

                                               <input type="radio" name="rating" value="3" id="star-3"> <label for="star-3">&#9733;</label>

                                               <input type="radio" name="rating" value="2" id="star-2"> <label for="star-2">&#9733;</label>

                                               <input type="radio" name="rating" value="1" id="star-1"> <label for="star-1">&#9733;</label>

                                               <div>
                                                   <button type="submit" class="btn btn-success btn-sm">ثبت امتیاز</button>
                                               </div>
                                           </div>
                                       </form>
                                       <h6 class="mt-2">
                                           میانگین امتیازات: {{number_format($stars,1,'/') ?? 'شما اولین نفر باشید'}}
                                       </h6>
                                       <h6 class="mt-2">
                                           تعداد افراد شرکت کننده: {{$starsCount}}
                                       </h6>

                                   </section>
                                   @endif
                            @endauth


                        </section>



                    </section>
                </section>
            </section>
        </section>
    </section>

    <!-- end description, features and comments -->
    <section class="position-fixed p-4 flex-row-reverse" style="z-index: 9999;left: 0;top:3rem;width: 26rem;max-width: 80%">
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
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            bill()
            $('input[name="color"]').change(function (){
                bill()
            })

            $('select[name="guarantee"]').change(function (){
                bill()
            })

            $('.cart-number').click(function (){

                bill()
            })

        })

        function bill(){
            if ($('input[name="color"]:checked').length !== 0) {
                let selected_color = $('input[name="color"]:checked')
                $('#selected_color_name').html(selected_color.attr('data-color-name'))

            }
            let selected_color_price = 0
            let selected_guarantee_price = 0
            let number = 1
            let product_discount_price = 1
            let price = $('#price')
            let product_original_price = parseFloat(price.attr('data-price'))
            if ($('input[name="color"]:checked').length !== 0) {
                let selected_color = $('input[name="color"]:checked')

                selected_color_price = parseFloat(selected_color.attr('data-color-price'))


            }
            if ($('#guarantee option:selected').length != 0){
                 selected_guarantee_price = $('#guarantee option:selected').attr('data-guarantee-price')
                selected_guarantee_price = parseFloat(selected_guarantee_price)

            }
            if ($('#number').val() > 0){
                 number = $('#number').val()
                // console.log(number)
            }

            if ($('#product_discount_price').attr('data-discount') !== 0){
                product_discount_price = $('#product_discount_price').attr('data-discount')

            }


            let product_price = product_original_price + selected_color_price + selected_guarantee_price
            let final_product_price = number * (product_price - product_discount_price)
            $('#price').html(toFarsiNumber(product_price))
            $('#final_price').html(toFarsiNumber(final_product_price))

        }

        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
    </script>

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
                        let span1 = $('#span-add')
                        let span2 = $('#span-delete')
                        span1.html('حذف از علاقه مندی')
                        span2.html('حذف از علاقه مندی')
                        icon.removeClass('text-dark')
                        favorite.attr('data-bs-original-title','حذف از علاقه مندی')

                    }
                    else if (status === 2) {
                        let span2 = $('#span-delete')
                        let span1 = $('#span-add')
                        span2.html('افزودن به علاقه مندی')
                        span1.html('افزودن به علاقه مندی')
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


        function addToCompare(id){

            let icon = $('#co1'+id)

            let compare = $('#compare'+id)
            let url = compare.attr('data-url')
            console.log(url)
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status} = res;
                    console.log(status)
                    if (status === 1){
                        icon.addClass('text-danger')
                        let span1 = $('#span-add1')
                        let span2 = $('#span-delete1')
                        span1.html('حذف از مقایسه')
                        span2.html('حذف از مقایسه')
                        icon.removeClass('text-dark')
                        compare.attr('data-bs-original-title','حذف از  مقایسه')

                    }
                    else if (status === 2) {
                        let span2 = $('#span-delete1')
                        let span1 = $('#span-add1')
                        span2.html('افزودن به مقایسه')
                        span1.html('افزودن به مقایسه')
                        icon.addClass('text-dark')
                        icon.removeClass('text-danger')
                        compare.attr('data-bs-original-title','اضافه به مقایسه ')

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
    <script>
        //start product introduction, features and comment
        $(document).ready(function() {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function() {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        //end product introduction, features and comment
    </script>


@endsection
