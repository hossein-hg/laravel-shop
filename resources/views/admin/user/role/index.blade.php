@extends('admin.layouts.master')

@section('head-tag')
    <title>نقش ها </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نقش ها </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        نقش ها
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.role.create')}}" class="btn btn-info btn-sm">ایجاد  نقش  </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th>نام نقش </th>
                            <th>توضیحات </th>

                            <th>دسترسی ها    </th>
                            <th>کاربرها    </th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                        <tr id="tr{{$role->id}}">
                            <th>{{++$key}}</th>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>

                            <td>
                                @if(empty($role->permissions()->get()->toArray()))
                                    <span class="text-danger">برای این نقش سطح دسترسی وجود ندارد</span>
                                @else
                                    @foreach($role->permissions as $key => $permission)
                                 {{++$key.' - '.$permission->name}} <br>
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if(empty($role->users()->get()->toArray()))
                                    <span class="text-danger">برای این نقش  کاربری وجود ندارد</span>
                                @else
                                    @foreach($role->users as $key => $user)
                                        {{$user->id.' - '.$user->fullName}} <br>
                                    @endforeach
                                @endif
                            </td>

                            <td class="width-22-rem text-left">

                                <a href="{{route('admin.user.role.permission-role',[$role->id])}}" class="btn btn-info btn-sm"><i class="fa fa-user-graduate"></i> دسترسی ها</a>
                                <a href="{{route('admin.user.role.edit',[$role->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <a  id="delete{{$role->id}}" onclick="deleteRecord({{$role->id}})" data-url="{{route('admin.user.role.destroy',[$role->id])}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-edit"></i> حذف</a>
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

