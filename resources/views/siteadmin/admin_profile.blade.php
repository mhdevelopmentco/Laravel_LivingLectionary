@extends('siteadmin.layout.admin_master')
@section('title', 'Admin profile')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Admin profile</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Admin profile</h5>
                </header>
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">

                        <?php foreach ($admin_setting_details as $admin) {
                        } ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                admine profile
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">First Name<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_fname; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Last Name<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_lname; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Password<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_password; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Email-id<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_email; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Phone Number <span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_phone; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address One<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_address1; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Address Two<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->adm_address2; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">Country<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->co_name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">City<span
                                                class="text-sub">*</span></label>
                                    <div class="col-md-4">
                                        <?php echo $admin->ci_name; ?>
                                    </div>
                                </div>
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

