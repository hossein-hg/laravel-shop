@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش بنر </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">پیج ساز</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش بنر </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش بنر
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.content.banner.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form action="{{route('admin.content.banner.update',[$banner->id])}}" method="post" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for=""> عنوان</label>
                                    <input value="{{old('title',$banner->title)}}" name="title" type="text" class="form-control form-control-sm">
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">آدرس url </label>
                                    <input name="url" value="{{old('url',$banner->url)}}" class="form-control form-control-sm" type="text">
                                    @error('url')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input name="image"  type="file" class="form-control form-control-sm">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>




                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for=""> موقعیت</label>
                                    <select name="position" class="form-control form-control-sm" id="">
                                        @foreach($positions as $key => $position)
                                            <option {{old('position',$banner->position) == $key ? 'selected' : ''}} value="{{$key}}">{{$position}}</option>

                                        @endforeach
                                    </select>
                                    @error('position')
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
