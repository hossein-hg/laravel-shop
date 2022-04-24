@extends('admin.layouts.master')

@section('head-tag')
<title>کوپن تخفیف</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">کوپن تخفیف</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
               کوپن تخفیف
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.discount.coupon.create') }}" class="btn btn-info btn-sm">ایجاد کوپن تخفیف</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کد تخفیف</th>
                            <th>میزان تخفیف</th>
                            <th>سقف تخفیف</th>
                            <th>نوع کوپن</th>
                            <th>کاربر</th>
                            <th>تاریخ شروع</th>
                            <th>تاریخ پایان</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $key => $coupon)
                        <tr>
                            <th>{{$key+1}}</th>
                            <th>{{$coupon->code}}</th>
                            <th>{{$coupon->amount_type == 0 ? $coupon->amount." %" : $coupon->amount." تومان  "}}</th>
                            <th>{{$coupon->discount_ceiling ?? '-'}} تومان</th>
                            <th>{{$coupon->type == 0 ? "عمومی" : "اختصاصی"}}</th>
                            <th>{{$coupon->user->full_name ?? '-'}}</th>
                            <td> {{jalaliDate($coupon->start_date)}} </td>
                            <td>  {{jalaliDate($coupon->end_date)}}</td>
                            <td>
                                <label for="">
                                    <input id="{{$coupon->id}}" type="checkbox" @if($coupon->status == 1) checked @endif onchange="changeStatus({{$coupon->id}})" data-url="{{route('admin.market.discount.coupon.status',[$coupon->id])}}">
                                </label>
                            </td>
                            <td class="width-16-rem text-left d-flex">
                                <a href="{{route('admin.market.discount.coupon.edit',[$coupon->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.discount.coupon.destroy',[$coupon->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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
                            successToast('کوپن با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('کوپن با موفقیت غیرفعال شد')
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
