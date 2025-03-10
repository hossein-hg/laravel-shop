@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پست</title>

    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">پست ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش پست
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.content.post.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form id="form" enctype="multipart/form-data" action="{{route('admin.content.post.update',[$post->id])}}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان پست</label>
                                    <input value="{{old('title',$post->title)}}" type="text" name="title" class="form-control form-control-sm">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">انتخاب دسته</label>
                                    <select name="category_id" type="text" class="form-control form-control-sm">
                                        <option >دسته را انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($category->id == old('category_id',$post->category_id)) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">گذاشتن نظر </label>
                                    <select name="commentable" type="text" class="form-control form-control-sm">

                                        <option value="1" @if($post->commentable == 1) selected @endif>فعال</option>
                                        <option value="0" @if($post->commentable == 0) selected @endif>غیرفعال</option>
                                    </select>
                                    @error('commentable')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input name="image" type="file" class="form-control form-control-sm">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                                <section class="row">
                                    @php($number = 1)
                                    @foreach($post->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{6/$number}}">
                                            <div class="form-check">
                                                <input {{$post->image['currentImage'] == $key ? 'checked' : ''}} name="currentImage" id="{{$number}}" value="{{$key}}" type="radio" class="form-check-input">
                                                <label for="{{$number}}" class="form-check-label mx-2">
                                                    <img src="{{asset($value)}}" class="w-100" alt="">
                                                </label>
                                            </div>
                                        </section>
                                        @php($number++)
                                    @endforeach

                                </section>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تگ ها </label>
                                    <input   id="tags" name="tags" value="{{old('tags',$post->tags)}}" type="hidden" class="form-control form-control-sm">
                                    <select id="select" multiple="multiple"  class="select2 form-control form-control-sm"></select>
                                    @error('tags')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ انتشار </label>
                                    <input id="published_at" name="published_at" type="hidden" class="form-control form-control-sm">
                                    <input id="published_at_view"  type="text" class="form-control form-control-sm">
                                    @error('published_at')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">خلاصه پست</label>
                                    <textarea name="summary" id="summary" class="form-control">{{old('summary',$post->summary)}}</textarea>
                                    @error('summary')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">متن پست</label>
                                    <textarea name="body" id="body" class="form-control">{{old('body',$post->body)}}</textarea>
                                    @error('body')
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
    <script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}">

    </script>
    <script>
        CKEDITOR.replace('body')
        CKEDITOR.replace('summary')

    </script>

    <script>
        let tags = $('#tags')
        let select = $('#select')
        let form = $('#form')
        let default_tags = tags.val()
        let default_data = null
        if (tags.val() !== null && tags.val().length > 0){
            default_data = default_tags.split(',')
        }
        select.select2({
            placeholder:'لطفا تگ های خود را وارد کنید',
            tags:true,
            data : default_data
        })
        select.children('option').attr('selected',true).trigger('change')
        form.submit(function (e){
            if (select.val() !== null && select.val().length > 0){
                let selected_source = select.val().join(',');

                tags.val(selected_source)
            }
        })
    </script>
    <script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>
    <script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(()=>{
            $('#published_at_view').persianDatepicker({
                altField: '#published_at',
                format:"YYYY/MM/DD"
            });
        })

    </script>
@endsection


