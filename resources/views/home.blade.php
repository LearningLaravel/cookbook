@extends('master')
@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title">Home Page</div>
            @if(!Auth::check())
                <div class="quote">Our Home page!</div>
            @else
                <div class="quote">You are now logged in!</div>
            @endif
        </div>
    </div>
@endsection
