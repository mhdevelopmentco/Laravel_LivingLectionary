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
    <title>Living Lectionary Admin | @yield('title') </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <![endif]-->

    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/Font-Awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/main.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/theme.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/MoneAdmin.css"/>
    <link href="<?php echo url('')?>/public/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/tagsinput/jquery.tagsinput.css"/>
    <link rel="shortcut icon" href="<?php echo url(''); ?>/themes/images/favicon/favicon.ico"/>
    <link href="<?php echo url('');?>/public/plugins/dataTables/css/dataTables.bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/jquery-ui/jquery-ui.min.css"/>

    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
@yield('css')
<!-- END PAGE LEVEL STYLES -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="padTop53">

<!-- MAIN WRAPPER -->
<div id="wrap">
    <!-- HEADER SECTION -->
{!! $adminheader !!}
<!-- END HEADER SECTION -->

    <!-- MENU SECTION -->
{!! $adminleftmenus !!}
<!--END MENU SECTION -->

    <!--PAGE CONTENT -->
    <div id="content">
        <div class="inner">
            @yield('content')
        </div>
    </div>
    <!--END PAGE CONTENT -->
</div>
<!--END MAIN WRAPPER -->

<!-- FOOTER -->
{!! $adminfooter !!}
<!--END FOOTER -->

<!-- GLOBAL SCRIPT -->
<script src="<?php echo url('')?>/public/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo url(); ?>/public/assets/js/jquery-ui.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/dataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo url('')?>/public/plugins/dataTables/js/dataTables.bootstrap.js"></script>
<script src="<?php echo url('')?>/public/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/tagsinput/typeahead.js"></script>
<script src="<?php echo url('')?>/themes/js/common.js"></script>
<!-- END GLOBAL SCRIPTS -->

<!-- PAGE LEVEL SCRIPTS -->

<script>
    $(function () {
        $("#from_date").datepicker({
            prevText: "click for previous months",
            nextText: "click for next months",
            showOtherMonths: true,
            selectOtherMonths: false
        });
        $("#to_date").datepicker({
            prevText: "click for previous months",
            nextText: "click for next months",
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });

    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

@yield('script')
<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>
