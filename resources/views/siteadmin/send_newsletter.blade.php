@extends('siteadmin.layout.admin_master')
@section('title', 'Send Newsletter')
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
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Send Newsletter</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Send Newsletter</h5>

                </header>
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('error') !!}</div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif
                {!! Form::open(array('url'=>'send_newsletter_submit','class'=>'form-horizontal')) !!}
                <div id="div-1" class="accordion-body collapse in body">
                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Subject<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="News Letter Subject"
                                   value="{!! Input::old('subject') !!}" name="subject" id="text1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="wysihtml5" class="control-label col-md-2">Message<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">

                            <div id="">
                                <div class="tab-pane fade active in">

                                        <textarea id="wysihtml5" name="message" class="form-control"
                                                  rows="10">{!! Input::old('message') !!}</textarea>

                                    <div class="form-actions">
                                        <br/>
                                        <button type="submit" class="btn btn-warning btn-sm btn-grad"><a
                                                    style="color:#fff">Send</a></button>
                                        <button type="reset" class="btn btn-default btn-sm btn-grad"><a
                                                    style="color:#000">Reset</a></button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="<?php echo url(); ?>/public/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/bootstrap-wysihtml5-hack.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/pagedown/Markdown.Converter.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/pagedown/Markdown.Sanitizer.js"></script>
    <script src="<?php echo url(); ?>/public/plugins/Markdown.Editor-hack.js"></script>
    <script src="<?php echo url(); ?>/public/assets/js/editorInit.js"></script>
    <script>
        $(function () {
            formWysiwyg();
        });
    </script>

@endsection


