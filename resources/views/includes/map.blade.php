<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB43AT_wikI5KDzqdfEJpwYgBn0hp8O5bY&libraries=places"></script>
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
            visible: true,
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


<div id="map_canvas" style="width:300px;height:250px;"></div>