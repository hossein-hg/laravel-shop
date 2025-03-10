@extends('emails.layouts.master')

@section('content')

<h2>{{ $details['subject'] }}</h2>
<p>{!! $details['body'] !!}  </p>


@endsection
