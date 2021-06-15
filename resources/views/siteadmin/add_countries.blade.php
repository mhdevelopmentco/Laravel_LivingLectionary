@extends('siteadmin.layout.admin_master')
@section('title', 'Add Country')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Country</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Country</h5>

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

                    {!! Form::open(array('url'=>'add_country_submit','class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Country Name<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input  placeholder="" id="cname" name="cname" class="form-control"
                                   type="text" value="{!! Input::old('cname') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2">Country Code<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input placeholder="" id="ccode" name="ccode" maxlength="3" class="form-control"
                                   type="text" value="{!! Input::old('ccode') !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <p>Ex:AL,AX, etc..</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2">Currency Symbol<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input  placeholder="" id="cursymbol" name="cursymbol"
                                   class="form-control" type="text" value="{!! Input::old('cursymbol') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <p>Ex: $,₳,etc...</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2">Currency Code<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input  placeholder="" id="curcode" maxlength="3" name="curcode"
                                   class="form-control" type="text" value="{!! Input::old('curcode') !!}">
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
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                Reset
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
