@extends('siteadmin.layout.admin_master')
@section('title', 'Shipping and Delivery')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Shipping and Delivery</a></li>
            </ul>
        </div>
    </div>

    {!! Form::open(array('url'=>'manage_product_shipping_details')) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        <br>
        <div class="col-sm-3">
            <div class="item form-group">
                <div class="col-sm-6">
                    <label for="from_date">From Date</label>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="from_date" class="form-control" id="from_date">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="item form-group">
                <div class="col-sm-6">
                    <label for="to_date">To Date</label>
                </div>
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
                    <h5> Shipping and Delivery Resources </h5>
                </header>
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

                                <th class="sorting_asc" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 59px;"
                                    aria-label="S.No: activate to sort column ascending"
                                    aria-sort="ascending">S.No
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 67px;"
                                    aria-label="Product Name: activate to sort column ascending">
                                    Resource
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 76px;"
                                    aria-label="Resource Image : activate to sort column ascending">
                                    Resource Image
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 67px;"
                                    aria-label="Resource Type: Link/Download/Ship">
                                    Resource Type
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 73px;"
                                    aria-label="Total Price($): activate to sort column ascending">
                                    Total Price($)
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 88px;"
                                    aria-label="Customer: activate to sort column ascending">
                                    Customer
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 88px;"
                                    aria-label="Contributor: activate to sort column ascending">
                                    Contributor
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 88px;"
                                    aria-label="Contributor: activate to sort column ascending">
                                    Store
                                </th>

                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 68px;"
                                    aria-label="Sold Date: activate to sort column ascending">
                                    Sold Date
                                </th>
                                <th class="sorting" tabindex="0"
                                    aria-controls="dataTables-example"
                                    rowspan="1" colspan="1" style="width: 68px;"
                                    aria-label="Delivered Status: activate to sort column ascending">
                                    Delivered Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;?>
                            @foreach($sold_products as $sold_product)
                                <tr class="gradeA odd">
                                    <td class="sorting_1"><?php echo $i; ?></td>
                                    <td class="text-center">{{substr($sold_product->product_name, 0, 20)}}</td>
                                    <td class="text-center">
                                        <img style="height:40px;"
                                             src="{{asset('public/assets/images/product').'/'.$sold_product->product_img}}">
                                    </td>
                                    <td class="text-center">{{$sold_product->product_type}}</td>
                                    <td class="text-center">
                                        $ {{$sold_product->product_subtotal+$sold_product->ship_amt}}
                                    </td>
                                    <td class="text-center">{{$sold_product->customer_name}}</td>
                                    <td class="text-center">{{$sold_product->contributor_name}}</td>
                                    <td class="text-center">{{$sold_product->store_name}}</td>
                                    <td class="text-center">{{$sold_product->created_at}}</td>
                                    <td class="text-center">
                                        @if($sold_product->ship_status == 1)
                                            <i class="glyphicon glyphicon-home"></i>
                                        @else
                                            <i class="glyphicon glyphicon-shopping-cart"></i>
                                        @endif
                                        {{$sold_product->ship_status_string}}
                                    </td>
                                </tr>
                                <?php  $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info"
                                     role="alert"
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
