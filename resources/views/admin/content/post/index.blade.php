@extends('admin.layouts.master')

@section('head-tag')
<title>پست ها</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">پست ها</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                 پست ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.post.create') }}" class="btn btn-info btn-sm">ایجاد پست </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>دسته</th>
                            <th>وضعیت</th>
                            <th>نظر گذاشتن</th>
                            <th>تاریخ انتشار</th>
                            <th>تصویر</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th>1</th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>
                                <label for="">
                                    <input id="status-{{$post->id}}" type="checkbox" @if($post->status == 1) checked @endif onchange="changeStatus({{$post->id}})" data-url="{{route('admin.content.post.status',[$post->id])}}">
                                </label>
                            </td>
                            <td>
                                <label for="">
                                    <input id="commentable-{{$post->id}}" type="checkbox" @if($post->commentable == 1) checked @endif onchange="changeCommentable({{$post->id}})" data-url1="{{route('admin.content.post.commentable',[$post->id])}}">
                                </label>
                            </td>
                            <td>{{jalaliDate($post->published_at)}}</td>
                            <td><img width="60" height="50" src="{{asset($post->image['indexArray'][$post->image['currentImage']])}}"  alt="" class="max-height-2rem"></td>
                            <td class="width-16-rem text-left d-flex">
                                <a href="{{route('admin.content.post.edit',[$post->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form method="post" action="{{route('admin.content.post.destroy',[$post->id])}}">
                                    @method('delete')
                                    @csrf
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
                            successToast('پست با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('پست با موفقیت غیرفعال شد')
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


        function changeCommentable(id)
        {
            let element = $('#commentable-'+id)
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
                            successToast('کامنت گذاری با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('کامنت گذاری با موفقیت غیرفعال شد')
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
@endsection
