@extends('admin.layouts.master')

@section('head-tag')
    <title>سوالات متداول</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سوالات متداول</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        سوالات متداول
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.content.faq.create')}}" class="btn btn-info btn-sm">ایجاد سوال جدید </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>پرسش </th>
                                <th>خلاصه پاسخ </th>
                                <th>وضعیت  </th>
                                <th class="max-width-16-rem text-left"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($faqs as $key => $faq)
                            <tr id="tr{{$faq->id}}">
                                <th>{{++$key}}</th>
                                <td>{!! substr($faq->question,0,20) !!}</td>
                                <td>{!! substr($faq->answer,0,20) !!}</td>
                                <td><input data-url="{{route('admin.content.faq.status',[$faq->id])}}" id="{{$faq->id}}" onchange="changeStatus({{$faq->id}})" type="checkbox" {{$faq->status == 1 ? 'checked' : ''}}></td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.content.faq.edit',[$faq->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <a data-url="{{route('admin.content.faq.destroy',[$faq->id])}}" id="delete{{$faq->id}}" onclick="deleteFaq({{$faq->id}})"  class="btn btn-danger btn-sm text-white"><i class="fa fa-trash-alt"></i> حذف</a>
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
        let changeStatus = (id)=> {
            let element = $('#' + id)
            let elementValue = !element.prop('checked')
            let url = element.attr('data-url')
            $.ajax({
                url,
                type: 'GET',
                success: (res) => {
                    let {status, checked} = res;
                    if (status) {
                        if (checked) {

                            element.prop('checked', true)
                            successToast('پست با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false)
                            successToast('پست با موفقیت غیرفعال شد')
                        }
                    } else {
                        errorToast('خطایی رخ داد!')
                        element.prop('checked', elementValue)
                    }
                },
                error: () => {
                    errorToast('ارتباط برقرار نشد!')
                    element.prop('checked', elementValue)
                }

            })
            let successToast = (message) => {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n' +
                    '</section>\n' +
                    '</section>'
                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove()
                })
            }
        }

        let deleteFaq = (id)=>{

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
                    let element = $('#delete'+id);
                    let url = element.attr('data-url');
                    $.ajax({
                        url,
                        type: "POST",
                        data:{
                            _method: 'delete'
                        },
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:(res)=>{
                            let {status} = res;
                            if (status){
                                let trTag = $('#tr'+id);

                                trTag.remove();
                                successAlert('پرسش با موفقیت حذف شد')
                            }
                            else {
                                errorAlert('خطایی رخ داد!')
                            }
                        },
                        error:()=>{
                            errorAlert('خطایی رخ داد!')
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
    </script>
@endsection
