@extends('admin.layouts.master')

@section('head-tag')
    <title>گالری کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> گالری کالا</li>
        </ol>
    </nav>

    <section >

                <section class="row">
                    <section class="col-12">
                        <section class="main-body-container">
                            <section class="main-body-container-header">
                                <h4>
                                    ایجاد تصویر
                                </h4>

                            </section>

                            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">




                            </section>

                            <section >
                                <form enctype="multipart/form-data" action="{{route('admin.market.gallery.store',[$product->id])}}" id="form" method="post">
                                    @csrf
                                    <section class="row">


                                        <section class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">تصویر </label>
                                                <input name="image" type="file" class="form-control form-control-sm">
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </section>

                                        <section class="col-12">
                                            <button class="btn btn-primary btn-sm">ثبت</button>
                                        </section>

                                    </section>
                                </form>

                            </section>

                        </section>
                    </section>
                </section>



    </section>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        گالری کالا
                    </h4>

                </section>





            </section>
            <section class="row">
                @foreach($product->images as $key => $image)

                <section class="col-md-4 mt-2" id="tr{{$image->id}}">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset($image->image['indexArray']['medium'])}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>

                            <a  id="delete{{$image->id}}" onclick="deleteRecord({{$image->id}})" data-url="{{route('admin.market.gallery.destroy',[$image->id])}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-edit"></i> حذف</a>
                        </div>
                    </div>
                </section>

                @endforeach
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

    </script>
@endsection

