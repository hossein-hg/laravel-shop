@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>سبد خرید</title>
@endsection




@section('content')
    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">

        <!-- start cart -->
        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>سبد خرید شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <form action="{{route('customer.sales-process.update-cart')}}" id="" method="post">
                        <section class="row mt-4">
                            <section class="col-9">
                                <section class="content-wrapper bg-white p-3 rounded-2">

                                        @csrf
                                        @php
                                            $totalProductPrice = 0;
                                            $totalDiscount = 0;
                                        @endphp
                                @foreach($cartItems as $item)
                                            @php
                                                $totalProductPrice += $item->cartItemProductPrice();
                                                $totalDiscount += $item->cartItemProductDiscount();
                                            @endphp
                                    <section id="section{{$item->id}}" class="cart-item d-flex py-3">
                                        <section class="cart-img align-self-start flex-shrink-1"><img src="{{$item->product->image['indexArray']['medium']}}" alt=""></section>
                                        <section class="align-self-start w-100">
                                            <p class="fw-bold">{{$item->product->name}}    </p>
                                            @if(!empty($item->color))
                                            <p>
                                                <span style="background-color: {{$item->color->color}};" class="cart-product-selected-color me-1"></span> <span>{{$item->color->color_name}}</span>
                                            </p>
                                            @else
                                                <p>رنگ منتخب وجود ندارد</p>
                                            @endif
                                            @if(!empty($item->guarantee))
                                            <p>
                                                <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span> {{$item->guarantee->name}}</span>
                                            </p>
                                            @else
                                                <p>گارانتی منتخب وجود ندارد</p>
                                            @endif
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span></p>
                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <button class="cart-number cart-number-down" type="button">-</button>
                                                    <input class="number" data-product-price="{{$item->cartItemProductPrice()}}" data-product-discount="{{$item->cartItemProductDiscount()}}"  type="number" min="1" max="5" step="1" value="{{$item->number}}" name="number[{{$item->id}}]" readonly="readonly">
                                                    <button class="cart-number cart-number-up" type="button">+</button>
                                                </section>
                                                <a style="cursor: pointer" data-url="{{route('customer.sales-process.remove-from-cart',[$item->id])}}" id="delete{{$item->id}}" class="text-decoration-none ms-4 cart-delete"  onclick="deleteRecord({{$item->id}})"><i class="fa fa-trash-alt"></i> حذف از سبد</a>
                                            </section>
                                        </section>
                                        <section class="align-self-end flex-shrink-1">
                                            @if(!empty($item->product->activeAmazingSales()))
                                            <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف {{\App\Helpers\priceFormat($item->cartItemProductDiscount())}}
                                            </section>
                                            @endif
                                            <section class="text-nowrap fw-bold">{{\App\Helpers\priceFormat($item->cartItemProductPrice())}} تومان</section>
                                        </section>
                                    </section>

                                @endforeach





                                </section>
                            </section>
                            <section class="col-3">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالاها ({{$cartItems->count()}})</p>
                                        <p id="total_product_price" class="text-muted">{{\App\Helpers\priceFormat($totalProductPrice)}} تومان</p>
                                    </section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p id="total_discount" class="text-danger fw-bolder">{{\App\Helpers\priceFormat($totalDiscount)}} تومان</p>
                                    </section>
                                    <section class="border-bottom mb-3"></section>
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">جمع سبد خرید</p>
                                        <p id="total_price" class="fw-bolder">{{\App\Helpers\priceFormat($totalProductPrice - $totalDiscount)}} تومان</p>
                                    </section>

                                    <p class="my-3">
                                        <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                                    </p>


                                    <section class="">

                                        <button type="submit" class="btn btn-danger d-block w-100">تکمیل فرآیند خرید</button>
                                    </section>

                                </section>
                            </section>
                        </section>
                        </form>
                    </section>
                </section>

            </section>
        </section>
        <!-- end cart -->




        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>کالاهای مرتبط با سبد خرید شما</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach($related as $product)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <a  data-url="{{route('customer.market.add-to-favorite',[$product->slug])}}" id="favorite{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" onclick="addToFavorite({{$product->id}})">
                                                            <i id="fa" class="fa fa-heart text-dark"></i>
                                                        </a>
                                                    </section>
                                                @endguest

                                                @auth
                                                    @if($product->users->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <a  data-url="{{route('customer.market.add-to-favorite',[$product->slug])}}" id="favorite{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" onclick="addToFavorite({{$product->id}})">
                                                                <i id="fa{{$product->id}}" class="fa fa-heart text-danger"></i>
                                                            </a>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <a  data-url="{{route('customer.market.add-to-favorite',[$product->slug])}}" id="favorite{{$product->id}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی" onclick="addToFavorite({{$product->id}})">
                                                                <i id="fa{{$product->id}}" class="fa fa-heart text-dark"></i>
                                                            </a>
                                                        </section>
                                                    @endif

                                                @endauth
                                                <a class="product-link" href="#">
                                                    <section class="product-image">
                                                        <img class="" src="{{asset($product->image['indexArray']['medium'])}}" alt="{{$product->name}}">
                                                    </section>
                                                    <section class="product-name"><h3>  {{$product->name}}</h3></section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-price">{{\App\Helpers\priceFormat($product->price)}} تومان</section>
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($product->colors as $color)
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




    </main>
    <!-- end main one col -->

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
    </script>
    <script>

        $(document).ready(function (){

            bill()
            $('.cart-number').click(function (){
                bill()
            })
        })

        function bill(){
            console.log('bill')
            let totalProductPrice = 0;
            let totalDiscount = 0;
            let totalPrice = 0;
            $('.number').each(function (){
                let productPrice = parseFloat($(this).data('product-price'))
                let productDiscount = parseFloat($(this).data('product-discount'))
                let number = parseFloat($(this).val())
                totalProductPrice += productPrice * number
                totalDiscount += productDiscount * number


            })
            totalPrice = totalProductPrice - totalDiscount
            $('#total_product_price').html(toFarsiNumber(totalProductPrice))
            $('#total_discount').html(toFarsiNumber(totalDiscount))
            $('#total_price').html(toFarsiNumber(totalPrice))
        }

        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }

        function deleteRecord(id){

            Swal.fire({
                title: 'آیا مطمین هستید؟',
                text: "می خواهید رکورد را حذف کنید؟",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'انصراف',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله, حذف کن!'
            }).then((result) => {

                if (result.value) {
                    let element = $('#delete'+id)
                    let tr = $('#section'+id)
                    let url = element.attr('data-url')

                    $.ajax({
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',

                        success:(res)=>{

                            tr.remove()
                            bill()
                            Swal.fire({
                                icon: 'success',
                                title: 'موفق',
                                text: 'رکورد با موفقیت حذف شد',
                                confirmButtonText : 'باشه'
                            })

                        }
                    })
                }
            })


        }
    </script>


@endsection












