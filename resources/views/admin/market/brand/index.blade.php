@extends('admin.layouts.master')

@section('head-tag')
<title>برند</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">برند ها</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                 برند ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.brand.create') }}" class="btn btn-info btn-sm">ایجاد برند </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام فارسی </th>
                            <th>نام اصلی </th>
                            <th>لوگو</th>
                            <th>تگ ها</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $key => $brand)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$brand->persian_name}}	</td>
                            <td>{{$brand->original_name}}	</td>
                            <td><img width="50" height="50" src="{{asset($brand->logo['indexArray'][$brand->logo['currentImage']])}}" alt=""></td>
                            <td>{{$brand->tags}}	</td>
                            <td>
                                <label for="">
                                    <input id="{{$brand->id}}" type="checkbox" @if($brand->status == 1) checked @endif onchange="changeStatus({{$brand->id}})" data-url="{{route('admin.market.brand.status',[$brand->id])}}">
                                </label>
                            </td>
                            <td class="width-16-rem text-left d-flex">
                                <a href="{{route('admin.market.brand.edit',[$brand->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.brand.destroy',[$brand->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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
                            successToast('برند با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('برند با موفقیت غیرفعال شد')
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
