@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Taxes')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage Taxes</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Taxes</h5>

                </header>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif


                <div class="accordion-body collapse in body" id="div-1">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
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
                                <tr>
                                    <th style="width: 100px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting_asc text-center"
                                        aria-sort="ascending">T.No
                                    </th>
                                    <th aria-label="Browser: activate to sort column ascending"
                                        style="width: 100px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting text-center">Country
                                    </th>
                                    <th aria-label="Browser: activate to sort column ascending"
                                        style="width: 100px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting text-center">State
                                    </th>
                                    <th aria-label="Browser: activate to sort column ascending"
                                        style="width: 200px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting text-center">Tax Amount (%)
                                    </th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($tax_details as $tax)
                                    <tr class="gradeA odd">
                                        <td class="text-center"><?php echo $i;?></td>
                                        <td class="text-center">{!! $tax->co_name !!}</td>
                                        <td class="text-center">{!! $tax->st_name !!}</td>
                                        <td class="text-center">{!! $tax->tax_amount !!}</td>
                                        <td class="text-center"><a
                                                    href="{!! url('edit_tax').'/'.$tax->tax_id!!}"><i
                                                        class="icon icon-edit icon-2x"></i></a></td>

                                        <td class="text-center"><?php if($tax->tax_status == 1){ ?><a
                                                    href="{!! url('status_tax_submit').'/'.$tax->tax_id.'/'.'0'!!}"
                                                    title="Block"><i class="icon icon-ok icon-2x"></i>
                                            </a> <?php } else { ?> <a
                                                    href="{!! url('status_tax_submit').'/'.$tax->tax_id.'/'.'1'!!}"
                                                    title="UnBlock">
                                                <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?>
                                        </td>
                                        <td class="text-center"><a
                                                    href="{!! url('delete_tax').'/'.$tax->tax_id!!}"><i
                                                        class="icon icon-trash icon-2x"></i></a></td>
                                    </tr>
                                    <?php $i++;?>
                                @endforeach
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
    </div>
@endsection
@section('script')
    <script>
    </script>
@endsection

