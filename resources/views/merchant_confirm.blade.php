@extends('includes/page_master')
@section('title', 'Confirm Contributor')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Thank you for Contributor Registration</li>
                </ul>

                <div class="text-center less_content">
                    <h3 class="text-center">Welcome! You are now a confirmed contributor!<br> Let’s get to work
                        getting your content up on the site.
                    </h3>
                    <h4 style="font-style: italic"><a style="text-decoration: underline; color: #11659b;"
                                href="<?php echo url('add_product_by_contributor');?>">Add Resource</a></h4>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
