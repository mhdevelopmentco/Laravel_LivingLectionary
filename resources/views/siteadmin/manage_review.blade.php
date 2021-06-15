@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Review')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Manage Resource Reviews </a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5> Manage Resource Reviews </h5>

                </header>
                @if (Session::has('block_message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('block_message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    <div role="grid" class="dataTables_wrapper form-inline" id="dataTables-example_wrapper">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="dataTables-example_length">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter"></div>
                            </div>
                        </div>
                        <table id="dataTables-example"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               aria-describedby="dataTables-example_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1"
                                    colspan="1" style="width: 59px;"
                                    aria-label="S.No: activate to sort column ascending" aria-sort="ascending">
                                    S.No
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                    colspan="1" style="width: 76px;"
                                    aria-label="Store Name: activate to sort column ascending">Review Title
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                    colspan="1" style="width: 67px;"
                                    aria-label="Deals Name: activate to sort column ascending">Resource Name
                                </th>

                                <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                    colspan="1" style="width: 76px;"
                                    aria-label="Store Name: activate to sort column ascending">Member Name
                                </th>


                                <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                    colspan="1" style="width: 71px;"
                                    aria-label="Actions: activate to sort column ascending">Actions
                                </th>

                                <!-- <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 74px;" aria-label="Preview: activate to sort column ascending">Preview</th> -->

                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach($get_review as $row) {
                            ?>
                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $row->title; ?></td>
                                <td class="text-center"><?php echo substr($row->pro_title, 0, 45); ?></td>
                                <td class="text-center"><?php echo $row->mem_fname . ' ' . $row->mem_lname;?></td>
                                <td class="text-center">
                                    <a href="<?php echo url('edit_review/' . $row->comment_id); ?>"> <i
                                                class="icon icon-edit" style="margin-left:15px;"></i></a>
                                    <?php if($row->status == 0){?>
                                    <a href="<?php echo url('block_review/' . $row->comment_id . '/1');?>">
                                        <i
                                                style='margin-left:10px;' class='icon icon-ok icon-me'></i>
                                    </a>
                                    <?php } elseif($row->status == 1) { ?>
                                    <a href="<?php echo url('block_review/' . $row->comment_id . '/0');?>">
                                        <i
                                                style='margin-left:10px;'
                                                class='icon icon-ban-circle icon-me'></i> </a>
                                    <?php } ?>
                                    <a href="<?php echo url('delete_review') . "/" . $row->comment_id; ?>"><i
                                                class="icon icon-trash icon-1x"
                                                style="margin-left:14px;"></i>
                                    </a>
                                </td>

                            </tr>
                            <?php $i++;  }
                            ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="alert"
                                     aria-live="polite" aria-relevant="all"></div>
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
@endsection
