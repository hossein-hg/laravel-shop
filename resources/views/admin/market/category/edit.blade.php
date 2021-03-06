@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش دسته بندی
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form id="form" action="{{route('admin.market.category.update',[$productCategory->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">نام دسته</label>
                                    <input value="{{old('name',$productCategory->name)}}" id="name" type="text" name="name" class="form-control form-control-sm @error('name') border-danger @enderror">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="parent_id">دسته والد</label>
                                    <select  name="parent_id" id="parent_id" class="form-control form-control-sm @error('parent_id') border-danger @enderror">
                                        <option value="">دسته بندی را انتخاب کنید ..</option>
                                        @foreach($product_categories as $category)
                                            <option value="{{$category->id}}" @if(old('parent_id',$productCategory->parent_id) == $category->id) selected @endif>  {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <input id="tags" value="{{old('tags',$productCategory->tags)}}" type="hidden" name="tags" class="form-control form-control-sm @error('tags') border-danger @enderror">
                                    <select id="select_tags" class="select2 form-control form-control-sm" multiple></select>
                                    @error('tags')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">تصویر</label>
                                    <input id="image" type="file" name="image" class="form-control form-control-sm ">

                                </div>
                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($productCategory->image['indexArray'] as $key => $value )
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="currentImage" value="{{ $key }}" id="{{ $number }}" @if($productCategory->image['currentImage'] == $key) checked @endif>
                                                <label for="{{ $number }}" class="form-check-label mx-2">
                                                    <img src="{{ asset($value) }}" class="w-100" alt="">
                                                </label>
                                            </div>
                                        </section>
                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach

                                </section>
                            </section>


                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select  name="status" id="status" class="form-control form-control-sm @error('status') border-danger @enderror">
                                        <option value="0" @if(old('status',$productCategory->status) == 0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status',$productCategory->status) == 1) selected @endif>فعال</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="show_in_menu">نمایش در منو</label>
                                    <select  name="show_in_menu" id="show_in_menu" class="form-control form-control-sm @error('show_in_menu') border-danger @enderror">
                                        <option value="0" @if(old('show_in_menu',$productCategory->show_in_menu) == 0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('show_in_menu',$productCategory->show_in_menu) == 1) selected @endif>فعال</option>
                                    </select>
                                    @error('show_in_menu')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="description"  class="form-control form-control-sm" rows="6">{{old('description',$productCategory->description)}}</textarea>
                                    @error('description')
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

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
        $(document).ready(function (){
            let tags_input = $('#tags');
            let select_tags = $('#select_tags')
            let default_tags = tags_input.val();
            let default_data = null;
            if (tags_input.val() !== null && tags_input.val().length >0)
            {
                default_data = default_tags.split(',');
            }
            select_tags.select2({
                placeholder:'لطفا تگ های خود را وارد کنید',
                tags:true,
                data : default_data
            })
            select_tags.children('option').attr('selected',true).trigger('change')

            $('#form').submit(function (e){
                if (select_tags.val() !== null && select_tags.val().length > 0){
                    let selected_source = select_tags.val().join(',')
                    tags_input.val(selected_source)
                }
            })
        })
    </script>

@endsection
