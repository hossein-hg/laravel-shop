@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد دسته بندی</title>
    <script>
        // function callbackThen(response){
        //     // console.log(response)
        //     response.json().then(function (data){

        //         if (data.success === true && data.score >= 0.5){
        //             console.log(data)
        //             console.log('valid data')
        //         }
        //         else {
        //             document.getElementById('form').addEventListener('submit',function (e){
        //                 e.preventDefault();
        //             })
        //         }
        //     })
        // }
        // function callbackCatch(response){
        //     console.log(response)

        // }
    </script>
    {{-- {!! htmlScriptTagJsApi([

            'callback_then' => 'callbackThen',
            'callback_catch' => 'callbackCatch'
        ]) !!} --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسته بندی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ایجاد دسته بندی
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.content.category.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form id="form" enctype="multipart/form-data" action="{{route('admin.content.category.store')}}" method="post">
                        <section class="row">
                        @csrf
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام دسته</label>
                                    <input name="name" value="{{old('name')}}" type="text" class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>


                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تگ ها </label>
                                    <input  id="tags" name="tags" value="{{old('tags')}}" type="hidden" class="form-control form-control-sm">
                                    <select id="select" multiple="multiple"  class="select2 form-control form-control-sm"></select>
                                    @error('tags')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input name="image" value="{{old('image')}}" type="file" class="form-control form-control-sm">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت </label>
                                    <select name="status"  type="file" class="form-control form-control-sm">
                                        <option value="1" >فعال</option>
                                        <option value="0">غیر فعال</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">توضیحات </label>
                                    <textarea id="description" name="description" type="text" class="form-control form-control-sm">{{old('description')}}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>
                            @error('g-recaptcha-response')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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
        CKEDITOR.replace('description')
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
