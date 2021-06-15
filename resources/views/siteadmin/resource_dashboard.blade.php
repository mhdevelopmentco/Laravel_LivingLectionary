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
    <title>Living Lectionary | Resource Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/main.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/theme.css"/>
    <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/MoneAdmin.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
    <!--END GLOBAL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo url(); ?>/public/plugins/flot/examples/examples.css" rel="stylesheet"/>

    <script class="include" type="text/javascript"
            src="<?php echo url(); ?>/public/assets/js/chart/jquery.min.js"></script>

    <link class="include" type="text/css" rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/jquery.jqplot/jquery.jqplot.min.css"/>

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
    <div id="content">
        <!--PAGE CONTENT -->
        <div class="inner">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class=""><a>Home</a></li>
                        <li class="active"><a>Resource</a></li>
                    </ul>
                </div>

            </div>

            <!-- Resource Status -->
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resources
                        </div>

                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="demo-container">
                                    <div id="resource_register_pie"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="demo-container">
                                    <div id="resource_approved_pie"></div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="demo-container">
                                    <div id="resource_shipping_pie"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--  Resource History -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resource Registered History
                        </div>
                        <div class="panel-body">
                            <div class="demo-container" id="resource_register_chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resource Sold History
                        </div>
                        <div class="panel-body">
                            <div class="demo-container" id="resource_sold_chart"></div>
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
{!! $adminfooter !!}
<!--END FOOTER -->

<script src="<?php echo url(); ?>/public/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo url(); ?>/public/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

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
        var act_inact = [['Active Resources',{{$active_resources_cnt}}], ['Blocked Resources',{{$all_resources_cnt-$active_resources_cnt}}]];

        var register_pie = $.jqplot('resource_register_pie', [act_inact], {
            title: "Register Status",
            seriesDefaults: {
                // make this a donut chart.
                renderer: $.jqplot.DonutRenderer,
                rendererOptions: {
                    // Donut's can be cut into slices like pies.
                    sliceMargin: 3,
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
    $(document).ready(function () {
        var approve_disapprove_pending = [['Approved Resources', {{$approved_resources_cnt}}], ['Disapproved Resources', {{$disapproved_resources_cnt}}], ['Pending Resources', {{$pending_resources_cnt}}]];
        var apporve_pie = $.jqplot('resource_approved_pie', [approve_disapprove_pending], {
            title: "Approved Status",
            seriesDefaults: {
                // make this a donut chart.
                renderer: $.jqplot.DonutRenderer,
                rendererOptions: {
                    // Donut's can be cut into slices like pies.
                    sliceMargin: 3,
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

    //Resource shipping status
    $(document).ready(function () {
        var data = [
            ['Done', {{$ship_done_cnt}}], ['To do', {{$ship_all_cnt-$ship_done_cnt}}],
        ];

                @if ($ship_all_cnt === $ship_done_cnt)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_resource_shipping = $.jqplot('resource_shipping_pie', [data], {
                    title: "Shipping Status",
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
                            dataLabels: 'value',
                            // "totalLabel=true" uses the centre of the donut for the total amount
                            totalLabel: true
                        }
                    },
                    legend: {show: true, location: 'e'}
                });
    });

    //Resources History
    $(document).ready(function () {
        $.jqplot.config.enablePlugins = true;
        //var s1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                <?php echo "var s1 = " . json_encode($resource_register_chart_data); ?>

        var ticks = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var register_chart = $.jqplot('resource_register_chart', [s1], {
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

        $('#resource_register_chart').bind('jqplotDataClick',
                function (ev, seriesIndex, pointIndex, data) {
                    $('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );
    });


    //Resources History
    $(document).ready(function () {
        $.jqplot.config.enablePlugins = true;
        //var s1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                <?php echo "var s1 = " . json_encode($resource_sold_chart_data); ?>

        var ticks = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var sold_chart = $.jqplot('resource_sold_chart', [s1], {
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

        $('#resource_sold_chart').bind('jqplotDataClick',
                function (ev, seriesIndex, pointIndex, data) {
                    $('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );
    });


</script>
</body>
<!-- END BODY -->
</html>
