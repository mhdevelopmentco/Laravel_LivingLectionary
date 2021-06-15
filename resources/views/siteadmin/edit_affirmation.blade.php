@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Theme')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">

    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/multiselect/style.css">

    <style>
        ul.wysihtml5-toolbar > li {
            position: relative;
        }

        .js-multiselect1 option, .js-mutliselect2 option {
            border: 1px solid #aa4318;
            border-radius: 2px;
            margin-top: 2px;
            overflow: auto;
            color: white;
            background-color: rgb(41, 127, 116);
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit Theme</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>{{$theme_details->theme_name}}</h5>

                </header>
                @if ($errors->any())
                    <br>
                    <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'edit_affirmation_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                        <div class="form-group">
                            <label class="control-label col-md-2" for="theme_name">Name<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input type="hidden" class="form-control" name="theme_id"
                                       value="{!! $theme_details->theme_id !!}">
                                <input type="text" class="form-control" placeholder=""
                                       name="theme_name" required
                                       value="{!! $theme_details->theme_name !!}"/>
                            </div>
                        </div>

                        <div class="form-group" id="parent_theme_select"
                             @if($theme_details -> parent_theme == 0)
                             style="display: none;"
                                @endif>
                            <label class="control-label col-md-2" for="parent_theme_id">Select Parent Theme<span
                                        class="text-sub"></span></label>
                            <div class="col-md-4">
                                <select class="form-control" id="parent_theme_id" name="parent_theme_id">
                                    <option value="0">--- Select ---</option>
                                    @foreach($parent_theme_details as $theme)
                                        @if($theme_details -> parent_theme != '0' && $theme_details-> parent_theme == $theme->theme_id)
                                            <option value="{{$theme->theme_id}}"
                                                    selected> {{$theme->theme_name}}</option>
                                        @else
                                            <option value="{{$theme->theme_id}}"> {{$theme->theme_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="theme_banner_title">Banner Title</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder=""
                                       name="theme_banner_title" id="theme_banner_title"
                                       value="{!! $theme_details->theme_banner_title !!}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="file">Banner Image<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input type="hidden" name="file_old"
                                       value="<?php echo $theme_details->theme_banner_img; ?>"/>
                                <input type="file" id="file" name="file" placeholder="Theme Bannner Image">
                                <br>
                                <img src="<?php echo url('public/assets/images/themes') . "/" . $theme_details->theme_banner_img; ?>"
                                     height="45px">
                                Image upload size 1224 X 500
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="file2">
                                Gallery Image<span class="text-sub">*</span>
                            </label>

                            <div class="col-md-4">
                                <input type="hidden" name="file2_old"
                                       value="<?php echo $theme_details->theme_gallery_img; ?>"/>

                                <input type="file" id="file2" name="file2" placeholder="Theme Gallery Image">
                                <br>
                                <?php if($theme_details->theme_gallery_img) {?>
                                <img src="<?php echo url('public/assets/images/finalgalleryimage') . "/" . $theme_details->theme_gallery_img; ?>"
                                     height="45px">
                                <?php } ?>
                                Image upload size 400 X 300
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2" for="theme_heading">Heading<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder=""
                                       id="theme_heading" name="theme_heading" required
                                       value="{!! $theme_details->theme_heading !!}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="theme_description">Theme description
                                <span class="text-sub">*</span></label>

                            <div class="col-md-8">
                                         <textarea id="theme_description" class="form-control" rows="10"
                                                   name="theme_description">{!! $theme_details->theme_description !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="theme_side">Theme Side</label>

                            <div class="col-md-8">
                                                <textarea id="theme_side" name="theme_side" row="5"
                                                          class="form-control">{!! $theme_details->theme_side !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Choose Resources</label>
                            <div class="col-md-8">


                                <div class="col-xs-12 form-group">
                                    <input type="text"
                                           onchange="insert_found_products_by_name(this.value)"
                                           class="form-control" Placeholder="Input Product Name to Include">
                                </div>

                                <div class="col-xs-5">
                                    <select name="from[]" id="js_multiselect_from_1"
                                            class="js-multiselect1 form-control" size="8"
                                            multiple="multiple">
                                        @if(count($not_used_product)>0)
                                            @foreach($not_used_product as $product)
                                                <option value="{{$product[0]}}"> {{$product[1]}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-xs-2">
                                    <button type="button" id="js_right_All_1" class="btn btn-block">
                                        <i class="glyphicon glyphicon-forward"></i>
                                    </button>
                                    <button type="button" id="js_right_Selected_1"
                                            class="btn btn-block">
                                        <i class="glyphicon glyphicon-chevron-right"></i>
                                    </button>
                                    <button type="button" id="js_left_Selected_1" class="btn btn-block">
                                        <i class="glyphicon glyphicon-chevron-left"></i>
                                    </button>
                                    <button type="button" id="js_left_All_1" class="btn btn-block">
                                        <i class="glyphicon glyphicon-backward"></i>
                                    </button>
                                </div>

                                <div class="col-xs-5">
                                    <select name="select_product[]" id="js_multiselect_to_1"
                                            class="form-control js-mutliselect2"
                                            size="8" multiple="multiple">
                                        @if(count($used_product)>0)
                                            @foreach($used_product as $product)
                                                <option value="{{$product[0]}}"> {{$product[1]}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="pass1"><span
                                        class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button type="submit" id="submit" class="btn btn-warning btn-sm btn-grad">
                                    <a style="color:#fff">Submit</a>
                                </button>
                                <button class="btn btn-default btn-sm btn-grad" type="reset">
                                    <a style="color:#000" href="#">Reset</a>
                                </button>
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
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>

    <script src="<?php echo url('')?>/public/plugins/multiselect/multiselect.min.js"></script>

    <script>
        function insert_found_products_by_name(name) {
            $.ajax({
                type: 'get',
                data: 'product_name=' + name,
                url: '<?php echo url("instant_search_by_name"); ?>',
                success: function (data) {
                    console.log(data);
                    $('#js_multiselect_from_1').html(data);
                }
            });
        }

        $(document).ready(function () {

            $('.js-multiselect1').multiselect({
                left: "#js_multiselect_from_1",
                right: '#js_multiselect_to_1',
                rightAll: '#js_right_All_1',
                rightSelected: '#js_right_Selected_1',
                leftSelected: '#js_left_Selected_1',
                leftAll: '#js_left_All_1'
            });

            $('#theme_description').wysihtml5();

            var wysihtml5 = $('#theme_description');

            $('#submit').click(function () {
                //name
                if ($('#theme_name').val() == "") {
                    $('#theme_name').css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Theme Name');
                    return false;
                } else {
                    $('#theme_name').css('border', '');
                    $('#error_msg').html('');
                }

                //heading
                if ($('#theme_heading').val() == "") {
                    $('#theme_heading').css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Heading');
                    return false;
                } else {
                    $('#theme_heading').css('border', '');
                    $('#error_msg').html('');
                }

                //description
                if ($.trim(wysihtml5.val()) == '') {
                    wysihtml5.css('border', '1px solid red');
                    $('#error_msg').html('Please Enter Description');
                    wysihtml5.focus();
                    return false;
                }
                else {
                    wysihtml5.css('border', '');
                    $('#error_msg').html('');
                }

            });
        });

    </script>
@endsection
