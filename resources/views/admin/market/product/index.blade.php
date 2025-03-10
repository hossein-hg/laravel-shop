@extends('admin.layouts.master')

@section('head-tag')
    <title>محصولات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> محصولات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        محصولات
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.product.create')}}" class="btn btn-info btn-sm ">ایجاد محصول</a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <td>نام محصول</td>
                            <td>تصویر محصول</td>
                            <td>قیمت </td>
                            <td>وزن </td>
                            <td>دسته </td>
                            <td>وضعیت </td>
                            <td>وضعیت فروش </td>


                            <th class="max-width-8-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody >
                        @foreach($products as $key => $product)
                        <tr id="tr{{$product->id}}" class="height-95px">
                            <th>{{++$key}}</th>
                            <td>{{$product->name}}</td>
                            <td><img src="{{asset($product->image['indexArray']['small'])}}" class="max-height-2rem" alt=""></td>
                            <td>{{$product->price}} </td>
                            <td>{{$product->weight}}</td>
                            <td>{{$product->category->name}} </td>
                            <td><label for="">
                                    <input data-url="{{route('admin.market.product.status',[$product->id])}}" id="{{$product->id}}" type="checkbox" {{$product->status == 1 ? 'checked' : ''}} onchange="changeStatus({{$product->id}})">
                                </label>
                            </td>
                            <td><label for="">
                                    <input data-url="{{route('admin.market.product.marketable',[$product->id])}}" id="market{{$product->id}}" type="checkbox" {{$product->marketable == 1 ? 'checked' : ''}} onchange="changeMarket({{$product->id}})">
                                </label>
                            </td>

                            <td class="width-8-rem text-left">
                                <div class="dropdown">
                                    <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-tools"></i> عملیات
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a href="{{route('admin.market.gallery.index',$product->id)}}" class="dropdown-item text-right"><i class="fa fa-images"></i> گالری </a>
                                        <a href="{{route('admin.market.color.index',[$product->id])}}" class="dropdown-item text-right"><i class="fa fa-list-ul"></i> رنگ کالا</a>
                                        <a href="{{route('admin.market.guarantee.index',[$product->id])}}" class="dropdown-item text-right"><i class="fa fa-list-ul"></i> گارانتی کالا</a>
                                        <a href="{{route('admin.market.product.edit',[$product->id])}}" class="dropdown-item text-right"><i class="fa fa-edit"></i> ویرایش</a>


                                        <button  id="delete{{$product->id}}" onclick="deleteRecord({{$product->id}})" data-url="{{route('admin.market.product.destroy',[$product->id])}}" class="dropdown-item text-right"><i class="fa fa-trash-alt"></i> حذف</button>

                                    </div>
                                </div>
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

@section('script')
    <script>
        let changeStatus = (id)=>{
            let element = $('#'+id)
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    console.log(res)
                    let {checked,status} = res
                    if (status === false){
                        element.prop('checked',elementValue)
                        errorToast('خطایی رخ داد!')
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: 'خطایی رخ داد!',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === true){
                        element.prop('checked',true)
                        // successToast('روش ارسال با موفقیت فعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'محصول با موفقیت فعال شد',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === false){
                        element.prop('checked',false)
                        // successToast('دسته بندی با موفقیت غیرفعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'محصول با موفقیت غیرفعال شد',
                            confirmButtonText : 'باشه'
                        })
                    }
                },
                error : function (){
                    element.prop('checked',elementValue)
                    // errorToast('ارتباط برقرار نشد!')
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'ارتباط برقرار نشد!',
                        confirmButtonText : 'باشه'
                    })
                }
            })
            let successToast = (message)=>{
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }
            let errorToast = (message)=>{
                let errorToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }
        }
        let changeMarket = (id)=>{
            let element = $('#market'+id)
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    console.log(res)
                    let {checked,status} = res
                    if (status === false){
                        element.prop('checked',elementValue)
                        errorToast('خطایی رخ داد!')
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: 'خطایی رخ داد!',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === true){
                        element.prop('checked',true)
                        // successToast('روش ارسال با موفقیت فعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'محصول قابل فروش شد',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === false){
                        element.prop('checked',false)
                        // successToast('دسته بندی با موفقیت غیرفعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'محصول غیر قابل فروش شد',
                            confirmButtonText : 'باشه'
                        })
                    }
                },
                error : function (){
                    element.prop('checked',elementValue)
                    // errorToast('ارتباط برقرار نشد!')
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'ارتباط برقرار نشد!',
                        confirmButtonText : 'باشه'
                    })
                }
            })
            let successToast = (message)=>{
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }
            let errorToast = (message)=>{
                let errorToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }
        }
        let showInMenu = (id)=>{
            let element = $('#show'+id)
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    console.log(res)
                    let {checked,status} = res
                    if (status === false){
                        element.prop('checked',elementValue)
                        errorToast('خطایی رخ داد!')
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: 'خطایی رخ داد!',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === true){
                        element.prop('checked',true)
                        // successToast('روش ارسال با موفقیت فعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'دسته بندی در منو قرار گرفت ',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === false){
                        element.prop('checked',false)
                        // successToast('دسته بندی با موفقیت غیرفعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'دسته بندی با موفقیت از منو حذف شد',
                            confirmButtonText : 'باشه'
                        })
                    }
                },
                error : function (){
                    element.prop('checked',elementValue)
                    // errorToast('ارتباط برقرار نشد!')
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'ارتباط برقرار نشد!',
                        confirmButtonText : 'باشه'
                    })
                }
            })
            let successToast = (message)=>{
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }
            let errorToast = (message)=>{
                let errorToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }
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
                    let tr = $('#tr'+id)
                    let url = element.attr('data-url')
                    console.log(result)
                    $.ajax({
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        data:{
                            '_method': 'delete'
                        },
                        success:(res)=>{
                            console.log(res)
                            tr.remove()
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

