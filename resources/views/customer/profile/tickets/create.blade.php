@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>ساخت تیکت</title>
@endsection




@section('content')

    <section class="row">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        @include('customer.layouts.partials.profile-sidebar')
                    </section>

                </aside>


                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">




                        <section >
                            <form action="{{route('customer.profile.my-tickets.store')}}" method="post" enctype="multipart/form-data">
                                <section class="row">

                                    <section class="col-12 ">

                                        @csrf
                                        <div class="form-group mb-2">
                                            <section class="d-flex justify-content-between">
                                                <label for="">عنوان تیکت </label>
                                                <a href="{{route('customer.profile.my-tickets')}}" class="btn btn-danger mb-2">بازگشت</a>
                                            </section>
                                            <input  name="subject"   class="form-control form-control-sm" value="{{old('subject')}}" />
                                            @error('subject')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-2">
                                                <label for="">توضیحات تیکت </label>
                                            <textarea  name="description"  rows="4" class="form-control form-control-sm">{{old('description')}}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <section class="col-12 mb-2">
                                            <div class="form-group">
                                                <label for="">دسته تیکت</label>
                                                <select name="category_id" type="text" class="form-control form-control-sm">
                                                    <option value="">دسته را انتخاب کنید</option>
                                                @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </section>

                                        <section class="col-12 mb-2">
                                            <div class="form-group">
                                                <label for="">اولویت تیکت</label>
                                                <select name="priority_id" type="text" class="form-control form-control-sm">
                                                    <option value="">اولویت را انتخاب کنید</option>
                                                    @foreach($priorities as $priority)
                                                        <option value="{{$priority->id}}" {{$priority->id == old('priority_id') ? 'selected' : ''}}>{{$priority->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('priority_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </section>

                                        <section class="col-12 ">
                                            <div class="form-group">
                                                <label for="">فایل </label>
                                                <input name="file" value="{{old('file')}}" type="file" class="form-control form-control-sm">
                                                @error('file')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </section>


                                        <div  class="form-group mt-2">
                                            <button type="submit" class="btn btn-success">ثبت</button>
                                        </div>

                                    </section>


                                </section>
                            </form>

                        </section>


                    </section>
                </main>




            </section>
        </section>
    </section>

@endsection

