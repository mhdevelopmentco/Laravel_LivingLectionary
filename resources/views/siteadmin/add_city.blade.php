@extends('siteadmin.layout.admin_master')
@section('title', 'Add City')
@section('css')
    <style type="text/css">

        #container {

            left: -100000px;

            position: relative !important;

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

    </style>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add City</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add City</h5>

                </header>

                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('error') !!}</div>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'add_city_submit','class'=>'form-horizontal')) !!}

                        <div class="form-group">
                            <label class="control-label col-md-2" for="country_name">Country<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <select class="validate[required] form-control" id="country_name"
                                        name="country_name" required
                                        onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'state_name')">

                                    <option value="">--select country--</option>
                                    @foreach($country_details as $country_det)
                                        @if($country_det->co_id == 1)
                                            <option value="{!! $country_det->co_id!!}"
                                                    selected>{!! $country_det->co_name!!}</option>
                                        @else
                                            <option value="{!! $country_det->co_id!!}">{!! $country_det->co_name!!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="state_name">State<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <select class="validate[required] form-control" id="state_name"
                                        name="state_name" required
                                        onchange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'city_name')">
                                    <option value="">--select state--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="city_name">City Name <span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="" required
                                       value="{!!Input::old('city_name')!!}" name="city_name"
                                       id="city_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="pac-input">Map Search Location<span
                                        class="text-sub">*</span><br><span style="color:#999">(Drag Marker to get latitude & longitude )</span></label>

                            <div class="col-md-4">
                                <input id="pac-input" class="controls" type="text"
                                       placeholder="Enter a location">
                                <div id="map" style="width:100%; min-height:300px;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="city_lat">City Latitude <span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input type="text" class="form-control"
                                       placeholder="" required
                                       value="{!!Input::old('city_lat')!!}"
                                       name="city_lat" id="city_lat"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="city_lng">City Longitude <span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="" required
                                       value="{!!Input::old('city_lng')!!}" name="city_lng"
                                       id="city_lng"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="pass1"><span
                                        class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                        style="color:#fff">Add
                                </button>
                                <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                    Cancel
                                </button>

                            </div>
                            <div id="container" class="col-md-12">
                                <input id="pac-input" class="controls" type="text"
                                       placeholder="Enter a location">
                                <div id="map" style="width:100%; min-height:300px;"></div>
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
    <script type="text/javascript"
            src="<?php echo url('');?>/public/assets/js/jquery.mousewheel-3.0.4.pack.js"></script>
    <script>
        /*prevent default event for enter click*/
        $(document).keydown(function (e) {
            var key = e.keyCode;
            if (key == 13) {
                e.preventDefault();
            }
        });

        $(document).ready(function () {
            //init country and state
            if ($('#country_name').val() != 0)
                $('#country_name').trigger('change');
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

            set_lang_long(marker.getPosition());

            function init_lang_long() {
                $('#pac-input').val('');
                $('#city_lat').val('');
                $('#city_lng').val('');
            }

            function set_lang_long(location) {
                var lat = location.lat();
                var lng = location.lng();
                $('#city_lat').val(lat);
                $('#city_lng').val(lng);
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