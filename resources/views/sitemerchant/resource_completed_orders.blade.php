@extends('sitemerchant.layout.merchant_master')
@section('title', 'Resource Completed Orders')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Completed Orders</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        {!! Form::open(['action'=>'MerchantController@resource_completed_orders']) !!}
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

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

        {!! Form::close() !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Resource Completed Orders</h5>
                </header>

                <div id="div-1" class="accordion-body collapse in body">
                    <div role="grid" class="dataTables_wrapper form-inline"
                         id="dataTables-example_wrapper">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="dataTables-example_length">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                </div>
                            </div>
                        </div>
                        <table id="dataTables-example"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               aria-describedby="dataTables-example_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="S.No: activate to sort column ascending"
                                    aria-sort="ascending">O.No
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Name: activate to sort column ascending">
                                    Customer Name
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Email: activate to sort column ascending">
                                    Customer Email
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="1"
                                    colspan="4"
                                    aria-label="City: activate to sort column ascending">
                                    Resource List
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Joined Date: activate to sort column ascending">
                                    Order Type
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Send Mail: activate to sort column ascending">
                                    Shipped
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Edit: activate to sort column ascending">
                                    Get Paid
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Status: activate to sort column ascending">
                                    Completed
                                </th>
                                <th class="sorting text-center" tabindex="0"
                                    aria-controls="dataTables-example" rowspan="2"
                                    colspan="1"
                                    aria-label="Status: activate to sort column ascending">
                                    Created At
                                </th>
                            </tr>
                            <tr role="row">
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Resource Type</th>
                                <th class="text-center">Resource Img</th>
                                <th class="text-center">Resource Delieverd Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @forelse($orders as $order)
                                <?php
                                $order_merchant_products = $order->get_products_by_merchant($merchant_id);
                                $row_span_count = count($order_merchant_products);
                                $first = true;
                                ?>
                                @foreach( $order_merchant_products as $product)
                                    @if($first)
                                        <tr class="gradeA odd">
                                            <td class="text-center" rowspan="{{$row_span_count}}">{{$i}}</td>
                                            <td class="text-center"
                                                rowspan="{{$row_span_count}}">{{$order->order_cus_name}}</td>
                                            <td class="text-center"
                                                rowspan="{{$row_span_count}}">{{$order->order_cus_email}}</td>
                                            <td class="text-center">
                                                {{$product->product_name}}
                                            </td>
                                            <td class="text-center">
                                                {{$product->product_type}}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{asset('/public/assets/images/product/').'/'.$product->product_img}}"
                                                     style="max-width: 80px;" class="img-responsive">
                                            </td>
                                            <td class="text-center">
                                                @if($product->ship_status == 1)
                                                    <i class="glyphicon glyphicon-home"></i>
                                                    {{$product->ship_status_string}}
                                                @else
                                                    <a href="{{url('report_as_delivered').'/'.$sold_product->id}}">
                                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                                        {{$product->ship_status_string}}
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center" rowspan="{{$row_span_count}}">
                                                {{$order->type_name}}
                                            </td>

                                            <td class="text-center" rowspan="{{$row_span_count}}">
                                                @if($order->get_shipping_status_merchant($merchant_id))
                                                    <i class="icon-ok"></i>
                                                @else
                                                    <i class="icon-remove"></i>
                                                @endif
                                            </td>

                                            <td class="text-center" rowspan="{{$row_span_count}}">
                                                @if($order->get_payout_status_merchant($merchant_id))
                                                    <i class="icon-ok"></i>
                                                @else
                                                    <i class="icon-remove"></i>
                                                @endif
                                            </td>

                                            <td class="text-center" rowspan="{{$row_span_count}}">
                                                @if($order->order_status)
                                                    <i class="icon-ok"></i>
                                                @else
                                                    <i class="icon-remove"></i>
                                                @endif
                                            </td>

                                            <td class="text-center"
                                                rowspan="{{$row_span_count}}">{{$order->created_at}}</td>

                                        </tr>
                                        <?php
                                        $i++;
                                        $first = false;
                                        ?>
                                    @else
                                        <tr class="gradeA odd">
                                            <td class="text-center">
                                                {{$product->product_name}}
                                            </td>
                                            <td class="text-center">
                                                {{$product->product_type}}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{asset('/public/assets/images/product/').'/'.$product->product_img}}"
                                                     style="max-width: 80px;" class="img-responsive">
                                            </td>
                                            <td class="text-center">
                                                @if($product->ship_status == 1)
                                                    <i class="glyphicon glyphicon-home"></i>
                                                    {{$product->ship_status_string}}
                                                @else
                                                    <a href="{{url('report_as_delivered').'/'.$sold_product->id}}">
                                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                                        {{$product->ship_status_string}}
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @empty
                            @endforelse
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
