@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>تیکت</title>
@endsection




@section('content')

    <section class="row">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                        @include('customer.layouts.partials.profile-sidebar')
                    </section>

                </aside>


                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <section class="card mb-3">
                            <section class="card-header bg-custom-yellow d-flex justify-content-between">
                                <div>{{$ticket->user->fullName}}</div>
                                <div>{{\App\Helpers\jalaliDate($ticket->created_at)}}</div>
                            </section>
                            <section class="card-body">
                                <h5 class="card-title">عنوان تیکت : {{$ticket->subject}}</h5>
                                <p class="card-text">{{$ticket->description}}</p>
                            </section>
                            @if($ticket->file)
                            <section class="card-footer">

                                <a download href="{{asset($ticket->file->file_path)}}" class="btn btn-info"> فایل دانلود</a>
                            </section>
                            @endif
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
                        @if($ticket->status == 0)
                        <section >
                            <form action="{{route('customer.profile.my-tickets.answer',[$ticket->id])}}" method="post">
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
                                        <div  class="form-group mt-2">
                                            <button type="submit" class="btn btn-success">ثبت</button>
                                        </div>

                                    </section>


                                </section>
                            </form>

                        </section>
                        @else
                            <section class="bg-danger text-white p-3">این تیکت بسته شده است</section>
                        @endif

                    </section>
                </main>




            </section>
        </section>
    </section>

@endsection
