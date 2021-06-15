@extends('sitemerchant.layout.merchant_master')
@section('title', 'Change Password')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li class=""><a href="<?php echo url('sitemerchant_dashboard'); ?>">Home</a></li>
                <li class="active"><a href="#">Change Password</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Change Password</h5>
                </header>
                @if ($errors->any())
                    <br>
                    <ul class="alert alert-danger alert-dismissable">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </ul>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif

                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'change_password_submit','class'=>'form-horizontal')) !!}

                    <div id="error_msg" style="color:#F00;font-weight:800"></div>
                    <br>
                    <input type="hidden" value="<?php echo $mem_id; ?>" name="merchant_id" id="merchant_id">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Old Password<span class="text-sub">*</span></label>

                        <div class="col-lg-8">
                            <input type="password" class="form-control" placeholder="" name="oldpwd" id="oldpwd" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2"> New Password<span class="text-sub">*</span></label>

                        <div class="col-lg-8">
                            <input type="password" class="form-control" placeholder="" name="pwd" id="pwd" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text2" class="control-label col-lg-2">Confirm Password<span
                                    class="text-sub">*</span></label>

                        <div class="col-lg-8">
                            <input type="password" class="form-control" placeholder="" name="confirmpwd" id="confirmpwd" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-2"><span class="text-sub"></span></label>

                        <div class="col-lg-8">
                            <button id="updatepwd" class="btn btn-warning btn-sm btn-grad" style="color:#fff"> Update
                            </button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000"> Cancel</button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            var pwd = $('#pwd');
            var confirmpwd = $('#confirmpwd');
            var oldpwd = $('#oldpwd');

            $('#updatepwd').click(function () {

                if ( $(pwd).val() != $(confirmpwd).val() ) {
                    $(confirmpwd).css('border', '1px solid red');
                    $('#error_msg').html('Confirm password does not match');
                    oldpwd.focus();
                    return false;
                }
            });
        });
    </script>
@endsection