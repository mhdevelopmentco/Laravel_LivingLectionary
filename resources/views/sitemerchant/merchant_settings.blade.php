@extends('sitemerchant.layout.merchant_master')
@section('title', 'Merchant Setting')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb" style="color:#C00;">
                <li class=""><a href="<?php echo url('sitemerchant_dashboard'); ?>">Home</a></li>
                <li class="active"><a href="#">Merchant Setting</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Merchant Setting</h5>
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
                <div class="col-md-12 panel-body">
                    {!! Form::open(array('url'=>'update_merchant_settings','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    <div class="form-group row-fluid">
                        <label class="col-md-3" for="mer_paypal_email">Paypal Email</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" value="{{$mer_paypal_email}}" id="mer_paypal_email"
                                   name="Paypal_Email">
                        </div>
                    </div>
                    <div class="form-group row-fluid">
                        <label class="col-md-3" for="mer_paypal_email">Minimum Amount to get paid</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" value="{{$minimum}}" id="mer_minimum_amount"
                                   name="Minimum_Amount" min="20">
                        </div>
                    </div>
                    <div class="form-group row-fluid">
                        <div class="col-md-4 col-md-offset-3">
                            <button class="btn btn-warning btn-sm btn-grad" style="color:#fff" type="submit">Update
                            </button>
                            <button class="btn btn-default btn-sm btn-grad" style="color:#000" type="reset">Cancel
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
@endsection

