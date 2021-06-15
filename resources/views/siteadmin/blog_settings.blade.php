@extends('siteadmin.layout.admin_master')
@section('title', 'Blog Settings')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a href="#">Home</a></li>
                <li class="active"><a href="#">Blog Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Blog Settings</h5>
                </header>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'blog_settings_submit','class'=>'form-horizontal')) !!}
                    @foreach($blog_settings as $blog_set)
                        <div class="form-group">
                            <label class="control-label col-md-3">Allow Comments Posting In Blog<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-6">
                                <select class="form-control" name="allow_comments">
                                    <option value="1" <?php if($blog_set->bs_allowcommt == 1){?> selected <?php } ?>>Yes
                                    </option>
                                    <option value="0" <?php if($blog_set->bs_allowcommt == 0){?> selected <?php } ?>>No
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="approval">Require Admin Approval For Every
                                Comment<span class="text-sub">*</span></label>

                            <div class="col-md-6">
                                <select class="form-control" name="admin_approval" id="approval">
                                    <option value="1"
                                            <?php if($blog_set->bs_radminapproval == 1){?> selected <?php } ?>>
                                        Yes
                                    </option>
                                    <option value="0"
                                            <?php if($blog_set->bs_radminapproval == 0){?> selected <?php } ?>>
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="post_per_page" class="control-label col-md-3">Posts Per Page<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-6">
                                <input type="text" id="post_per_page" name="post_per_page"
                                       value="{!! $blog_set->bs_postsppage!!}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-md-3"><span class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">Update
                                </button>
                                <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel
                                </button>
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
