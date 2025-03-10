@extends('admin.layouts.master')

@section('head-tag')
    <title>ایمیل </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایمیل </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایمیل
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.notify.email.create')}}" class="btn btn-info btn-sm">ایجاد ایمیل </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان اطلاعیه</th>
                            <th>متن اطلاعیه</th>
                            <th>تاریخ ارسال </th>
                            <th>وضعیت  </th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($emails as $key => $email)
                            <tr id="tr{{$email->id}}">
                                <th>{{++$key}}</th>
                                <td>{{$email->subject}}</td>
                                <td>{!! \Illuminate\Support\Str::limit($email->body,20) !!} </td>
                                <td>{{\App\Helpers\jalaliDate($email->published_at,'H:i:s Y-m-d')}} </td>
                                <td>
                                    <input id="{{$email->id}}" data-url="{{route('admin.notify.email.status',[$email->id])}}" onchange="changeStatus({{$email->id}})" type="checkbox" {{$email->status == 1 ? 'checked' : ''}}>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.notify.email-file.index',[$email->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> فایل های ضمیمه شده</a>
                                    <a href="{{route('admin.notify.email.edit',[$email->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <a href="{{route('admin.notify.email.sendMail',[$email->id])}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> ارسال</a>
                                    <a data-url="{{route('admin.notify.email.destroy',[$email->id])}}" onclick="deleteSms({{$email->id}})"  id="delete{{$email->id}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash-alt"></i> حذف</a>
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
        let deleteSms = (id)=>{
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
                    let url = element.attr('data-url');
                    $.ajax({
                        url,
                        type: 'POST',
                        data:{
                            _method: 'delete'
                        },
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:(res)=>{
                            if (res.status){
                                let trTag = $('#tr'+id)
                                trTag.remove()
                                successAlert('ایمیل با موفقیت حذف شد')
                            }
                            else {
                                errorAlert('خطایی رخ داد!')
                            }


                        },
                        error:()=>{
                            errorAlert('ارتباط برقرار نشد!')
                        }


                    })
                    let successAlert = (message)=>{
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: message,
                            confirmButtonText : 'باشه'
                        })
                    }
                    let errorAlert = (message)=>{
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: message,
                            confirmButtonText : 'باشه'
                        })
                    }
                }

            })
        }

        let changeStatus = (id)=>{
            let element = $('#'+id)
            let elementValue = !element.prop('checked')
            let url = element.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status,checked} = res;
                    if (status){
                        if (checked){
                            element.prop('checked',true)
                            successToast('ایمیل با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('ایمیل با موفقیت غیرفعال شد')
                        }
                    }
                    else {
                        errorToast('خطایی رخ داد!')
                        element.prop('checked',elementValue)
                    }
                },
                error:()=>{
                    errorToast('ارتباط برقرار نشد!')
                    element.prop('checked',elementValue)
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
    </script>
@endsection
