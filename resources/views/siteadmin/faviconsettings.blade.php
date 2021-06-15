@extends('siteadmin.layout.admin_master')
@section('title', 'Logo Settings')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Favicon Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Favicon Settings</h5>

                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    @if (Session::has('message'))
                        <p style="background-color:green;color:#fff;">{!! Session::get('message') !!}</p>
                    @endif
                    {!! Form::open(array('url'=>'add_favicon_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-3">Current Favicon<span class="text-sub">*</span></label>
                        <?php foreach ($favicondetails as $favicon) {
                        }
                        $imgpath = "assets/favicon/" . $favicon->imgs_name;
                        ?>
                        <div class="col-md-8">
                            <img alt="" src="<?php echo $imgpath;?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Upload Banner Image<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" placeholder="" name="favfile" id="favfile">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-3"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success btn-sm btn-grad " style="color:#fff">Submit
                            </button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">Reset
                            </button>

                        </div>

                    </div>


                    {!! Form::close() !!}}
                </div>
            </div>
        </div>
    </div>

@endsection