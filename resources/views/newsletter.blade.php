<body>
{!! $navbar !!}

<!-- Navbar ================================================== -->
{!! $header !!}
<!-- Header End====================================================================== -->
<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->

            <!-- Sidebar end=============================================== -->
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('/'); ?>">Home</a></li>
                    <li class="active">News Letter</li>
                </ul>
                <h4 style="padding:10px;background:#eee;">Subscribe Your Mail Id</h4>

                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('Error_letter'))
                    <div class="alert alert-warning alert-dismissable">{!! Session::get('Error_letter') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if (Session::has('subscribe'))
                    <div class="alert alert-warning alert-dismissable">{!! Session::get('subscribe') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <h3 style="margin-bottom:0px;  padding-left: 27px;
    padding-top: 91px;
    position: absolute;
    width: 40%;" class="subsc">Welcome to Subscribe your News Letter
                    subscription! {!! Form::open(array('url'=>'subscription_submit','class'=>'form-horizontal loginFrm')) !!}


                    <div class="row">
                        <div class="span5 subsc-textbox" style="
    top: 560px;float:right;">


                            <input type="email" id="email" name="email"
                                   placeholder="Enter Your Mail Id For Email Subscription"
                                   style="width:63%; padding:7px 7px 7px 7px; margin-left:26px;"
                                   class="form-control span5 width-textsub" value="{!! Input::old('email') !!}"
                                   required>


                            <input type="submit" id="register_submit" class="btn btn-warning" value="Subscribe" style="margin-top: 20px;
    margin-left: 123px;
    padding-top: 10px;
    padding-bottom: 26px;
    background: rgba(10, 135, 152, 0.9);
    border: none;"/>
                        </div>


                    </div>


                    </form></h3>


                <div class="content">
                    <div class="col-sm-12">
                        <img src="<?php echo url();?>/themes/images/mail.jpg" class="hide-mob subsc-img"
                             style="width:100% !important">


                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
{!! $footer !!}
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="<?php echo url('')?>/public/plugins/jquery-2.0.3.min.js"></script>
<script src="<?php //echo url();?>/themes/js/jquery.steps.js"></script>
<script src="<?php echo url(); ?>/themes/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo url(); ?>/themes/js/bootshop.js"></script>

<!--    <script src="<?php echo url(); ?>/themes/js/jquery.lightbox-0.5.js"></script>-->


<script>
    $(document).ready(function () {


        $('.close').click(function () {
            $('.alert').hide();
        });
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
    });
</script>
<script>

    function select_city_ajax(city_id) {
        var passData = 'city_id=' + city_id;
        //alert(passData);
        $.ajax({
            type: 'get',
            data: passData,
            url: '<?php echo url('ajax_select_city'); ?>',
            success: function (responseText) {
                // alert(responseText);
                if (responseText) {
                    $('#select_city').html(responseText);
                }
            }
        });
    }

    function select_mer_city_ajax(city_id) {
        var passData = 'city_id=' + city_id;
        // alert(passData);
        $.ajax({
            type: 'get',
            data: passData,
            url: '<?php echo url('ajax_select_city'); ?>',
            success: function (responseText) {
                // alert(responseText);
                if (responseText) {
                    $('#select_mer_city').html(responseText);
                }
            }
        });
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>

<script src="<?php echo url(); ?>/themes/js/simpleform.min.js"></script>
<script type="text/javascript">
    $(".testform").simpleform({
        speed: 500,
        transition: 'fade',
        progressBar: true,
        showProgressText: true,
        validate: true
    });


    function validateForm(formID, Obj) {

        switch (formID) {
            case 'testform' :
                Obj.validate({
                    rules: {
                        mem_email: {
                            required: true,
                            email: true
                        },
                        mem_name: {
                            required: true
                        },
                        mem_password: {
                            required: true
                        },
                        mem_phone: {
                            required: true
                        },
                        select_country: {
                            required: true
                        },
                        select_city: {
                            required: true
                        }


                    },
                    messages: {
                        mem_email: {
                            required: "Please enter an email address",
                            mem_email: "Not a valid email address"
                        },
                        mem_name: {
                            required: "Please enter your store name"
                        },
                        mem_password: {
                            required: "Please enter your phone no"
                        },
                        mem_phone: {
                            required: "Please enter address1 field"
                        },
                        select_country: {
                            required: "Please select country"
                        },
                        select_city: {
                            required: "Please select city"
                        }


                    }
                });
                return Obj.valid();
                break;

            case 'testform2' :
                Obj.validate({
                    rules: {
                        email_id: {
                            required: true,
                            email_id: true
                        },
                        first_name: {
                            required: true
                        },
                        select_mer_city: {
                            required: true,

                        },
                        addreess_one: {
                            required: true
                        },
                        payment_account: {
                            required: true
                        },

                        last_name: {
                            required: true
                        },
                        select_mer_country: {
                            required: true
                        },
                        phone_no: {
                            required: true
                        },
                        address_two: {
                            required: true
                        }
                    },
                    messages: {
                        email_id: {
                            required: "Please enter an email address",
                            email: "Not a valid email address"
                        },
                        first_name: {
                            required: "Please enter your first name"
                        },
                        select_mer_city: {
                            required: "Please enter city",

                        },
                        addreess_one: {
                            required: "Please enter  addreess1 field"
                        },
                        payment_account: {
                            required: "Please enter payment account"
                        },

                        last_name: {
                            required: "Please enter last name"
                        },
                        select_mer_country: {
                            required: "Please select country"
                        },
                        phone_no: {
                            required: "Please enter phone no"
                        },
                        address_two: {
                            required: "Please enter address2 field"
                        }
                    }
                });
                return Obj.valid();
                break;
        }
    }
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>


<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB43AT_wikI5KDzqdfEJpwYgBn0hp8O5bY&libraries=places"></script>
<script src="<?php echo url(); ?>/themes/js/jquery-gmaps-latlon-picker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB43AT_wikI5KDzqdfEJpwYgBn0hp8O5bY"></script>
<script type="text/javascript">
    var map;

    function initialize() {
        var myLatlng = new google.maps.LatLng(11.0195253, 76.9195069);
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

        map = new google.maps.Map(document.getElementById('map_canvas'),
                mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            visible: false,
            draggable: true,
        });
        google.maps.event.addListener(marker, 'dragend', function (e) {

            var lat = this.getPosition().lat();
            var lng = this.getPosition().lng();
            $('#latitude').val(lat);
            $('#longtitude').val(lng);
        });
        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {

            var place = autocomplete.getPlace();

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
                var myLatlng = place.geometry.location;
                //alert(place.geometry.location);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    visible: true,
                    map: map,
                    draggable: true,
                });
                google.maps.event.addListener(marker, 'dragend', function (e) {

                    var lat = this.getPosition().lat();
                    var lng = this.getPosition().lng();
                    $('#latitude').val(lat);
                    $('#longtitude').val(lng);
                });
            } else {
                map.setCenter(place.geometry.location);

                map.setZoom(17);
            }
        });


    }


    google.maps.event.addDomListener(window, 'load', initialize);
</script>


<!-- Themes switcher section ============================================================================================= -->


</body>
</html>