@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Member')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Manage Members </a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('url'=>'manage_member','class'=>'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="row">
                <br>


                <div class="col-sm-3">
                    <div class="item form-group">
                        <div class="col-sm-6"><label for="from_date">From Date</label></div>
                        <div class="col-sm-6">
                            <input type="text" name="from_date" class="form-control" id="from_date"
                                   required/>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="item form-group">
                        <div class="col-sm-6"><label for="to_date">To Date</label></div>
                        <div class="col-sm-6">
                            <input type="text" name="to_date" id="to_date" class="form-control"/>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-block btn-success" value="Search"/>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>

                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5> Manage Members </h5>

                </header>

                @if ($errors->any())
                    <br>
                    <div class="alert alert-danger alert-dismissable">
                        {!! implode('', $errors->all(':message')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif

                <div class="accordion-body collapse in body" id="div-1">

                    <div role="grid" class="dataTables_wrapper form-inline"
                         id="dataTables-example_wrapper">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="dataTables-example_length">
                                    <label></label></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter"
                                     class="dataTables_filter"></div>
                            </div>
                        </div>
                        <table aria-describedby="dataTables-example_info"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="dataTables-example">
                            <thead>
                            <tr role="row">
                                <th aria-label="S.No: activate to sort column ascending"
                                    style="width: 61px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting_asc" aria-sort="ascending">S.No
                                </th>
                                <th aria-label="Member First Name: activate to sort column ascending"
                                    style="width: 69px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">First Name
                                </th>
                                <th aria-label="Member Last Name: activate to sort column ascending"
                                    style="width: 69px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Last Name
                                </th>
                                <th aria-label="Email: activate to sort column ascending"
                                    style="width: 81px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Email
                                </th>
                                <th aria-label="User ID: activate to sort column ascending"
                                    style="width: 81px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">User ID
                                </th>
                                <th aria-label="Address: activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Address
                                </th>
                                <th aria-label=" Resource Image : activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Actions
                                </th>
                                <th aria-label="Send Mail: activate to sort column ascending"
                                    style="width: 64px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Status
                                </th>
                                <th aria-label="Send Mail: activate to sort column ascending"
                                    style="width: 64px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Confirm
                                </th>
                                <th aria-label="Actions: activate to sort column ascending"
                                    style="width: 73px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Delete
                                </th>
                                <th aria-label="Hot deals: activate to sort column ascending"
                                    style="width: 65px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Make a Contributor
                                </th>
                                <th aria-label="Original Price($): activate to sort column ascending"
                                    style="width: 75px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Created At
                                </th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php $i = 1;

                            if(isset($_POST['submit']))
                            {
                            foreach($customerrep as $row)
                            {
                            ?>

                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $row->mem_fname . ' ' . $row->mem_lanme;?></td>
                                <td class="text-center"><?php echo $row->mem_email;?></td>
                                <td class="text-center"><?php echo $row->mem_userid;?></td>
                                <td class="text-center">{!! $row->co_name.' '. $row->st_name .' '. $row->ci_name !!}</td>
                                <td class="text-center"><a
                                            href="<?php echo url('edit_member/' . $row->mem_id); ?>">
                                        <i class="icon icon-edit icon-2x"
                                        ></i></a></td>

                                <td class="text-center"><?php if($row->mem_status == 0){ ?><a
                                            href="{!! url('update_member_status').'/'.$row->mem_id.'/'.'1'!!}"><i
                                                class="icon icon-ok icon-2x"></i>
                                    </a> <?php } else { ?> <a
                                            href="{!! url('update_member_status').'/'.$row->mem_id.'/'.'0'!!}">
                                        <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?>
                                </td>
                                <td class="text-center">
                                    @if($row->mem_confirmed)
                                        <i class="icon-thumbs-up"></i>
                                    @else
                                        <a href="{{url('activate_account_from_admin').'/'.base64_encode($row->mem_id)}}"><i
                                                    class="icon-thumbs-up-alt"></i></a>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="<?php echo url('delete_member/' . $row->mem_id); ?>">
                                        <i class="icon icon-trash icon-2x"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo url('convert_member_to_contributor/' . $row->mem_id); ?>"><i
                                                class="icon icon-trophy"></i></a></td>
                                <td class="text-center"><?php echo $row->created_at;?></td>

                            </tr>

                            <?php $i++;
                            }
                            }
                            else
                            {

                            foreach($customerresult as $customerdetails) {
                            ?>
                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $customerdetails->mem_fname;?></td>
                                <td class="text-center"><?php echo $customerdetails->mem_lname;?></td>
                                <td class="text-center"><?php echo $customerdetails->mem_email;?></td>
                                <td class="text-center"><?php echo $customerdetails->mem_userid;?></td>
                                <td class="text-center">{!! $customerdetails->co_name.' '. $customerdetails->st_name .' '. $customerdetails->ci_name !!}</td>
                                <td class="text-center"><a
                                            href="<?php echo url('edit_member/' . $customerdetails->mem_id); ?>">
                                        <i class="icon icon-edit icon-2x"
                                        ></i></a></td>

                                <td class="text-center"><?php if($customerdetails->mem_status == 0){ ?>
                                    <a href="{!! url('update_member_status').'/'.$customerdetails->mem_id.'/'.'1'!!}"><i
                                                class="icon icon-ban-circle icon-2x icon-me"></i>
                                    </a> <?php } else { ?> <a
                                            href="{!! url('update_member_status').'/'.$customerdetails->mem_id.'/'.'0'!!}">
                                        <i class="icon  icon-ok icon-2x"></i></a> <?php } ?>
                                </td>

                                <td class="text-center">
                                    @if($customerdetails->mem_confirmed)
                                        <i class="icon-thumbs-up"></i>
                                    @else
                                        <a href="{{url('activate_account_from_admin').'/'.base64_encode($customerdetails->mem_id)}}"><i
                                                    class="icon-thumbs-up-alt"></i></a>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="<?php echo url('delete_member/' . $customerdetails->mem_id); ?>">
                                        <i class="icon icon-trash icon-2x"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo url('convert_member_to_contributor/' . $customerdetails->mem_id); ?>"><i
                                                class="icon icon-trophy icon-2x"></i></a></td>
                                <td class="text-center"><?php echo $customerdetails->created_at;?></td>

                            </tr>

                            <?php $i++; }
                            }?>

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info"
                                     role="alert" aria-live="polite" aria-relevant="all"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="dataTables-example_paginate"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
    <script>
        $(function () {
            $("#from_date").datepicker({
                prevText: "click for previous months",
                nextText: "click for next months",
                showOtherMonths: true,
                selectOtherMonths: false
            });
            $("#to_date").datepicker({
                prevText: "click for previous months",
                nextText: "click for next months",
                showOtherMonths: true,
                selectOtherMonths: true
            });
        });
    </script>
@endsection
