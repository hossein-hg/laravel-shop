@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران ادمین</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        کاربران ادمین
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.admin-user.create')}}" class="btn btn-info btn-sm">ایجاد  کاربر ادمین</a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>شماره موبایل </th>
                                <th>نام  </th>


                                <th>وضعیت   </th>
                                <th>فعالسازی   </th>
                                <th>نقش ها   </th>
                                <th>دسترسی ها   </th>
                                <th class=" text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $key => $admin)
                            <tr id="tr{{$admin->id}}">
                                <th>{{++$key}}</th>
                                <td>{{$admin->mobile}}</td>
                                <td>{{$admin->fullName}}</td>

                                <td>
                                    <input id="{{$admin->id}}" data-url="{{route('admin.user.admin-user.status',[$admin->id])}}" onchange="changeStatus({{$admin->id}})" type="checkbox" {{$admin->status == 1 ? 'checked' : ''}}>
                                </td>
                                <td>
                                    <input id="activation{{$admin->id}}" data-url="{{route('admin.user.admin-user.activation',[$admin->id])}}" onchange="changeActivation({{$admin->id}})" type="checkbox" {{$admin->activation == 1 ? 'checked' : ''}}>
                                </td>

                                <td>
                                    @if(empty($admin->roles()->get()->toArray()))
                                        <span class="text-danger">برای این ادمین  نقشی وجود ندارد</span>
                                    @else
                                        @foreach($admin->roles as $key => $role)
                                            {{++$key.' - '.$role->name}} <br>
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    @if(empty($admin->permissions()->get()->toArray()))
                                        <span class="text-danger">برای این ادمین  هیچ دسترسی وجود ندارد</span>
                                    @else
                                        @foreach($admin->permissions as $key => $role)
                                            {{++$key.' - '.$role->name}} <br>
                                        @endforeach
                                    @endif
                                </td>




                                <td class="text-left ">
                                    <a href="{{route('admin.user.admin-user.roles',[$admin->id])}}" class="btn btn-info btn-sm" title="نقش"><i  class="fa fa-user-shield"></i>  </a>
                                    <a href="{{route('admin.user.admin-user.permissions',[$admin->id])}}" class="btn btn-warning btn-sm"><i class="fa fa-user-check" title="دسترسی"></i>  </a>
                                    <a href="{{route('admin.user.admin-user.edit',[$admin->id])}}" title="ویرایش" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> </a>
                                    <a data-url="{{route('admin.user.admin-user.destroy',[$admin->id])}}" title="حذف" onclick="deleteUser({{$admin->id}})"  id="delete{{$admin->id}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash-alt"></i> </a>
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
        let deleteUser = (id)=>{
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
                                successAlert('کاربر با موفقیت حذف شد')
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
                            successToast('کاربر با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('کاربر با موفقیت غیرفعال شد')
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

        let changeActivation = (id)=>{
            let element = $('#activation'+id)
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
                            successToast('فعالسازی کاربر با موفقیت انجام شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('غیرفعالسازی کاربر با موفقیت انجام شد')
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
