@extends('includes/page_master')
@section('title', 'Become A Subscriber')
@section('css')
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
    <style>
        textarea {
            width: 100%;
            box-sizing: border-box;
        }

        .panel {
            -webkit-box-shadow: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row-fluid">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('/'); ?>">Home</a></li>
                    <li class="active">Register as Subscriber</li>
                </ul>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif

                <h3>Become a Subscriber</h3>

                <div class="content">

                    {!! Form::open(array('url'=>'become_subscriber_submit','id'=>'register_form', 'class'=>'form-horizontal loginFrm', 'enctype'=>'multipart/form-data')) !!}

                    <fieldset class="personal-data text-center">
                        <div class="row-fluid">
                            <h3>
                                Subscribe to the Living Lectionary<br>
                                for free monthly content and discounts on all
                                Lectionary materials.
                            </h3>
                            <h4>
                                For <span class="text-info text-bold">39.97</span> each month, you’ll receive a monthly
                                email with links to 2 free Lectionary
                                items, <br>and a <span class="text-info text-bold">30%</span> discount all the content on
                                the site.
                            </h4>
                            <h4 class="text-primary">
                                Subscribe Today!
                            </h4>
                        </div>

                        <div class="control-group text-center">
                            <input type="submit" id="register_submit" class="btn btn-primary"
                                   value="Confirm Subscriber"/>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script src="<?php echo url('')?>/themes/js/common.js"></script>
    <script>
        $(document).ready(function () {
        });
    </script>
@endsection