<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if ($metadetails) {
        foreach ($metadetails as $metainfo) {
            $metaname = $metainfo->gs_metatitle;
            $metakeywords = $metainfo->gs_metakeywords;
            $metadesc = $metainfo->gs_metadesc;
        }
    } else {
        $metaname = "Living Lectionary";
        $metakeywords = "Living Lectionary";
        $metadesc = "Living Lectionary";
    }
    ?>

    <meta charset="utf-8">
    <title>Living Lectionary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $metadesc;?>">
    <meta name="keywords" content="<?php echo $metakeywords;?>">
    <meta name="author" content="<?php echo $metaname;?>">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta property="og:image" content="http://livinglectionary.org/assets/images/tree.png"/>

    <!-- validation (Register Page)(newsletter)-->
    <link href='https://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'/>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"/>

    <!-- FontAwesome CSS for cool icons -->
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/Font-Awesome/css/font-awesome.min.css"/>

    <!-- Bootstrap style -->
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/bootstrap/css/bootstrap.css">
    <link id="callCss" rel="stylesheet" href="<?php echo url(); ?>/themes/bootshop/bootstrap.min.css"
          media="screen">

    <link href="<?php echo url(); ?>/themes/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <link href="<?php echo url(); ?>/themes/css/base.css" rel="stylesheet" media="screen"/>
    <link href="<?php echo url(); ?>/themes/css/jquery.colorpanel.css" rel="stylesheet" media="screen"/>

    <!-- Bootstrap style responsive-->
    <link href="<?php echo url(); ?>/themes/css/planing.css" rel="stylesheet"/>
    <link href="<?php echo url(); ?>/themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <!-- Google-code-prettify (Register Page)-->
    <link href="<?php echo url(); ?>/themes/css/jquery-gmaps-latlon-picker.css" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <link rel="stylesheet" href="<?php echo url(); ?>/themes/css/normalize.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/themes/css/styles.min.css"/>
    <link href="<?php echo url(); ?>/themes/css/jplist.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo url(); ?>/themes/css/leftmenu.css" rel="stylesheet" media="screen"/>

    <!-- FinalTitleGallery -->
    <!-- Final Tiles Grid Gallery CSS -->
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/finaltilesgallery/css/finaltilesgallery.css">

    <link href="<?php echo url(); ?>/public/plugins/finaltilesgallery/css/elements.css" rel="stylesheet"
          type="text/css">

    <style type="text/css" id="enject"></style>
    <link rel="stylesheet" type="text/css" href="<?php echo url(); ?>/themes/css/compare-products/demo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo url(); ?>/themes/css/compare-products/component.css"
          media="screen"/>

    @yield('css')


    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-97137955-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>
{!! $header !!}
<body>

@yield('content')

