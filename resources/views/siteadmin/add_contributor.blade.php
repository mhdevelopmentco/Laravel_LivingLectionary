@extends('siteadmin.layout.admin_master')
@section('title', 'Add Contributor Account')
@section('css')

    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">

    <style>

        ul.wysihtml5-toolbar > li {
            position: relative;
        }

        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: 'Roboto';
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 250px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: 'Roboto';
        }

    </style>
    <link rel="stylesheet" href="<?php echo url(); ?>/public/plugins/cropimage/css/jquery.Jcrop.min.css"/>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Contributor Account</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Contributor Account</h5>

                </header>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif

                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'add_contributor_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Contributor Account
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">First Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="first_name" required
                                               name="first_name" value="{!! Input::old('first_name') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Last Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="last_name" required
                                               name="last_name" value="{!! Input::old('last_name') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">E-mail<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="email_id" required
                                               name="email" value="{!! Input::old('email') !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">UserID<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder=""
                                               name="userid"
                                               value="{!! Input::old('userid') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Password">Password<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder=""
                                               name="password" id="password"
                                               value="{!! Input::old('password') !!}"/>
                                    </div>
                                </div>
                            </div>


                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Phone<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" required
                                               id="phone_no" name="phone_no"
                                               pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                               value="{!! Input::old('phone_no') !!}"
                                               title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Select Country<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <select class="form-control" name="select_mer_country"
                                                id="select_mer_country" required
                                                value="{!! Input::old('select_mer_country') !!}"
                                                onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_mer_state')">
                                            <option value="">--select--</option>
                                            <?php foreach($country_details as $country_result){ ?>
                                            <option value="<?php echo $country_result->co_id; ?>"
                                                    <?php if($country_result->co_default == '1'){?> selected <?php } ?>><?php echo $country_result->co_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Select State<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <select class="validate[required] form-control"
                                                id="select_mer_state"
                                                onchange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'select_mer_city')"
                                                name="select_mer_state" required>
                                            <option value="">--select--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Input City<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input class="form-control typeahead" required id="select_mer_city"
                                               name="select_mer_city" value="{!! Input::old('select_mer_city') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="address_one">Address1<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" required
                                               id="address_one"
                                               name="address_one" value="{!! Input::old('address_one') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address2</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="address_two"
                                               name="address_two" value="{!! Input::old('address_two') !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Zip Code<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="mem_zipcode" required
                                               name="mem_zipcode" value="{!! Input::old('mem_zipcode') !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Payment Account<span
                                                class="text-sub"></span></label>

                                    <div class="col-md-10">
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder=""
                                                   name="payment_account" value="1"
                                                   style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Paypal
                                        </label>
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder="" value="2"
                                                   name="payment_account"
                                                   style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Stripe
                                        </label>
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder=""
                                                   name="payment_account" value="3" checked
                                                   style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Later Setup
                                        </label>
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder=""
                                                   name="payment_account" value="4" checked
                                                   style="width: auto; display:inline-block; margin-right: 10px;"/> Not
                                            Charged
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Store Details
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Display Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_name" required
                                               name="store_name" value="{!! Input::old('store_name') !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_org">Organization</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_org"
                                               name="store_org" value="{!! Input::old('store_org') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_title">Title</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_title"
                                               name="store_title" value="{!! Input::old('store_title') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_web">Website Address</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_web"
                                               name="store_web" value="{!! Input::old('store_web') !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Select Country<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <select class="form-control" name="select_country" id="select_country" required
                                                onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_state')">
                                            <option value="">--select--</option>
                                            <?php foreach($country_details as $country_fetch){ ?>
                                            <option value="<?php echo $country_fetch->co_id; ?>"
                                                    <?php if($country_fetch->co_default == '1'){?> selected <?php } ?>><?php echo $country_fetch->co_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Select State<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <select class="validate[required] form-control"
                                                id="select_state"
                                                onchange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'select_city')"
                                                name="select_state" required>
                                            <option value="">--select--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Input Store City<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input class="form-control typeahead" id="select_city"
                                               name="select_city" required
                                               value="{!! Input::old('select_city') !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address1<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder=""
                                               id="store_add_one" name="store_add_one" required
                                               value="{!! Input::old('store_add_one') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address2</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder=""
                                               id="store_add_two" name="store_add_two"
                                               value="{!! Input::old('store_add_two') !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Zipcode<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="zip_code"
                                               name="zip_code" required
                                               pattern="\d{5}([\-]\d{4})?"
                                               title="xxxxx or xxxxx-xxxx"
                                               value="{!! Input::old('zip_code') !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_phone">Phone <span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_phone"
                                               name="store_phone" required
                                               pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                               value="{!! Input::old('store_phone') !!}"
                                               title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Meta keywords</label>

                                    <div class="col-md-10">
                                                <textarea class="form-control" name="meta_keyword"
                                                          id="meta_keyword">{!! Input::old('meta_keyword') !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_desc">Organization
                                        description</label>

                                    <div class="col-md-10">
                                                <textarea id="stor_desc" name="store_desc" rows="10"
                                                          class="form-control">{!! Input::old('store_desc') !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <label style="color:#999">Would you like to display this store's address on a
                                            map? If so, please choose
                                            your location in the map below
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="store_show_map"
                                                   value="1" checked
                                                   title="For Profit"/>Yes
                                        </label>
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="store_show_map"
                                                   value="0"
                                                   title="Non Profit"/>No
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Map Search Location<br><span
                                                style="color:#999">(Drag Marker to get latitude & longitude )</span></label>

                                    <div class="col-md-10">
                                        <input id="pac-input" class="controls" type="text"
                                               placeholder="Enter a location">
                                        <div id="map" style="width:100%; min-height:300px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Latitude</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="latitude"
                                               name="latitude" readonly value="{!! Input::old('latitude') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Longitude</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="longtitude"
                                               name="longtitude" value="{!! Input::old('longtitude') !!}"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_commission">Store
                                        Commission</label>

                                    <div class="col-md-10 input-group">
                                        <input type="text" class="form-control" placeholder="" id="store_commission"
                                               name="store_commission" pattern="[0-9]+(\\.[0-9]+)?"
                                               value="{!! Input::old('store_commission') !!}">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Stores Image<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="file" id="file" name="file" alt="Store Image">Image
                                        upload size 515 X 386
                                    </div>
                                </div>
                            </div>

                            <?= Form::hidden('x', '', array('id' => 'x')) ?>
                            <?= Form::hidden('y', '', array('id' => 'y')) ?>
                            <?= Form::hidden('w', '', array('id' => 'w')) ?>
                            <?= Form::hidden('h', '', array('id' => 'h')) ?>

                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" for="pass1"><span
                                        class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button class="btn btn-warning btn-sm btn-grad" type="submit" id="submit"><a
                                            style="color:#fff">Submit</a></button>
                                <button class="btn btn-default btn-sm btn-grad" type="reset"><a
                                            style="color:#000">Reset</a></button>

                            </div>

                        </div>

                        {!! Form::close() !!}
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
@endsection

@section('script')
    <script src="<?php echo url('')?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>


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
                                setSelect: [515, 386, 0, 0],
                                boxWidth: limit_width,
                                boxHeight: limit_height,
                                allowSelect: true,
                                allowMove: true,
                                allowResize: true
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
                alert('Please Choose Valid Image for Store');
                input.value = "";
            }
        }


        $(document).ready(function () {

            //init country and state
            if ($('#select_mer_country').val() != 0)
                $('#select_mer_country').trigger('change');

            if ($('#select_country').val() != 0)
                $('#select_country').trigger('change');

            $('#stor_desc').wysihtml5();

            $('#submit').click(function () {
                var file = $('#file');
                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                if (file.val() == "") {
                    file.focus();
                    file.css('border', '1px solid red');
                    return false;
                }
                else if ($.inArray($('#file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    file.focus();
                    file.css('border', '1px solid red');
                    return false;
                }
                else {
                    file.css('border', '');
                }
            });

            $("#file").change(function () {
                readURL(this);
            });
        });
    </script>

    <script type="text/javascript">

        var map;
        function initMap() {
            var myLatlng = new google.maps.LatLng(40.707393, -73.818745);
            var mapOptions = {
                zoom: 10,
                center: myLatlng,
                disableDefaultUI: true,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                streetViewControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP

            };

            map = new google.maps.Map(document.getElementById('map'),
                    mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                visible: true,
                draggable: true,
                animation: google.maps.Animation.BOUNCE
            });

            //set_lang_long(marker.getPosition());

            function init_lang_long() {
                $('#pac-input').val('');
                $('#latitude').val('');
                $('#longtitude').val('');
            }

            function set_lang_long(location) {
                var lat = location.lat();
                var lng = location.lng();
                $('#latitude').val(lat);
                $('#longtitude').val(lng);
            }

            function placeMarker(map, location) {

                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });

                set_lang_long(marker.getPosition());
            }

            //event click and drag end
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(map, event.latLng);
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {
                set_lang_long(marker.getPosition());
            });


            var input = (document.getElementById('pac-input'));
            var types = document.getElementById('type-selector');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {

                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    init_lang_long();
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);

                    var myLatlng = place.geometry.location;
                    placeMarker(map, myLatlng);

                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
            });
        }
    </script>

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtA9j3NF1CKkSiHi9tVeECFLdlgwT3gGE&libraries=places&callback=initMap"></script>
@endsection