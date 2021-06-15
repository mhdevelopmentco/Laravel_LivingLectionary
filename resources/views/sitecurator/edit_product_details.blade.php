@extends('sitecurator.layout.curator_master')
@section('title', 'Resource Details')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <link rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css"/>
    <style>
        ul.wysihtml5-toolbar > li {
            position: relative;
        }

        .imgrow {
            margin-top: 10px;
        }

        .imgrow dd {
            display: inline-block;
        }

        .price_div {
            display: none;
        }

        #sub_theme_selection {
            /*display:none;*/
        }

        .multiselect-native-select .btn-group, .multiselect {
            width: 100%;
        }

        .multiselect-container li.subtheme {
            padding-left: 30px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Curator</a></li>
                <li class="active"><a>Edit Resource</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Resource</h5>
                </header>

                <div class="row">

                    <div class="col-md-12 panel_marg">
                        @if ($errors->any())
                            <ul class="alert alert-danger alert-dismissable">
                                {!! implode('', $errors->all('<li>:message</li>')) !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="top:-20px;">×
                                </button>
                            </ul>
                        @endif
                        @if (Session::has('message'))
                            <div class="alert alert-danger alert-dismissable">{!! Session::get('message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="top:-20px;">×
                                </button>
                            </div>
                        @endif

                        <div id="error_msg" style="color:#F00;font-weight:800"></div>


                        {!! Form::open(array('url'=>'edit_product_submit_by_curator', 'class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                        <input type="hidden" name="product_edit_id" value="{{$product->pro_id}}">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Title</label>
                                <div class="col-md-9">
                                    <?php echo $product->pro_title; ?>
                                </div>
                            </div>
                        </div>


                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Themes</label>
                                <div class="col-md-10 row">
                                    <table class="resource_theme_table col-md-10 col-md-offset-1">
                                        <thead>
                                        <tr>
                                            <th>Affirmation</th>
                                            <th>Sub Affirmations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($used_theme)>0)
                                            <?php $ti = 1;?>
                                            @foreach($used_theme as $parent_theme_id  => $theme_group)
                                                @if($theme_group['parent_theme'] != null)
                                                    <tr>
                                                        <td>
                                                            <label>{{$theme_group['parent_theme']->theme_name}}</label>
                                                            <img class="img-responsive parent_theme_img"
                                                                 src="{{url('public/assets/images/themes/'.$theme_group['parent_theme']->theme_banner_img)}}"/>
                                                        </td>
                                                        <td>
                                                            <div class="child_theme_list">
                                                                <ul>
                                                                    <?php
                                                                    if(array_key_exists('child_themes', $theme_group))
                                                                    {
                                                                    $child_theme_list = $theme_group['child_themes'];//array
                                                                    foreach($child_theme_list as $child_theme){
                                                                    ?>
                                                                    <li>
                                                                        <label class="child_theme_name">{{$child_theme->theme_name}}</label>
                                                                    </li>
                                                                    <?php }}?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $parent_theme = \App\Theme::find($parent_theme_id);
                                                            ?>
                                                            <label>{{$parent_theme->theme_name}}</label>
                                                            <img class="img-responsive deactive_theme_img parent_theme_img"
                                                                 src="{{url('public/assets/images/themes/'.$parent_theme->theme_banner_img)}}"/>
                                                        </td>
                                                        <td>
                                                            <div class="child_theme_list">
                                                                <ul>
                                                                    <?php
                                                                    $child_theme_list = $theme_group['child_themes'];//array
                                                                    foreach($child_theme_list as $child_theme){
                                                                    ?>
                                                                    <li>
                                                                        <label class="child_theme_name">{{$child_theme->theme_name}}</label>
                                                                    </li>
                                                                    <?php }?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="select_theme">Choose Affirmations<span
                                        class="text-sub">*</span></label>
                            <div class="col-md-8">
                                <select name="select_theme" id="select_theme"
                                        class="form-control" size="8"
                                        multiple="multiple">
                                    @foreach($theme_details as $theme_group)
                                        <option value="{{$theme_group[0]->theme_id}}">{{$theme_group[0]->theme_name}}</option>
                                        @foreach($theme_group[1] as $sub_theme)
                                            <option value="{{$sub_theme->theme_id}}"
                                                    class="subtheme">{{$sub_theme->theme_name}}</option>
                                        @endforeach
                                    @endforeach

                                </select>
                                <input type="hidden" value="" name="selected_theme" id="selected_theme">
                            </div>
                        </div>

                        <div class=" panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->mc_name; ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Price</label>
                                <div class="col-md-9">
                                    <?php if ($product->pro_price > 0) {
                                        echo $product->pro_price;

                                        if ($product->pro_inctax) {
                                            echo ' :Included Tax';
                                        }

                                    } else {
                                        echo 'Free';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="text1" class="control-label col-md-2">Content Type</label>

                                <div class="col-md-9">

                                    <?php

                                    $pro_file_down = $product->pro_file_down;
                                    $pro_file_link = $product->pro_file_link;

                                    if ($product->pro_content_kind == 1) {
                                        echo 'A tangible item to be shipped';

                                        if ($product->pro_shippamt > 0) {
                                            echo '<br><br>Shipping Amount: <strong>' . $product->pro_shippamt . '</strong>';
                                        } else {
                                            echo '<br><br>Shipping Not Required';
                                        }

                                    } else if ($product->pro_content_kind == 2) {
                                    echo 'A downloadable resource';
                                    if(str_contains($pro_file_down, 'pdf') || str_contains($pro_file_down, 'docx') || str_contains($pro_file_down, 'txt')){
                                    ?>
                                    <br><br>Download URL: <a href="{{url('download_product').'/'.$pro_file_down}}">
                                        {{$product->pro_file_down}} </a>
                                    <?php
                                    } else { ?>
                                    <br><br>Download URL: <a
                                            href="{{ asset('public/assets/images/product/download').'/'.$pro_file_down }}"
                                            download="download"> {{$pro_file_down}} </a>
                                    <?php
                                    }
                                    } else {
                                        echo 'A link to content hosted on another site';
                                        echo '<br><br>Link URL: <strong><a href="' . $product->pro_file_link . '" target="_blank">' . $product->pro_file_link . '</a></strong>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Shipping Amount</label>
                                <div class="col-md-9">
                                    <?php echo $product->pro_shippamt; ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="wysihtml5">Content Description</label>
                                <div class="col-md-9">
                                        <textarea id="wysihtml5" class="form-control" name="Description"
                                                  rows="10"
                                                  id="Description"><?php echo $product->pro_desc; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="text1" class="control-label col-md-2">Contributor</label>
                                <div class="col-md-9">
                                    {{ $product->mem_fname.' '.$product->mem_lname }}
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="text1" class="control-label col-md-2">Shop</label>

                                <div class="col-md-9">
                                    {{ $product->stor_name }}
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="Scripture">Scripture</label>

                                <div class="col-md-9">
                                    <textarea class="form-control" id="Scripture" readonly
                                              name="Scripture"><?php echo $product->pro_scripture; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Resource Image</label>
                                <div class="col-md-9">
                                    <?php
                                    $file_get_path = explode('/**/', $product->pro_Img);

                                    for($i = 0; $i < $product->pro_image_count; $i++){
                                    ?>
                                    <div class="col-sm-3">
                                        <img class="img-responsive"
                                             src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $file_get_path[$i]; ?>">
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-offset-2">
                                    <button class="btn btn-success" type="submit" id="submit_product"><i
                                                class="icon-ok"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="<?php echo url('')?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack-back.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>

    <script src="<?php echo url(); ?>/public/plugins/cropimage/js/jquery.Jcrop.min.js"></script>

    <script src="<?php echo url('')?>/public/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

    <script>

        <?php echo 'var used_theme_arr =' . json_encode($used_theme_arr).';';?>

        $(document).ready(function () {

            $('#select_theme').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: true,
                disableIfEmpty: true
            });

            $('#select_theme').multiselect('select', used_theme_arr);

            $('#wysihtml5').wysihtml5();
        });

        jQuery(function ($) {
            $('#submit_product').click(function () {

                var wysihtml5 = $('#wysihtml5');

                var selected_options = $('#select_theme option:selected').length;
                if (selected_options == 0) {
                    $('#select_theme').focus();
                    $('#error_msg').html('Please Select theme');
                    return false;
                }

                $('#selected_theme').val($('#select_theme').val());


                if ($.trim(wysihtml5.val()) == '') {
                    wysihtml5.css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Description');
                    wysihtml5.focus();
                    return false;
                } else {
                    wysihtml5.css('border', '');
                    $('#error_msg').html('');
                }

            });
        });
    </script>
@endsection