<!-- Login/Password Modal -->
<input type="hidden" id="return_url" value="{{URL::current()}}"/>
<div id="login" class="modal fade login_modal" aria-hidden="true" role="dialog" aria-labelledby="login"
     style="display:none; overflow:inherit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="font-style: italic">Welcome to The Living Lectionary</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="col-md-12">
                <div class="logerror_msg" style="color:#F00;font-weight:300"></div>
                <div class="text-hidden resend_msg">
                    The account needs to be activated. Please check your mail box and Activate.
                    <a class="btn-link resend_link" type="btn">Resend your confirmation email</a>
                </div>
                <p class="resend_success_msg text-hidden text-success">&emsp;Success of Mail Resend</p>
                <p class="resend_error_msg text-hidden text-danger">&emsp;Fail of Mail Resend. Try again later.</p>
            </div>
        </div>

        <div class="row-fluid">
            <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="control-group">
                    <input type="text" name="loginemail" class="loginemail"
                           placeholder="Enter Your Login Email"
                           autofocus>
                </div>
                <div class="control-group">
                    <input type="password" name="loginpassword" class="loginpassword"
                           placeholder="Enter Your Password">
                </div>

                <button type="submit" class="btn btn-primary login_submit"><i
                            class="icon icon-signin"></i>&nbsp;Sign In
                </button>
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i
                            class="icon icon-eye-close"></i>&nbsp;Close
                </button>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="control-group">
                    <a href="{{url('Join')}}" class="btn-link link">
                        Don't have an account yet?<br> Sign Up Now!
                    </a>
                </div>
                <div class="control-group">
                    <a href="#forget_username_modal" role="button" class="forgot_a_click link" onclick="$('.close').click();"
                       data-toggle="modal">Forgot Username?</a>
                </div>
                <div class="control-group">
                    <a href="#forget_password_modal" role="button" class="forgot_a_click link" onclick="$('.close').click();"
                       data-toggle="modal">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="forget_password_modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="forget_password_modal"
     aria-hidden="false" style="height:250px;display:none; overflow:auto;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Forgot Password</h3>
    </div>
    <div class="modal-body">
        <div class="reset_errmsg" style="color:#F00;font-weight:400"></div>
        <div style="float:left">
            <label>E-mail&nbsp;*</label>
            <div class="control-group" style="padding-left:0px;">
                <input type="text" class="passwordemail" placeholder="Enter Your Email">
            </div>
            <input type="button" style="color:#fff" id="reset_password" value="Submit" class="btn btn-success"/>
            <input type="reset" style="color:#000" value="cancel" data-dismiss="modal"
                   class="btn btn-default btn-sm btn-grad"/>
        </div>
        <div class="clearfix" style="margin-top:8px; text-align:center">
            <a href="#login" onclick="$('.close').click();" data-toggle="modal" class="link">
                Already a member? Sign in</a>
        </div>
    </div>
</div>
<div id="forget_username_modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="forget_username_modal"
     aria-hidden="false" style="height:250px;display:none; overflow:auto;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Forgot Username</h3>
    </div>
    <div class="modal-body">
        <div class="reset_errmsg" style="color:#F00;font-weight:400"></div>
        <div style="float:left">
            <label>E-mail&nbsp;*</label>
            <div class="control-group" style="padding-left:0px;">
                <input type="text" class="passwordemail" placeholder="Enter Your Email">
            </div>
            <input type="button" style="color:#fff" id="send_username" value="Submit" class="btn btn-success"/>
            <input type="reset" style="color:#000" value="cancel" data-dismiss="modal"
                   class="btn btn-default btn-sm btn-grad"/>
        </div>
        <div class="clearfix" style="margin-top:8px; text-align:center">
            <a href="#login" onclick="$('.close').click();" data-toggle="modal" class="link">
                Already a member? Sign in</a>
        </div>
    </div>
</div>
<div id="reset_pwd" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="login45"
     aria-hidden="false" style="height:220px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Reset Password</h3>
    </div>
    <div id="passmsg" style="color:#F00;font-weight:400"></div>
    <div class="modal-body">
        <div class="control-group row-fluid" style="padding-left:0px;">
            <label class="span4" style="text-align:left;">New Password&nbsp;*</label>
            <input class="span8" type="password" id="passwordnew" placeholder="Enter Your New Password">
        </div>
        <div class="control-group row-fluid" style="padding-left:0px;">
            <label class="span4" style="text-align:left;">Confirm Password&nbsp;*</label>
            <input class="span8" type="password" id="passwordconfirmnew"
                   placeholder="Confirm Your New Password">
            <input type="hidden" id="passsworduseremail"
                   value="<?php echo Session::get('reset_user_email');?>"/>
        </div>
        <div class="row-fluid">
            <button type="button" id="reset_new_password" class="btn btn-success span3 offset6">Submit
            </button>
            <button type="reset" id="cancel_password" class="btn btn-danger span3" data-dismiss="modal">
                Cancel
            </button>
        </div>

    </div>
</div>

