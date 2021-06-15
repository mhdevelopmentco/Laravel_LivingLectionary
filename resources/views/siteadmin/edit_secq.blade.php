@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Security Question')
@section('content')
    <div class="row-fluid">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Security Question</a></li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Security Question</h5>
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


                    @foreach ($secqresult as $info)
                        {!! Form::open(array('url'=>'update_secq_submit','class'=>'form-horizontal')) !!}
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Enter your security question<span
                                        class="text-sub">*</span></label>
                            <div class="col-md-8">
                                <input id="text1" name="editsecquestion" placeholder="" class="form-control" type="text"
                                       value="<?php echo $info->question; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">Update
                                </button>
                                <a href="<?php echo url('manage_secq');?>" class="btn btn-default btn-sm btn-grad"
                                   style="color:#000">Cancel</a>

                            </div>

                        </div>

                    @endforeach
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
