@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Contributor')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Manage Contributor Accounts </a></li>
            </ul>
        </div>
    </div>
    <div class="row">

        <form action="{!!action('MemberController@manage_contributor')!!}" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="row">
                <br>
                <div class="col-sm-3">
                    <div class="item form-group">
                        <div class="col-sm-6"><label for="from_date">From Date</label></div>
                        <div class="col-sm-6">
                            <input type="text" name="from_date" class="form-control" id="from_date" required>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="item form-group">
                        <div class="col-sm-6"><label for="to_date">To Date</label></div>
                        <div class="col-sm-6">
                            <input type="text" name="to_date" id="to_date" class="form-control">

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-block btn-success" value="Search">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Contributor Accounts </h5>
                </header>
                @if ($errors->any())
                    <br>
                    <ul style="color:red;">
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('result'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('result') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
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
                                    <th aria-label="Product Name: activate to sort column ascending"
                                        style="width: 69px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Name
                                    </th>
                                    <th aria-label="City: activate to sort column ascending"
                                        style="width: 81px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">E-mail
                                    </th>
                                    <th aria-label="Store Name: activate to sort column ascending"
                                        style="width: 78px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Store Name
                                    </th>
                                    <th aria-label="Original Price($): activate to sort column ascending"
                                        style="width: 75px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Address
                                    </th>
                                    <th aria-label=" Resource Image : activate to sort column ascending"
                                        style="width: 78px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting"> Add Store
                                    </th>
                                    <th aria-label="Send Mail: activate to sort column ascending"
                                        style="width: 64px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Manage Stores
                                    </th>
                                    <th aria-label="Actions: activate to sort column ascending"
                                        style="width: 73px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Edit
                                    </th>
                                    <th aria-label="Actions: activate to sort column ascending"
                                        style="width: 73px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Delete
                                    </th>
                                    <th aria-label="Hot deals: activate to sort column ascending"
                                        style="width: 65px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting">Block / Unblock
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;

                                if(isset($_POST['submit']))
                                {
                                foreach($merchantrep as $merchant_details){ ?>
                                <tr class="gradeA odd">
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $merchant_details->mem_fname; ?></td>
                                    <td class=" text-center"><?php echo $merchant_details->mem_email; ?></td>
                                    <td class="text-center"><?php echo $merchant_details->stor_name; ?></td>
                                    <td class="text-center">{!! $merchant_details->co_name !!}
                                        <br> {!! $merchant_details->st_name !!}  {!! $merchant_details->ci_name !!}</td>
                                    <td class="text-center"><a
                                                href="<?php echo url('add_store/' . $merchant_details->mem_id); ?>"><i
                                                    class="icon-plus-sign icon-2x"></i></a></td>
                                    <td class="text-center"><a
                                                href="<?php echo url('manage_store/' . $merchant_details->mem_id); ?>"><i
                                                    class="icon-shopping-cart icon-2x"></i><span
                                                    style="color:#2574c4;padding-left:5px;">(<?php echo $store_count[$merchant_details->mem_id]; ?>
                                                ) Shops </span></a></td>
                                    <td class="text-center"><a
                                                href="<?php echo url('edit_contributor/' . $merchant_details->mem_id); ?>"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>
                                    <td class="text-center">
                                        <a href="<?php echo url('delete_merchant/' . $merchant_details->mem_id); ?>">
                                            <i class="icon icon-trash icon-2x"></i>
                                        </a>
                                    </td>
                                    <td class="text-center ">
                                        <?php if($merchant_details->mem_status == 1) { ?>
                                        <a href="<?php echo url('block_merchant/' . $merchant_details->mem_id . "/0"); ?>"><i
                                                    class="icon icon-ok icon-2x "></i></a> <?php } else if($merchant_details->mem_status == 0) { ?>
                                        <a href="<?php echo url('block_merchant/' . $merchant_details->mem_id . "/1"); ?>"><i
                                                    class="icon icon-ban-circle icon-2x icon-me"></i></a>
                                        <?php } //} else { echo 'Contributor In Use'; } ?>
                                    </td>

                                </tr>
                                <?php $i++; }
                                }
                                else{
                                foreach($merchant_return as $merchant_details){ ?>
                                <tr class="gradeA odd">
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $merchant_details->mem_fname; ?></td>
                                    <td class=" text-center"><?php echo $merchant_details->mem_email; ?></td>
                                    <td class="text-center"><?php echo $merchant_details->stor_name; ?></td>
                                    <td class="text-center">{!! $merchant_details->co_name !!}
                                        <br> {!! $merchant_details->st_name !!}  {!! $merchant_details->ci_name !!}</td>
                                    <td class="text-center"><a
                                                href="<?php echo url('add_store/' . $merchant_details->mem_id); ?>"><i
                                                    class="icon-plus-sign icon-2x"></i></a></td>
                                    <td class="text-center"><a
                                                href="<?php echo url('manage_store/' . $merchant_details->mem_id); ?>"><i
                                                    class="icon-shopping-cart icon-2x"></i><span
                                                    style="color:#2574c4;padding-left:5px;">(<?php echo $store_count[$merchant_details->mem_id]; ?>
                                                ) Shops </span></a></td>
                                    <td class="text-center"><a
                                                href="<?php echo url('edit_contributor/' . $merchant_details->mem_id); ?>"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>
                                    <td class="text-center">
                                        <a href="<?php echo url('delete_merchant/' . $merchant_details->mem_id); ?>">
                                            <i class="icon icon-trash icon-2x"></i>
                                        </a>
                                    </td>
                                    <td class="text-center ">
                                        <?php if($merchant_details->mem_status == 1) { ?>
                                        <a href="<?php echo url('block_merchant/' . $merchant_details->mem_id . "/0"); ?>"><i
                                                    class="icon icon-ok icon-2x "></i></a> <?php } else if($merchant_details->mem_status == 0) { ?>
                                        <a href="<?php echo url('block_merchant/' . $merchant_details->mem_id . "/1"); ?>"><i
                                                    class="icon icon-ban-circle icon-2x icon-me"></i></a>
                                        <?php } //} else { echo 'Contributor In Use'; } ?>
                                    </td>

                                </tr>
                                <?php $i++; }
                                }
                                ?>
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
    </div>
@endsection
@section('script')
    <script src="<?php echo url(); ?>/public/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo url('')?>/public/plugins/dataTables/js/jquery.dataTables.js"></script>
    <script src="<?php echo url('')?>/public/plugins/dataTables/js/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {

            $('#dataTables-example').dataTable();

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