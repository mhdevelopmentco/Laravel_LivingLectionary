@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Banner')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit Banner Image</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Banner Image</h5>
                </header>
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif

                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'edit_banner_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    @foreach($banner_detail as $banner_det)
                        <div class="form-group">
                            <label for="bn_title" class="control-label col-md-2">Image Title<span class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="hidden" name="bn_id" id="bn_id" value="{!!$banner_det->bn_id!!}"/>
                                <input placeholder="" name="bn_title" id="bn_title"
                                       value="{!! $banner_det->bn_title!!}" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for= "bn_img" class="control-label col-md-2">Upload Banner Image<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="file" name="file" id="bn_img" value="{!! $banner_det->bn_img!!}"
                                       placeholder="Fruit ball"><br>
                                <img src="{!! url('public/assets/images/bannerimage/').'/'.$banner_det->bn_img!!}"
                                     style="height:60px;">
                            </div>

                        </div>

                        <div class="form-group">
                            <label id="bn_redirecturl" class="control-label col-md-2">Redirect URL<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="text" name="bn_redirecturl" id="bn_redirecturl"
                                       value="{!! $banner_det->bn_redirecturl!!}" class="form-control"
                                       placeholder="">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-8 col-md-offset-2">
                                <button type='submit' class="btn btn-warning btn-sm btn-grad"
                                        style="color:#fff">Update
                                </button>
                                <a href="<?php echo url('manage_banner_image');?>"
                                   class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</a>

                            </div>

                        </div>
                    @endforeach

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
