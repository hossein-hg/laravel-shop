@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسترسی ها </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>

            <li class="breadcrumb-item font-size-12 " > <a href="#">نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسترسی ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش دسترسی ها
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.user.role.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.user.role.permission-update',[$role->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">






@php
    $rolePermissionsArray = $role->permissions->pluck('id')->toArray();
@endphp

                            <section class="col-12">
                                <section class="row">
                                <section class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for=""><h6>نام نقش</h6></label> : <span>{{$role->name}}</span>
                                        <section></section>
                                    </div>
                                </section>

                                <section class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for=""><h6>توضیح نقش</h6></label> : <span>{{$role->description}}</span>
                                        <section></section>
                                    </div>
                                </section>
                                </section>
                                <section class="row border-top mt-3 py-3">

                                    @foreach($permissions as $key => $permission)

                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input name="permissions[]" id="{{$permission->id}}" type="checkbox" class="form-check-input" value="{{$permission->id}}" {{in_array($permission->id,$rolePermissionsArray) ? 'checked' : ''}} >
                                            <label for="{{$permission->id}}" class="form-check-label mr-4"> {{$permission->name}}</label>
                                        </div>
                                        @error('permissions.'.$key)
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </section>
                                    @endforeach
                                </section>

                                <section class="col-12 col-md-2 mt-md-4">
                                    <button class="btn btn-primary btn-sm">ثبت</button>
                                </section>


                            </section>

                        </section>
                    </form>

                </section>

            </section>
        </section>
    </section>
@endsection