<div id="login_for_checkout" class="modal fade login_modal" aria-hidden="true" role="dialog" aria-labelledby="login"
     style="display:none; overflow:inherit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="font-style: italic">Sign in to checkout and save your selected resources to your account.</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="col-md-12">
                <div class="logerror_msg" style="color:#F00;font-weight:300"></div>
                <div class="text-hidden resend_msg">
                    The account needs to be activated. Please check your mail box and Activate.
                    <a class="btn-link resend_link" type="btn">Resend your confirmation email</a>
                </div>
                <p class="resend_success_msg text-hidden text-success">&emsp;Success of Mail Resend</p>
                <p class="resend_error_msg text-hidden text-danger">&emsp;Fail of Mail Resend. Try again later.</p>
            </div>
        </div>

        <div class="row-fluid">
            <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="control-group">
                    <input type="text" name="loginemail" class="loginemail" placeholder="Enter Your Login Email"
                           autofocus>
                </div>
                <div class="control-group">
                    <input type="password" name="loginpassword" class="loginpassword"
                           placeholder="Enter Your Password">
                </div>

                <button type="submit" class="btn btn-primary login_submit"><i
                            class="icon icon-signin"></i>&nbsp;Sign In
                </button>
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i
                            class="icon icon-eye-close"></i>&nbsp;Close
                </button>

            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="control-group">
                    <a href="{{url('Join')}}" class="btn-link link">
                        Not a member yet? &nbsp;Signing up is easy! &nbsp;Click here to join.
                    </a>
                </div>
                <div class="control-group">
                    <a href="#forget_password_modal" role="button" onclick="$('.close').click();"
                       data-toggle="modal" class="link forgot_a_click">Forgot
                        Password?</a>
                </div>
                <div class="control-group">
                    <button type="button" class="btn btn-warning" id="checkout_guest">Checkout as a Guest</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="subscribe" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false"
     style="height:250px; display:none; overflow:auto;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Thanks for your subscribe!</h3>
    </div>
    <div class="modal-body">
        <div id="subscribe_errmsg" style="color:#F00;font-weight:400"></div>
        <div id="subscribe_sucmsg" style="color:green;font-weight:400"></div>
        <div>
            <div class="control-group row" style="padding-left:0px;">
                <label class="col-md-4 text-center">E-mail&nbsp;*</label>
                <input type="text" class="col-md-7 passwordemail" placeholder="Enter Your Email" id="subscribe_email">
            </div>
            <div class="control-group row" style="padding-left:0px;">
                <label class="col-md-4 text-center">Name&nbsp;*</label>
                <input type="text" class="col-md-7" placeholder="Enter Your Name" id="subscribe_name">
            </div>

            <div class="control-group row" style="padding-left:0px;">
                <div class="col-md-offset-1 col-md-9">
                    <input type="button" style="color:#fff" id="submit_for_subscribe" value="Submit"
                           class="btn btn-success"/>
                    <input type="reset" style="color:#000" value="cancel" data-dismiss="modal"
                           class="btn btn-default btn-sm btn-grad"/>
                </div>
            </div>
        </div>
    </div>
</div>

{!! $footer !!}

<!-- script-->
<script src="<?php echo url(); ?>/themes/js/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="<?php echo url(); ?>/themes/switch/themeswitch.css" type="text/css" media="screen"/>
<script src="<?php echo url(); ?>/themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo url(); ?>/themes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo url(); ?>/themes/js/jquery.lightbox-0.5.js"></script>

<!-- Product page -->
<script src="<?php echo url('');?>/themes/js/modernizr.min.js"></script>
<script src="<?php echo url(); ?>/themes/js/jplist.min.js"></script>

<script src="<?php echo url(); ?>/themes/js/google-code-prettify/prettify.js"></script>
<script src="<?php echo url(); ?>/themes/js/bootshop.js"></script>

<script src="<?php echo url(); ?>/themes/js/common.js"></script>

