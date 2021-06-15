@extends('includes/page_master')
@section('content')
    <div class="container text-center">
        <div class="titlerror">
            <h1>Oops!</h1>
        </div>
        <p class="narrate404">Something has gone wrong. If you are uploading items to the site, please try again, making sure that the files you are adding are correctly formatted.</p>
        <p> Still need help? Please send us a message at contact@livinglectionary.org.</p>
        <button class="btn btn-primary btn-lg" onclick="window.history.back();" style="margin-top: 40px;">Go Back
        </button>
    </div>
@endsection
