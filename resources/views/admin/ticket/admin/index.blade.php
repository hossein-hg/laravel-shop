@extends('admin.layouts.master')

@section('head-tag')
    <title>ادمین تیکت ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">تیکت ها</a></li>

            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ادمین تیکت ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ادمین تیکت ها
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد ادمین  </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام ادمین</th>
                            <th>ایمیل</th>

                            <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $key => $admin)
                        <tr>
                            <th>{{++$key}}</th>
                            <td>{{$admin->fullName}}</td>
                            <td>  {{$admin->email}}</td>

                            <td class="width-16-rem text-left">

                                <a onclick="roleToggle({{$admin->id}})" data-url="{{route('admin.ticket.admin.set',[$admin->id])}}" id="set{{$admin->id}}" class="btn btn-{{$admin->ticketAdmin ? 'danger' : 'primary'}} btn-sm text-white"><i class="fa fa-check"></i> {{$admin->ticketAdmin ? 'حذف' : 'اضافه'}} </a>

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
        let roleToggle = (id)=>{
            let element = $('#set'+id);
            let url = element.attr('data-url')
            $.ajax({
                url,
                type:"GET",
                success:(res)=>{
                    let {status,toggle} = res;
                    console.log(res)
                    if (status){
                        if (toggle){
                            element.html("<i class='fa fa-eye'></i> <span>حذف</span>")
                            element.addClass("btn-danger")
                            element.removeClass("btn-primary")
                            successToast('ادمین با موفقیت اضافه شد')
                        }
                        else {
                            element.html("<i class='fa fa-eye'></i> <span>اضافه</span>")
                            element.removeClass("btn-danger")
                            element.addClass("btn-primary")
                            successToast('ادمین با موفقیت حذف شد')
                        }
                    }
                    else {
                        errorToast('خطایی رخ داد!')

                    }
                },
                err: ()=>{
                    errorToast('خطایی رخ داد!')
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