<script>
    $(document).ready(function () {
        var dropdiv = $('#drop-down-div');
        var droptog = $('#dropdown_toggle_bt');
        var nsi = $('#normal_search_input');

        function show_advanced_search_form() {
            $(dropdiv).fadeIn().data('area-expanded', true);
        }

        function hide_advanced_search_form() {
            jQuery(dropdiv).fadeOut().data('area-expanded', false);
        }

        $(document).click(function (e) {
            var target = e.target;
            var cn = target.className;
            if (cn.indexOf('icon-caret-down') > 1 || cn.indexOf('dropdown-toggle') > 1) {
                return;
            } else {
                hide_advanced_search_form();
            }
        });

        $(droptog).click(function () {
            var expanded = $(dropdiv).data('area-expanded');
            if (expanded) {
                hide_advanced_search_form();
            } else {
                show_advanced_search_form();
            }
        });

        $(nsi).click(function () {
            hide_advanced_search_form();
        })

//        var siteheader = $('#siteheader');
//        $(document).scroll(function () {
//
//            var scroll = $(this).scrollTop();
//            if (scroll > 50) {
//                $(siteheader).addClass('inverse');
//                $('.inverse_hide').addClass('hidden');
//                $('.inverse_show').removeClass('hidden');
//            } else {
//                $(siteheader).removeClass('inverse');
//                $('.inverse_show').addClass('hidden');
//                $('.inverse_hide').removeClass('hidden');
//            }
//        });
    });

    $(document).on('change', '.category_search', function () {

        var parent = $(this);
        var parent_val = $(this).val();
        var level = $(this).data('level');

        var childs = $(this).data('child');
        childs = childs.split(',');

        for (var j = 0; j < childs.length; j++) {
            var child_id = childs[j];
            $('#' + child_id).empty();
            var option0 = '<option selected value="0">--select--</option>';
            $('#' + child_id).append(option0);
        }
        if (parent_val == 0)
            return;

        show_sub_category(parent, parent_val, level, childs[0]);
    });

    function show_sub_category(parent, parent_val, level, child) {
        var url = "{{ url('product_getsubcategory_list')}}" + '/' + level;

        $.ajax({
            type: 'get',
            data: {'id': parent_val},
            url: url,
            success: function (data) {
                //add subcategory under this category
                if (data.length > 0) {

                    console.log(data);

                    for (var i = 0; i < data.length; i++) {
                        var catg = data[i];

                        var option;

                        if (level == 1) {
                            option = '<option value="' + catg["smc_id"] + '" >' + catg["smc_name"] + '</option>';

                        } else if (level == 2) {

                            option = '<option value="' + catg["sb_id"] + '" >' + catg["sb_name"] + '</option>';

                        } else if (level == 3) {
                            option = '<option value="' + catg["ssb_id"] + '" >' + catg["ssb_name"] + '</option>';
                        } else {
                            continue;
                        }

                        $('#' + child).append(option);
                    }


                }

            }
        });
    }
</script>

