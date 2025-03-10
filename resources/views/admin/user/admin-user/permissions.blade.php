@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد دسترسی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>

            <li class="breadcrumb-item font-size-12 " > <a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسترسی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد دسترسی
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.admin-user.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.user.admin-user.permissions.store',[$user->id])}}">
                        @csrf
                        <section class="row">



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">دسترسی ها </label>

                                    <select name="permissions[]" id="select_roles" multiple="multiple"  class=" form-control form-control-sm">
                                        <option value="">انتخاب کنید</option>

                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}" @foreach($user->permissions as $user_permission) @if($user_permission->id == $permission->id) selected @endif @endforeach>{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('permissions')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>

                        </section>
                    </form>

                </section>

            </section>
        </section>
    </section>
@endsection
@section('script')
<script>

    let select = $('#select_roles')




    select.select2({
        placeholder:'لطفا دسترسی ها را انتخاب کنید',

    })

</script>
@endsection
