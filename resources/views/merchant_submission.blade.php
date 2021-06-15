@extends('includes/page_master')
@section('title', 'Contributor Register Successfully')
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
                <div id="result">
                </div>
                <div class="text-center less_content">
                    <h3 class="text-center">Success!! Your Contributor Account has been created!
                        <br>Please check your email to find a link to confirm your account and get started.
                    </h3>
                    <input type="hidden" id="store_name" value="{{ $store_name }}" >
                    <h4 style="font-style: italic">Don’t see the email?
                        <button id="submit_bt" class="href_button">Re-send the message.</button>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#submit_bt').click(function () {
            var store_name = $('#store_name').val();

            $.ajax({
                type: 'GET',
                url: '<?php echo url('resend_contributor_register_success');?>',
                data: {'store_name': store_name },
                success: function (data) {
                    //alert(responseText);
                    if (data.result == "success") {
                        show_success_msg()
                    }
                    else {
                        show_err_msg();
                    }
                },
                error: function (data) {
                    console.log(data);
                    show_err_msg();
                }
            });
        });

        function show_success_msg() {
            $('#result').html('<div class="alert alert-success alert-dismissable" id="result_suc_div">' +
                    '<span>Message Resented Successfully, Please recheck your email.</span>' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                    '</div>');
        }

        function show_err_msg() {
            $('#result').html('<div class="alert alert-danger alert-dismissable" id="result_err_div">' +
                    '<span>Message Resending Failed. Please try again later.</span>' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                    '</div>')
        }

    </script>
@endsection
