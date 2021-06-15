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
    <title>Contributor Transactions</title>
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
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/plan.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/MoneAdmin.css"/>
    <link rel="shortcut icon" href="<?php echo url(); ?>/themes/images/favicon/favicon.ico">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
    <link href="<?php echo url('')?>/public/assets/css/datepicker.css" rel="stylesheet">
    <!--END GLOBAL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo url('')?>/public/plugins/flot/examples/examples.css" rel="stylesheet"/>

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
    <!-- MENU SECTION -->
{!!$merchantleftmenus!!}

<!--END MENU SECTION -->

    <!--PAGE CONTENT -->
    <div id="content">
        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li class=""><a href="<?php echo url('sitemerchant_dashboard'); ?>">Home</a></li>
                        <li class="active"><a href="#">Transaction</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="icon-dashboard"></i></div>
                            <h5>Transaction Dashboard</h5>

                        </header>

                        <div class="row" style="padding-top: 20px;">
                            <div class="col-md-6 col-md-offset-3 ">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Period Transaction Details</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Transactions</th>
                                                    <th>Count</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Today</td>
                                                    <td>{{$orders_today_count}}</td>
                                                    <td>{{$orders_today_amount}}</td>
                                                </tr>

                                                <tr>
                                                    <td>This Week</td>
                                                    <td>{{$orders_week_count}}</td>
                                                    <td>{{$orders_week_amount}}</td>
                                                </tr>

                                                <tr>
                                                    <td>This Month</td>
                                                    <td>{{$orders_month_count}}</td>
                                                    <td>{{$orders_month_amount}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Transactions
                                </div>

                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="transaction_kind_pie"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="transaction_completed_pie"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>Transaction History</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="demo-container" id="transaction_chart"></div>
                                </div>
                            </div>
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
    <p>&copy; Living Lectionary {{Date('Y-m-d')}}</p>
</div>
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

<script type="text/javascript">

    //Transaction: shipping/email-download, completed or not
    $(document).ready(function () {
        var ship_or_no = [['Transactions with Shipping',{{$shipping_order_count}}], ['Transactions without Shipping',{{$all_orders_cnt-$shipping_order_count}}]];

        var transaction_kind = $.jqplot('transaction_kind_pie', [ship_or_no], {
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
        var to_do_or_not = [['Completed', {{$completed_orders_cnt}}], ['To do', {{$all_orders_cnt-$completed_orders_cnt}}]];

        var transaction_done = $.jqplot('transaction_completed_pie', [to_do_or_not], {
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


    //Transactions
    $(document).ready(function () {
        $.jqplot.config.enablePlugins = true;
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
<!-- END BODY -->
</html>
