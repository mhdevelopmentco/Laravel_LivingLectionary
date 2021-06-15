@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Review')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
    <style>
        ul.wysihtml5-toolbar > li {
            position: relative;
        }
    </style>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Edit Review</a></li>
            </ul>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Review</h5>

                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    @if ($errors->any())
                        <br>
                        <ul style="color:red;">
                            <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        </ul>
                    @endif
                    @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissable">{!! Session::get('error_message') !!}</div>
                    @endif
                    @foreach ($result as $info) @endforeach
                    {!! Form::open(array('url'=>'edit_review_submit','class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Review Title :<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-10">
                            <input type="hidden" name="comment_id" value="{!! $info->comment_id !!}" ?>
                            <input id="text1" placeholder="Title" class="form-control" type="text" name="review_title"
                                   value="{!! $info->title !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="wysihtml5" class="control-label col-md-2">Review Description :<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-10">
                                <textarea id="wysihtml5" class="form-control" rows="10"
                                          name="review_comment">{!! $info->comments !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button class="btn btn-warning btn-sm btn-grad"><a style="color:#fff">Submit</a></button>
                            <button class="btn btn-default btn-sm btn-grad" type="reset"><a
                                        href="<?php echo url('manage_cms_page'); ?> "
                                        style="color:#000">Reset</a>
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