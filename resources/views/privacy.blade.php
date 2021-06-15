@extends('includes/page_master')
@section('title', 'Privacy Policy')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <?php if ($terms) {
                foreach ($terms as $privacy) {
                }
                $cms_desc = stripslashes($privacy->pri_text);
            } else {
                $cms_desc = 'Yet To be Filled';
            } ?>
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('index');?>">Home</a></li>
                    <li><a href="<?php echo url('privacy_policy');?>">Privacy Policy</a> <span
                                class="divider">/</span></li>
                </ul>
                <h3>Privacy Policy</h3>
                <hr class="soft"/>
                <div id="legalNotice">
                    <?php echo $cms_desc; ?>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function setBarWidth(dataElement, barElement, cssProperty, barPercent) {
            var listData = [];
            $(dataElement).each(function () {
                listData.push($(this).html());
            });
            var listMax = Math.max.apply(Math, listData);
            $(barElement).each(function (index) {
                $(this).css(cssProperty, (listData[index] / listMax) * barPercent + "%");
            });
        }
        setBarWidth(".style-1 span", ".style-1 em", "width", 100);
        setBarWidth(".style-2 span", ".style-2 span", "width", 55);
    </script>
@endsection
