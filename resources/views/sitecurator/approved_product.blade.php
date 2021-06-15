@extends('sitecurator.layout.curator_master')
@section('title', 'Approved Resources')
@section('css')
    <style>
        .text-center a .icon {
            margin: 0 7px;
        }

        #dataTables-example th, #dataTables-example td {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Curator</a></li>
                <li class="active"><a> Approved Resources </a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5> Approved Resources </h5>
                </header>
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">

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
                        <table id="dataTables-example"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               aria-describedby="dataTables-example_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 59px;"
                                    aria-label="S.No: activate to sort column ascending"
                                    aria-sort="ascending">P.No
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 67px;"
                                    aria-label="Deals Name: activate to sort column ascending">Resource
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 76px;"
                                    aria-label="Store Name: activate to sort column ascending">Contributor
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 76px;"
                                    aria-label="Store Name: activate to sort column ascending">Store
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 76px;"
                                    aria-label=" Deal Image : activate to sort column ascending">
                                    Resource Image
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 71px;"
                                    aria-label="Actions: activate to sort column ascending">Actions
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 71px;"
                                    aria-label="Approved At: activate to sort column ascending">Approved At
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            if(count($products)>0){
                            foreach($products as $product) {
                                $product_get_img = explode('/**/', $product->pro_Img);
                            ?>
                            <tr class="gradeA odd">
                                <td class="sorting_1 text-center"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo substr($product->pro_title, 0, 45); ?></td>
                                <td class="text-center"><?php echo $product->mem_fname.' '.$product->mem_lname;?></td>
                                <td class="text-center"><?php echo $product->stor_name;?></td>
                                <td class="text-center"><a><img style="height:40px;"
                                                                src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $product_get_img[0]; ?>"></a>
                                </td>

                                <td class="text-center">

                                    <a href="<?php echo url('curator_check_resource/' . base64_encode($product->pro_id)); ?>">
                                        <i class="icon icon-search icon-2x"></i>
                                    </a>

                                    <a href="<?php echo url('curator_resource_details') . "/" . base64_encode($product->pro_id); ?>">
                                        <i class="icon icon-eye-open icon-2x"></i>
                                    </a>

                                </td>
                                <td class="text-center"><?php echo $product->approved_at;?></td>
                            </tr>
                            <?php $i++; }}
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
@endsection