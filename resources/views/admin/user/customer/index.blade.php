@extends('admin.layouts.master')

@section('head-tag')
<title>کاربران مشتری</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران مشتری</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                کاربران مشتری
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.customer.create') }}" class="btn btn-info btn-sm">ایجاد مشتری جدید</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>تصویر پروفایل</th>
                            <th>وضعیت فعالسازی</th>
                            <th>وضعیت </th>
                            <th>نقش</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $key => $customer)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->mobile}}	</td>
                            <td>{{$customer->first_name}}	</td>
                            <td>{{$customer->last_name}}	</td>
                            <td><img src="{{asset($customer->profile_photo_path)}}" alt="" width="70" height="60">	</td>
                            <td>
                                <label for="">
                                    <input id="{{$customer->id}}" type="checkbox" @if($customer->activation == 1) checked @endif onchange="changeActivation({{$customer->id}})" data-url="{{route('admin.user.customer.activation',[$customer->id])}}">
                                </label>
                            </td>
                            <td>
                                <label for="">
                                    <input id="status-{{$customer->id}}" type="checkbox" @if($customer->status == 1) checked @endif onchange="changeStatus({{$customer->id}})" data-url1="{{route('admin.user.customer.status',[$customer->id])}}">
                                </label>
                            </td>
                            <td>سوپر ادمین	</td>
                            <td class="width-22-rem text-left d-flex">
                                <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
                                <a href="{{route('admin.user.customer.edit',[$customer->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.user.customer.destroy',[$customer->id])}}" method="post">
                                    @csrf
                                    @method('delete')

                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt "></i> حذف</button>
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
    <script>

        function changeActivation(id)
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
                            successToast('کاربر  با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('کاربر  با موفقیت غیرفعال شد')
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


        function changeStatus(id)
        {
            let element = $('#status-'+id)
            console.log(element)
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
                            successToast('وضعیت کاربر  با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('وضعیت کاربر  با موفقیت غیرفعال شد')
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

    </script>
@endsection
