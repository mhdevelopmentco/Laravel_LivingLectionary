@extends('siteadmin.layout.admin_master')
@section('title', 'BLOG DETAILS')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>BLOG DETAILS</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Blog Details</h5>
                </header>
                <?php
                foreach ($blog_list as $blog) {
                }
                $title = $blog->blog_title;
                $description = $blog->blog_desc;
                $category_get = $blog->blog_catid;
                $file_get = $blog->blog_image;
                $blog_title = $blog->blog_metatitle;
                $metadescription = $blog->blog_metadesc;
                $metakeyword = $blog->blog_metakey;
                $blog_tags = $blog->blog_tags;
                $blog_comments = $blog->blog_comments;
                $blog_type = $blog->blog_type;
                $blog_status = $blog->blog_status;
                $blog_created_date = $blog->blog_created_date;
                ?>
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Deal details
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Blog Title<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $title; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Category Type<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $blog->mc_name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Blog Description<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-9">
                                        <?php echo $description; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Blog Metatitle<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $blog_title;?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Blog MetaDescription<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $metadescription;?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Blog Meta keyword<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $metakeyword;?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1"> Blog Tags<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-8">
                                        <?php echo $blog_tags;?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Blog Image<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <img style="height:40px;"
                                             src="<?php echo url(''); ?>/public/assets/images/blogimage/<?php echo $file_get; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1"> Comments<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-8">
                                        <?php if ($blog_comments == 0) {
                                            echo 'Not Allow';
                                        } else {
                                            echo 'Allow';
                                        }?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1"> Status <span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-8">
                                        <?php if ($blog_type == 1) {
                                            echo 'Public';
                                        } else {
                                            echo 'Draft';
                                        }?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1"> Created Date <span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-8">
                                        <?php echo $blog_created_date; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-10" for="pass1"><span
                                        class="text-sub"></span></label>

                            <div class="col-md-2">
                                <a style="color:#fff" href="<?php if ($blog_type == 1) {
                                    echo url('manage_publish_blog');
                                } else {
                                    echo url('manage_draft_blog');
                                } ?>" class="btn btn-warning btn-sm btn-grad">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

