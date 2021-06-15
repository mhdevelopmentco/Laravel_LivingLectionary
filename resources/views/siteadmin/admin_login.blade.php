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
    <title>Living Lectionary | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link href="<?php echo url('');?>/public/plugins/dataTables/css/dataTables.bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/login.css"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/magic/magic.css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body style="" oncontextmenu="return false">

<!-- PAGE CONTENT -->
<div class="container">
    <div class="text-center">
        <img src="<?php echo url() ;?>/themes/images/logo/adminlogo.png" alt="Logo"/>
    </div>

    <div class="tab-content">
        <div id="login" class="tab-pane active">
            {!! Form::open(array('url'=>'login_check','class'=>'form-signin')) !!}
            @if (Session::has('login_error'))
                <div class="alert alert-danger alert-dismissable" id="error_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('login_error') !!}</div>
            @endif
            @if (Session::has('login_success'))
                <div class="alert alert-success alert-dismissable" id="success_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('login_success') !!}</div>
            @endif

            <p class="text-muted text-center btn-block  btn-primary    disabled">
                ADMIN LOGIN
            </p>
            <input type="text" placeholder="Username" name="admin_name" class="form-control" tabindex="1" autofocus/>
            <input type="password" placeholder="Password" name="admin_pass" class="form-control"/>
            <div class="text-center">
                <button class="btn text-muted text-center  btn-warning" type="submit">Sign in</button>
            </div>
            {!! form::close() !!}

        </div>


        <div id="forgot" class="tab-pane">
            {!! Form::open(array('url'=>'forgot_check','class'=>'form-signin')) !!}
            @if (Session::has('forgot_error'))
                <div class="alert alert-danger alert-dismissable" id="forgot_error_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('forgot_error') !!}</div>
            @endif
            @if (Session::has('forgot_success'))
                <div class="alert alert-success alert-dismissable" id="forgot_success_div" align="center"
                     style="height:50px;width:298px;">{!! Session::get('forgot_success') !!}</div>
            @endif
            <div class="alert alert-danger alert-dismissable" id="error_name" align="center"
                 style="height:50px;width:298px;display:none;"></div>
            <p class="text-muted text-center btn-block btn-primary btn-rect disabled">Enter your valid e-mail</p>
            <input type="email" required="required" name="admin_email" id="admin_email" placeholder="Your E-mail"
                   class="form-control"/>
            <br/>
            <button class="btn text-muted text-center btn-success" id="recover_password" type="submit">Recover
                Password
            </button>
            {!! form::close() !!}
        </div>

    </div>
    <div class="text-center ">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" style="display:none;" id="login_click" data-toggle="tab">Back To
                    Login</a></li>
            <li><b><a class="text-muted" href="#forgot" id="forgot_click" data-toggle="tab">Forgot Password</a></b></li>
            <!-- <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>-->
        </ul>
    </div>


</div>

<!--END PAGE CONTENT -->

<!-- PAGE LEVEL SCRIPTS -->
<script src="<?php echo url('')?>/public/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo url('')?>/public/assets/js/login.js"></script>

<script>

    var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    $(document).ready(function () {

        $('#forgot_click').click(function () {

            $('#login_click').show();
            $('#admin_email').focus();
            $('#forgot_click').hide();
            $('#error_div').hide();
            $('#success_div').hide();
        });
        $('#login_click').click(function () {
            $('#forgot_click').show();
            $('#login_click').hide();
            $('#forgot_error_div').hide();
            $('#forgot_success_div').hide();
        });
        $('#error_div').fadeOut(4000);
        $('#success_div').fadeOut(4000);
        $('#forgot_error_div').fadeOut(4000);
        $('#forgot_success_div').fadeOut(4000);

        $('#recover_password').click(function () {
            var admin_email = $('#admin_email');
            if (admin_email.val() == '') {
                $('#error_name').show();
                admin_email.css({border: '1px solid red'});
                admin_email.focus();
                $('#error_name').html('Enter your email');
                $('#error_name').fadeOut(4000);
                return false;
            }
            else if (!emailReg.test(admin_email.val())) {
                $('#error_name').show();
                admin_email.css({border: '1px solid red'});
                admin_email.focus();
                $('#error_name').html('Enter your valid Email');
                $('#error_name').fadeOut(4000);
                return false;
            }
            else {
                $('#error_name').hide();
                admin_email.css({border: ''});
            }

        });
        <?php if(Session::has('forgot_error') || Session::has('forgot_success')){?>
         $('#forgot_click').click();

        <?php } ?>
    });
</script>
</body>
<!-- END BODY -->
</html>
