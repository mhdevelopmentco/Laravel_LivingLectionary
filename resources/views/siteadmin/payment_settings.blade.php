@extends('siteadmin.layout.admin_master')
@section('title', 'Payment Settings')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Payment Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="box dark">
            <header>
                <div class="icons"><i class="icon-edit"></i></div>
                <h5>Payment Settings</h5>

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

            <div class="row">
                <div class="col-md-11 panel_marg" style="padding-bottom:10px;">
                    {!! Form::open(array('url'=>'payment_settings_submit','class'=>'form-horizontal')) !!}
                    <?php foreach ($get_pay_settings as $pay_details) {
                    } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Country / Currency
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="country_name">Country Name<span
                                            class="text-sub">*</span></label>

                                <div class="col-md-4">
                                    <select class="validate[required] form-control" id="country_name"
                                            name="country_name"
                                            onChange="select_cur_val(this.value)">
                                        <option value="">-- Select ---</option>
                                        <?php foreach($country_settings as $pay_country_details) { ?>
                                        <option value="<?php echo $pay_country_details->co_id; ?>"
                                                <?php if($pay_details->ps_countryid == $pay_country_details->co_id) {?> selected <?php } ?> ><?php echo $pay_country_details->co_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="whole_currency_div">
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="country_code">Country Code <span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="country_code" placeholder=""
                                               id="country_code" value="<?php echo $pay_details->ps_countrycode; ?>"
                                               readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3" for="currency_symbol">Currency
                                        Symbol <span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="currency_symbol"
                                               placeholder="Rs."
                                               id="currency_symbol"
                                               value="<?php echo $pay_details->ps_cursymbol; ?>"
                                               readonly>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3" for="currency_code">Currency Code <span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="currency_code"
                                               placeholder="INR"
                                               id="currency_code" value="<?php echo $pay_details->ps_curcode; ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Payment Account
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="text1">Paypal Account<span
                                            class="text-sub"></span></label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="paypal_account" placeholder=""
                                           value="<?php echo $pay_details->ps_paypalaccount; ?>" id="text1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="text1">Paypal API Password<span
                                            class="text-sub"></span></label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="paypal_api_password"
                                           placeholder=""
                                           value="<?php echo $pay_details->ps_paypal_api_pw; ?>" id="text1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="text1">Paypal API Signature <span
                                            class="text-sub"></span></label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="paypal_api_signature"
                                           placeholder=""
                                           value="<?php echo $pay_details->ps_paypal_api_signature; ?>" id="text1">
                                </div>
                            </div>
                        <!-- 	 <div class="panel-body">
                           <div class="form-group">
                    <label class="control-label col-md-3" for="text1">Authorize.net Transaction Key<span class="text-sub"></span></label>

                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="" name="authorizenet_trans_key" value="<?php //echo $pay_details->ps_authorize_trans_key; ?>" id="text1">
                    </div>
                </div>
             </div> -->
                        <!-- 	 <div class="panel-body">
                           <div class="form-group">
                    <label class="control-label col-md-3" for="text1">Authorizenet API ID<span class="text-sub"></span></label>

                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="" name="authorizenet_api_id" value="<?php //echo $pay_details->ps_authorize_api_id; ?>" id="text1">
                    </div>
                </div>
             </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-3" for="text1">Payment Mode<span
                                            class="text-sub">*</span></label>

                                <div class="col-md-4">

                                    <label>
                                        <input type="radio"
                                               <?php if($pay_details->ps_paypal_pay_mode == 0) { echo 'checked'; } ?>   value="0"
                                               id="optionsRadios1" name="payment_mode">
                                        Test Account
                                    </label>
                                    &emsp;
                                    <label>
                                        <input type="radio"
                                               <?php if($pay_details->ps_paypal_pay_mode == 1) { echo 'checked'; } ?> value="1"
                                               id="optionsRadios1" name="payment_mode">
                                        Live Account
                                    </label>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button class="btn btn-warning btn-sm btn-grad"><a style="color:#fff">Update</a>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function select_cur_val(id) {
            var passData = 'id=' + id;
            $.ajax({
                type: 'get',
                data: passData,
                url: '<?php echo url('select_currency_value_ajax'); ?>',
                success: function (data) {
                    if (data.result == "success") {
                        var co_code = data.co_code;
                        var cur_symbol = data.cur_symbol;
                        var cur_code = data.cur_code;

                        $('#country_code').val(co_code);
                        $('#currency_symbol').val(cur_symbol);
                        $('#currency_code').val(cur_code);

                    } else {

                    }
                }
            });
        }
    </script>
@endsection

