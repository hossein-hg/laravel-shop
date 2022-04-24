@extends('admin.layouts.master')

@section('head-tag')
<title>برند</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">برند</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد برند</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد برند
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.brand.store')}}" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="persian_name">نام برند(فارسی)</label>
                                <input type="text" class="form-control form-control-sm" value="{{old('persian_name')}}" name="persian_name" id="persian_name">
                                @error('persian_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="original_name">نام برند(انگلیسی)</label>
                                <input type="text" class="form-control form-control-sm" value="{{old('original_name')}}" name="original_name" id="original_name">
                                @error('original_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input id="tags" value="{{old('tags')}}" type="hidden" name="tags" class="form-control form-control-sm ">
                                <select id="select_tags" class="select2 form-control form-control-sm" multiple></select>
                                @error('tags')
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
                                <label for="">تصویر برند</label>
                                <input type="file" class="form-control form-control-sm" name="logo">
                                @error('logo')
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
    <script>
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
