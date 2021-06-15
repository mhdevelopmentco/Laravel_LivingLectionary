@extends('includes/page_master')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <?php if ($cms_result) {
                foreach ($cms_result as $cms) {
                }
                $cms_desc = stripslashes($cms->ap_description);
            } else {
                $cms_desc = 'Yet To be Filled';
            } ?>
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('index');?>">Home</a></li>
                    <li><a href="<?php echo url('aboutus');?>">Checkout</a></li>
                </ul>
                <h3 style="text-transform: uppercase;">Comming Soon!</h3>
                <p>The Living Lectionary is gathering content and will be live for the public
                    to purchase and download content soon.</p>
                   <p> Thank you for being part of the Living Lectionary community!</p>
                <!--<hr class="soft"/> */ -->
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
