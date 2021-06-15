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
    <title>Living Lectionary | Curator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/main.css"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/theme.css"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/assets/css/MoneAdmin.css"/>
    <link rel="stylesheet" href="<?php echo url('');?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
    <link rel="shortcut icon" href="<?php echo url(''); ?>/themes/images/favicon/favicon.ico"/>
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="<?php echo url('');?>/public/assets/css/layout2.css" rel="stylesheet"/>
    <link href="<?php echo url('');?>/public/plugins/flot/examples/examples.css" rel="stylesheet"/>


    <link class="include" type="text/css" rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/jquery.jqplot/jquery.jqplot.min.css"/>

    <script class="include" type="text/javascript"
            src="<?php echo url(); ?>/public/assets/js/chart/jquery.min.js"></script>
    <!-- END PAGE LEVEL  STYLES -->

</head>

<!-- END HEAD -->

<body class="padTop53 ">

<div id="wrap">
    <!-- Header -->
{!!$curator_header!!}
<!-- End Header -->

    <div class=" container">
        <div class="inner" style="min-height: 700px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="icon-dashboard"></i></div>
                            <h5>Curator Dashboard</h5>
                        </header>
                        <div class="col-md-12" style="text-align: center; padding: 20px;">
                            <div>
                                <a class="quick-btn1 active" href="#">
                                    <i class="icon-th-large icon-2x"></i>
                                    <span>All Resources</span>
                                    <span class="label label-danger"><?php echo $all_products;?></span>
                                </a>
                                <a class="quick-btn1" href="<?php echo url('curator_approved_resource');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>Approved</span>
                                    <span class="label label-success"><?php echo $approved_products; ?></span>
                                </a>
                                <a class="quick-btn1" href="<?php echo url('curator_disapproved_resource'); ?>">
                                    <i class="icon-refresh icon-2x"></i>
                                    <span>Disapproved</span>
                                    <span class="label label-warning"><?php echo $disapproved_products;?></span>
                                </a>
                                <a class="quick-btn1" href="<?php echo url('curator_pending_resource'); ?>">
                                    <i class="icon-cloud-upload icon-2x"></i>
                                    <span>Pending</span>
                                    <span class="label label-warning"><?php echo $pending_products;?></span>
                                </a>
                            </div>
                            <button class="btn btn-success btn-sm btn-grad" style="margin-top:40px;">
                                <a style="color:#fff" href="<?php echo url(); ?>" target="_blank">
                                    Go to Live</a>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
{!!$curator_footer!!}
<!-- End Footer -->

<script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
<script src="<?php echo url(); ?>/public/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
</body>

<!-- END BODY -->
</html>