@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>لیست سفارشات</title>
@endsection




@section('content')
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                       @include('customer.layouts.partials.profile-sidebar')
                    </section>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تیکت ها</span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{route('customer.profile.my-tickets.create')}}" class="text-white btn btn-sm btn-info">ارسال تیکت جدید</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->



                        <section class="order-wrapper">
                            <section class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>آیدی تیکت</th>
                                        <th>عنوان تیکت</th>
                                        <th>دسته تیکت</th>
                                        <th>اولویت تیکت</th>



                                        <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tickets as $key => $ticket)
                                        <tr>
                                            <th>{{$ticket->id}}</th>
                                            <td>{{\Illuminate\Support\Str::limit($ticket->subject,20)}} </td>

                                            <td>{{$ticket->category->name}}  </td>
                                            <td>{{$ticket->priority->name}}  </td>

                                            <td class="width-16-rem text-left">
                                                <a href="{{route('customer.profile.my-tickets.show',[$ticket->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>

                                            </td>
                                        </tr>
                                    @empty
                                        <section>
                                            تیکتی یافت نشد
                                        </section>
                                    @endforelse

                                    </tbody>
                                </table>

                            </section>


                        </section>


                    </section>
                </main>
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
