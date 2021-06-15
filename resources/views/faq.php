@extends('includes/page_master')
@section('title', 'FAQ')
@section('css')
@endsection
@section('content')
    <div class="container">
        <?php if($cms_result){ foreach($cms_result as $cms) {
        if($cms->cp_title == 'Help') {
        $cms_desc = stripslashes($cms->cp_description);  ?>
        <h1 style="color:#ff8400;"><?php echo $cms->cp_title; ?> </h1>
        <legend></legend>
        <div id="legalNotice">
            <?php echo $cms_desc; ?>
        </div>
        <?php } } } else { ?>
        <h1 style="color:#ff8400;"></h1>
        <legend></legend>
        <div id="legalNotice">
            <?php echo 'No data found!'; ?>
        </div>
    </div>
    <?php }  ?>
@endsection