<script>
    //Login

    var return_url = $('#return_url').val();

    var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //var emailReg = /^([\w-]+@([\w-]+\.)+[\w-]{2,4})?$/;

    $('.login_submit').click(function () {
        var modal = $(this).closest('.modal-body')[0];

        var loginemail = $(modal).find('.loginemail');
        var loginpassword = $(modal).find('.loginpassword');
        var loginerrmsg = $(modal).find('.logerror_msg');
        var reseterrmsg = $(modal).find('.reset_errmsg');
        var passwordemail = $(modal).find('.passwordemail');

        var resend_link = $(modal).find('.resend_link');
        var resend_msg = $(modal).find('.resend_msg');

        if (loginemail.val() == "") {
            $(loginemail).css('border', '1px solid red');
            $(loginemail).focus();
            $(loginerrmsg).html('Please Input your Email or UserID.');
            return false;
        }
        else {
            $(loginerrmsg).html('');
            $(loginemail).css('border', '');
        }

        if (loginpassword.val() == "") {
            $(loginpassword).css('border', '1px solid red');
            $(loginpassword).focus();
            $(loginerrmsg).html('Please Input your password.');
            return false;
        }
        else {
            $(loginpassword).css('border', '');
            $(loginerrmsg).html('');
        }
        //login submit

        var logemail = $(loginemail).val();
        var logpassword = $(loginpassword).val();

        var passemail = 'email=' + logemail + "&pwd=" + logpassword;

        $.ajax({
            type: 'post',
            data: passemail,
            url: '<?php echo url('user_login_submit');?>',

            success: function (data) {
                if (data) {
                    if (data.result == "success") {
                        var return_url = $('#return_url').val();

                        if (return_url.indexOf('register_submit') > 1)
                            window.location = "<?php echo url('')?>";
                        else
                            window.location = return_url;

                    } else if (data.result == "not_confirmed") {
                        var customer_id = data.customer_id;
                        $(resend_link).attr('customer_id', customer_id);
                        $(resend_msg).show();
                    } else {
                        $(loginerrmsg).html('Invalid Login Credentials');
                    }
                }
            },
            error: function (data) {
                $(loginerrmsg).html('Login Failed, Please try again later.');
            }
        });
    });

    $('#checkout_guest').click(function () {
        var modal = $(this).closest('.modal-body')[0];

        var loginerrmsg = $(modal).find('.logerror_msg');

        $.ajax({
            type: 'post',
            url: '<?php echo url('checkout_guest_submit');?>',
            success: function (data) {
                if (data.result == "success") {
                    var return_url = $('#return_url').val();
                    if (return_url.indexOf('register_submit') > 1)
                        window.location = "<?php echo url('')?>";
                    else
                        window.location = return_url;
                } else {
                    $(loginerrmsg).html('Checkout as a Guest Failed, Please try again later.');
                }
            },
            error: function (data) {
                $(loginerrmsg).html('Checkout as a Guest Failed, Please try again later.');
            }
        });
    });


    $('.resend_link').click(function () {

        var customer_id = $(this).attr('customer_id');

        $.ajax({
            type: 'GET',
            url: '<?php echo url('resend_member_register_success');?>',
            data: {'encoded_customer_id': customer_id},
            success: function (data) {
                if (data.result == "success") {
                    show_resend_success_msg();
                }
                else {
                    show_resend_error_msg();
                }
            },
            error: function (data) {
                show_resend_error_msg();
            }
        });
    });


    //submit subscribe
    $('#submit_for_subscribe').click(function () {

        var subscribe_email = $('#subscribe_email');
        var subscribe_email_val = $('#subscribe_email').val();

        var subscribe_name = $('#subscribe_name');
        var subscribe_name_val = $('#subscribe_name').val();

        var subscribe_errmsg = $('#subscribe_errmsg');
        var subscribe_sucmsg = $('#subscribe_sucmsg');

        if (!subscribe_email_val) {
            $(subscribe_email).css('border', '1px solid red');
            $(subscribe_email).focus();
            $(subscribe_errmsg).html('Please input your E-mail.');
            return false;
        }


        if (!emailReg.test(subscribe_email_val)) {
            $(subscribe_email).css('border', '1px solid red');
            $(subscribe_email).focus();
            $(subscribe_errmsg).html('Please input valid email.');
            return false;
        }

        if (!subscribe_name_val) {
            $(subscribe_name).css('border', '1px solid red');
            $(subscribe_name).focus();
            $(subscribe_errmsg).html('Please input your name.');
            return false;
        }

        $(subscribe_email).css('border', '');
        $(subscribe_name).css('border', '');
        $(subscribe_errmsg).html('');
        $(subscribe_sucmsg).html('');

        var data = 'subscribe_email=' + subscribe_email_val + '&subscribe_name=' + subscribe_name_val;
        $.ajax({
            type: 'get',
            data: data,
            url: '<?php echo url('subscribe_submit');?>',
            success: function (data) {
                if (data.result == "success") {
                    $(subscribe_sucmsg).html('You have become a subscriber.');
                } else {
                    $(subscribe_errmsg).html(data.message);
                }
            },
            error: function () {
                $(subscribe_errmsg).html('Problem Occurred. Please try again later.');
            }
        });
    });


    function show_resend_success_msg() {
        $('.resend_msg').fadeOut(function () {
            $('.resend_success_msg').fadeIn().delay(1000).fadeOut();
        });
    }

    function show_resend_error_msg() {
        $('.resend_msg').fadeOut(function () {
            $('.resend_error_msg').fadeIn().delay(1000).fadeOut();
        });
    }

    $('#reset_password').click(function () {

        var modal = $(this).closest('.modal-body');

        var passwordemail = $(modal).find('.passwordemail');
        var reseterrmsg = $(modal).find('.reset_errmsg')

        if (passwordemail.val() == "") {
            $(passwordemail).css('border', '1px solid red');
            $(passwordemail).focus();
            $(reseterrmsg).html('Please input your email.');
            return false;
        }

        if (!emailReg.test($(passwordemail).val())) {
            $(passwordemail).css('border', '1px solid red');
            $(passwordemail).focus();
            $(reseterrmsg).html('Please input valid email.');
            return false;
        }

        $(passwordemail).css('border', '');
        $(reseterrmsg).html('');

        var data = 'pwdemail=' + passwordemail.val();

        $.ajax({
            type: 'get',
            data: data,
            url: '<?php echo url('user_forgot_submit');?>',
            success: function (responseText) {
                if (responseText == "success") {
                    $(reseterrmsg).html('Please check your email for further instructions ');
                }
                else if (responseText == "fail") {
                    $(reseterrmsg).html('User Email does not exist');
                }
            },
            error: function () {
                $(reseterrmsg).html('Problem Occured. Please try again later.');
            }
        });
    });

    $('#send_username').click(function () {

        var modal = $(this).closest('.modal-body');

        var passwordemail = $(modal).find('.passwordemail');
        var reseterrmsg = $(modal).find('.reset_errmsg')

        if (passwordemail.val() == "") {
            $(passwordemail).css('border', '1px solid red');
            $(passwordemail).focus();
            $(reseterrmsg).html('Please input your email.');
            return false;
        }

        if (!emailReg.test($(passwordemail).val())) {
            $(passwordemail).css('border', '1px solid red');
            $(passwordemail).focus();
            $(reseterrmsg).html('Please input valid email.');
            return false;
        }

        $(passwordemail).css('border', '');
        $(reseterrmsg).html('');

        var data = 'pwdemail=' + passwordemail.val();

        $.ajax({
            type: 'get',
            data: data,
            url: '<?php echo url('username_forgot_submit');?>',
            success: function (responseText) {
                if (responseText == "success") {
                    $(reseterrmsg).html('Please check your email.');
                }
                else if (responseText == "fail") {
                    $(reseterrmsg).html('User Email does not exist');
                }
            },
            error: function () {
                $(reseterrmsg).html('Problem Occured. Please try again later.');
            }
        });
    });

    $('#reset_new_password').click(function () {

        if ($('#passwordnew').val() == "") {
            $('#passwordnew').css('border', '1px solid red');

            $('#passwordnew').focus();
            return false;
        }
        else {
            $('#passwordnew').css('border', '');
            $('#passmsg').html('');
        }
        if ($('#passwordconfirmnew').val() == "") {
            $('#passwordconfirmnew').css('border', '1px solid red');

            $('#passwordconfirmnew').focus();
            return false;
        }
        else if ($('#passwordconfirmnew').val() != $('#passwordnew').val()) {
            $('#passwordconfirmnew').css('border', '1px solid red');

            $('#passwordconfirmnew').focus();
            return false;
        }
        else {
            $('#passwordconfirmnew').css('border', '');
            var newpwd = $('#passwordnew').val();
            var useremail = $('#passsworduseremail').val();
            var passnewpwd = 'newpwd=' + newpwd + '&useremail=' + useremail;

            $.ajax({
                type: 'get',
                data: passnewpwd,
                url: '<?php echo url('user_reset_password_submit');?>',
                success: function (responseText) {
                    //alert(responseText);
                    if (responseText == "success") {
                        $('#passmsg').html('Password Changed Success');
                        $('.close').click();
                        $('#login').modal('show');
                    }
                    else if (responseText == "fail") {
                        $('#passmsg').html('You must choose a new password that does not match one you have used in the past.');
                    }
                }

            });
        }
    });

