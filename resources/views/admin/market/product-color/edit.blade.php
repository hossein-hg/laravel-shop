@extends('admin.layouts.master')

@section('head-tag')
<title>رنگ محصول</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">رنگ محصول </a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش رنگ </li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش رنگ
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.product-color.index',[$color->product->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form id="form" action="{{route('admin.market.product-color.update',[$color->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام رنگ</label>
                                <input value="{{old('color_name',$color->color_name)}}" id="name" type="text" name="color_name" class="form-control form-control-sm @error('color_name') border-danger @enderror">
                                @error('color_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">افزایش قیمت</label>
                                <input value="{{old('price_increase',$color->price_increase)}}" id="name" type="text" name="price_increase" class="form-control form-control-sm @error('price_increase') border-danger @enderror">
                                @error('price_increase')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select  name="status" id="status" class="form-control form-control-sm @error('status') border-danger @enderror">
                                    <option value="0" @if(old('status',$color->status) == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('status',$color->status) == 1) selected @endif>فعال</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_id">محصول</label>
                                <select  name="product_id" id="product_id" class="form-control form-control-sm @error('product_id') border-danger @enderror">
                                    <option value="" >انتخاب کنید</option>
                                 @foreach($products as $product)
                                        <option value="{{$product->id}}" {{$product->id == old('product_id',$color->product_id) ? 'selected' : '' }}>{{$product->name}}</option>
                                    @endforeach


                                </select>
                                @error('product_id')
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
        CKEDITOR.replace('description');
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
