@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد نقش</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>

            <li class="breadcrumb-item font-size-12 " > <a href="#">کاربران ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد نقش
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.admin-user.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.user.admin-user.roles.store',[$user->id])}}">
                        @csrf
                        <section class="row">



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نقش ها </label>

                                    <select name="roles[]" id="select_roles" multiple="multiple"  class=" form-control form-control-sm">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @foreach($user->roles as $user_role) @if($user_role->id == $role->id) selected @endif @endforeach>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
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
        placeholder:'لطفا نقش ها را انتخاب کنید',

    })

</script>
@endsection
