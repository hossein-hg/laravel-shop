@extends('emails.layouts.master')

@section('content')

<h2>{{ $details['title'] }}</h2>
<p>{{ $details['body'] }}</p>
<p>کد فعالسازی شما : {{ $code }}</p>

@endsection
