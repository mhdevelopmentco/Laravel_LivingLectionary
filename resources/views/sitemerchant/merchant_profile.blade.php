@extends('sitemerchant.layout.merchant_master')
@section('title', 'Merchant Profile')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb" style="color:#C00;">
                <li class=""><a href="<?php echo url('sitemerchant_dashboard'); ?>">Home</a></li>
                <li class="active"><a href="#">Merchant Profile</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Merchant Profile</h5>
                </header>
                <div class="form-group panel-body" style="margin-bottom: 0">
                    <?php $merchant_id = Session::get('merchantid');?>

                    <?php if (Session::has('merchantid')) {?>
                    <a href="<?php echo url('edit_contributor_profile'); ?>" style="color:#C00;">Edit
                        Information |</a>
                    <?php } else { ?>
                    <a href="<?php echo url('sitemerchant'); ?>" style="color:#C00;">Edit Information |</a>
                    <?php } ?>

                    <?php if (Session::has('merchantid')) {?>
                    <a href="<?php echo url('change_merchant_password'); ?>" style="color:#C00;">Change
                        Password</a>
                    <?php } else { ?>
                    <a href="<?php echo url('sitemerchant'); ?>">Change Password</a>
                    <?php } ?>

                </div>
                <div class="row">
                    <div class="col-md-12 panel_marg" style="padding-bottom:10px;">
                        <?php foreach ($merchant_details as $fetch_mer_details) {
                        } ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Merchant Account
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">First Name</label>
                                    <div class="col-md-4">
                                        <input type="hidden" name="mem_id"
                                               value="{!! $fetch_mer_details->mem_id !!}">
                                        <input type="text" class="form-control" placeholder="" id="first_name" readonly
                                               name="first_name" value="{!! $fetch_mer_details->mem_fname !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Last Name</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="last_name" readonly
                                               name="last_name" value="{!! $fetch_mer_details->mem_lname !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">E-mail</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="email_id" readonly
                                               name="email_id" value="{!! $fetch_mer_details->mem_email !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="userid">UserID</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="userid" readonly
                                               value="{!! $fetch_mer_details->mem_userid !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Phone<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="phone_no"
                                               readonly name="phone_no" value="{!! $fetch_mer_details->mem_phone !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_mer_country">Country</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="select_mer_country" readonly
                                               id="select_mer_country" value="{!! $fetch_mer_details->co_name !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_mer_state">State</label>
                                    <div class="col-md-4">
                                        <input class="form-control" id="select_mer_state" name="select_mer_state"
                                               readonly
                                               value=" {!! $fetch_mer_details->st_name !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_mer_city">Input City</label>
                                    <div class="col-md-4">
                                        <input class="form-control typeahead" id="select_mer_city" readonly
                                               name="select_mer_city" value="{!! $fetch_mer_details->ci_name !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="address_one">Address1</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="address_one"
                                               name="address_one" readonly
                                               value="{!! $fetch_mer_details->mem_address1 !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address2</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="address_two"
                                               name="address_two" readonly
                                               value="{!! $fetch_mer_details->mem_address2 !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Zip Code</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="mem_zipcode"
                                               readonly name="mem_zipcode"
                                               value="{!! $fetch_mer_details->mem_zipcode !!}">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body hidden">
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
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

