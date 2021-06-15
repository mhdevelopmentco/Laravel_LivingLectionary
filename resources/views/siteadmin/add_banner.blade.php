@extends('siteadmin.layout.admin_master')
@section('title', 'Add Banner')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Banner Image</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Banner Image</h5>
                </header>
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('error') !!}</div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'add_banner_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <div class="form-group">
                        <label for="bn_title" class="control-label col-md-3">Image Title<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input placeholder="Banner Title" name="bn_title"
                                   value="{!!Input::old('bn_title')!!}" id="bn_title" class="form-control"
                                   type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="bn_img">Upload Banner Image<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" name="file" id="bn_img"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="bn_redirecturl">Redirect URL<span
                                    class="text-sub"></span></label>

                        <div class="col-md-8">
                            <input type="text" name="bn_redirecturl" id="bn_redirecturl" class="form-control"
                                   value="{!!Input::old('bn_redirecturl')!!}" placeholder="Redirect Url">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-3"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type='submit' class="btn btn-warning btn-sm btn-grad" style="color:#fff">
                                Update
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
@endsection