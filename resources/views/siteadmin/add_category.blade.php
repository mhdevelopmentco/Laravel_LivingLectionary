@extends('siteadmin.layout.admin_master')
@section('title', 'Add Category')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class=""><a>Categories</a></li>
                <li class="active"><a>Add Category</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Category</h5>

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
                    {!! Form::open(array('url'=>'add_category_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-3">Top Category Name<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="catg_name" placeholder="" name="catg_name" class="form-control"
                                   value="{!!Input::old('catg_name')!!}" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catg_desc" class="control-label col-md-3">Category Description</label>

                        <div class="col-md-8">
                            <input id="catg_desc" placeholder="" name="catg_desc" class="form-control"
                                   value="{!!Input::old('catg_desc')!!}" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="text1"> Category Status
                            <label class="sample"></label></label>

                        <div class="col-md-8">
                            <input type="radio" value="1" title="Active" checked="checked" name="catg_status"> <label
                                    class="sample">Active </label>
                            <input type="radio" value="0" title="Active" name="catg_status"> <label
                                    class="sample">Deactive </label></label>
                            <label class="sample"></label></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Listing Category Image<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" placeholder="Fruit ball" name="file" id="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Explore Category Image<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="file" name="file2" id="file2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-3"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">Add
                            </button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel
                            </button>

                        </div>

                    </div>


                    {!! form::close()!!}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection