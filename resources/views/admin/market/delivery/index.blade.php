@extends('admin.layouts.master')

@section('head-tag')
    <title>روش ارسال</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> روش ارسال</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        روش ارسال
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.delivery.create')}}" class="btn btn-info btn-sm">ایجاد روش ارسال </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام روش ارسال</th>
                                <th>هزینه ارسال</th>
                                <th>زمان ارسال</th>
                                <th>وضعیت</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($delivery_methods as $key => $method)
                            <tr id="tr{{$method->id}}">
                                <th>{{++$key}}</th>
                                <td>{{$method->name}}</td>
                                <td>{{number_format($method->amount)}} هزار تومان</td>
                                <td>{{$method->delivery_time}} {{$method->delivery_time_unit}}</td>
                                <td><label for="">
                                        <input data-url="{{route('admin.market.delivery.status',[$method->id])}}" id="{{$method->id}}" type="checkbox" {{$method->status == 1 ? 'checked' : ''}} onchange="changeStatus({{$method->id}})">
                                    </label> </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.market.delivery.edit',[$method->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <a  id="delete{{$method->id}}" onclick="deleteRecord({{$method->id}})" data-url="{{route('admin.market.delivery.destroy',[$method->id])}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-edit"></i> حذف</a>
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
                            text: 'دسته بندی با موفقیت فعال شد',
                            confirmButtonText : 'باشه'
                        })
                    }
                    else if(checked === false){
                        element.prop('checked',false)
                        // successToast('دسته بندی با موفقیت غیرفعال شد')
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'دسته بندی با موفقیت غیرفعال شد',
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
