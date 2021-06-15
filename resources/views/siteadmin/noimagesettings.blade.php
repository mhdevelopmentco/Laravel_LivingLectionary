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
    <title>Living Lectionary |Noimage Settings</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/main.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/theme.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/MoneAdmin.css"/>
    <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
    <!--END GLOBAL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="padTop53 ">

<!-- MAIN WRAPPER -->
<div id="wrap">


    <!-- HEADER SECTION -->
{!!$adminheader!!}
<!-- END HEADER SECTION -->
    <!-- MENU SECTION -->
{!!$adminleftmenus!!}
<!--END MENU SECTION -->

    <div></div>

    <!--PAGE CONTENT -->
    <div id="content">

        <div class="inner">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class=""><a>Settings</a></li>
                        <li class="active"><a>Noimage Settings</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="icon-edit"></i></div>
                            <h5>Noimage Settings</h5>

                        </header>
                        <div id="div-1" class="accordion-body collapse in body">
                            @if (Session::has('message'))
                                <p style="background-color:green;color:#fff;">{!! Session::get('message') !!}</p>
                            @endif
                            {!! Form::open(array('url'=>'add_noimage_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                            <div class="form-group">
                                <label for="text1" class="control-label col-md-3">Current Noimage<span class="text-sub">*</span></label>
                                <?php
                                if ($noimagedetails) {
                                    foreach ($noimagedetails as $noimage) {
                                        $imgpath = "assets/noimage/" . $noimage->imgs_name;
                                    }
                                } else {
                                    $imgpath = "";
                                }

                                ?>
                                <div class="col-md-8">
                                    <img src="<?php echo $imgpath;?>"></div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Upload Banner Image<span class="text-sub">*</span></label>

                                <div class="col-md-8">
                                    <input type="file" placeholder="" name="noimgfile" id="noimgfile">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-md-3"><span class="text-sub"></span></label>

                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success btn-sm btn-grad " style="color:#fff">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                        Reset
                                    </button>

                                </div>

                            </div>


                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <!--END PAGE CONTENT -->

</div>

<!--END MAIN WRAPPER -->

<!-- FOOTER -->
<div id="footer">
    <p>&copy; Nex eCart 2014&nbsp;</p>
</div>
<!--END FOOTER -->


<!-- GLOBAL SCRIPTS -->
<script src="<?php echo url('')?>/public/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo url('')?>/public/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END GLOBAL SCRIPTS -->

</body>
<!-- END BODY -->
</html>
