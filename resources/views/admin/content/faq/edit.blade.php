@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش سوال </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">سوالات متداول</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش سوال </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش سوال
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.content.faq.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.content.faq.update',[$faq->id])}}" method="post" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12">
                                <div class="form-group">
                                    <label for=""> پرسش</label>
                                    <textarea class="form-control" name="question" id="question">{{old('question',$faq->question)}}</textarea>
                                    @error('question')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">پاسخ </label>
                                    <textarea class="form-control" name="answer" id="answer">{{old('answer',$faq->answer)}}</textarea>
                                    @error('answer')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="">تگ ها</label>
                                    <input id="tags" value="{{old('tags',$faq->tags)}}" type="hidden" name="tags"  >
                                    <select name="" id="select" multiple="multiple" class="form-control form-control-sm select2"></select>
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
    <script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}">

    </script>
    <script>

        CKEDITOR.replace('answer')
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
@endsection
