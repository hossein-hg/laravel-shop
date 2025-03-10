@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش  تیکت</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش تیکت</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>
                        نمایش تیکت
                    </h4>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pt-2 border-bottom">
                    <a href="{{route('admin.ticket.index')}}" class="btn btn-info btn-sm"> بازگشت </a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{$ticket->user->fullName}} - {{$ticket->user->id}}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">عنوان تیکت : {{$ticket->subject}}</h5>
                        <p class="card-text">{{$ticket->description}}</p>
                    </section>
                </section>

                <hr>
                @foreach($ticket->children as $child)
                    <section class="card mb-3 m-4">
                        <section class="card-header bg-info d-flex justify-content-between">
                            @if($child->reference)
                                <div>{{$child->reference->user->fullName}}</div>
                            @else
                                <div>{{$child->user->fullName}}</div>
                            @endif
                            
                            <div>{{\App\Helpers\jalaliDate($child->created_at)}}</div>
                        </section>
                        <section class="card-body">

                            <p class="card-text">{{$child->description}}</p>
                        </section>

                    </section>
                @endforeach

                <section >
                    <form action="{{route('admin.ticket.answer',[$ticket->id])}}" method="post">
                        <section class="row">

                            <section class="col-12 ">

                                    @csrf

                                    <div class="form-group">
                                        <label for="">پاسخ تیکت </label>
                                        <textarea  name="description"  rows="4" class="form-control form-control-sm">{{old('description')}}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">ثبت</button>
                                    </div>

                            </section>


                        </section>
                    </form>

                </section>


            </section>
        </section>
    </section>
@endsection
