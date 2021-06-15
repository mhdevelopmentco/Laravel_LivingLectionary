@extends('siteadmin.layout.admin_master')
@section('title', '')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Manage Estimated Zip Code</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Estimated Zip Code</h5>
                </header>
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    <div role="grid" class="dataTables_wrapper form-inline" id="dataTables-example_wrapper">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="dataTables-example_length"><label></label></div>
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
                                <th aria-label="Rendering engine: activate to sort column ascending"
                                    style="width: 100px;" colspan="1" rowspan="1" aria-controls="dataTables-example"
                                    tabindex="0" class="sorting_asc" aria-sort="ascending">S.No
                                </th>
                                <th aria-label="Browser: activate to sort column ascending" style="width: 100px;"
                                    colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Zip Code Range
                                </th>
                                <th aria-label="Browser: activate to sort column ascending" style="width: 100px;"
                                    colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Delivery Days
                                </th>
                                <th aria-label="Platform(s): activate to sort column ascending"
                                    style="width: 100px;" colspan="1" rowspan="1" aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Status
                                </th>
                                <th aria-label="CSS grade: activate to sort column ascending" style="width: 100px;"
                                    colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Actions
                                </th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach($zipcode as $postcode) {
                            ?>
                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $postcode->ez_code_series; ?>
                                    - <?php echo $postcode->ez_code_series_end; ?></td>
                                <td class="text-center"><?php echo $postcode->ez_code_days; ?></td>
                                <td class="text-center">
                                    <?php if ($postcode->ez_status == 1) { echo 'Activated' ;} else { echo "Deactivated"; }; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo url('edit_zipcode/' . $postcode->ez_id); ?>"><i
                                                class="icon icon-edit icon-2x " style="margin-left:15px;"></i></a>
                                    @if ($postcode->ez_status == 1)
                                        <a href="<?php echo url('block_zipcode/' . $postcode->ez_id.'/0'); ?>"><i style='margin-left:10px;' class='icon icon-2x  icon-ok icon-me'></i> </a>
                                    @else
                                        <a href="<?php echo url('block_zipcode/' . $postcode->ez_id.'/1'); ?>"><i style='margin-left:10px;' class='icon icon-2x  icon-ban-circle icon-me'></i> </a>
                                    @endif

                                    <a href="<?php echo url('remove_zipcode/' . $postcode->ez_id); ?>"><i style='margin-left:10px;' class='icon icon-2x icon-trash'></i></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="alert"
                                     aria-live="polite" aria-relevant="all"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="dataTables-example_paginate">
                                    <ul class="pagination"></ul>
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
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

@endsection

