@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Store')
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
                <li class="active"><a>Edit Store Account</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Store Account</h5>

                </header>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                        </div>
                    </ul>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'edit_store_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                        <?php foreach ($store_return as $store_details) {
                        }  ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Store Details
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Store Owner</label>
                                    <div class="col-md-10">
                                        <label class="control-label">{!! $merchant_name !!}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Display Name<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-10">

                                        <input type="hidden" name="mem_id" value="<?php echo $mem_id; ?>" ?>
                                        <input type="hidden" name="store_id" value="<?php echo $id; ?>" ?>
                                        <input type="text" class="form-control" placeholder="" id="store_name"
                                               name="store_name" value="{!! $store_details->stor_name !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_org">Organization</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_org"
                                               name="store_org" value="{!! $store_details->stor_org !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_title">Title</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_title"
                                               name="store_title" value="{!! $store_details->stor_title !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_web">Website Address</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_web"
                                               name="store_web" value="{!! $store_details->stor_website !!}">
                                    </div>
                                </div>
                            </div>


                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Country<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <select class="form-control" name="select_country" id="select_country" required
                                                onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_state', '{{$store_details->stor_state}}')">
                                            <option value="">-- Select Country--</option>
                                            @foreach($country_details as $country_det)
                                                <option value="{!! $country_det->co_id!!}"
                                                        <?php if($country_det->co_id == $store_details->stor_country){?> selected <?php } ?>>{!! $country_det->co_name!!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">State<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <select class="validate[required] form-control" id="select_state"
                                                name="select_state" required
                                                onchange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'select_city', '{{$store_details->stor_city}}')">
                                            <option value="">--select--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">City<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input class="form-control" name="select_city" id="select_city" required/>
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
                                               value="{!! $store_details->stor_address1 !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address2</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder=""
                                               id="store_add_two" name="store_add_two"
                                               value="{!! $store_details->stor_address2 !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="zip_code">Zipcode<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="zip_code"
                                               pattern="\d{5}([\-]\d{4})?" required
                                               title="xxxxx or xxxxx-xxxx"
                                               name="zip_code" value="{!! $store_details->stor_zipcode !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_phone">Phone <span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="store_phone"
                                               pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                               required
                                               name="store_phone" value="{!! $store_details->stor_phone !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Meta keywords</label>

                                    <div class="col-md-10">
                                                <textarea class="form-control" name="meta_keyword"
                                                          id="meta_keyword">{!! $store_details->stor_metakeywords !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="store_orgdesc">Organization
                                        description</label>

                                    <div class="col-md-10">
                                        <textarea id="wysihtml5" name="store_orgdesc" rows="10"
                                              class="form-control">{!! $store_details->stor_orgdesc !!}</textarea>
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
                                    <div class="col-md-10">
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="store_show_map"
                                                   value="1" <?php if($store_details->stor_show_map == 1) {?> checked <?php } ?>
                                                   title="For Profit"/>Yes
                                        </label>
                                        <label style="display: inline-block;">
                                            <input type="radio" style="margin-left:10px;" name="store_show_map"
                                                   value="0"  <?php if($store_details->stor_show_map == 0) {?> checked <?php } ?>
                                                   title="Non Profit"/>No
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Map Search Location<br><span style="color:#999">(Drag Marker to get latitude & longitude )</span></label>

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
                                               name="latitude" readonly
                                               value="<?php if ($store_details->stor_latitude != '0') echo $store_details->stor_latitude; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Longitude</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="" id="longtitude"
                                               name="longtitude"
                                               value="<?php if ($store_details->stor_longitude != '0') echo $store_details->stor_longitude; ?>"
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
                                               value="{!! $store_details->stor_commission !!}">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Store Image<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-10">
                                        <input type="file" id="file" name="file" placeholder="Fruit ball">
                                        <input type="hidden" name="file_new"
                                               value="<?php echo $store_details->stor_img; ?>"/>
                                        <img src="<?php echo url('public/assets/images/storeimage') . "/" . $store_details->stor_img; ?>"
                                             height="45px">
                                        Image upload size 515 X 386
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

                            <div class="col-md-10">
                                <button class="btn btn-warning btn-sm btn-grad" type="submit" id="submit"><a
                                            style="color:#fff">Submit</a></button>
                                <a href="<?php echo url('manage_store' . '/' . $store_details->stor_merchant_id);?>"
                                   class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</a>

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
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack-back.js"></script>
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
                                allowResize: true,
                                aspectRatio: 515/386,
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
            if ($('#select_country').val() != 0)
                $('#select_country').trigger('change');

            $("#file").change(function () {
                readURL(this);
            });

            $('#wysihtml5').wysihtml5();
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

