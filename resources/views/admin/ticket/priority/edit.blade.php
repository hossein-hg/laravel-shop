@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش اولویت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">اولویت</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش اولویت</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش اولویت تیکت
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.ticket.priority.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form id="form"  action="{{route('admin.ticket.priority.update',[$priority->id])}}" method="post">
                        <section class="row">
                        @csrf
                            @method('put')
                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">نام اولویت</label>
                                    <input name="name" value="{{old('name',$priority->name)}}" type="text" class="form-control form-control-sm">
                                    @error('priority')
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


