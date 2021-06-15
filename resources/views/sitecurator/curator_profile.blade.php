@extends('sitecurator.layout.curator_master')
@section('title', 'Profile')
@section('css')
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Curator</a></li>
                <li class="active"><a>Profile</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <div class="row-fluid">
                    <div class="col-md-12">
                        <div class="box dark">
                            <header>
                                <div class="icons"><i class="icon-edit"></i></div>
                                <h5>Edit Profile</h5>
                            </header>
                            @if ($errors->any())
                                <br>
                                <div class="alert alert-danger alert-dismissable">
                                    {!! implode('', $errors->all(':message')) !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                                    {!! Form::open(array('url'=>'update_curator_profile_submit','class'=>'form-horizontal', 'enctype'=>'multipart/form-data')) !!}

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


                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="text1">E-mail<span
                                                    class="text-sub">*</span></label>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder=""
                                                   name="curator_email" required
                                                   value="{{ $curator->curator_email }}"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="text1">Curator ID<span
                                                    class="text-sub">*</span></label>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder=""
                                                   name="curator_userid" required
                                                   value="{{ $curator->curator_userid }}"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="text1">Reset Password</label>

                                        <div class="col-md-4">
                                            <label for="current_pwd">Current Password</label>
                                            <input type="text" class="form-control" placeholder=""
                                                   name="current_password" id="current_password"/>
                                            <label for="new_pwd">New Password</label>
                                            <input type="text" class="form-control" placeholder=""
                                                   name="new_password" id="new_password"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="text1">Theme in Charge<span
                                                    class="text-sub">*</span></label>

                                        <div class="col-md-10">
                                            <table class="resource_theme_table col-md-10 col-md-offset-1">
                                                <thead>
                                                <tr>
                                                    <th>Affirmation</th>
                                                    <th>Sub Affirmations</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(count($charge_in_theme)>0)
                                                    @foreach($charge_in_theme as $parent_theme_id  => $theme_group)
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
                                            <!--ul style="list-style: none; padding-left: 0;">
                                                @foreach($curator->curator_theme_name_list as $theme)
                                                    <li>
                                                        <p>{{$theme}}
                                                    </li>
                                                @endforeach
                                            </ul-->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="text1">Profile Image</label>
                                        <div class="col-md-8" id="img_upload">
                                            <input type="file" id="file" name="file" onchange="readURL(this)">
                                            <input type="hidden" id="x" name="x">
                                            <input type="hidden" id="y" name="y">
                                            <input type="hidden" id="w" name="w">
                                            <input type="hidden" id="h" name="h">
                                        </div>
                                    </div>
                                    <div class="form-group">
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

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                                    id="update_submit"><a
                                                        style="color:#fff">Submit</a></button>
                                            <button class="btn btn-default btn-sm btn-grad" type="reset">
                                                <a style="color:#000" href="#">Reset</a>
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
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="<?php echo url(); ?>/public/plugins/cropimage/js/jquery.Jcrop.min.js"></script>
    <script>

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
                                setSelect: [300, 300, 0, 0],
                                boxWidth: limit_width,
                                boxHeight: limit_height,
                                allowSelect: true,
                                allowMove: true,
                                allowResize: true,
                                aspectRatio: 1
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
    </script>
@endsection


