@extends('siteadmin.layout.admin_master')
@section('title', 'Add Security Question')
@section('content')
    <div class="row-fluid">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Security Question</a></li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Security Question</h5>
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
                    {!! Form::open(array('url'=>'add_secq_submit','class'=>'form-horizontal')) !!}
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Enter your security question<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <input id="text1" name="secquestion" placeholder="" class="form-control" type="text"
                                   required value="{!! Input::old('secquestion') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">
                                Add
                            </button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                Cancel
                            </button>
                        </div>
                    </div>
                    {!!  Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection