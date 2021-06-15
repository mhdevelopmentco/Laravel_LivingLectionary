@extends('siteadmin.layout.admin_master')
@section('title', 'Email Contact Settings')
@section('css')
    <style type="text/css">
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
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Email Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Email Settings</h5>
                </header>
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif

                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'email_setting_submit','class'=>'form-horizontal')) !!}
                    @foreach($email_settings as $email_set)
                        <div class="form-group">
                            <label for="contact_name" class="control-label col-md-2">Contact Name<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder=""
                                       value="{!! $email_set->es_contactname!!}" name="Contact_Name"
                                       id="contact_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_email" class="control-label col-md-2">Contact E-Mail<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder=""
                                       value="{!! $email_set->es_contactemail!!}" name="Contact_Email"
                                       id="contact_email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2" for="webmaster_email">Webmaster E-Mail<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder=""
                                       value="{!! $email_set->es_webmasteremail!!}" name="Webmaster_Email"
                                       id="webmaster_email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2" for="no_reply_email">Site no-reply E-Mail</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder=""
                                       value="{!! $email_set->es_noreplyemail!!}" name="No_Reply_Email"
                                       id="no_reply_email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_pno" class="control-label col-md-2">Contact Phone 1</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder=""
                                       pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                       value="{!! $email_set->es_phone1!!}" name="Contact_Phone1" id="contact_pno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact_pno2" class="control-label col-md-2">Contact Phone 2</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder=""
                                       pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                       value="{!! $email_set->es_phone2!!}" name="Contact_Phone2"
                                       id="contact_pno2">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="text1">Map Search Location<br><span
                                        style="color:#999">(Drag Marker to get latitude & longitude )</span></label>

                            <div class="col-md-4">
                                <input id="pac-input" class="controls" type="text"
                                       placeholder="Enter a location">
                                <div id="map" style="width:100%; min-height:300px;"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lati" class="control-label col-md-2">Latitude</label>

                            <div class="col-md-8">
                                <a id="inline" href="#map_canvas">
                                    <input type="text" class="form-control" placeholder=""
                                           value="{!! $email_set->es_latitude!!}" name="lati" id="latitude"></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="long" class="control-label col-md-2">Longitude</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="" name="long"
                                       value="{!! $email_set->es_longitude!!}" id="longtitude">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8  col-md-offset-2">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                        style="color:#fff">Update
                                </button>

                                <button class="btn btn-default btn-sm btn-grad" type="reset"><a
                                            style="color:#000">Reset</a></button>
                            </div>
                        </div>
                </div>
                @endforeach
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        var map;

        var lati = "{{$email_set->es_latitude }}";
        var long = "{{$email_set->es_longitude}}";

        function initMap() {

            var myLatlng = new google.maps.LatLng(lati, long);

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
