@extends('includes/page_master')
@section('content')
    <div class="container text-center">
        <div class="title404">
            <h1>404</h1>
        </div>
        <p class="narrate404">The page you are looking for cannot be found</p>
        <button class="btn btn-primary btn-lg" onclick="location.href = '{{url('Home')}}'" style="margin-top: 40px;">Go
            to Home Page
        </button>
    </div>
@endsection
