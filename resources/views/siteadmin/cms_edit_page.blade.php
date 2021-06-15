@extends('siteadmin.layout.admin_master')
@section('title', 'Edit CMS Page')
@section('css')
    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/Font-Awesome/css/font-awesome.css"/>
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
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit CMS Page</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit CMS Page</h5>

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
                    {!! Form::open(array('url'=>'edit_cms_page_submit','class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        <label for="page_title" class="control-label col-md-5">Page Title :<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-8">
                            <input type="hidden" name="cms_id" value="{!! $info->cp_id !!}" ?>
                            <input id="page_title" placeholder="Title" class="form-control" type="text"
                                   name="page_title"
                                   value="{!! $info->cp_title !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wysihtml5" class="control-label col-md-2">Page Description :<span
                                    class="text-sub">*</span></label>
                        <div class="col-md-11">


                            <div class="body collapse in">
                                <textarea id="wysihtml5" class="form-control" rows="10"
                                          name="page_description">{!! $info->cp_description !!}</textarea>
                                <div class="form-actions">
                                    <br/>
                                    <button class="btn btn-warning btn-sm btn-grad"><a
                                                style="color:#fff">Submit</a></button>
                                    <button class="btn btn-default btn-sm btn-grad" type="reset"><a
                                                href="<?php echo url('manage_cms_page'); ?> "
                                                style="color:#000">Reset</a></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

                {!! Form::close() !!}
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
            formWysiwyg();
        });
    </script>
@endsection