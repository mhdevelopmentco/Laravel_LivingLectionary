@extends('siteadmin.layout.admin_master')
@section('title', 'Logo Settings')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Logo Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Logo Settings</h5>
                </header>

                @if ($errors->any())
                    <br>
                    <ul class="alert alert-danger alert-dismissable">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </ul>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif


                <div id="div-1" class="accordion-body collapse in body">

                    {!! Form::open(array('url'=>'add_logo_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <?php
                    if (count($logodetails) > 0) {
                        $logo = $logodetails[0];
                        $imgpath = "./themes/images/logo/" . $logo->imgs_name;
                    } else {
                        $imgpath = "";
                    }

                    if (count($inverse_logodetails) > 0) {
                        $logo2 = $inverse_logodetails[0];
                        $imgpath2 = "./themes/images/logo/" . $logo2->imgs_name;
                    } else {
                        $imgpath2 = "";
                    }


                    ?>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-3">Current Logo<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-4">
                            <img alt="" src="<?php echo $imgpath;?>" class="img-responsive  show_in_gray">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Upload Logo Image<span class="text-sub">*</span></label>

                        <div class="col-md-4">
                            <input type="file" placeholder="" name="logofile" id="logofile">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-md-3">Current Invsere Logo<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-4">
                            <img alt="" src="<?php echo $imgpath2;?>" class="img-responsive show_in_gray">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Upload Inverse Logo Image<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" placeholder="" name="logofile2" id="logofile2">
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
                    {!! Form::close() !!}
                </div>
            </div>
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
                    {!! Form::open(array('url'=>'add_favicon_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-3">Current Favicon<span class="text-sub">*</span></label>
                        <?php foreach ($favicondetails as $favicon) {
                        }
                        $imgpath = "./themes/images/favicon/" . $favicon->imgs_name;
                        ?>
                        <div class="col-md-1">
                            <img alt="" class="img-responsive" src="<?php echo $imgpath;?>">
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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Noimage Settings</h5>

                </header>
                <div id="div-1" class="accordion-body collapse in body">

                    {!! Form::open(array('url'=>'add_noimage_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-3">Current Noimage<span class="text-sub">*</span></label>
                        <?php
                        if ($noimagedetails) {
                            foreach ($noimagedetails as $noimage) {
                                $imgpath = "./themes/images/noimage/" . $noimage->imgs_name;
                            }
                        } else {
                            $imgpath = "";
                        }

                        ?>
                        <div class="col-md-1">
                            <img src="<?php echo $imgpath;?>" class="img-responsive"></div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Upload Banner Image<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" placeholder="" name="noimgfile" id="noimgfile">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-3"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success btn-sm btn-grad " style="color:#fff">
                                Submit
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
