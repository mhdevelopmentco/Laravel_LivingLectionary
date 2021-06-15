@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Ads')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit Ads</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Ads</h5>
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
                    {!! Form::open(array('url'=>'edit_ad_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    @foreach($adresult as $info)
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="editadtitle" class="control-label col-md-2">Ad Title<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input placeholder="" class="form-control" type="text" name="editadtitle"
                                       id="editadtitle"
                                       value="<?php echo $info->ad_name;?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editadposition" class="control-label col-md-2">Ads Position<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <select class="form-control" name="editadposition" id="editadposition">
                                    <option value="0" <?php if($info->ad_position == 0){ ?> selected <?php };?>>select position</option>
                                    <option value="1" <?php if($info->ad_position == 1){ ?> selected <?php };?>>Header Left</option>
                                    <option value="2" <?php if($info->ad_position == 2){ ?> selected <?php };?>>Header Right</option>
                                    <option value="3" <?php if($info->ad_position == 3){ ?> selected <?php };?>>Left Sidebar</option>
                                    <option value="4" <?php if($info->ad_position == 4){ ?> selected <?php };?>>Right Sidebar</option>
                                    <option value="5" <?php if($info->ad_position == 5){ ?> selected <?php };?>>Bottom Footer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Redirect URL<span class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input id="editredirecturl" placeholder="" class="form-control" type="text"
                                       name="editredirecturl"
                                       value="<?php echo $info->ad_redirecturl;?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ad_img" class="control-label col-md-2">Upload Image<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <input type="file" name="file" id="ad_img" value="{!!$info->ad_img!!}"
                                       placeholder="Fruit ball"><br>
                                <img src="{!! url('public/assets/images/adimage/').'/'.$info->ad_img!!}"
                                     style="height:60px;">
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">
                                    Update
                                </button>
                                <a href="<?php echo url('manage_ad');?>" class="btn btn-default btn-sm btn-grad"
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
@section('script')
@endsection
