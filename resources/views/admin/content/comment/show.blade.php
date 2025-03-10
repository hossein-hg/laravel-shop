@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش  نظر</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 " > <a href="#">نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        نمایش نظر
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.content.comment.index')}}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                           {{$comment->user->fullName}}  - {{$comment->user->id}}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title"> پست : {{$comment->commentable->title}}</h5>
                        <p class="card-text">{{$comment->body}}</p>
                    </section>
                </section>
                @if($comment->parent_id == null)
                <section >
                    <form method="post" action="{{route('admin.content.comment.answer',[$comment->id])}}">
                        @csrf
                        <section class="row">

                            <section class="col-12 ">
                                <div class="form-group">
                                    <label for="">پاسخ ادمین </label>
                                    <textarea name="body" rows="4" class="form-control form-control-sm"></textarea>
                                    @error('body')
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
                @endif

            </section>
        </section>
    </section>
@endsection
