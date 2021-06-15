@extends('siteadmin.layout.admin_master')
@section('title', 'Edit Member')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Edit Member</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Edit Member</h5>

                </header>
                @if ($errors->any())
                    <br>
                    <ul>
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all('<li>:message</li>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-11 panel_marg" style="padding-bottom:10px;">
                        <?php foreach ($customerresult as $customer) {
                        }
                        ?>

                        {!! Form::open(array('url'=>'edit_member_submit','class'=>'form-horizontal')) !!}

                        <input type="hidden" name="customer_edit_id" value="<?php echo $customer->mem_id; ?>"/>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Add Member
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_FirstName">First Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_FirstName" id="Customer_FirstName"
                                               value="<?php echo $customer->mem_fname;?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_LastName">Last Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_LastName" id="Customer_LastName"
                                               value="<?php echo $customer->mem_lname;?>"/>
                                    </div>
                                </div>
                            </div>


                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Email">E-mail<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id="Customer_Email"
                                               name="Customer_Email" value="<?php echo $customer->mem_email;?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="text1">UserID<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_UserID" required
                                               value="<?php echo $customer->mem_userid;?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Reset_Password">Reset Password</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_Reset_Password"/>
                                    </div>
                                </div>
                            </div>

                            <!--
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Phone">Phone</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               id="Customer_Phone" value="<?php echo $customer->mem_phone;?>"
                                               name="Customer_Phone"
                                               pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                               title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_customer_country">Select Country</label>

                                    <div class="col-md-4">
                                        <select class="form-control" name="select_customer_country"
                                                id="select_customer_country"
                                                onChange="select_state_from_country(this.value, '{{url('select_state_by_country')}}', 'select_customer_state', '{{$customer->mem_state}}')">
                                            <option value="">--select--</option>
                                            <?php foreach($countryresult as $countrydetails){ ?>
                                            <option value="<?php echo $countrydetails->co_id; ?>"
                                                    <?php if($countrydetails->co_id == $customer->mem_country) { ?> selected <?php } ?> ><?php echo $countrydetails->co_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_customer_state">Select State</label>

                                    <div class="col-md-4">
                                        <select class="validate[required] form-control"
                                                id="select_customer_state"
                                                name="select_customer_state"
                                                onChange="select_city_from_state(this.value, '{{url('select_city_by_state')}}', 'select_customer_city', '{{$customer->mem_city}}')">
                                            <option value="">--select--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_customer_city">Input City</label>

                                    <div class="col-md-4">
                                        <input class="form-control typeahead" id="select_customer_city"
                                               name="select_customer_city"
                                               value="<?php echo $customer->ci_name;?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Address1</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               value="<?php echo $customer->mem_address1;?>"
                                               name="Customer_Address1"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Address2</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               value="<?php echo $customer->mem_address2;?>"
                                               name="Customer_Address2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Zip">Zip/Postal Code</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               id="Customer_Zip"
                                               value="<?php echo $customer->mem_zipcode;?>"
                                               name="Customer_Zip"
                                               pattern="\d{5}([\-]\d{4})?"
                                               title="xxxxx or xxxxx-xxxx"/>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="pass1"><span
                                        class="text-sub"></span></label>

                            <div class="col-md-8">
                                <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                        style="color:#fff">Submit
                                </button>
                                <a href="<?php echo url('manage_customer');?>"
                                   class="btn btn-default btn-sm btn-grad" style="color:#000">Cancel</a>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            if ($('#select_customer_country').val() != 0)
                $('#select_customer_country').trigger('change');
        });

    </script>
@endsection


