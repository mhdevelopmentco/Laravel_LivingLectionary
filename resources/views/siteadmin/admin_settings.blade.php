@extends('siteadmin.layout.admin_master')
@section('title', 'Admin Settings')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Admin Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Admin Settings</h5>
                </header>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    {!! Form::open(array('url'=>'admin_settings_submit','class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
                    <?php foreach ($admin_setting_details as $admin_get) {
                    }?>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">First Name<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="first_name" class="form-control"
                                       value="<?php echo $admin_get->adm_fname; ?>" type="text">
                            </div>
                        </div>
                    </div>


                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Last Name<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="last_name" class="form-control"
                                       value="<?php echo $admin_get->adm_lname; ?>" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Old Password<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="password" placeholder="" name="old_password" class="form-control"
                                       value="<?php echo $admin_get->adm_password; ?>" type="password">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">New Password<span
                                        class="text-sub"></span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="new_password" class="form-control" value=""
                                       type="password">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Email<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="email" class="form-control"
                                       value="<?php echo $admin_get->adm_email; ?>" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Phone<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="phone" class="form-control"
                                       value="<?php echo $admin_get->adm_phone; ?>" type="text">
                            </div>
                        </div>
                    </div>



                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-md-2" for="select_admin_country" >Select Country<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <select class="form-control" name="select_admin_country"
                                        id="select_admin_country"
                                        onChange="select_state_from_country(this.value, '{{url('select_state_by_country')}}', 'select_admin_state', '{{$admin_get->adm_st_id}}')">
                                    <option value="">--select--</option>
                                    <?php foreach($country_result as $countrydetails){ ?>
                                    <option value="<?php echo $countrydetails->co_id; ?>"
                                            <?php if($countrydetails->co_id == $admin_get->adm_co_id) { ?> selected <?php } ?> ><?php echo $countrydetails->co_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-md-2" for="select_admin_state">Select State<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <select class="validate[required] form-control"
                                        id="select_admin_state"
                                        name="select_admin_state"
                                        onChange="select_city_from_state(this.value, '{{url('select_city_by_state')}}', 'select_admin_city', '{{$admin_get->adm_ci_id}}')">
                                    <option value="">--select--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-md-2" >Input City<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-4">
                                <input class="form-control typeahead" id="select_admin_city"
                                       name="select_admin_city"
                                       value="<?php echo $admin_get->ci_name;?>" />
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Address one<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="address_one" class="form-control"
                                       value="<?php echo $admin_get->adm_address1; ?>" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Address two<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-7">
                                <input id="text1" placeholder="" name="address_two" class="form-control"
                                       value="<?php echo $admin_get->adm_address2 ?>" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="pass1"><span class="text-sub"></span></label>
                        <div class="col-md-7">
                            <button class="btn btn-warning btn-sm btn-grad" type="submit"><a
                                        style="color:#fff">Update</a>
                            </button>
                            <a href="<?php echo url('siteadmin_dashboard'); ?>" style="color:#000"
                               class="btn btn-default btn-sm btn-grad">Back</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#select_admin_country').trigger('change');
        });
    </script>
@endsection
