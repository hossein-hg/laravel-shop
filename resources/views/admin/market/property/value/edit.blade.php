@extends('admin.layouts.master')

@section('head-tag')
<title>مقدار فرم کالا</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">فرم کالا</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مقدار فرم کالا</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ویرایش مقدار فرم کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.value.index',[$categoryValue->attribute->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.market.value.update',[$categoryValue->id])}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">مقدار ویژگی</label>
                                <input type="text" class="form-control form-control-sm" name="value" value="{{old('value',json_decode($categoryValue->value)->value)}}">
                                @error('value')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">افزایش قیمت</label>
                                <input type="text" class="form-control form-control-sm" name="price_increase" value="{{old('price_increase',json_decode($categoryValue->value)->price_increase)}}">
                                @error('price_increase')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="type">نوع</label>
                                <select  name="type" id="type" class="form-control form-control-sm @error('type') border-danger @enderror">
                                    <option value="0" @if(old('type',$categoryValue->type) == 0) selected @endif>ساده</option>
                                    <option value="1" @if(old('type') == 1) selected @endif>انتخابی</option>
                                </select>
                                @error('type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">انتخاب محصول</label>
                                <select name="product_id" id="" class="form-control form-control-sm" >
                                    <option value="">محصول را انتخاب کنید</option>
                                    @foreach($products as $product)
                                    <option @if(old('product_id',$categoryValue->product_id) == $product->id) selected  @endif value="{{$product->id}}">{{$product->name}}</option>
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
