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
    <title>Living Lectionary | Merchant Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/main.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/theme.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/plan.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/MoneAdmin.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
    <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <!--END GLOBAL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo url(); ?>/public/plugins/flot/examples/examples.css" rel="stylesheet"/>

    <link class="include" type="text/css" rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/jquery.jqplot/jquery.jqplot.min.css"/>

    <script class="include" type="text/javascript"
            src="<?php echo url(); ?>/public/assets/js/chart/jquery.min.js"></script>

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="padTop53 ">

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
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class=""><a>Home</a></li>
                        <li class="active"><a>Curators</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="icon-dashboard"></i></div>
                            <h5>Curator Dashboard</h5>
                        </header>

                        <div class="row-fluid">
                            <div class="col-md-12 panel_marg">
                                <a style="color:#fff" href="<?php echo url(); ?>"
                                   class="btn btn-success btn-sm btn-grad" target="_blank">Go to Live</a>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Curators</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div id="curator_pie"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Resources Checked By Curator
                                    </div>
                                    <div class="panel-body">
                                        <div class="demo-container" id="curator_resource_check_chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<!--END PAGE CONTENT -->

<!-- FOOTER -->
{!! $adminfooter !!}
<!--END FOOTER -->
<!-- GLOBAL SCRIPTS -->

<script src="<?php echo url(); ?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo url(); ?>/public/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END GLOBAL SCRIPTS -->

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/plugins/jquery.jqplot/jquery.jqplot.min.js"></script>

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/plugins/jquery.jqplot/plugins/jqplot.pieRenderer.js"></script>

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/plugins/jquery.jqplot/plugins/jqplot.barRenderer.js"></script>

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/plugins/jquery.jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/plugins/jquery.jqplot/plugins/jqplot.pointLabels.js"></script>

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/plugins/jquery.jqplot/plugins/jqplot.donutRenderer.js"></script>

<script>
    //Resrouces: active/inactive, approved/disapproved/pending
    $(document).ready(function () {
        var act_inact = [['Active Curators',{{$active_curator_cnt}}], ['Blocked Curators',{{$all_curator_cnt-$active_curator_cnt}}]];


                @if ($all_curator_cnt === $active_curator_cnt)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_curator = $.jqplot('curator_pie', [act_inact], {
                    seriesDefaults: {
                        // make this a donut chart.
                        renderer: $.jqplot.DonutRenderer,
                        rendererOptions: {
                            // Donut's can be cut into slices like pies.
                            sliceMargin: slice_margin,
                            // Pies and donuts can start at any arbitrary angle.
                            startAngle: -90,
                            showDataLabels: true,
                            // By default, data labels show the percentage of the donut/pie.
                            // You can show the data 'value' or data 'label' instead.
                            dataLabels: 'value'
                        }
                    },
                    legend: {show: true, location: 'e'},
                });
    });

    //Transactions
    $(document).ready(function () {
        $.jqplot.config.enablePlugins = true;
        //var s1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                <?php echo "var s1 = " . json_encode($curator_resource_check_history_data); ?>

        var ticks = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var curator_resource_check_plot = $.jqplot('curator_resource_check_chart', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults: {
                renderer: $.jqplot.BarRenderer,
                pointLabels: {show: true}
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: {show: false}
        });

        $('#curator_resource_check_chart').bind('jqplotDataClick',
                function (ev, seriesIndex, pointIndex, data) {
                    $('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );
    });
</script>

</body>
<!-- END BODY -->
</html>
