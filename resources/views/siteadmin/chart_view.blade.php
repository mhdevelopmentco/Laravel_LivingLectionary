<!DOCTYPE html>
<html>
<head>
    <!--[if lt IE 9]>
    <script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript"
            src="<?php echo url(); ?>/public/assets/js/chart/jquery.min.js"></script>
</head>
<body>

<div id="chart1" style="margin-top:20px; margin-left:20px; width:800px; height:500px;"></div>

<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/assets/js/chart/jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/assets/js/chart/jqplot.barRenderer.min.js"></script>
<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/assets/js/chart/jqplot.pieRenderer.min.js"></script>
<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/assets/js/chart/jqplot.categoryAxisRenderer.min.js"></script>
<script class="include" type="text/javascript"
        src="<?php echo url(); ?>/public/assets/js/chart/jqplot.pointLabels.min.js"></script>

<script class="code" type="text/javascript">$(document).ready(function ()  {
        $.jqplot.config.enablePlugins = true;
        var s1 = [2, 6, 7, 10, 5, 8, 20, 50];
        var ticks = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        plot1 = $.jqplot('chart1', [s1], {
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

<script class="code" type="text/javascript">$(document).ready(function () {
        var s1 = [2, -6, 7, -5];
        var ticks = ['a', 'b', 'c', 'd'];

        plot7 = $.jqplot('chart7', [s1], {
            seriesDefaults: {
                renderer: $.jqplot.BarRenderer,
                rendererOptions: {fillToZero: true},
                pointLabels: {show: true}
            },
            axes: {
                // yaxis: { autoscale: true },
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            }
        });
    });
</script>
</body>
</html>