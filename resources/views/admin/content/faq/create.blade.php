@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد سوال</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.faq.index')}}">سوالات متداول</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد سوال</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد سوال
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form id="form" action="{{ route('admin.content.faq.store') }}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">پرسش</label>
                                <input type="text" name="question" class="form-control form-control-sm" value="{{old('question')}}">
                                @error('question')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">پاسخ</label>
                                <textarea name="answer" id="body"  class="form-control form-control-sm" rows="6">{{old('answer')}}</textarea>
                                @error('answer')
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
        CKEDITOR.replace('body');

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
