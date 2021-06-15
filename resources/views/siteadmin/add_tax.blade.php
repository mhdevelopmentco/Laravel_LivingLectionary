@extends('siteadmin.layout.admin_master')
@section('title', 'Add Tax')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Tax</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Tax</h5>
                </header>

                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('error') !!}</div>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'add_tax_submit','class'=>'form-horizontal')) !!}

                        <div class="form-group">
                            <label class="control-label col-md-2" for="country_name">Country<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <select class="validate[required] form-control" id="country_name"
                                        name="country_id" required
                                        onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'state_name')">

                                    <option value="">--select country--</option>
                                    @foreach($country_details as $country_det)
                                        @if($country_det->co_default == 1)
                                            <option value="{!! $country_det->co_id!!}"
                                                    selected>{!! $country_det->co_name!!}</option>
                                        @else
                                            <option value="{!! $country_det->co_id!!}">{!! $country_det->co_name!!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="state_name">State<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <select class="validate[required] form-control" id="state_name"
                                        name="state_id" required>
                                    <option value="">--select state--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="city_name">Tax Amount<span
                                        class="text-sub">*</span></label>

                            <div class="input-group col-md-4">
                                <span class="input-group-addon" id="basic-addon1">%</span>
                                <input type="text" class="form-control" placeholder="" required aria-describedby="basic-addon1"
                                       value="{!!Input::old('tax_amount')!!}" name="tax_amount"
                                       id="tax_amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="pass1"><span
                                        class="text-sub"></span></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                        style="color:#fff">Add
                                </button>
                                <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                    Cancel
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
        $('#country_name').trigger('change');
    </script>
@endsection