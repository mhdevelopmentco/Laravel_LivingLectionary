<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8"/>
    <title>Living Lectionary Contributor | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link href="<?php echo url('');?>/public/plugins/dataTables/css/dataTables.bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/login.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/magic/magic.css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>

<!-- PAGE CONTENT -->
<div class="container">
    <div class="text-center">
        <img src="<?php echo url();?>/themes/images/logo/contributorlogo.png" alt="Logo"/>
    </div>

    <div class="tab-content">
        <div id="login" class="tab-pane active">
            {!! Form::open(array('url'=>'mer_login_check','class'=>'form-signin')) !!}
            @if (Session::has('login_success'))
                <div class="alert alert-success alert-dismissable" id="success_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('login_success') !!}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissable" id="error_div" align="center"
                     style="height:50px;width:270px;">{!! Session::get('error') !!}</div>
            @endif
            <p class="text-muted text-center btn-block  btn-primary disabled">
                MERCHANT LOGIN
            </p>
            <input type="text" name="mer_user" placeholder="Username" class="form-control"/>
            <input type="password" name="mer_pwd" placeholder="Password" class="form-control"/>
            <button class="btn text-muted text-center  btn-warning" type="submit">Sign in</button>
            {!! Form::close() !!}
        </div>

        <div id="forgot" class="tab-pane">
            {!! Form::open(array('url'=>'merchant_forgot_check','class'=>'form-signin')) !!}
            @if (Session::has('forgot_error'))
                <div class="alert alert-danger alert-dismissable" id="error_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('forgot_error') !!}</div>
            @endif
            @if (Session::has('forgot_success'))
                <div class="alert alert-success alert-dismissable" id="success_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('forgot_success') !!}</div>
            @endif
            <div class="alert alert-danger alert-dismissable" id="error_name" align="center"
                 style="height:50px;width:298px;display:none;"></div>
            <p class="text-muted text-center btn-block btn-primary btn-rect disabled">Enter your valid e-mail</p>
            <input type="email" required="required" placeholder="Your E-mail" name="merchant_email" id="merchant_email"
                   class="form-control"/>
            <br/>
            <button class="btn text-muted text-center btn-success" id="recover_password" type="submit">Recover
                Password
            </button>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="text-center ">
        <ul class="list-inline">
            <!--<li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>-->
            <li><a class="text-muted" href="#login" style="display:none;" id="login_click" data-toggle="tab">Back To
                    Login</a></li>
            <li><strong><a class="text-muted" id="forgot_click" href="#forgot" data-toggle="tab">Forgot
                        Password</a></strong></li>
            <!-- <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>-->
        </ul>
    </div>

</div>

<!--END PAGE CONTENT -->

<!-- PAGE LEVEL SCRIPTS -->
<script src="<?php echo url('')?>/public/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo url('')?>/public/assets/js/login.js"></script>

<script>
    $(document).ready(function () {

        var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        $('#forgot_click').click(function () {
            $('#login_click').show();
            $('#forgot_click').hide();
            $('#error_div').hide();
            $('#success_div').hide();
        });
        $('#login_click').click(function () {
            $('#forgot_click').show();
            $('#login_click').hide();
            $('#error_div').hide();
            $('#success_div').hide();
        });

        $('#error_div').fadeOut(3000);
        $('#success_div').fadeOut(3000);

        $('#recover_password').click(function () {

            var merchant_email = $('#merchant_email');
            var error_name = $('#error_name');

            if (merchant_email.val() == '') {
                error_name.show();
                merchant_email.css({border: '1px solid red'});
                merchant_email.focus();
                error_name.html('Enter your email');
                error_name.fadeOut(3000);
                return false;
            }
            else if (!emailReg.test(merchant_email.val())) {
                error_name.show();
                merchant_email.css({border: '1px solid red'});
                merchant_email.focus();
                error_name.html('Enter your valid Email');
                error_name.fadeOut(3000);
                return false;
            }
            else {
                error_name.hide();
                merchant_email.css({border: ''});
            }

        });
    });

</script>

<!--END PAGE LEVEL SCRIPTS -->

</body>
<!-- END BODY -->
</html>
