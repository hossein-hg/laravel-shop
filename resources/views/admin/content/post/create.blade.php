+
@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد پست</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پست</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد پست
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.content.post.store')}}" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title">عنوان پست</label>
                                <input id="title" value="{{old('title')}}" type="text" class="form-control form-control-sm" name="title">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">انتخاب دسته</label>
                                <select name="category_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach($postCategories as $postCategory)
                                    <option value="{{$postCategory->id}}" @if(old('category_id') == $postCategory->id) selected @endif>{{$postCategory->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر </label>
                                <input type="file" name="image" class="form-control form-control-sm">
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="text" id="published_at" name="published_at" class="form-control form-control-sm d-none"  value="{{old('published_at')}}">
                                <input type="text" id="published_at_view"  class="form-control form-control-sm">
                                @error('published_at')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select  name="status" id="status" class="form-control form-control-sm @error('status') border-danger @enderror">
                                    <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">امکان درج نظر</label>
                                <select  name="commentable" id="commentable" class="form-control form-control-sm @error('commentable') border-danger @enderror">
                                    <option value="0" @if(old('commentable') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('commentable') == 1) selected @endif>فعال</option>
                                </select>
                                @error('commentable')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input id="tags" value="{{old('tags')}}" type="hidden" name="tags" class="form-control form-control-sm ">
                                <select id="select_tags" class="select2 form-control form-control-sm" multiple></select>
                                @error('tags')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>


                        <section class="col-12">
                            <div class="form-group">
                                <label for="summary">خلاصه پست</label>
                                <textarea name="summary" id="summary"  class="form-control form-control-sm" rows="6">{{old('summary')}}</textarea>
                                @error('summary')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="body">متن پست</label>
                                <textarea name="body" id="body"  class="form-control form-control-sm" rows="6">{{old('body')}}</textarea>
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

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');

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

    <script>
        $(document).ready(function (){

          $('#published_at_view').persianDatepicker({
              format : 'YYYY/MM/DD',
              altField: '#published_at'
          })
        })
    </script>

@endsection
