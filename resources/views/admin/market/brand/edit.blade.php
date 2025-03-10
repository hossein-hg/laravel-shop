@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش  برند</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">برند</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش برند</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش برند
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.brand.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form enctype="multipart/form-data" action="{{route('admin.market.brand.update',[$brand->id])}}" method="post" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام فارسی برند</label>
                                    <input value="{{old('persian_name',$brand->persian_name)}}" type="text" class="form-control form-control-sm" name="persian_name">
                                    @error('persian_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام انگلیسی برند</label>
                                    <input value="{{old('original_name',$brand->original_name)}}" type="text" class="form-control form-control-sm" name="original_name">
                                    @error('original_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تگ ها</label>
                                    <input id="tags" value="{{old('tags',$brand->tags)}}" type="hidden" name="tags"  >
                                    <select name="" id="select" multiple="multiple" class="form-control form-control-sm select2"></select>
                                    @error('tags')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">لوگو </label>
                                    <input name="logo" value="{{old('logo')}}" type="file" class="form-control form-control-sm">
                                    @error('logo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <section class="row">
                                    @php($number = 1)
                                    @foreach($brand->logo['indexArray'] as $key => $value)
                                        <section class="col-md-{{6/$number}}">
                                            <div class="form-check">
                                                <input {{$brand->logo['currentImage'] == $key ? 'checked' : ''}} name="currentImage" id="{{$number}}" value="{{$key}}" type="radio" class="form-check-input">
                                                <label for="{{$number}}" class="form-check-label mx-2">
                                                    <img src="{{asset($value)}}" class="w-100" alt="">
                                                </label>
                                            </div>
                                        </section>
                                        @php($number++)
                                    @endforeach

                                </section>
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
