@extends('admin.layouts.master')

@section('head-tag')
<title>دسته بندی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  دسته بندی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام دسته بندی</th>
                        <th>توضیحات</th>
                        <th>دسته والد</th>
                        <th>اسلاگ</th>
                        <th>تگ ها</th>
                        <th>وضعیت</th>
                        <th>نمایش در منو</th>
                        <th>تصویر</th>
                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_categories as $category)
                        <tr>
                            <th>{{$category->id}}</th>
                            <td>{{$category->name}}	</td>
                            <td>{!! $category->description !!}</td>
                            <td>{{$category->parent ? $category->parent->name : '-'}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->tags}}</td>
                            <td>
                                <label for="">
                                    <input id="{{$category->id}}" type="checkbox" @if($category->status == 1) checked @endif onchange="changeStatus({{$category->id}})" data-url="{{route('admin.market.category.status',[$category->id])}}">
                                </label>
                            </td>
                            <td>
                                <label for="">
                                    <input id="show-{{$category->id}}" type="checkbox" @if($category->show_in_menu == 1) checked @endif onchange="changeShow({{$category->id}})" data-url1="{{route('admin.market.category.changeShow',[$category->id])}}">
                                </label>
                            </td>
                            <td><img width="50" height="50" src="{{asset($category->image['indexArray'][$category->image['currentImage']])}}" alt=""></td>
                            <td class="width-16-rem d-flex  text-left">
                                <a href="{{route('admin.market.category.edit',[$category->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form method="post" action="{{route('admin.market.category.destroy',[$category->id])}}">
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
    <script type="text/javascript">
        function changeStatus(id)
        {
            let element = $('#'+id)
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')

            $.ajax({
                url : url,
                type : 'GET',
                success: function (response){
                    if (response.status)
                    {
                        if (response.checked)
                        {
                            element.prop('checked',true)
                            successToast('دسته بندی با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('دسته بندی با موفقیت غیرفعال شد')
                        }
                    }
                    else {
                        element.prop('checked',elementValue)
                        errorToast('هنگام ویرایش مشکلی به وجود آمده است')
                    }
                },
                error:function (){
                    errorToast('ارتباط برقرار نشد')
                }
            })

            function successToast(message){
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    ' <section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message+'</strong>\n'+
                    ' <button type="button" class="mr-2  close" data-dismiss="toast" aria-label="Close">\n'+
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function (){
                    $(this).remove()
                })
            }

            function errorToast(message){
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    ' <section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message+'</strong>\n'+
                    ' <button type="button" class="mr-2  close" data-dismiss="toast" aria-label="Close">\n'+
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function (){
                    $(this).remove()
                })
            }
        }
    </script>

    <script type="text/javascript">
        function changeShow(id)
        {
            let element = $('#show-'+id)
            let url = element.attr('data-url1')
            let elementValue = !element.prop('checked')

            $.ajax({
                url : url,
                type : 'GET',
                success: function (response){
                    if (response.status)
                    {
                        if (response.checked)
                        {
                            element.prop('checked',true)
                            successToast('نمایش در منو با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('نمایش در منو با موفقیت غیرفعال شد')
                        }
                    }
                    else {
                        element.prop('checked',elementValue)
                        errorToast('هنگام ویرایش مشکلی به وجود آمده است')
                    }
                },
                error:function (){
                    errorToast('ارتباط برقرار نشد')
                }
            })

            function successToast(message){
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    ' <section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message+'</strong>\n'+
                    ' <button type="button" class="mr-2  close" data-dismiss="toast" aria-label="Close">\n'+
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function (){
                    $(this).remove()
                })
            }

            function errorToast(message){
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    ' <section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message+'</strong>\n'+
                    ' <button type="button" class="mr-2  close" data-dismiss="toast" aria-label="Close">\n'+
                    '<span aria-hidden="true">&times;</span>\n'+
                    '</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function (){
                    $(this).remove()
                })
            }
        }
    </script>

    @include('admin.alerts.sweet-alert.delete-confirm',['className'=>'delete'])
@endsection
