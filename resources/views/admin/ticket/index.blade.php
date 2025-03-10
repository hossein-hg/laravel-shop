@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>

            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت ها</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        تیکت ها
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد تیکت </a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نویسنده تیکت</th>
                            <th>عنوان تیکت</th>
                            <th>دسته تیکت</th>
                            <th>اولویت تیکت</th>
                            <th> ارجاع شده از</th>
                            <th>پاسخ به</th>
                            <th>بستن تیکت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $key => $ticket)
                        <tr>
                            <th>{{++$key}}</th>
                            <td>{{$ticket->user->fullName}}</td>
                            <td>{{\Illuminate\Support\Str::limit($ticket->subject,20)}} </td>

                            <td>{{$ticket->category->name}}  </td>
                            <td>{{$ticket->priority->name}}  </td>
                            <td>{{$ticket->reference->user->fullName ?? '*'}}  </td>
                            <td>{{$ticket->ticket_id ? $ticket->ticket->subject : '-'}}  </td>
                            <td><label for="">
                                    <input data-url="{{route('admin.ticket.status',[$ticket->id])}}" id="{{$ticket->id}}" type="checkbox" {{$ticket->status == 1 ? 'checked' : ''}} onchange="changeStatus({{$ticket->id}})">
                                </label> </td>
                            <td class="width-16-rem text-left">
                                <a href="{{route('admin.ticket.show',[$ticket->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> مشاهده</a>

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
            let url = element.attr('data-url')
            let elementValue = !element.prop('checked')
            $.ajax({
                url,
                type:'GET',
                success:(res)=>{
                    console.log(res)
                    let {checked,status} = res
                    if (status === false){
                        element.prop('checked',elementValue)
                        errorToast('خطایی رخ داد!')

                    }
                    else if(checked === true){
                        element.prop('checked',true)
                        successToast('تیکت با موفقیت بسته شد')

                    }
                    else if(checked === false){
                        element.prop('checked',false)
                        successToast('تیکت با موفقیت باز شد')
                    }
                },
                error : function (){
                    element.prop('checked',elementValue)
                    errorToast('ارتباط برقرار نشد!')
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'ارتباط برقرار نشد!',
                        confirmButtonText : 'باشه'
                    })
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

