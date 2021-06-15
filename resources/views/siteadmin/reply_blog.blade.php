@extends('siteadmin.layout.admin_master')
@section('title', 'Reply to Blog Comments')
@section('css')
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
                <li class=""><a>Home</a></li>
                <li class="active"><a>Reply To Blog Comments</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Reply To Blog Comments</h5>

                </header>
                @if (Session::has('success'))
                    <div class="alert alert-danger alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">{!! implode('', $errors->all('<li>:message</li>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'admin_blogreply_submit','class'=>'form-horizontal')) !!}
                    <div id="error_msg" style="color:#F00;font-weight:800"></div>
                    <?php foreach ($cmtsdetails as $inq_list) {
                    }?>
                    <input type="hidden" name="blog_id" value="<?php echo $inq_list->cmt_blog_id;;?>">
                    <input type="hidden" name="cmt_id" value="<?php echo $inq_list->cmt_id;;?>">

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Member Comments</label>
                        <div class="col-md-8">
                                    <textarea class="form-control" rows="10" name="blog_cmts"
                                              readonly><?php echo $inq_list->cmt_msg;?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-md-2">Reply To Member Comments<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                                    <textarea id="wysihtml5" class="form-control" rows="10"
                                              name="blog_reply"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button id="submit_reply" class="btn btn-success btn-sm btn-grad"><a
                                        style="color:#fff">Submit</a></button>
                            <button class="btn btn-default btn-sm btn-grad" style="color:#000">Reset</button>
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
        $(document).ready(function () {
            $('#wysihtml5').wysihtml5();

            $('#submit_reply').click(function () {
                if ($('#wysihtml5').val() == "") {
                    $('#wysihtml5').css('border', '1px solid red');
                    $('#error_msg').html('Please provide reply');
                    $('#wysihtml5').focus();
                    return false;
                }
                else if ($('#wysihtml5').val().length <= 10) {
                    $('#wysihtml5').css('border', '1px solid red');
                    $('#error_msg').html('Please provide reply with more than 10 characters');
                    $('#wysihtml5').focus();
                    return false;
                }
                else {
                    $('#wysihtml5').css('border', '');
                    $('#error_msg').html('');
                }
            });
        });
    </script>
@endsection