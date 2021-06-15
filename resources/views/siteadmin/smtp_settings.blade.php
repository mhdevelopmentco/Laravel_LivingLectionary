@extends('siteadmin.layout.admin_master')
@section('title', 'SMTP SETTINGS')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>SMTP Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>SMTP Settings</h5>

                </header>
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

                <div class="accordion-body collapse in body">
                    <div class="form-group">
                        <?php foreach ($smtp_settings as $smtp) {
                        }
                        foreach ($send_settings as $send) {
                        } ?>
                        <label for="inlineCheckbox1" class="control-label col-md-2">
                            <input type="checkbox" value="1" name="sendgrid" id="inlineCheckbox1"
                                   <?php if($smtp->sm_isactive == 1){ ?> checked <?php } ?> >
                            SMTP
                        </label>
                    </div>
                </div>
                <div class="alert alert-danger alert-dismissable" id="update_notice"
                     style="display:none;"></div>
                <div id="div-1" class="accordion-body collapse in body"
                     <?php if($smtp->sm_isactive == 1){ ?> style="display:block;"
                     <?php } else { ?> style="display:none;" <?php } ?>>
                    {!! Form::open(array('url'=>'smtp_setting_submit','class'=>'form-horizontal')) !!}
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            Don't change these values unless you know what you're doing
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Smtp Host<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="smtp.gmail.com"
                                   value="{!!$smtp->sm_host!!}" name="smtp_host" id="smtp_host">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"> Smtp Port<span class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="465" name="smtp_port"
                                   value="{!!$smtp->sm_port!!}" id="smtp_port">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2">Smtp User Name<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="1234@getonthedancefloor"
                                   value="{!!$smtp->sm_uname!!}" name="smtp_username" id="smtp_username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2">Smtp Password<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="password" class="form-control" name="password"
                                   value="{!!$smtp->sm_pwd!!}" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">
                                Update
                            </button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                Cancel
                            </button>

                        </div>

                    </div>


                    {!!Form::close()!!}
                </div>

                <div id="div-2" class="accordion-body collapse in body"
                     <?php if($send->sm_isactive == 1){ ?> style="display:block;"
                     <?php } else { ?> style="display:none;" <?php } ?>>
                    {!! Form::open(array('url'=>'send_setting_submit','class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            Don't change these values unless you know what you're doing
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Sendgrid Host<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="sendgrid.gmail.com"
                                   value="{!!$send->sm_host!!}" name="send_host" id="send_host">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"> Sendgrid Port<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="465" name="send_port"
                                   value="{!!$send->sm_port!!}" id="send_port">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text2" class="control-label col-md-2">Sendgrid User Name<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="1234@getonthedancefloor"
                                   value="{!!$send->sm_uname!!}" name="send_username" id="send_username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2">Sendgrid Password<span
                                    class="text-sub">*</span></label>

                        <div class="col-md-8">
                            <input type="password" class="form-control" name="send_password"
                                   value="{!!$send->sm_pwd!!}" id="send_password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>

                        <div class="col-md-8">
                            <button type="submit" class="btn btn-warning btn-sm btn-grad" style="color:#fff">
                                Update
                            </button>
                            <button type="reset" class="btn btn-default btn-sm btn-grad" style="color:#000">
                                Cancel
                            </button>

                        </div>

                    </div>


                    {!!Form::close()!!}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
<script>

    $(document).ready(function () {
        $('#inlineCheckbox2').click(function () {
            if (this.checked) {
                $('#div-1').hide();
                $('#div-2').show();
                $('#inlineCheckbox1').prop('checked', false);
                $('#update_notice').show();
                $('#update_notice').text('Click Update to Choose the selected settings');
                $('#update_notice').fadeOut(2000);
            }
        });

        $('#inlineCheckbox1').click(function () {
            if (this.checked) {
                $('#div-2').hide();
                $('#div-1').show();
                $('#inlineCheckbox2').prop('checked', false);
                $('#update_notice').show();
                $('#update_notice').text('Click Update to Choose the selected settings');
                $('#update_notice').fadeOut(2000);
            }
        });
    });
</script>
@endsection