</script>

<script type="text/javascript">

    $(window).load(function () {

        $('#upload_add').click(function () {

            var position = $("#ad_pos option:selected").val();
            var page = $("#ad_pages option:selected").val();

            if ($('#ad_title').val() == "") {
                $('#ad_title').css('border', '1px solid red');
                $('#ad_title').focus();
                return false;
            }
            else {
                $('#ad_title').css('border', '');
            }
            if (position == 0) {
                $('#ad_pos').css('border', '1px solid red');
                $('#ad_pos').focus();
                return false;
            }
            else {
                $('#ad_pos').css('border', '');
            }
            if (page == 0) {
                $('#ad_pages').css('border', '1px solid red');
                $('#ad_pages').focus();
                return false;
            }
            else {
                $('#ad_pages').css('border', '');
            }
            if ($('#ad_url').val() == "") {
                $('#ad_url').css('border', '1px solid red');
                $('#ad_url').focus();
                return false;
            }
            else {
                var txt = $('#ad_url').val();
                var re = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/
                if (re.test(txt)) {
                    $('#ad_url').css('border', '');
                }
                else {
                    $('#ad_url').css('border', '1px solid red');
                    $('#ad_url').focus();
                    return false;
                }

            }
            if ($('#file').val() == '') {
                alert('Image field required!');
                return false;
            }
            else {

                var title = $('#ad_title').val();
                var pass = "title=" + title;
                $.ajax({
                    type: 'get',
                    data: pass,
                    url: '<?php echo url('check_title'); ?>',
                    success: function (responseText) {

                        if (responseText == "success") {
                            $('#error_name').html('Thank You ,Your request should be processed soon');
                            $("#uploadform").submit();
                        }
                        else {
                            $('#ad_title').css('border', '1px solid red');
                            $('#ad_title').focus();
                            $('#error_name').html('Ad title already exists');
                        }
                    }
                });


            }


        });
        $('#news_result').hide();
        $('#newsletter').click(function () {
            var sname4 = $('#sname4');
            if (sname4.val() == "") {
                $(sname4).focus();
                $(sname4).css("border", "red solid 1px");
                return false;
            }
            else if ($.trim(sname4.val()) == "") {
                $(sname4).focus();
                $(sname4).css("border", "red solid 1px");
                return false;
            }
            else if (!emailReg.test(sname4.val())) {
                $(sname4).focus();
                $(sname4).css("border", "red solid 1px");
                return false;
            }

            else {
                $('#newsletter').hide();
                $(sname4).css("border", "#CCCCCC solid 1px");
                var passData = 'semail=' + sname4.val();
                $.ajax({
                    type: 'GET',
                    data: passData,
                    url: '<?php echo url('front_newsletter_submit'); ?>',
                    success: function (responseText) {
                        //alert(responseText);
                        $('#news_result').show();
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);


                    }
                });
                return false;

            }
        });
    });
</script>

<script>
    //paste this code under head tag or in a seperate js file.
    // Wait for window load
    $(window).load(function () {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });
</script>


<script>
    $('document').ready(function () {
        if ($('#demo').length > 0) {
            $('#demo').jplist({
                itemsBox: '.list'
                , itemPath: '.list-item'
                , panelPath: '.jplist-panel'

                //save plugin state
                , storage: 'localstorage' //'', 'cookies', 'localstorage'
                , storageName: 'jplist-div-layout'
            });
        }

        $('.close').click(function () {
            $('.alert').hide();
        });
    });
</script>

@yield('script')

</body>
</html>