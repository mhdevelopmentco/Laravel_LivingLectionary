@extends('siteadmin.layout.admin_master')
@section('title', 'Social Media Settings')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Social Media Pages</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>{!! Session::get('success') !!}</div>
                    @endif
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Social Media Pages</h5>

                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'social_media_setting_submit','class'=>'form-horizontal')) !!}
                    <?php
                        $social_details = $social_settings[0];
                    ?>
                    <div class="form-group">
                        <label for="fb_app_id" class="control-label col-md-2">Facebook App ID<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="fb_app_id" name="fb_app_id" value="<?php echo $social_details->sm_fb_app_id; ?>"
                                   placeholder="298683020274383" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fb_secret_key" class="control-label col-md-2">Facebook Secrect Key<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="fb_secret_key" name="fb_secret_key" value="<?php echo $social_details->sm_fb_sec_key; ?>"
                                   placeholder="4b30f51b1042d04fd6c3953b1944e509" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fb_page_url" class="control-label col-md-2">FaceBook Page URL<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="fb_page_url" name="fb_page_url" value="<?php echo $social_details->sm_fb_page_url; ?>"
                                   placeholder="https://www.facebook.com/UniEcommerce" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fb_like_box_url" class="control-label col-md-2">FaceBook Like box URL<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="fb_like_box_url" name="fb_like_box_url"
                                   value="<?php echo $social_details->sm_fb_like_page_url; ?>"
                                   placeholder="https://www.facebook.com/UniEcommerce" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="twitter_page_url" class="control-label col-md-2">Twitter Page URL<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="twitter_page_url" name="twitter_page_url" value="<?php echo $social_details->sm_twitter_url; ?>"
                                   placeholder="https://twitter.com/uni_ecommerce" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="twitter_app_id" class="control-label col-md-2">Twitter App ID<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="twitter_app_id" name="twitter_app_id"
                                   value="<?php echo $social_details->sm_twitter_app_id; ?>" placeholder="291719054236926"
                                   class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="twitter_secret_key" class="control-label col-md-2">Twitter Secrect Key<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="twitter_secret_key" name="twitter_secret_key"
                                   value="<?php echo $social_details->sm_twitter_sec_key; ?>"
                                   placeholder="b24927947a1adc1cff504bd4cbb16968" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="linkedin_page_url" class="control-label col-md-2">Linkedin Page URL<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="linkedin_page_url" name="linkedin_page_url"
                                   value="<?php echo $social_details->sm_linkedin_url; ?>"
                                   placeholder="http://www.linkedin.com/company/uniecommerce" class="form-control"
                                   type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="youtube_page_url" class="control-label col-md-2">Youtube URL<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="youtube_page_url" name="youtube_page_url" value="<?php echo $social_details->sm_youtube_url; ?>"
                                   placeholder="http://www.youtube.com/watch?v=QhzrdsS5J9w" class="form-control"
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gmap_app_key" class="control-label col-md-2">Gmap App Key<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input id="gmap_app_key" name="gmap_app_key" value="<?php echo $social_details->sm_gmap_app_key; ?>"
                                   placeholder="b24927947a1adc1cff504bd4cbb16968" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="android_page_url" class="control-label col-md-2">Android page URL<span
                                    class="text-sub"></span></label>

                        <div class="col-md-8">
                            <input id="android_page_url" name="android_page_url"
                                   value="<?php echo $social_details->sm_android_page_url; ?>"
                                   placeholder="https://play.google.com/store/apps/details?id=com.uniecommerce.uninew.ecommerce"
                                   class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="iphone_page_url" class="control-label col-md-2">iPhone page URL<span
                                    class="text-sub"></span></label>

                        <div class="col-md-8">
                            <input id="iphone_page_url" name="iphone_page_url"
                                   placeholder="https://itunes.apple.com/us/app/uniecommercenew/id592052500?ls=1&mt=8"
                                   value="<?php echo $social_details->sm_iphone_url; ?>" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="analytics_code" class="control-label col-md-2">Analytics Code<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                        <textarea id="analytics_code" class="form-control" rows = "10"
                                  name="analytics_code"><?php echo $social_details->sm_analytics_code; ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button class="btn btn-warning btn-sm btn-grad"><a style="color:#fff">Update</a></button>
                            <button class="btn btn-default btn-sm btn-grad" type="reset"><a
                                        style="color:#000">Reset</a></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection

