@extends('siteadmin.layout.admin_master')
@section('title', 'Add Estimated ZipCode')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Zip Code Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Zip Code Settings</h5>
                </header>

                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'add_estimated_zipcode_submit','class'=>'form-horizontal')) !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Zip Code
                            </div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <label class="control-label col-md-3" for="text1">Enter Starting Zipcode<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="text1"
                                               name="zip_code"
                                               value="{!! Input::old('zip_code') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <label class="control-label col-md-3" for="text1">Enter Ending Zipcode<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="text1"
                                               name="zip_code2"
                                               value="{!! Input::old('zip_code2') !!}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <label class="control-label col-md-3" for="text1">Delivery Days<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="text1"
                                               name="delivery_days" value="{!! Input::old('delivery_days') !!}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="pass1"><span class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button class="btn btn-success btn-sm btn-grad"><a style="color:#fff">Add Zipcode</a>
                                </button>

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
        function select_cur_val(id) {

            var passData = 'id=' + id;

            $.ajax({
                type: 'get',
                data: passData,
                url: '<?php echo url('select_currency_value_ajax'); ?>',
                success: function (responseText) {
                    if (responseText) {
                        //alert(responseText);
                        $('#whole_currency_div').html(responseText);
                    }
                }
            });
        }
    </script>
@endsection


