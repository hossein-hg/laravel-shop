@extends('admin.layouts.master')

@section('head-tag')
<title>سوالات متداول</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> سوالات متداول</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                سوالات متداول
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.faq.create') }}" class="btn btn-info btn-sm">ایجاد سوال جدید</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>پرسش</th>
                            <th>خلاصه پاسخ</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>

                        </tr>
                    </thead>
                    <tbody>
                    @php($k = 0)
                    @foreach($faqs as $faq)
                        <tr>
                            <th>{{$k += 1}}</th>
                            <td>{{$faq->question}}	</td>
                            <td>{!! substr($faq->answer,0,20)."..." !!}</td>
                            <td>
                                <label for="">
                                    <input id="status-{{$faq->id}}" type="checkbox" @if($faq->status == 1) checked @endif onchange="changeStatus({{$faq->id}})" data-url="{{route('admin.content.faq.status',[$faq->id])}}">
                                </label>
                            </td>
                            <td class="width-16-rem text-left d-flex">
                                <a href="{{route('admin.content.faq.edit',[$faq->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form method="post" action="{{route('admin.content.faq.destroy',[$faq->id])}}">
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                    @csrf
                                    @method('delete')
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

        function changeStatus(id)
        {
            let element = $('#status-'+id)
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
                            successToast('سوال با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('سوال با موفقیت غیرفعال شد')
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





        }

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
    </script>

    @include('admin.alerts.sweet-alert.delete-confirm',['className'=>'delete'])

    </script>
@endsection
