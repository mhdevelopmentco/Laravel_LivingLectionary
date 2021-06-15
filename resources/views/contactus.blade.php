@extends('includes/page_master')

@section('content')
    <div class="container">
        <div class="row"><br>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Contact Details</h4>
                    </div>
                    <div class="panel-body">
                        <?php foreach ($get_contact_det as $enquiry_det) {
                        }?>
                        <ul class="fo">
                            <li><?php echo $enquiry_det->es_contactemail; ?></li>
                            <li>Skype: <?php echo $enquiry_det->es_contactname; ?></li>
                            <li>Phone: <?php echo $enquiry_det->es_phone1; ?></li>
                            <li>US #: <?php echo $enquiry_det->es_phone2; ?></li>
                            <li>ll.skycrossmedia.com/</li>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Email Us</h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url'=>'contact_submit','class'=>'form-horizontal')) !!}

                        <div class="control-group">

                            <input type="text" placeholder="Enter your name" name="name" id="inquiry_name"
                                   class="input-xlarge" style="width:95%" required/>

                        </div>
                        <div class="control-group">
                            <input type="email" placeholder="Enter your Email" name="email" id="inquiry_email"
                                   style="width:95%" class="input-xlarge" required/>
                        </div>
                        <div class="control-group">

                            <input type="text" placeholder="Enter your Phone number" name="phone" id="inquiry_phone"
                                   pattern = "\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                   style="width:95%" class="input-xlarge" required/>
                        </div>
                        <div class="control-group">
                                <textarea rows="3" name="message" id="inquiry_desc" class="input-xlarge" style="width:95%"
                                          placeholder="Enter Queries" required></textarea>
                        </div>
                        <div class="control-group">
                            <input type="submit" class="btn me_btn btnb-success" value="Send Message" id="send_msg"
                                   style="background: #2F3234; border-radius: 0px;">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div id="us3" style="min-height: 500px; margin-bottom:10px;"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB43AT_wikI5KDzqdfEJpwYgBn0hp8O5bY&libraries=places"></script>
<script src="<?php echo url(); ?>/public/assets/js/locationpicker.jquery.js"></script>
<script>
    var lati = '<?php echo $enquiry_det->es_latitude; ?>';
    var long = '<?php echo $enquiry_det->es_longitude; ?>';

    $('#us3').locationpicker({
        location: {
            latitude: lati,
            longitude: long},
        radius: 200,
        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            // Uncomment line below to show alert on each Location Changed event
            //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
        }
    });
</script>
@endsection