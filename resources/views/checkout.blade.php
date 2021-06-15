@extends('includes/page_master')
@section('title', 'Checkout')
@section('css')
    <style>
        #cod_div {
            display: none;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="row">

            <ul class="breadcrumb">
                <li class="active">Home</li>
                <li class="active">Checkout</li>
            </ul>

            <?php
            $cart_data = $checkout_data['cart_data'];
            $count = count($cart_data);
            if($count != 0) {
            ?>

            <div class="row-fluid">
                @if($guest_checkout)
                    <h3 class="col-md-6">CHECKOUT<span class="sub">(Guest)</span></h3>
                @else
                    <h3 class="col-md-6">CHECKOUT</h3>
                @endif
                <div class="col-md-6">
                    <a href="<?php echo url('products'); ?>" class="btn btn-large me_btn res-cont2 pull-right ">
                        <i class="icon icon-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    {!! $message !!}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
                <?php Session::forget('success'); ?>
            @endif
            @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    {!! $message !!}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
                <?php Session::forget('error');?>
            @endif


            <div class="row-fluid" id="ship_info">
                {!! Form::Open(array('url' => 'process_checkout')) !!}
                <?php
                $ship_name = $ship_addr1 = $ship_addr2 = $ship_country = "";
                $ship_state = $ship_city = $ship_email = $ship_zipcode = $ship_phone = "";
                $ship_first_name = $ship_last_name = "";
                if (isset($shipping_addr_details) && count($shipping_addr_details) > 0) {
                    $ship_addr_det = $shipping_addr_details[0];
                    $ship_name = $ship_addr_det->ship_name;
                    $ship_name_arr = explode(' ', $ship_name);
                    $ship_first_name = $ship_name_arr[0];
                    $ship_last_name = substr($ship_name, strlen($ship_first_name));
                    $ship_last_name = ltrim($ship_last_name, ' ');
                    $ship_email = $ship_addr_det->ship_email;
                    $ship_addr1 = $ship_addr_det->ship_address1;
                    $ship_addr2 = $ship_addr_det->ship_address2;
                    $ship_country = $ship_addr_det->co_name;
                    $ship_state = $ship_addr_det->st_name;
                    $ship_city = $ship_addr_det->ci_name;
                    $ship_zipcode = $ship_addr_det->ship_zipcode;
                    $ship_phone = $ship_addr_det->ship_phone;
                }
                ?>

                <div class="row-fluid">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="shipping_addr_div">
                            <h5 class="panel-deal">DELIVERY INFORMATION</h5>

                            <input type="hidden" name="ship_needs" value="{{$ship_needs}}">

                            <?php if (!$ship_needs) $show_address = "hidden"; else $show_address = ""?>

                            <label class="control-label @if(!$cus_info) hidden @endif">
                                Load Details From
                                &emsp;<label class="span_lb"><input type="radio" name="shipping_addr"
                                                                    id="shipping_addr_2rad"
                                                                    onClick="load_addr_from_shipinfo(1)"
                                                                    value="profile" checked> Profile</label>
                                &emsp;<label class="span_lb"><input type="radio" name="shipping_addr"
                                                                    id="shipping_addr_1rad"
                                                                    onClick="load_addr_from_shipinfo(0)"
                                                                    value="ship"> Shipping Information</label>
                            </label>
                            <br>

                            @if( isset($cus_info) && count($cus_info)>0 )
                                <div class="row-fluid">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="load_ship" class="control-label">First Name<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="first_name"
                                                       value="{{$cus_info->mem_fname}}"
                                                       data-profile="{{$cus_info->mem_fname}}"
                                                       data-ship="{{$ship_first_name}}"
                                                       name="ship_first_name" placeholder=""
                                                       required
                                                       class="form-control">
                                                <input type="hidden" id="load_ship"
                                                       name="load_ship" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="load_ship" class="control-label">Last Name<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="last_name"
                                                       value="{{$cus_info->mem_lname}}"
                                                       data-profile="{{$cus_info->mem_lname}}"
                                                       data-ship="{{$ship_last_name}}"
                                                       required
                                                       name="ship_last_name" placeholder=""
                                                       class="form-control">
                                                <input type="hidden" id="load_ship"
                                                       name="load_ship" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="email">Email<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" class="form-control span" placeholder=""
                                                       required
                                                       id="email" name="ship_email" value="{{$cus_info->mem_email}}"
                                                       data-profile="{{$cus_info->mem_email}}"
                                                       data-ship="{{$ship_email}}">
                                            </div>
                                        </div>


                                        <div class="form-group {{$show_address}} ">
                                            <label class="control-label" for="phone1_line">Phone Number<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" class="form-control span" placeholder=""
                                                       name="ship_phone"
                                                       @if(isset($ship_needs) && $ship_needs)
                                                       required
                                                       @endif
                                                       value="{{$cus_info->mem_phone}}"
                                                       pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                                       title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"
                                                       data-profile="{{$cus_info->mem_phone}}"
                                                       data-ship="{{$ship_phone}}"
                                                       id="phone1_line" maxlength="10">
                                            </div>
                                        </div>

                                        <div class="form-group  {{$show_address}} ">
                                            <label class="control-label" for="zipcode">Zip Code</label>
                                            <div>
                                                <input type="text" class="form-control span" placeholder=""
                                                       id="zipcode" name="ship_zipcode"
                                                       value="{{$cus_info->mem_zipcode}}"
                                                       pattern="\d{5}([\-]\d{4})?"
                                                       title="xxxxx or xxxxx-xxxx"
                                                       data-profile="{{$cus_info->mem_zipcode}}"
                                                       data-ship="{{$ship_zipcode}}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6  {{$show_address}} ">

                                        <div class="form-group">
                                            <label class="control-label" for="country">Country<span
                                                        class="text-sub">*</span></label>
                                            <input type="text" id="country"
                                                   name="ship_country" placeholder=""
                                                   value="{{$cus_info->co_name}}"
                                                   data-profile="{{$cus_info->co_name}}"
                                                   data-ship="{{$ship_country}}"
                                                   @if(isset($ship_needs) && $ship_needs)
                                                   required
                                                   @endif
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="state">State<span
                                                        class="text-sub">*</span></label>
                                            <input type="text" id="state"
                                                   @if(isset($ship_needs) && $ship_needs)
                                                   required
                                                   @endif
                                                   name="ship_state" placeholder=""
                                                   value="{{$cus_info->st_name}}"
                                                   data-profile="{{$cus_info->st_name}}"
                                                   data-ship="{{$ship_state}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="city" class="control-label">City<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="city" name="ship_city"
                                                       value="{{$cus_info->ci_name}}"
                                                       @if(isset($ship_needs) && $ship_needs)
                                                       required
                                                       @endif
                                                       data-profile="{{$cus_info->ci_name}}"
                                                       data-ship="{{$ship_city}}"
                                                       placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="addr1" class="control-label">Address1<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="addr1"
                                                       name="ship_addr1" placeholder=""
                                                       value="{{$cus_info->mem_address1}}"
                                                       @if(isset($ship_needs) && $ship_needs)
                                                       required
                                                       @endif
                                                       data-profile="{{$cus_info->mem_address1}}"
                                                       data-ship="{{$ship_addr1}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="addr2" class="control-label">Address2</label>
                                            <div>
                                                <input type="text" id="addr2"
                                                       name="ship_addr2" placeholder=""
                                                       value="{{$cus_info->mem_address2}}"
                                                       data-profile="{{$cus_info->mem_address2}}"
                                                       data-ship="{{$ship_addr2}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="row-fluid">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="load_ship" class="control-label">First Name<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="first_name" required
                                                       value="{{$ship_first_name}}"
                                                       data-profile=""
                                                       data-ship="{{$ship_first_name}}"
                                                       name="ship_first_name" placeholder=""
                                                       class="form-control">
                                                <input type="hidden" id="load_ship"
                                                       name="load_ship" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="load_ship" class="control-label">Last Name<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="last_name" required
                                                       value="{{$ship_last_name}}"
                                                       data-profile=""
                                                       data-ship="{{$ship_last_name}}"
                                                       name="ship_last_name" placeholder=""
                                                       class="form-control">
                                                <input type="hidden" id="load_ship"
                                                       name="load_ship" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="email">Email<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" class="form-control span" placeholder=""
                                                       id="email" name="ship_email" value="{{$ship_email}}"
                                                       data-profile="" required
                                                       data-ship="{{$ship_email}}">
                                            </div>
                                        </div>

                                        <div class="form-group {{$show_address}}">
                                            <label class="control-label" for="phone1_line">Phone Number<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" class="form-control span" placeholder=""
                                                       name="ship_phone"
                                                       @if(isset($ship_needs) && $ship_needs)
                                                       required
                                                       @endif
                                                       value="{{$ship_phone}}"
                                                       pattern="\(?\d{3}\)?\s?[\-]?\d{3}[\-]?\d{4}"
                                                       title="(ddd) ddd-dddd or ddd-ddd-dddd or 7 digits"
                                                       data-profile=""
                                                       data-ship="{{$ship_phone}}"
                                                       id="phone1_line" maxlength="10">
                                            </div>
                                        </div>

                                        <div class="form-group {{$show_address}}">
                                            <label class="control-label" for="zipcode">Zip Code<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" class="form-control span" placeholder=""
                                                       id="zipcode" name="ship_zipcode" value="{{$ship_zipcode}}"
                                                       pattern="\d{5}([\-]\d{4})?"
                                                       title="xxxxx or xxxxx-xxxx"
                                                       data-profile=""
                                                       data-ship="{{$ship_zipcode}}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6 {{$show_address}}">

                                        <div class="form-group">
                                            <label class="control-label" for="country">Country<span
                                                        class="text-sub">*</span></label>
                                            <input type="text" id="country"
                                                   name="ship_country" placeholder=""
                                                   value="{{$ship_country}}"
                                                   data-profile=""
                                                   @if(isset($ship_needs) && $ship_needs)
                                                   required
                                                   @endif
                                                   data-ship="{{$ship_country}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="state">State<span
                                                        class="text-sub">*</span></label>
                                            <input type="text" id="state"
                                                   name="ship_state" placeholder=""
                                                   value="{{$ship_state}}"
                                                   data-profile=""
                                                   @if(isset($ship_needs) && $ship_needs)
                                                   required
                                                   @endif
                                                   data-ship="{{$ship_state}}"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="city" class="control-label">City<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="city" name="ship_city"
                                                       value="{{$ship_city}}"
                                                       data-profile=""
                                                       @if(isset($ship_needs) && $ship_needs)
                                                       required
                                                       @endif
                                                       data-ship="{{$ship_city}}"
                                                       placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="addr1" class="control-label">Address1<span
                                                        class="text-sub">*</span></label>
                                            <div>
                                                <input type="text" id="addr1"
                                                       name="ship_addr1" placeholder=""
                                                       value="{{$ship_addr1}}"
                                                       data-profile=""
                                                       @if(isset($ship_needs) && $ship_needs)
                                                       required
                                                       @endif
                                                       data-ship="{{$ship_addr1}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="addr2" class="control-label">Address2</label>
                                            <div>
                                                <input type="text" id="addr2"
                                                       name="ship_addr2" placeholder=""
                                                       value="{{$ship_addr2}}"
                                                       data-profile=""
                                                       data-ship="{{$ship_addr2}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- Payment Info -->
                        <div class="payment_select_div hidden">
                            <h5>Select Payment Method</h5>
                            <div class="paytype fieldset">
                                <?php if($checkout_data['total_price'] == 0) {?>
                                <label class="span_lb">
                                    <input type="radio" value="{{\App\Order::ORDER_TYPE_FREE}}"
                                           id="free_radio" name="select_payment_type" checked
                                           style="margin-top:-2px;"> Free
                                </label>
                                <?php  } else { ?>

                                <div class="paypal_pay col-md-6">
                                    <label class="span_lb">
                                        <input type="radio" checked value="{{\App\Order::ORDER_TYPE_PAYPAL}}"
                                               id="paypal_radio" name="select_payment_type"
                                               style="margin-top:-2px;">Paypal
                                    </label>
                                <!--img class="img-responsive" src="<?php echo url(); ?>/themes/images/paypal.png"-->
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">

                        <div class="shipping_addr_div">
                            <h5 class="panel-deal">ORDER SUMMARY [
                                <small style="color:white !important">
                                    <?php echo $count;?> Item(s)
                                </small>
                                ]
                            </h5>
                            <h4>Resource Details</h4>
                            <?php

                            $cart_data = $checkout_data['cart_data'];
                            $overall_pro_price = $checkout_data['subtotal_price'];
                            $overall_shipping_price = $checkout_data['shipping_price'];
                            $overall_tax = $checkout_data['tax_price'];
                            $overall_total_price = $checkout_data['total_price'];

                            foreach($cart_data as $cart_product)
                            {
                            $pid = $cart_product['pid'];
                            $q = $cart_product['qty'];
                            $pro_price = $cart_product['pro_price'];
                            $pro_title = $cart_product['pro_title'];
                            $product_img = $cart_product['pro_img'];
                            $pro_shippamt = $cart_product['pro_ship_amount'];
                            $item_total_price = $cart_product['pro_sub_total'];
                            ?>

                            <legend></legend>
                            <div class="row product_select" style="margin:0px auto"
                                 id="product_select_div<?php echo $pid;?>">
                                <div class="col-md-4 check-wid">
                                    <img src="<?php echo url('/public/assets/images/product') . '/' . $product_img; ?>"
                                         alt="<?php echo $pro_title; ?>" class="img-responsive"
                                         style="padding:10px">
                                </div>
                                <div class="col-md-8">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <?php echo $pro_title; ?>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <label>Quantity: <?php echo $q;?></label>
                                            </td>
                                            <td>
                                                <label>Price: <?php if ($pro_price > 0) {
                                                        echo '$' . $pro_price;
                                                    } else {
                                                        echo "Free";
                                                    } ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Shipping:
                                                    $<?php echo $pro_shippamt;?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="text-right">Sub Total:
                                                    $<?php echo $item_total_price;?></label>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <br>
                            <?php
                            }//end product exist in cart
                            ?>
                            <legend></legend>

                            <!--Total Statics-->
                            <div class="row-fluid">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label" for="text1">Order Subtotal:<span
                                                    class="text-sub">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label"
                                               for="text1">$ <?php echo($overall_pro_price);?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="text1" class="control-label">Order Shipping<span
                                                    class="text-sub">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="text1"
                                               class="control-label">$ <?php echo($overall_shipping_price);?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="text1" class="control-label">Order Tax<span
                                                    class="text-sub">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="text1"
                                               class="control-label"><?php echo ($tax) . ' %';?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="text1" class="control-label me_color">Order Total:<span
                                                    class="text-sub">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="total_price"
                                               class="control-label me_color">$ <?php echo $overall_total_price;?></label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="text-right">
                                <button type="submit" id="place_order_submit"
                                        class="btn btn-primary btn-sm btn-grad" style="color:#fff">Place Order
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

                <?php
                } // count! = 0
                else
                { //no items ?>
                <div class="span6">
                    <h3>Nothing to checkout</h3>
                </div>
                <?php } ?>
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script>

        function load_addr_from_shipinfo(val) {
            if (val == 0) {
                $('#ship_info input[type="text"]').each(function () {
                    $(this).val($(this).data("ship"));
                });
                $('#load_ship').val(0);
            } else {
                $('#ship_info input[type="text"]').each(function () {
                    $(this).val($(this).data("profile"));
                });
                $('#load_ship').val(1);
            }
        }

        $(document).ready(function () {

            $('#paypal_radio').click(function () {

                $('#paypal_div').show();
                $('#cod_div').hide();
            });

            $('#cod_radio').click(function () {

                $('#paypal_div').hide();
                $('#cod_div').show();
            });
        });
    </script>
@endsection



