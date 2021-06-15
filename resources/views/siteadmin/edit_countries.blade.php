@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Country')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit Country</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Country</h5>

                </header>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>
                @endif
                @if (Session::has('message'))
                    <p style="background-color:green;color:#fff;">{!! Session::get('message') !!}</p>
                @endif
                <div id="div-1" class="accordion-body collapse in body">

                    @foreach ($countryresult as $info)
                        {!! Form::open(array('url'=>'update_country_submit','class'=>'form-horizontal')) !!}

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label for="ceditname" class="control-label col-md-2">Country Name<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input  placeholder="" id="ceditname" name="ceditname" class="form-control"
                                       type="text" value="<?php echo $info->co_name; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ceditcode" class="control-label col-md-2">Country Code<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input  placeholder="" id="ceditcode" name="ceditcode" class="form-control"
                                       type="text" value="<?php echo $info->co_code; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2"><span class="text-sub"></span></label>

                            <div class="col-md-8">
                                <p>Ex:AL,AX, etc..</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cureditsymbol" class="control-label col-md-2">Currency Symbol<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input  placeholder="" id="cureditsymbol" name="cureditsymbol"
                                       class="form-control" type="text" value="<?php echo $info->co_cursymbol; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2"><span class="text-sub"></span></label>

                            <div class="col-md-8">
                                <p>Ex: $,₳,etc...</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cureditcode" class="control-label col-md-2">Currency Code<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input  placeholder="" id="cureditcode" name="cureditcode"
                                       class="form-control" type="text" value="<?php echo $info->co_curcode; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2"><span class="text-sub"></span></label>

                            <div class="col-md-8">
                                <p>Ex: USD,EUR,SAR,etc...</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">
                                    Update
                                </button>
                                <a href="<?php echo url('manage_country');?>" class="btn btn-default btn-sm btn-grad"
                                   style="color:#000">Cancel</a>

                            </div>

                        </div>
                        {!! Form::close() !!}
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection

