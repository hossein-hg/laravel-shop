@extends('admin.layouts.master')

@section('head-tag')
    <title>فرم کالا</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فرم کالا</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        فرم کالا
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.market.property.create')}}" class="btn btn-info btn-sm">ایجاد فرم کالا</a>

                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جست و جو" class="form-control form-control-sm form-text">
                    </div>

                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام فرم کالا</th>
                                <th>نام دسته بندی</th>
                                <th>واحد</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($category_attributes as $key => $attribute)
                            <tr id="tr{{$attribute->id}}">
                                <th>{{++$key}}</th>
                                <td>{{$attribute->name}}</td>
                                <td>{{$attribute->category->name ?? ''}}</td>
                                <td>{{$attribute->unit}}</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.market.value.index',[$attribute->id])}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> ویژگی ها</a>
                                    <a href="{{route('admin.market.property.edit',[$attribute->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <a  id="delete{{$attribute->id}}" onclick="deleteRecord({{$attribute->id}})" data-url="{{route('admin.market.property.destroy',[$attribute->id])}}" class="btn btn-danger btn-sm text-white"><i class="fa fa-edit"></i> حذف</a>
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
    </script>
@endsection
