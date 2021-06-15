@extends('siteadmin.layout.admin_master')
@section('title', 'Privacy Policy Setting')
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
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Privacy Policy</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>CMS Privacy Policy</h5>
                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            {!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                        </div>
                    @endif
                    @if (Session::has('update_result'))
                        <div class="alert alert-success alert-dismissable">{!! Session::get('update_result') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                        </div>
                    @endif
                    {!! Form::open(array('url'=>'privacy_update','class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        <label for="wysihtml5" class="control-label col-md-3">Privacy Policy Data<span
                                    class="text-sub">*</span></label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                                <textarea id="wysihtml5" class="form-control" name="data"
                                          rows="20">
                                    @foreach($result as $info){!! $info->pri_text !!}@endforeach
                                </textarea>
                        </div>
                        <label class="control-label col-md-2"><span class="text-sub"></span></label>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-"><span
                                    class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button class="btn btn-warning btn-sm btn-grad" type="submit"><a
                                        style="color:#fff">Update</a></button>
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

    <script>
        $(function () {
            $('#wysihtml5').wysihtml5();
            var wysihtml5 = $('#wysihtml5');
        });
    </script>
@endsection