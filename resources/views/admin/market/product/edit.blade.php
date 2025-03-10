@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش محصول</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">محصولات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        ویرایش کالا
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.product.index')}}" class="btn btn-info btn-sm"> بازگشت </a>



                </section>

                <section >
                    <form enctype="multipart/form-data" action="{{route('admin.market.product.update',[$product->id])}}" id="form" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام کالا</label>
                                    <input name="name" value="{{old('name',$product->name)}}" type="text" class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">دسته کالا</label>
                                    <select name="category_id" type="text" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == old('category_id',$product->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">برند کالا</label>
                                    <select name="brand_id"  type="text" class="form-control form-control-sm">
                                        <option value="">برند را انتخاب کنید</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$brand->id == old('brand_id',$product->brand_id) ? 'selected' : ''}}>{{$brand->original_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تصویر کالا</label>
                                    <input name="image" type="file" class="form-control form-control-sm">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <section class="row">
                                    @php($number = 1)
                                    @foreach($product->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{6/$number}}">
                                            <div class="form-check">
                                                <input {{$product->image['currentImage'] == $key ? 'checked' : ''}} name="currentImage" id="{{$number}}" value="{{$key}}" type="radio" class="form-check-input">
                                                <label for="{{$number}}" class="form-check-label mx-2">
                                                    <img src="{{asset($value)}}" class="w-100" alt="">
                                                </label>
                                            </div>
                                        </section>
                                        @php($number++)
                                    @endforeach

                                </section>
                            </section>

                            <section class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label for="">قیمت</label>
                                    <input name="price" value="{{old('price',$product->price)}}" type="text" class="form-control form-control-sm">
                                    @error('price')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وزن</label>
                                    <input name="weight" value="{{old('weight',$product->weight)}}" type="text" class="form-control form-control-sm">
                                    @error('weight')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">طول</label>
                                    <input name="length" value="{{old('length',$product->length)}}" type="text" class="form-control form-control-sm">
                                    @error('length')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">ارتفاع</label>
                                    <input name="height" value="{{old('height',$product->height)}}" type="text" class="form-control form-control-sm">
                                    @error('height')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عرض</label>
                                    <input name="width" value="{{old('width',$product->width)}}" type="text" class="form-control form-control-sm">
                                    @error('width')
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
                                    <label for="">تگ ها </label>
                                    <input   id="tags" name="tags" value="{{old('tags',$product->tags)}}" type="hidden" class="form-control form-control-sm">
                                    <select id="select" multiple="multiple"  class="select2 form-control form-control-sm"></select>
                                    @error('tags')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <textarea id="body" class="form-control" name="introduction">{{old('introduction',$product->introduction)}}</textarea>
                                    @error('introduction')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </section>
                            @if($product->metas()->count() > 0)
                            <section class="col-12 border-bottom border-top pt-2 mb-3">
                               
                                    @foreach($product->metas as $key => $value )
                                <div class="row">
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">

                                            <input value="{{$value->meat_key}}" name="meat_key[]" type="text" class="form-control form-control-sm" placeholder="ویژگی...">
                                            @error('meat_key.*')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </section>
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">

                                            <input value="{{$value->meat_value}}" name="meat_value[]" type="text" class="form-control form-control-sm" placeholder="مقدار...">
                                            @error('meat_value.*')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </section>
                                </div>

                               

                                @endforeach
                                <section class="mb-3">
                                    <button id="btn-copy" type="button" class="btn btn-success btn-sm">افزودن</button>
                                </section>

                              

                            </section>
                            @endif
                            @if($product->metas()->count() == 0) 
                                 <section class="col-12 border-bottom border-top pt-2 mb-3">
                                    <div class="row">
                                        <section class="col-6 col-md-3">
                                            <div class="form-group">

                                                <input name="meat_key[]" type="text" class="form-control form-control-sm" placeholder="ویژگی...">
                                            </div>
                                        </section>
                                        <section class="col-6 col-md-3">
                                            <div class="form-group">

                                                <input name="meat_value[]" type="text" class="form-control form-control-sm" placeholder="مقدار...">
                                            </div>
                                        </section>
                                    </div>

                                    <section class="mb-3">
                                        <button id="btn-copy" type="button" class="btn btn-success btn-sm">افزودن</button>
                                    </section>

                                </section>
                            @endif

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

    <script>
        $('#btn-copy').on('click',function (){
            let ele = $(this).parent().prev().clone(true)
            $(this).before(ele)
        })
    </script>
@endsection
