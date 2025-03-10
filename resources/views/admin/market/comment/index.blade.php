@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
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
                                <th>نویسنده نظر</th>

                                <th> کالا</th>
                                <th> وضعیت</th>
                                <th> پاسخ به</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cog"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($comments as $key => $comment)
                            <tr>
                                <th>{{++$key}}</th>
                                <th>{{\Illuminate\Support\Str::limit($comment->body,10)}}</th>
                                <td>{{$comment->user->fullName}}  </td>

                                <td>{{$comment->commentable->name}}  </td>
                                <td>  {{$comment->approved ? 'تایید شده' : 'تایید نشده'}}  </td>
                                <td>  {{$comment->parent->body ?? ''}}  </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{route('admin.market.comment.show',[$comment->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> نمایش</a>
                                    <a   href="{{route('admin.market.comment.approve',[$comment->id])}}" class="btn text-white btn-{{$comment->approved ? 'success' : 'warning'}} btn-sm"><i class="fa fa-clock"></i> {{$comment->approved ? 'عدم تایید' : 'تایید'}}</a>
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
