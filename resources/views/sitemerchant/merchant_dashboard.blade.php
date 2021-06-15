<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <?php if (Session::has('merchantid')) {
        $merchantid = Session::get('merchantid');
    }
    ?>
    <meta charset="UTF-8"/>
    <title>Living Lectionary| Contributor</title>
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
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/plan.css"/>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/assets/css/MoneAdmin.css"/>
    <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
    <!--END GLOBAL STYLES -->

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
{!!$merchantheader!!}
<!-- END HEADER SECTION -->

    <!--PAGE CONTENT -->
    <div class="container">
        <div class="inner" style="min-height: 700px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="icon-dashboard"></i></div>
                            <h5>Contributor Dashboard</h5>
                        </header>

                        <div class="col-lg-12" style="text-align: center; padding: 20px;">
                            <a href="{{url('mer_add_product')}}" class="add_product_link">
                                Click here to add a new resource.
                            </a>
                            <div>
                                <a class="quick-btn1"
                                   href="<?php echo url('merchant_manage_shop');?>">
                                    <i class="icon-home icon-2x"></i>
                                    <span>Shops</span>
                                    <span class="label label-danger">{{$mer_all_shop_count}}</span>
                                </a>

                                <a class="quick-btn1 active" href="<?php echo url('mer_manage_product');?>">
                                    <i class="icon-th-large icon-2x"></i>
                                    <span>All Resources</span>
                                    <span class="label label-danger">{{$mer_all_resource_count}}</span>
                                </a>

                                <a class="quick-btn1" href="<?php echo url('mer_sold_product');?>">
                                    <i class="icon-shopping-cart icon-2x"></i>
                                    <span>Sold Resources</span>
                                    <span class="label label-success">{{$mer_sold_resource_count}}</span>
                                </a>

                                <a class="quick-btn1" href="<?php echo url('show_merchant_transactions');?>">
                                    <i class="icon-money icon-2x"></i>
                                    <span>Transactions</span>
                                    <span class="label label-success">{{$mer_all_transaction_count}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success btn-sm btn-grad" style="margin-bottom:10px;">
                        <a style="color:#fff" href="<?php echo url(); ?>" target="_blank">Go to Live</a>
                    </button>
                </div>
            </div>

            <div class="row-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Resources
                    </div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="demo-container">
                                <div id="resource_active_status_pie"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="demo-container">
                                <div id="resource_confirm_status_pie"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Shops
                    </div>

                    <div class="panel-body">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="demo-container">
                                <div id="shop_active_status_pie"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Transaction History</strong>
                        </div>
                        <div class="panel-body panel panel-default">
                            <div class="demo-container" id="transaction_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--END MAIN WRAPPER -->

<!-- FOOTER -->
{!! $merchantfooter !!}
<!--END FOOTER -->

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
        var act_inact = [['Active Resources',{{$mer_active_resource_count}}], ['Blocked Resources',{{$mer_all_resource_count-$mer_active_resource_count}}]];

        var resource_active_pie = $.jqplot('resource_active_status_pie', [act_inact], {
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
        var approve_disapprove_pending = [['Approved Resources', {{$mer_approved_resource_count}}], ['Disapproved Resources', {{$mer_disapproved_resource_count}}], ['Pending Resources', {{$mer_pending_resource_count}}]];

        var resource_confirm_pie = $.jqplot('resource_confirm_status_pie', [approve_disapprove_pending], {
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

    //Members
    $(document).ready(function () {
        var data = [
            ['Active Shops', {{$mer_active_shop_count}}], ['Inactive Shops', {{$mer_all_shop_count-$mer_active_shop_count}}]
        ];

                @if ($mer_all_shop_count === $mer_active_shop_count)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_member = jQuery.jqplot('shop_active_status_pie', [data],
                {
                    seriesDefaults: {
                        renderer: jQuery.jqplot.PieRenderer,
                        rendererOptions: {
                            startAngle: -90,
                            // Turn off filling of slices.
                            fill: false,
                            showDataLabels: true,
                            dataLabels: 'value',
                            // Add a margin to seperate the slices.
                            sliceMargin: slice_margin,
                            // stroke the slices with a little thicker line.
                            lineWidth: 5
                        }
                    },
                    legend: {show: true, location: 'e'}
                }
                );
    });


    //Transactions
    $(document).ready(function () {
        $.jqplot.config.enablePlugins = true;
        //var s1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                <?php echo "var s1 = " . json_encode($mer_transaction_chart_data); ?>

        var ticks = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        plot1 = $.jqplot('transaction_chart', [s1], {
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

        $('#chart1').bind('jqplotDataClick',
                function (ev, seriesIndex, pointIndex, data) {
                    $('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );
    });
</script>

</body>
</html>
