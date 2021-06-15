@extends('siteadmin.layout.admin_master')
@section('title', 'Add Blog')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css">
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Add Blog</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Blog</h5>
                </header>
                @if (Session::has('message'))
                    <div class="alert alert-danger alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">{!! implode('', $errors->all('<li>:message</li>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif


                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'add_blog_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2"> Title<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="text1" placeholder="" class="form-control" type="text" name="blog_title"
                                   value="{!! Input::old('blog_title') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Description<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                        <textarea id="wysihtml5" class="form-control" rows="10"
                                  name="blog_description">{!! Input::old('blog_description') !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2">Category<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <select class="form-control" name="blog_category"
                                    value="{!! Input::old('blog_category') !!}">
                                <option value="0">-- Select --</option>
                                <?php foreach($categoryresult as $categorydetails){ ?>
                                <option value="<?php echo $categorydetails->mc_id; ?>"><?php echo $categorydetails->mc_name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Image <span class="text-sub">*</span></label>

                        <div class="col-md-8">

                            <input type="file" name="file" id="blog_img">


                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            Select a snapshot (png,jpg,jpeg less than 1M).
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="text1">Meta title<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="" id="text1" name="meta_title"
                                   value="{!! Input::old('meta_title') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Meta description <span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                        <textarea id="text4" class="form-control"
                                  name="meta_description">{!! Input::old('meta_description') !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Meta keywords<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" id="text1" placeholder="" class="form-control" name="meta_keywords"
                                   value="{!! Input::old('meta_keywords') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Tags<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" id="text1" placeholder="" class="form-control" name="tags"
                                   value="{!! Input::old('tags') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Allow Comments<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="checkbox" checked="" value="1" name="allow_comments"
                                   value="{!! Input::old('allow_comments') !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2">Status<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="radio" name="blogstatus" checked="checked" title="Active" value="1"> <label
                                    class="sample">Publish </label>
                            <input type="radio" name="blogstatus" checked="checked" title="Active" value="2"> <label
                                    class="sample">Draft </label>
                            <label class="sample"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">Sumit
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

@endsection
@section('script')
    <script src="<?php echo url('')?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url('')?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url('')?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url('')?>/public/plugins/Markdown.Editor-hack.js"></script>
    <script src="<?php echo url('')?>/public/assets/js/editorInit.js"></script>
    <script>
        $(function () {
            $('#wysihtml5').wysihtml5();
        });
    </script>
@endsection
