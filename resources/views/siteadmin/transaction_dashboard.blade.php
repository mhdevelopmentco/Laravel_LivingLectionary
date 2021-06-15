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
    <title>Living Lectionary Transactions</title>
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
{!!$adminheader!!}
<!-- END HEADER SECTION -->
    <!-- MENU SECTION -->
{!!$adminleftmenus!!}

<!--END MENU SECTION -->

    <!--PAGE CONTENT -->
    <div id="content">
        <div class="inner">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class=""><a href="<?php echo url('siteadmin_dashboard'); ?>">Home</a></li>
                        <li class="active"><a href="#">Transaction</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="icon-dashboard"></i></div>
                            <h5>Transaction Dashboard</h5>
                        </header>

                        <div class="row">
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="demo-container">
                                        <div id="completed_pie"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="demo-container">
                                        <div id="ship_kind_pie"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="panel-body">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="demo-container">
                                        <p>Transaction Statics</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover"
                                                   width="100%">
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

                                                <tr>
                                                    <td>This Year</td>
                                                    <td>{{$orders_year_count}}</td>
                                                    <td>{{$orders_year_amount}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Yearly Transaction Statistics</strong>
                                    </div>

                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="yearly_transaction_chart"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--END PAGE CONTENT -->
            </div>
        </div>
    </div>
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

    //orders by shipping or email
    $(document).ready(function () {
        var completed_or_not = [['Completed Orders',{{$completed_orders_cnt}}], ['Orders to process',{{$all_orders_cnt-$completed_orders_cnt}}]];

        var plot_order_completed = $.jqplot('completed_pie', [completed_or_not], {
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

    //orders completed or not
    $(document).ready(function () {
        var shipping_email_orders = [['Orders by Shipping', {{$shipping_orders_count}}], ['Orders without Shipping', {{$email_orders_count}}]];
        var plot_order_kinds = $.jqplot('ship_kind_pie', [shipping_email_orders], {
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


    //Transactions statics Yearly
    $(document).ready(function () {

        $.jqplot.config.enablePlugins = true;
        //var s1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

                <?php echo "var s1 = " . json_encode($this_year_charts); ?>

        var ticks = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        plot1 = $.jqplot('yearly_transaction_chart', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            title: "Transaction History of This Year",
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

        $('#yearly_transaction_chart').bind('jqplotDataClick',
                function (ev, seriesIndex, pointIndex, data) {
                    $('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );
    });

</script>

</body>
<!-- END BODY -->
</html>
