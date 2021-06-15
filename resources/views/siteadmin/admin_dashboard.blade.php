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
    <title>Living Lectionary | Dashboard</title>
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
    <link rel="<?php echo url('');?>/stylesheet" href="<?php echo url('');?>/public/plugins/timeline/timeline.css"/>
    <script class="include" type="text/javascript"
            src="<?php echo url(); ?>/public/assets/js/chart/jquery.min.js"></script>
    <!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo url(); ?>/public/plugins/html5shiv.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/respond.min.js"></script>
    <![endif]-->

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

    <!--PAGE CONTENT -->
    <div class=" container">
        <div class="inner" style="min-height: 700px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="icon-dashboard"></i></div>
                            <h5>Admin Dashboard</h5>
                        </header>
                        @if ($errors->any())
                            <br>
                            <ul class="alert alert-danger alert-dismissable">
                                {!! implode('', $errors->all('<li>:message</li>')) !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </ul>
                        @endif
                        @if (Session::has('message'))
                            <div class="alert alert-danger alert-dismissable">{!! Session::get('message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="static_icons_row">
                                <a class="quick-btn1" href="<?php echo url('merchant_dashboard');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>Merchants</span>
                                    <span class="label label-danger"><?php echo $all_merchants_cnt;?></span>
                                </a>
                                <a class="quick-btn1" href="<?php echo url('merchant_dashboard');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>Stores</span>
                                    <span class="label label-danger"><?php echo $all_stores_cnt;?></span>
                                </a>

                                <a class="quick-btn1" href="<?php echo url('member_dashboard');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>Members</span>
                                    <span class="label label-danger"><?php echo $all_members_cnt;?></span>
                                </a>
                                <a class="quick-btn1" href="<?php echo url('curator_dashboard');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>Curators</span>
                                    <span class="label label-danger"><?php echo $all_curators_cnt;?></span>
                                </a>
                            </div>
                            <div class="static_icons_row">
                                <a class="quick-btn1" href="">
                                    <i class="icon-check icon-2x"></i>
                                    <span>Subscribers</span>
                                    <span class="label label-danger"><?php echo $all_subscribers_cnt;?></span>
                                </a>

                                <a class="quick-btn1" href="<?php echo url('manage_news_subscribers');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>News Subscribers</span>
                                    <span class="label label-danger"><?php echo $all_news_subscribers_cnt;?></span>
                                </a>
                                <a class="quick-btn1 active" href="<?php echo url('resource_dashboard');?>">
                                    <i class="icon-check icon-2x"></i>
                                    <span>All Resources</span>
                                    <span class="label label-danger"><?php echo $all_resources_cnt;?></span>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-sm btn-grad" style="margin-bottom:10px;">
                                    <a style="color:#fff" href="<?php echo url(); ?>" target="_blank">Go to Live</a></button>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Merchants and Stores
                                </div>

                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="merchant_pie"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="store_pie"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Members and Curators
                                </div>

                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="member_pie"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="curator_pie"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Subscribers and Newsletter Subscribers
                                </div>

                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="subscriber_pie"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="newsletter_subscriber_pie"></div>
                                        </div>
                                    </div>
                                </div>
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
                                            <div id="resource_pie1"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="demo-container">
                                            <div id="resource_pie2"></div>
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
                                    <div class="demo-container" id="transaction_chart"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!--END MAIN WRAPPER -->

<!-- FOOTER -->
<div id="footer">
    <p>&copy;&nbsp;{{Date('Y-m-d')}} Living Lectionary, All Rights Reserved.</p>
</div>
<!--END FOOTER -->

<!-- GLOBAL SCRIPTS -->

<script src="<?php echo url('');?>/public/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
    //Contributors
    $(document).ready(function () {
        var data = [
            ['Active Contributors', {{$active_merchants_cnt}}], ['Inactive Contributors', {{$all_merchants_cnt-$active_merchants_cnt}}],
        ];

                @if ($all_merchants_cnt === $active_merchants_cnt)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_contributor = $.jqplot('merchant_pie', [data], {
                    title: "Contributors",
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

    //Stores
    $(document).ready(function () {
        var data = [
            ['Active Stores', {{$active_stores_cnt}}], ['Inactive Stores', {{$all_stores_cnt-$active_stores_cnt}}],
        ];
                @if ($all_stores_cnt === $active_stores_cnt)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_store = $.jqplot('store_pie', [data], {
                    title: "Stores",
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

    //Members
    $(document).ready(function () {
        var data = [
            ['Active Members', {{$active_members_cnt}}], ['Inactive Members', {{$all_members_cnt-$active_members_cnt}}]
        ];

                @if ($all_members_cnt === $active_members_cnt)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_member = jQuery.jqplot('member_pie', [data],
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

    //Curators
    $(document).ready(function () {
        var data = [
            ['Active Curators', {{$active_curators_cnt}}], ['Inactive Curators', {{$all_curators_cnt-$active_curators_cnt}}]
        ];

                @if ($all_curators_cnt === $active_curators_cnt)
        var slice_margin = 0;
                @else
        var slice_margin = 3;
                @endif

        var plot_curator = jQuery.jqplot('curator_pie', [data],
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

    //Subscribers
    $(document).ready(function () {
        var data = [
            ['Active Subscribers', {{$active_subscribers_cnt}}], ['Inactive Subscribers', {{$all_subscribers_cnt- $active_subscribers_cnt}}]
        ];

        var plot_subscriber = jQuery.jqplot('subscriber_pie', [data],
                {
                    seriesDefaults: {
                        // Make this a pie chart.
                        renderer: jQuery.jqplot.PieRenderer,
                        rendererOptions: {
                            // Put data labels on the pie slices.
                            // By default, labels show the percentage of the slice.
                            showDataLabels: true,
                            dataLabels: "value",

                        }
                    },
                    legend: {show: true, location: 'e'}
                }
        );
    });

    //Newsletter Subscribers
    $(document).ready(function () {
        var data = [
            ['Active Newsletter Subscribers', {{$active_news_subscribers_cnt}}], ['Inactive Newsletter Subscribers', {{$all_news_subscribers_cnt- $active_news_subscribers_cnt}}]
        ];

        var plot_newsletter_subscriber = jQuery.jqplot('newsletter_subscriber_pie', [data],
                {
                    seriesDefaults: {
                        // Make this a pie chart.
                        renderer: jQuery.jqplot.PieRenderer,
                        rendererOptions: {
                            // Put data labels on the pie slices.
                            // By default, labels show the percentage of the slice.
                            showDataLabels: true,
                            dataLabels: "value",
                        }
                    },
                    legend: {show: true, location: 'e'}
                }
        );
    });

    //Resrouces: active/inactive, approved/disapproved/pending
    $(document).ready(function () {
        var act_inact = [['Active Resources',{{$active_resources_cnt}}], ['Blocked Resources',{{$all_resources_cnt-$active_resources_cnt}}]];

        var plot_resource1 = $.jqplot('resource_pie1', [act_inact], {
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
        var plot_resource2 = $.jqplot('resource_pie2', [approve_disapprove_pending], {
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
        //var s1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                <?php echo "var s1 = " . json_encode($transaction_chart_data); ?>

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