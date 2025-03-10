@extends('customer.layouts.master-simple')
@section('head-tag')
    <style>
        #resend-otp{
            font-size: 1rem;
        }
    </style>
@endsection
@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <form action="{{route('auth.customer.login-confirm',$token)}}" method="post">
            @csrf

            <section class="login-logo">
                <img src="{{asset('customer-assets/images/logo/4.png')}}" alt="">
            </section>
            <section class="login-title">
                <a href="{{route('auth.customer.login-register-form')}}">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </section>
            <section class="login-title mb-2">
               کد تایید را وارد نمایید
            </section>
            <section class="login-info">@if($otp->type == 1)  کد تایید برای ایمیل {{$otp->login_id}} ارسال گردید @elseکد تایید برای شماره موبایل {{$otp->login_id}} ارسال گردید @endif </section>
            <section class="login-input-text">
                <input type="text" name="otp" value="{{old('otp')}}">
                @error('otp')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </section>


            <section class="login-btn d-grid g-2"><button class="btn btn-danger">تایید</button></section>

            <section id="resend-otp" class="d-none">
                <a class="text-decoration-none text-primary" href="{{route('auth.customer.login-resend-otp',[$token])}}">دریافت مجدد کد تایید</a>
            </section>

            <section id="timer"></section>
        </form>
    </section>
@endsection

@section('script')
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp
    <script>

        let countDownDate = new Date().getTime() + {{$timer}}
        console.log(countDownDate)
        let timer = $('#timer')
        let resendotp = $('#resend-otp')
        let x = setInterval(function (){
            let now = new Date().getTime()
            let distance = countDownDate - now;
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
            let seconds = Math.floor((distance % (1000 * 60 )) / (1000 ))
            if (minutes === 0){
                timer.html('ارسال مجدد کد تایید تا '+ seconds + 'ثانیه دیگر')
            }
            else{
                timer.html('ارسال مجدد کد تایید تا '+ minutes + 'دقیقه و'+seconds+' ثانیه دیگر')
            }
            if (distance < 0){
                clearInterval(x)
                timer.addClass('d-none')
                resendotp.removeClass('d-none')
            }
        },1000)
    </script>
@endsection
