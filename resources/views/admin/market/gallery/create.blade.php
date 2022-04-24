@extends('admin.layouts.master')

@section('head-tag')
<title>گالری</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">گالری </a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد گالری</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد گالری
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.gallery.index',[$product->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form id="form" action="{{route('admin.market.gallery.store',[$product->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">





                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="images">تصویر</label>
                                <input id="images" type="file" name="images" class="form-control form-control-sm @error('images') border-danger @enderror">
                                @error('images')
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
