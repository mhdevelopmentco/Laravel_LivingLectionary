@extends('sitemerchant.layout.merchant_master')
@section('title', 'Withdraw Request')
@section('css')
    <style>
        #partial_pay {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a href="<?php echo url('sitemerchant_dashboard'); ?>">Home</a></li>
                <li class="active"><a href="#">Withdraw Request</a></li>
            </ul>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Withdraw Request</h5>
                </header>
                @if ($errors->any())
                    <br>
                    <div class="alert alert-danger alert-dismissable">
                        {!! implode('', $errors->all(':message')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="error_msg" style="color:red;" class="col-md-12"></div>
                <div class="row-fluid" style="padding-bottom: 50px;">
                    <div class="col-md-12 panel_marg">
                        <label class="control-label col-md-3">
                            Available Amount :$ {{$available}}
                        </label>
                    </div>

                    @if($available == 0)
                        <div class="col-md-12 panel_marg">
                            <p class="col-md-6">No Amount to withdraw</p>
                        </div>
                    @else
                        {!! Form::open(array('url'=>'merchant_withdraw_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                        <input type="hidden" name="available" id="available" value="{{$available}}">
                        <input type="hidden" name="least" id="least" value="{{$least}}">
                        <input type="hidden" name="merchant_id" id="merchant_id" value="{{$merchant_id}}">
                        <input type="hidden" name="pay_kind" id="pay_kind" value="1">

                        <div class="col-md-12 panel_marg">
                            <div class="form-group">
                                <label for="pay_amt" class="control-label col-md-3">
                                    Amount to withdraw
                                </label>
                                <div class="col-md-9">
                                    <label>
                                        <input class="radio_pay_kind" type="radio" name="get_paid_kind" checked
                                               value="1"/>Get Fully Paid
                                    </label>
                                    <br>
                                    <label>
                                        <input class="radio_pay_kind" type="radio" name="get_paid_kind" value="2">
                                        Get Partially Paid
                                    </label>
                                    <div class="form-group" id="partial_pay">
                                        <label for="pay_amt" class="control-label col-md-3">
                                            Amount to withdraw
                                        </label>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control"
                                                   placeholder="Input partial amount to withdraw" id="pay_amt"
                                                   name="pay_amt" value="{{$available}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 panel_marg">

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    @if($available > $least)
                                        <button class="btn btn-warning btn-sm btn-grad" type="submit"
                                                id="withdraw_request_bt"
                                                style="color:#fff">Submit
                                        </button>
                                        <button class="btn btn-sm btn-primary" type="reset">Reset</button>
                                    @else
                                        <button class="btn btn-sm btn-danger" type="submit"
                                                id="withdraw_request_bt" disabled style="color:#fff">Submit
                                        </button>
                                        <button class="btn btn-sm btn-primary" type="reset">Reset</button>
                                        <p style="margin-top: 20px;">*The amount is less than Minimum Withdraw Amount,
                                            To update the settings, click <a
                                                    href="{{url('merchant_settings')}}">here</a></p>
                                    @endif
                                </div>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#withdraw_request_bt').click(function (e) {

                    var err_msg = $('#error_msg');
                    //avail+rest > least
                    var avail = parseFloat($('#available').val());
                    var least = parseFloat($('#least').val());
                    var request = parseFloat($('#pay_amt').val());
                    var pay_kind = $('#pay_kind').val();

                    if (avail == 0) {
                        return false;
                    }

                    if (avail < least) {
                        $(err_msg).html('The amount is less than Minimum Withdraw Amount');
                        return false;
                    }

                    if (pay_kind == 2 && request == 0) {
                        return false;
                    }

                    if (pay_kind == 2 && avail < request) {
                        $('#pay_amt').css('border', '1px solid red');
                        $(err_msg).html('Please Enter Valid Amount');
                        return false;
                    }

                    $('#pay_amt').css('border', '');
                    $(err_msg).html('');
                }
        );

        $('.radio_pay_kind').change(function () {
            var kind = $(this).val();
            if (kind == 2) {
                //partail pay
                $('#partial_pay').show();
                $('#pay_kind').val(2);
            } else {
                $('#partial_pay').hide();
                $('#pay_kind').val(1);
            }
        });
    </script>
@endsection





