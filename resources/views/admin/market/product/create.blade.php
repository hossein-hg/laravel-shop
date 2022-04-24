@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد کالا</title>
<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کالا </a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کالا</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.product.store')}}" enctype="multipart/form-data" method="post" id="form">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام کالا</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                                @error('name')
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
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">وزن</label>
                                <input type="text" class="form-control form-control-sm" name="weight" value="{{old('weight')}}">
                                @error('weight')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">طول</label>
                                <input type="text" class="form-control form-control-sm" name="length" value="{{old('length')}}">
                                @error('length')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عرض</label>
                                <input type="text" class="form-control form-control-sm" name="width" value="{{old('width')}}">
                                @error('width')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">ارتفاع</label>
                                <input type="text" class="form-control form-control-sm" name="height" value="{{old('height')}}">
                                @error('height')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">قیمت کالا</label>
                                <input type="text" class="form-control form-control-sm" name="price" value="{{old('price')}}">
                                @error('price')
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
                                <label for="status">قابلیت فروش</label>
                                <select  name="marketable" id="status" class="form-control form-control-sm @error('marketable') border-danger @enderror">
                                    <option value="0" @if(old('marketable') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('marketable') == 1) selected @endif>فعال</option>
                                </select>
                                @error('marketable')
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
                                <label for="">انتخاب دسته</label>
                                <select name="category_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach($productCategories as $productCategory)
                                        <option value="{{$productCategory->id}}" @if(old('category_id') == $productCategory->id) selected @endif>{{$productCategory->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">انتخاب برند</label>
                                <select name="brand_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" @if(old('brand_id') == $brand->id) selected @endif>{{$brand->persian_name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
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

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">توضیحات</label>
                                <textarea name="introduction" id="body"  class="form-control form-control-sm" rows="6">{{old('introduction')}}</textarea>
                                @error('introduction')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 border-top border-bottom py-3 mb-3">

                            <section class="row">

                                <section class="col-6 col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="meta_key[]" placeholder="ویژگی ...">
                                        @error('meta_key.*')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </section>

                                <section class="col-6 col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="meta_value[]" placeholder="مقدار ...">
                                        @error('meta_value.*')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </section>

                            </section>

                            <section>
                                <button type="button" class="btn btn-success btn-sm" id="btn-copy">افزودن</button>
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
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
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

    <script>
        $(document).ready(function (){

            $('#published_at_view').persianDatepicker({
                format : 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled : true,
                    meridiem:{
                        enabled: true
                    }
                }
            })
        })
    </script>

    <script>

        $(function (){
                $('#btn-copy').on('click',function (){
                    let ele = $(this).parent().prev().clone(true);
                    $(this).before(ele);
                })
        })
    </script>
@endsection
