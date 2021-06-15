@extends('includes/page_master')
@section('title', 'Affirmations')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('Home');?>">Home</a></li>
                    <li><a href="<?php echo url('Affirmations');?>">Stores</a></li>
                </ul>
                <h4>Stores</h4>
                <legend></legend>

                <div class="container">
                    <div class="row">
                        <?php
                        foreach($theme_details as $theme_group) {
                        $parent_theme = $theme_group[0];
                        $child_themes = $theme_group[1];
                        $child_theme_count = count($child_themes);
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="thumbnail" style="margin-top: 20px;">
                                <div class="image-wrapper">
                                    <img src="<?php echo url('') . '/public/assets/images/themes/' . $parent_theme->theme_banner_img; ?>"
                                         style="height:150px; width:256px;" class="img-responsive">
                                </div>
                                <a><h4><?php echo substr($parent_theme->theme_name, 0, 20); ?></h4></a>
                                <div class="clearfix"></div>

                                <div class="text-center">
                                    <table border="0" class="table table-hover">
                                        <tr>
                                            <td>Sub Theme</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($child_theme_count != 0) {
                                                    echo $child_theme_count;
                                                } else {
                                                    echo 'N/A';
                                                } ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <a href="<?php echo url('Affirmations/' . $parent_theme->theme_name); ?>">
                                        <button class="btn  btn-warning">View Details</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
