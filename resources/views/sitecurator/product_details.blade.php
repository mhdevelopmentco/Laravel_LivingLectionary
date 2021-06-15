@extends('sitecurator.layout.curator_master')
@section('title', 'Resource Details')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
    <style>
        .control-label {
            text-align: right;
        }
    </style>
@endsection
@section('content')

    <?php
    if ($target == 'view') {
        $title = "Resource Details";
    } else {
        $title = "Resource Check";
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Curator</a></li>
                <li class="active"><a>{{$title}}</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>{{$title}}</h5>

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
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group text-center">
                                <p><strong>To change the listed affirmation or to add affirmations to this resource,
                                        please
                                        click
                                        <a href="{{url('edit_product_by_curator'.'/'.base64_encode($product->pro_id))}}">here
                                            <i class="icon-edit"></i></a></strong>
                                </p>
                            </div>
                        </div>
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

                        <div class=" panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->mc_name; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body hidden">
                            <div class="form-group">
                                <label class="control-label col-md-2">Main Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->smc_name; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body  hidden">
                            <div class="form-group">
                                <label class="control-label col-md-2">Sub Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->sb_name; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body  hidden">
                            <div class="form-group">
                                <label class="control-label col-md-2">Second Sub Category</label>
                                <div class="col-md-9">
                                    <?php echo $product->ssb_name; ?>
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
                                        <textarea id="wysihtml5" class="form-control"
                                                  rows="10" id="Description" disabled
                                                  readonly><?php echo $product->pro_desc; ?></textarea>
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

                        <?php
                        if ($target == 'view') {
                        ?>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <a style="color:#fff" href="javascript:history.back();"
                                       class="btn btn-success btn-md btn-grad">Back</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        } else { ?>
                        <div class="panel-body">
                            <label class="col-md-2 control-label">Approved or Disapproved</label>
                            <div class="col-md-9">
                                {!! Form::open(array('url'=>'submit_check_result_by_curator', 'class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                                <input type="hidden" name="product_id" value="{{$product->pro_id}}">
                                <input type="hidden" name="curator_id" value="{{$curator_id}}">
                                <div class="row-fluid">
                                    <label style="margin-right: 20px;">
                                        <input type="radio" class="approve_check" name="approve" value="1"/>Approved
                                    </label>
                                    <label style="margin-right: 20px;">
                                        <input type="radio" class="approve_check" name="approve" value="0"/>Disapproved
                                    </label>
                                    <button type="submit" class="btn btn-md btn-success">Submit</button>
                                </div>
                                <div class="row-fluid hidden" id="reason_div">

                                    <label for="reason"><i class="icon icon-comments icon-2x"></i> Please describe your
                                        reason </label>
                                    <textarea style="width: 100%; padding: 10px;" name="reason" id="reason"
                                              <?php if ($product->pro_approved_status == \App\Products::PRODUCT_STATUS_APPROVED) {
                                                  echo 'required';
                                              } ?>
                                              rows="10">Thank you for submitting your content to the Living Lectionary. Unfortunately, we are not able to add it to the Living Lectionary resources at this time. Please consider submitting more resources to us in the future — we are grateful to have you as part of the Living Lectionary community.</textarea>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <?php }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="<?php echo url('')?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>

    <script>
        $(document).ready(function () {

            $('#wysihtml5').wysihtml5();


            $('.approve_check').click(function () {
                var val = $(this).val();
                var reasondiv = $('#reason_div');
                var reason = $('#reason');
                if (val == 1) {
                    reasondiv.addClass('hidden');
                    reason.prop('required', false);
                } else {
                    reasondiv.removeClass('hidden');
                    reason.prop('required', true);
                }
            });

        });
    </script>
@endsection

