@extends('siteadmin.layout.admin_master')
@section('title', 'Add Ads')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Ads</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Ads</h5>
                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    @if ($errors->any())
                        <br>
                        <ul style="color:red;">
                            {!! implode('', $errors->all('<li>:message</li>')) !!}
                        </ul>
                    @endif
                    @if (Session::has('message'))
                        <p style="background-color:green;color:#fff;">{!! Session::get('message') !!}</p>
                    @endif
                    {!! Form::open(array('url'=>'add_ad_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <div class="form-group">
                        <label for="adtitle" class="control-label col-md-2">Ad Title<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="adtitle" placeholder="" class="form-control" type="text" name="adtitle"
                                   value="{!! Input::old('adtitle') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adposition" class="control-label col-md-2">Ads Position<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <select class="form-control" id="adposition" name="adposition" value="{!! Input::old('adposition') !!}">
                                <option value="0">select position</option>
                                <option value="1">Header Left</option>
                                <option value="2">Header Right</option>
                                <option value="3">Left Sidebar</option>
                                <option value="4">Right Sidebar</option>
                                <option value="5">Bottom Footer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="redirecturl">Redirect URL<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="redirecturl" placeholder="" class="form-control" type="text" name="redirecturl"
                                   value="{!! Input::old('redirecturl') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ad_img" class="control-label col-md-2">Upload Image<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" name="file" id="ad_img">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">Update</button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</button>
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

