@extends('admin.layouts.master')

@section('head-tag')
<title>گالری</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> گالری</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    گالری
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.gallery.create',[$product->id]) }}" class="btn btn-info btn-sm">ایجاد گالری</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>

                        <th>محصول</th>

                        <th>تصویر</th>
                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images as $key => $image)
                        <tr>
                            <th>{{$key}}</th>


                            <td>{{$image->product ? $image->product->name : '-'}}</td>



                            <td><img width="50" height="50" src="{{asset($image->images['indexArray'][$image->images['currentImage']])}}" alt=""></td>
                            <td class="width-16-rem d-flex  text-center">

                                <form method="post" action="{{route('admin.market.gallery.destroy',[$image->id])}}">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt" ></i> حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </section>

        </section>
    </section>
  </section>

@endsection

@section('script')
    @include('admin.alerts.sweet-alert.delete-confirm',['className'=>'delete'])
@endsection
