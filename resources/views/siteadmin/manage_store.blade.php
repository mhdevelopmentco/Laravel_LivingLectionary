@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Store')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Manage Store Accounts </a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Store</h5>

                </header>
                @if (Session::has('result'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('result') !!}
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
                                <div id="dataTables-example_filter" class="dataTables_filter"></div>
                            </div>
                        </div>
                        <table aria-describedby="dataTables-example_info"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="dataTables-example">
                            <thead>
                            <tr role="row">
                                <th aria-label="S.No: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting_asc" aria-sort="ascending">S.No
                                </th>
                                <th aria-label="Display Name: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Display Name
                                </th>
                                <th aria-label="Organization: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Organization
                                </th>
                                <th aria-label="Title: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Title
                                </th>
                                <th aria-label="Web Address: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Web Address
                                </th>
                                <th aria-label="Phone: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Phone
                                </th>
                                <th aria-label="Address: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Address
                                </th>
                                <th aria-label="Store Logo: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Store Logo
                                </th>
                                <th aria-label="Actions: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Edit
                                </th>
                                <th aria-label="Actions: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Delete
                                </th>
                                <th aria-label="Hot deals: activate to sort column ascending"
                                    colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0" class="sorting">
                                    Block / Unblock
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            //print_r($store_return);exit();
                            foreach($store_return as $store_details){

                            ?>
                            <tr class="gradeA odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $store_details->stor_name; ?></td>
                                <td class="text-center"><?php echo $store_details->stor_org; ?></td>
                                <td class="text-center"><?php echo $store_details->stor_title; ?></td>
                                <td class="text-center"><?php echo $store_details->stor_website; ?></td>
                                <td class=" text-center"><?php echo $store_details->stor_phone; ?></td>
                                <td class="text-center">{!! $store_details->co_name !!}
                                    <br> {!! $store_details->st_name !!}  {!! $store_details->ci_name !!}
                                    <br><?php echo $store_details->stor_address1 . $store_details->stor_address2; ?>
                                </td>
                                <td class="text-center"><img
                                            src="<?php echo url('public/assets/images/storeimage') . "/" . $store_details->stor_img; ?>"
                                            height="45px"></td>
                                <td class="text-center"><a
                                            href="<?php echo url('edit_store/' . $store_details->stor_id . "_ ". $store_details->stor_merchant_id); ?>"><i
                                                class="icon icon-edit icon-2x"></i></a></td>
                                <td class="text-center">
                                    <a href="<?php echo url('delete_store/' . $store_details->stor_id . "/" . $store_details->stor_merchant_id); ?>">
                                        <i class="icon icon-trash icon-2x"></i>
                                    </a>
                                </td>
                                <td class="text-center ">

                                    <?php if($store_details->stor_status == 1) { ?>
                                    <a href="<?php echo url('block_store/' . $store_details->stor_id . "/0" . "/" . $store_details->stor_merchant_id); ?>"><i
                                                class="icon icon-ok icon-2x "></i></a> <?php } else if($store_details->stor_status == 0) { ?>
                                    <a href="<?php echo url('block_store/' . $store_details->stor_id . "/1" . "/" . $store_details->stor_merchant_id); ?>"><i
                                                class="icon icon-ban-circle icon-2x icon-me"></i></a>
                                    <?php } ?>


                                </td>

                            </tr>
                            <?php $i++; }  ?>
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div aria-relevant="all" aria-live="polite" role="alert"
                                 id="dataTables-example_info" class="dataTables_info"></div>
                        </div>
                        <div class="col-sm-6">
                            <div id="dataTables-example_paginate"
                                 class="dataTables_paginate paging_simple_numbers"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <a style="color:#fff" href="<?php echo url('manage_contributor'); ?>"
                               class="btn btn-warning btn-sm btn-grad">Back</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
