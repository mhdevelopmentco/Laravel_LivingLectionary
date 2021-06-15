@extends('siteadmin.layout.admin_master')
@section('title', 'Add Member')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Add Member</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Add Member</h5>

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

                        {!! Form::open(array('url'=>'add_member_submit','class'=>'form-horizontal')) !!}
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
                                               id="Customer_FirstName"
                                               name="Customer_FirstName"
                                               value="{!! Input::old('Customer_FirstName') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_LastName">Last Name<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               id="Customer_LastName"
                                               name="Customer_LastName"
                                               value="{!! Input::old('Customer_LastName') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Email">E-mail<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               id="Customer_Email"
                                               name="Customer_Email"
                                               value="{!! Input::old('Customer_Email') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_UserID">UserID<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_UserID"
                                               id="Customer_UserID"
                                               value="{!! Input::old('Customer_UserID') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Password">Password<span
                                                class="text-sub">*</span></label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_Password"
                                               id="Customer_Password"
                                               value="{!! Input::old('Customer_Password') !!}"/>
                                    </div>
                                </div>
                            </div>

                            <!--
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Phone">Phone</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               id="Customer_Phone" name="Customer_Phone"
                                               pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                               value="{!! Input::old('Customer_Phone') !!}"
                                               title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_customer_country">Country</label>

                                    <div class="col-md-4">
                                        <select class="form-control" name="select_customer_country"
                                                id="select_customer_country"
                                                value="{!! Input::old('select_customer_country') !!}"
                                                onChange="select_state_from_country(this.value, '<?php echo url('select_state_by_country'); ?>', 'select_customer_state')">
                                            <option value="">--select--</option>
                                            <?php foreach($countryresult as $countrydetails){ ?>
                                            <option value="<?php echo $countrydetails->co_id; ?>"
                                                    <?php if($countrydetails->co_id == '1'){?> selected <?php } ?>><?php echo $countrydetails->co_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="select_customer_state">State</label>

                                    <div class="col-md-4">
                                        <select class="validate[required] form-control"
                                                id="select_customer_state"
                                                name="select_customer_state"
                                                onChange="select_city_from_state(this.value, '<?php echo url('select_city_by_state'); ?>', 'select_customer_city')">
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
                                               name="select_customer_city" autocomplete="off"
                                               value="{!! Input::old('select_customer_city') !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Address1">Address1</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_Address1" id="Customer_Address1"
                                               value="{!! Input::old('Customer_Address1') !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Address2">Address2</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               name="Customer_Address2" id="Customer_Address2"
                                               value="{!! Input::old('Customer_Address2') !!}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="Customer_Zip">Zip/Postal Code</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder=""
                                               id="Customer_Zip"
                                               value="{!! Input::old('Customer_Zip') !!}"
                                               name="Customer_Zip" pattern="\d{5}([\-]\d{4})?"
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
                                <button type="submit" class="btn btn-warning btn-sm btn-grad"><a
                                            style="color:#fff">Submit</a></button>
                                <button class="btn btn-default btn-sm btn-grad"><a style="color:#000" href="#">Reset</a>
                                </button>

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
        $(document).keydown(function (e) {
            var key = e.keyCode;
            if (key == 13){
                e.preventDefault();
            }
        });

        $(document).ready(function () {
            if ($('#select_customer_country').val() != 0)
                $('#select_customer_country').trigger('change');
        });

    </script>
@endsection
