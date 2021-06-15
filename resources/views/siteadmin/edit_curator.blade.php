@extends('siteadmin.layout.admin_master')
@section('title', 'Add Curator')
@section('css')
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
    <link rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css"/>
    <style>
        .multiselect-native-select .btn-group, .multiselect {
            width: 100%;
        }

        .multiselect-container li.subtheme {
            padding-left: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Curator</a></li>
                <li class="active"><a>Edit Curator</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Curator</h5>
                </header>
                @if ($errors->any())
                    <br>
                    <ul>
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all('<li>:message</li>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'edit_curator_submit','class'=>'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edit Curator
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="curator_name">Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="hidden" name="curator_id" value="{{ $curator->id }}"/>
                                        <input type="text" class="form-control" placeholder=""
                                               name="curator_name" id="curator_name" required
                                               value="{{ $curator->curator_name }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">E-mail<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="curator_email" required
                                               value="{{ $curator->curator_email }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Curator ID<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="curator_userid" required
                                               value="{{ $curator->curator_userid }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="curator_pwd">Reset Password</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="curator_pwd" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="curator_theme">Choose Theme<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <select name="curator_theme" id="curator_theme" multiple
                                                class="form-control" size="8">
                                            <?php
                                            $curator_theme_list = explode(':', $curator->curator_theme);
                                            $curator_theme_list_origin = str_replace(':', ',', $curator->curator_theme);
                                            ?>
                                            @foreach($theme_details as $theme_group)
                                                <option value="{{$theme_group[0]->theme_id}}"
                                                        <?php if($curator->curator_theme == $theme_group[0]->theme_id) {?> selected<?php } ?>>
                                                    {{$theme_group[0]->theme_name}}
                                                </option>
                                                @foreach($theme_group[1] as $sub_theme)
                                                    <option value="{{$sub_theme->theme_id}}"
                                                            <?php if( in_array($sub_theme->theme_id, $curator_theme_list)) {?> selected
                                                            <?php } ?>  class="subtheme">
                                                        {{$sub_theme->theme_name}}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <input type="hidden" value="" name="selected_curator_theme"
                                               value="{{$curator_theme_list_origin}}"
                                               id="selected_curator_theme">
                                    </div>
                                </div>
                            </div>


                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Profile Image</label>
                                    <div class="col-md-8" id="img_upload">
                                        <input type="file" id="file" name="file" onchange="readURL(this)">
                                        <label>570*362 Image Preferred</label>
                                        <input type="hidden" id="x" name="x">
                                        <input type="hidden" id="y" name="y">
                                        <input type="hidden" id="w" name="w">
                                        <input type="hidden" id="h" name="h">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-2">
                                        <?php if($curator->curator_img) {?>
                                        <img class="img-responsive img-circle"
                                             src="<?php echo url(''); ?>/public/assets/images/curator/<?php echo $curator->curator_img;?>">
                                        <?php } else {?>
                                        <img class="img-responsive  img-circle"
                                             src="<?php echo url(''); ?>/public/assets/images/profile/man.png">
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="pass1"><span
                                        class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad"><a
                                            id="submit_curator" style="color:#fff">Submit</a></button>
                                <button type="reset" class="btn btn-default btn-sm btn-grad"><a style="color:#000"
                                                                                                href="#">Reset</a>
                                </button>

                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

            <div id="img_modal" class="modal fade in" tabindex="-1" role="dialog"
                 aria-hidden="false" style="height:auto;display:none; background:white;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3>Edit Image</h3>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <img src="" id="cropimage">
                    </div>
                    <input type="button" style="color:#fff" id="reset_img" value="Done" data-dismiss="modal"
                           class="btn btn-success"/>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="<?php echo url(); ?>/public/plugins/cropimage/js/jquery.Jcrop.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script>

                <?php echo 'var used_theme =' . json_encode($used_theme);?>

        var cropimage = jQuery('#cropimage');
        var image_modal = jQuery('#img_modal');
        var imageType = /image.*/;

        var reader = new FileReader();

        function readURL(input) {
            var file = input.files[0];
            var image = new Image();

            if (file.type.match(imageType)) {

                reader.onload = function (e) {

                    image.src = e.target.result;

                    image.onload = function () {
                        if (this.width > 1500 || this.height > 1500) {
                            alert('This image is too large. Please try again with an image less than 1500 pixels square.');
                            input.value = "";
                        } else {
                            cropimage.attr('src', image.src);
                            var limit_width = jQuery(image_modal).width();
                            var limit_height = jQuery(image_modal).height();
                            if (cropimage.data('Jcrop')) {
                                cropimage.data('Jcrop').destroy();
                            }
                            cropimage.Jcrop({
                                onSelect: function (c) {
                                    jQuery('#x').val(c.x);
                                    jQuery('#y').val(c.y);
                                    jQuery('#w').val(c.w);
                                    jQuery('#h').val(c.h);
                                },
                                setSelect: [570, 362, 0, 0],
                                boxWidth: limit_width,
                                boxHeight: limit_height,
                                allowSelect: true,
                                allowMove: true,
                                allowResize: true,
                                aspectRatio: 570/362
                            });
                            jQuery('#img_modal').modal('show');
                        }
                    };
                };

                reader.onabort = function () {
                    input.value = "";
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please Choose Valid Image for Profile');
                input.value = "";
            }
        }

        $(document).ready(function () {
            $('#curator_theme').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: true,
                disableIfEmpty: true
            });

            $('#curator_theme').multiselect('select', used_theme);
        });

        jQuery(function ($) {
            $('#submit_curator').click(function () {
                $('#selected_curator_theme').val($('#curator_theme').val());
            });
        });
    </script>
@endsection
