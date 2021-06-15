@extends('sitemerchant.layout.merchant_master')
@section('title', 'Manage Product')
@section('css')
    <style>
        .text-center a .icon {
            margin: 0 7px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Manage Resources </a></li>
            </ul>
        </div>
    </div>
    @if( isset($type) && ($type == 1))
        {!! Form::open(array('url'=>'mer_manage_pending_approved_product', 'class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
    @else
        {!! Form::open(array('url'=>'mer_manage_disapproved_product', 'class'=>'form-horizontal','enctype'=>'multipart/form-data')) !!}
    @endif
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        <br>
        <div class="col-sm-3">
            <div class="item form-group">
                <label for="from_date">From Date</label>
                <div class="col-sm-6">
                    <input type="text" name="from_date" class="form-control" id="from_date" required>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="item form-group">
                <label for="to_date">To Date</label>
                <div class="col-sm-6">
                    <input type="text" name="to_date" id="to_date" class="form-control">

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-block btn-success" value="Search">
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5> Manage Resources </h5>
                </header>
                @if ($errors->any())
                    <br>
                    <ul class="alert alert-danger alert-dismissable">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </ul>
                @endif
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
                                    aria-sort="ascending">S.No
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 67px;"
                                    aria-label="Deals Name: activate to sort column ascending">Resource
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 73px;"
                                    aria-label="Original Price($): activate to sort column ascending">
                                    Original Price($)
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 73px;"
                                    aria-label="Resource Type($): activate to sort column ascending">
                                    Resource Type
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
                                    aria-label="Trend: activate to sort column ascending">Trend
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 71px;"
                                    aria-label="Trend: activate to sort column ascending">Checked By
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 71px;"
                                    aria-label="Trend: activate to sort column ascending">Present for Subscriber
                                </th>

                                <!-- <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 74px;" aria-label="Preview: activate to sort column ascending">Preview</th> -->
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 68px;"
                                    aria-label="Deal details: activate to sort column ascending">Resource
                                    details
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            foreach($products as $product) {
                            if($product->pro_no_of_purchase < 1)
                            {
                            $product_get_img = explode("/**/", $product->pro_Img);

                            $kind = $product->pro_content_kind;
                            if ($kind == 1) {
                                $kind = "Tangible";
                            } else if ($kind == 2) {
                                $kind = "Downloadable";
                            } else {
                                $kind = "Linked";
                            }

                            ?>
                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i; ?></td>
                                <td class="  "><?php echo substr($product->pro_title, 0, 45); ?></td>
                                <td class="text-center"><?php echo $kind;?></td>
                                <td class="text-center"><?php echo $product->pro_price; ?></td>
                                <td class="text-center"><a><img style="height:40px;"
                                                                src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $product_get_img[0]; ?>"></a>
                                </td>
                                <td class="text-center action_td">
                                    <a href="<?php echo url('mer_edit_product/' . $product->pro_id); ?>">
                                        <i class="icon icon-edit"></i>
                                    </a>
                                    <a href="<?php echo url('mer_delete_product') . "/" . $product->pro_id; ?>">
                                        <i class="icon icon-trash icon-1x"></i>
                                    </a>
                                </td>

                                <td class="text-center">
                                    <?php if($product->pro_trending) {?>
                                    <a href="<?php echo url('mer_set_trending_product') . '/' . $product->pro_id . '/' . '0'; ?>">
                                        <i class="icon-heart icon-1x icon-me"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="<?php echo url('mer_set_trending_product') . '/' . $product->pro_id . '/' . '1'; ?>">
                                        <i class="icon-heart icon-1x"></i>
                                    </a>
                                    <?php } ?>
                                </td>

                                <td class="text-center">
                                    <?php
                                    $pro_checker = $product->pro_checked_by;
                                    if ($pro_checker == '-1') {
                                        echo 'Pending';
                                    } else {
                                        $curator = \App\Curator::find($pro_checker);
                                        if ($curator) {
                                            echo $curator->curator_name;
                                        }
                                    }
                                    ?>
                                </td>

                                <td class="text-center">
                                    <?php if($product->pro_present) {?>
                                    <a href="<?php echo url('mer_set_present_product') . '/' . $product->pro_id . '/' . '0'; ?>">
                                        <i class="icon-star icon-1x icon-me"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="<?php echo url('mer_set_present_product') . '/' . $product->pro_id . '/' . '1'; ?>">
                                        <i class="icon-star icon-1x"></i>
                                    </a>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo url('mer_product_details') . "/" . base64_encode($product->pro_id); ?>">View
                                        details</a>
                                </td>
                            </tr>
                            <?php $i++; }
                            }   ?>
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