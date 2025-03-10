@extends('admin.layouts.master')

@section('head-tag')
    <title>اولویت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اولویت </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        اولویت تیکت ها
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.ticket.priority.create')}}" class="btn btn-info btn-sm">ایجاد اولویت</a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام اولویت</th>


                                <th>وضعیت </th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($priorities as $key => $priority)

                            <tr id="tr{{$priority->id}}">
                                <th>{{++$key}}</th>
                                <td>{{$priority->name}}</td>


                                <td>
                                    <label for="">
                                        <input data-url="{{route('admin.ticket.priority.status',[$priority->id])}}" id="{{$priority->id}}" type="checkbox" {{$priority->status == 1 ? 'checked' : ''}} onchange="changeStatus({{$priority->id}})">
                                    </label>
                                </td>
                                <td class="width-16-rem text-left justify-content-end">
                                    <a href="{{route('admin.ticket.priority.edit',[$priority->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <a  id="delete{{$priority->id}}" onclick="deleteRecord({{$priority->id}})" data-url="{{route('admin.ticket.priority.destroy',[$priority->id])}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-edit"></i> حذف</a>


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

         function deleteRecord(id){
             Swal.fire({
                 title: 'آیا مطمین هستید؟',
                 text: "می خواهید رکورد را حذف کنید؟",
                 icon: 'warning',
                 showCancelButton: true,
                 cancelButtonText: 'انصراف',
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'بله, حذف کن!'
             }).then((result) => {

                 if (result.value) {
                     let element = $('#delete'+id)
                     let tr = $('#tr'+id)
                     let url = element.attr('data-url')
                     console.log(result)
                     $.ajax({
                         url,
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         type:'POST',
                         data:{
                             '_method': 'delete'
                         },
                         success:(res)=>{
                             console.log(res)
                             tr.remove()
                             Swal.fire({
                                 icon: 'success',
                                 title: 'موفق',
                                 text: 'رکورد با موفقیت حذف شد',
                                 confirmButtonText : 'باشه'
                             })

                         }
                     })
                 }
             })


        }
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
                        successToast('اولویت با موفقیت فعال شد')

                    }
                    else if(checked === false){
                        element.prop('checked',false)
                        successToast('اولویت با موفقیت غیرفعال شد')

                    }
                },
                error : function (){
                    element.prop('checked',elementValue)
                    errorToast('ارتباط برقرار نشد!')

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


