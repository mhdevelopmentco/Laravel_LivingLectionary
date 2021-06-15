@extends('siteadmin.layout.admin_master')
@section('title', 'Add State')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit State</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit State</h5>
                </header>

                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        {!! Form::open(array('url'=>'edit_state_submit','class'=>'form-horizontal')) !!}
                        @foreach($stateresult as $stateres)

                            <div class="form-group">
                                <label class="control-label col-md-2" for="country_name">Country<span
                                            class="text-sub">*</span></label>

                                <div class="col-md-4">
                                    <select class="validate[required] form-control" id="country_name"
                                            name="country_name">
                                        <option value="0">Choose a Country</option>
                                        @foreach($country_details as $country_det)
                                            <option value="{!! $country_det->co_id!!}"
                                                    <?php if($country_det->co_id == $stateres->st_con_id){?> selected <?php } ?>>{!! $country_det->co_name!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="state_name">State Name <span
                                            class="text-sub">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder=""
                                           value="{!!$stateres->st_name!!}" name="state_name"
                                           id="state_name">
                                    <input type="hidden" class="form-control" placeholder=""
                                           value="{!!$stateres->st_id!!}" name="state_id" id="state_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="state_abbr">State Abbreviation <span
                                            class="text-sub">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder=""
                                           value="{!!$stateres->st_abbr!!}" name="state_abbr" id="state_abbr">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                            style="color:#fff">Update
                                    </button>
                                    <a href="<?php echo url('manage_state');?>"
                                       class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</a>
                                </div>
                            </div>
                        @endforeach
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection

