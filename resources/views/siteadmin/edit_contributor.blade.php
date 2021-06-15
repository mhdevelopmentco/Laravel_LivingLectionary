@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Contributor Account')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Edit Contributor Account</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Contributor Account</h5>
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
                        <?php foreach ($merchant_details as $fetch_mer_details) {
                        } ?>
                        {!! Form::open(array('url'=>'edit_contributor_account_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Contributor Account
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">First Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="hidden" name="mem_id"
                                               value="{!! $fetch_mer_details->mem_id !!}">
                                        <input type="text" class="form-control" placeholder="" id="first_name" required
                                               name="first_name" value="{!! $fetch_mer_details->mem_fname !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Last Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="last_name" required
                                               name="last_name" value="{!! $fetch_mer_details->mem_lname !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">E-mail<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="email_id" required
                                               name="email_id" value="{!! $fetch_mer_details->mem_email !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="userid">UserID<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="userid" required
                                               value="{!! $fetch_mer_details->mem_userid !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="userpwd">Reset Password</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="userpwd" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Phone<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="phone_no" required
                                               pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                               title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"
                                               name="phone_no" value="{!! $fetch_mer_details->mem_phone !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Select Country<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <select class="form-control" name="select_mer_country"
                                                id="select_mer_country" required
                                                value="{!! Input::old('select_mer_country') !!}"
                                                onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_mer_state', '{{$fetch_mer_details->mem_state}}')">
                                            <option value="">--select--</option>
                                            <?php foreach($country_details as $country_fetch){ ?>
                                            <option value="<?php echo $country_fetch->co_id; ?>"
                                            @if($fetch_mer_details->mem_country == $country_fetch->co_id)
                                                selected
                                            @elseif ((!$fetch_mer_details->mem_country) and $country_fetch->co_default == 1)
                                                selected
                                            @else
                                            @endif
                                            ><?php echo $country_fetch->co_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Select State<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <select class="validate[required] form-control"
                                                id="select_mer_state"
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

                                    <div class="col-md-4">
                                        <input class="form-control typeahead" required id="select_mer_city"
                                               name="select_mer_city" value="{!! $fetch_mer_details->ci_name !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="address_one">Address1<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="address_one"
                                               name="address_one" required
                                               value="{!! $fetch_mer_details->mem_address1 !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address2</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="address_two"
                                               name="address_two"
                                               value="{!! $fetch_mer_details->mem_address2 !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Zip Code</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="mem_zipcode"
                                               name="mem_zipcode" value="{!! $fetch_mer_details->mem_zipcode !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Payment Account<span
                                                class="text-sub"></span></label>

                                    <div class="col-md-4">

                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder=""
                                                   name="payment_account" value="1"
                                                   <?php if($fetch_mer_details->mem_payment == 1) { ?> checked
                                                   <?php } ?> style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Paypal
                                        </label>
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder="" value="2"
                                                   name="payment_account"
                                                   <?php if($fetch_mer_details->mem_payment == 2) { ?> checked
                                                   <?php } ?> style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Stripe
                                        </label>
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder=""
                                                   name="payment_account" value="3"
                                                   <?php if($fetch_mer_details->mem_payment == 3) { ?> checked
                                                   <?php } ?> style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Later Setup
                                        </label>
                                        <label style="display:inline-block; margin-right: 10px;">
                                            <input type="radio" class="form-control" placeholder=""
                                                   name="payment_account" value="4"
                                                   <?php if($fetch_mer_details->mem_payment == 4) { ?> checked
                                                   <?php } ?> style="width: auto; display:inline-block; margin-right: 10px;"/>
                                            Not Charged
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <button class="btn btn-warning btn-sm btn-grad" type="submit" id="submit"><a
                                                style="color:#fff">Update</a></button>
                                    <a href="<?php echo url('manage_contributor'); ?>"
                                       class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</a>

                                </div>

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
    <script>
        $(document).ready(function () {

            //init country and state
            if ($('#select_mer_country').val() != 0)
                $('#select_mer_country').trigger('change');

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
@endsection
