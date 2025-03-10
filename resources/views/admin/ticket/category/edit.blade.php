@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش دسته بندی تیکت
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.ticket.category.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form id="form" enctype="multipart/form-data" action="{{route('admin.ticket.category.update',[$category->id])}}" method="post">
                        <section class="row">
                        @csrf
                            @method('put')
                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">نام دسته</label>
                                    <input name="name" value="{{old('name',$category->name)}}" type="text" class="form-control form-control-sm">
                                    @error('name')
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


