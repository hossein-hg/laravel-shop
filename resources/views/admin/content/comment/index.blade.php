@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        نظرات
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر</a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نظر</th>
                                <th>کد کاربر</th>
                                <th>نویسنده نظر</th>
                                <th> پاسخ به</th>
                                <th> کد پست</th>
                                <th> عنوان پست</th>
                                <th> وضعیت تایید</th>
                                <th> وضعیت </th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $key => $comment)
                            <tr>
                                <th>{{++$key}}</th>
                                <th>{{\Illuminate\Support\Str::limit($comment->body,10)}}</th>
                                <td>{{$comment->user->id}}</td>
                                <td>{{$comment->user->fullName}} </td>
                                <td>{{$comment->parent_id ? $comment->parent->user->fullName : '-'}} </td>
                                <td>{{$comment->commentable->id}}</td>
                                <td>{{$comment->commentable->title}}</td>
                                <td>
                                    <input id="{{$comment->id}}" data-url="{{route('admin.content.comment.status',[$comment->id])}}" onchange="changeApproved({{$comment->id}})" type="checkbox" {{$comment->status == 1 ? 'checked' : ''}}>
                                </td>
                                <td>
                                    <input id="approved{{$comment->id}}" data-url="{{route('admin.content.comment.approved',[$comment->id])}}" onchange="changeStatus({{$comment->id}})" type="checkbox" {{$comment->approved == 1 ? 'checked' : ''}}>
                                </td>

                                <td class="width-16-rem text-left">

                                    <a href="{{route('admin.content.comment.show',[$comment->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> نمایش</a>

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

        let changeStatus = (id)=>{
            let element = $('#'+id)
            let elementValue = !element.prop('checked')
            let url = element.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status,checked} = res;
                    if (status){
                        if (checked){
                            element.prop('checked',true)
                            successToast('نظر با موفقیت فعال شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('نظر با موفقیت غیرفعال شد')
                        }
                    }
                    else {
                        errorToast('خطایی رخ داد!')
                        element.prop('checked',elementValue)
                    }
                },
                error:()=>{
                    errorToast('ارتباط برقرار نشد!')
                    element.prop('checked',elementValue)
                }

            })
            let successToast = (message)=>{
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }

            let errorToast = (message)=>{
                let errorToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }

        }

        let changeApproved = (id)=>{
            let element = $('#approved'+id)
            let elementValue = !element.prop('checked')
            let url = element.attr('data-url')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    let {status,checked} = res;
                    if (status){
                        if (checked){
                            element.prop('checked',true)
                            successToast('نظر با موفقیت تایید شد')
                        }
                        else {
                            element.prop('checked',false)
                            successToast('نظر با موفقیت تایید نشد')
                        }
                    }
                    else {
                        errorToast('خطایی رخ داد!')
                        element.prop('checked',elementValue)
                    }
                },
                error:()=>{
                    errorToast('ارتباط برقرار نشد!')
                    element.prop('checked',elementValue)
                }

            })
            let successToast = (message)=>{
                let successToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }

            let errorToast = (message)=>{
                let errorToastTag = '<section class="toast" data-delay="5000">\n'+
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n'+
                    '<strong class="ml-auto">'+message +'</strong>\n'+
                    '<button aria-label="Close" type="button" class="mr-2 close" data-dismiss="toast">&times;</button>\n'+
                    '</section>\n'+
                    '</section>'
                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay(5000).queue(function (){
                    $(this).remove()
                })
            }

        }
    </script>
@endsection
