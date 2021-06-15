@extends('includes/page_master')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row-fluid">

            <ul class="breadcrumb">
                <li><a>Home</a></li>
                <li class="active"><a>Cart</a></li>
            </ul>

            <?php
            $count = 0;
            if (isset($result_cart)) {
                $count = count($result_cart);
            }
            ?>

            <div class="row-fluid mob-text-center">
                <h3 class="col-xs-12"> Cart [
                    <small><?php echo $count; ?> Item(s)</small>
                    ]
                </h3>
            </div>

            <hr class="soft hide-mob"/>

            <div class="table-responsive hide-mob">
                <?php
                if($count != 0) {?>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Resource</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Quantity/Update</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $overall_total_price = 0;
                    $z = 0;
                    foreach($result_cart as $cproduct)
                    {
                    $z++;
                    $pid = $cproduct['pid'];
                    $q = $cproduct['qty'];
                    $product_title = $cproduct['pro_title'];
                    $product_price = $cproduct['pro_price'];
                    $product_img = $cproduct['pro_img'];
                    $item_total_price = $cproduct['pro_sub_total'];
                    $overall_total_price += $item_total_price;
                    ?>
                    <tr>
                        <td><?php echo $z;?> </td>
                        <td><?php echo $product_title; ?></td>
                        <td><img width="60"
                                 src="<?php echo url('/public/assets/images/product') . '/' . $product_img; ?>"
                                 alt="<?php echo $product_title; ?>"/></td>
                        <td>
                            <div class="input-append">
                                <input style="max-width:40px" id="pro_qty<?php echo $z; ?>" placeholder="" size="16"
                                       value="<?php echo $q; ?>" type="text">
                                <button class="btn" type="button"
                                        onClick="minus('<?php echo $z; ?>' , '<?php echo $pid; ?>')"><i
                                            class="icon-minus"></i></button>
                                <button class="btn" type="button"
                                        onClick="add('<?php echo $z; ?>', '<?php echo $pid; ?>')">
                                    <i class="icon-plus"></i></button>
                                <button class="btn btn-danger" type="button" onClick="del(<?php echo $pid?>)"><i
                                            class="icon-remove icon-white"></i></button>
                            </div>
                        </td>
                        <td><?php if ($product_price > 0) {
                                echo '$' . $product_price;
                            } else {
                                echo "Free";
                            }?></td>
                        <td><?php if ($item_total_price > 0) {
                                echo '$' . $item_total_price;
                            } else {
                                echo "Free";
                            }?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="100%" style="text-align:right"><strong>
                                Total : $<?php  echo $overall_total_price;?> </strong>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" style="display:none;">
                    <tr>
                        <th style="background: #1D84C1;color:white">ESTIMATE YOUR SHIPPING</th>
                    </tr>
                    <tr>
                        <td>
                            <form class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" for="inputPost" style="width:440px;">Check product
                                        availability at your location(Post Code/ Zipcode) </label>
                                    <div class="controls" style="margin-left:458px;">
                                        <input type="text" id="estimate_check_val" placeholder="ex: 641041">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls" style="margin-left:425px;">
                                        <button type="button" class="btn" id="estimate_check"
                                                style="background:#424542;color:white;text-shadow:none">Verify
                                        </button>
                                        <br>
                                        <div id="result_zip_code" style="margin-top:10px;"></div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
                <?php } else { ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>
                            No Items in cart...
                        </td>
                    </tr>
                    </thead>
                </table>
                <?php } ?>
            </div>

            <div class="show_mob" style="clear: both">
                <div class="row-fluid">
                    <?php
                    $overall_total_price = 0;
                    $z = 0;
                    foreach($result_cart as $cproduct)
                    {
                    $z++;
                    $pid = $cproduct['pid'];
                    $q = $cproduct['qty'];
                    $product_title = $cproduct['pro_title'];
                    $product_price = $cproduct['pro_price'];
                    $product_img = $cproduct['pro_img'];
                    $item_total_price = $cproduct['pro_sub_total'];
                    $overall_total_price += $item_total_price;
                    ?>

                    <div class="cart_product">
                        <h4><?php echo $z;?>: <?php echo $product_title; ?></h4>
                        <div>
                            <img src="<?php echo url('/public/assets/images/product') . '/' . $product_img; ?>"
                                 alt="<?php echo $product_title; ?>" class="img-responsive cart_product_img"/>
                        </div>
                        <div>
                            <div class="input-append">
                                <input style="max-width:40px" id="pro_qty<?php echo $z; ?>" placeholder="" size="16"
                                       value="<?php echo $q; ?>" type="text">
                                <button class="btn" type="button"
                                        onClick="minus('<?php echo $z; ?>' , '<?php echo $pid; ?>')"><i
                                            class="icon-minus"></i></button>
                                <button class="btn" type="button"
                                        onClick="add('<?php echo $z; ?>', '<?php echo $pid; ?>')">
                                    <i class="icon-plus"></i></button>
                                <button class="btn btn-danger" type="button" onClick="del(<?php echo $pid?>)"><i
                                            class="icon-remove icon-white"></i></button>
                            </div>
                        </div>
                        <p>Resource Price: <?php if ($product_price > 0) {
                                echo '$' . $product_price;
                            } else {
                                echo "Free";
                            }?></p>
                        <p>Item Total Price: <?php if ($item_total_price > 0) {
                                echo '$' . $item_total_price;
                            } else {
                                echo "Free";
                            }?></p>
                    </div>
                    <?php
                    }
                    ?>

                    <h4 class="text-center">Total Price: $<?php echo $overall_total_price;?></h4>
                </div>
            </div>

            <div class="row-fluid" id="cart_buttons">
                <div class="col-sm-6 col-xs-12">
                    <a href="<?php echo url('products'); ?>" class="btn btn-large btn-warning">
                        <i class="icon icon-arrow-left"></i>&emsp;Continue Shopping
                    </a>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <?php if(Session::has('customerid')) { ?>
                    <a href="<?php echo url('checkout');?>" class="btn btn-large pull-right btn-primary">
                        Proceed to Checkout&emsp;<i class="icon-shopping-cart"></i>
                    </a>
                    <?php } else { ?>
                    <a href="cart#login_for_checkout" data-toggle="modal" target="#login_for_checkout"
                       class="btn btn-large pull-right  btn-primary">
                        Proceed to Checkout&emsp;<i class="icon-shopping-cart"></i>
                    </a>
                    <?php } ?>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="<?php echo url(); ?>/public/plugins/plug-k/js/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo url(); ?>/public/plugins/plug-k/demo/js/demo.js " type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#return_url').val('<?php echo url('');?>/checkout');

            $('#estimate_check').click(function () {
                var estimate_check_val = $('#estimate_check_val').val();
                if (estimate_check_val == "") {
                    $('#estimate_check_val').css("border-color", "red");
                    $('#estimate_check_val').focus();
                } else if (isNaN(estimate_check_val)) {
                    $('#estimate_check_val').css("border-color", "red");
                    $('#estimate_check_val').focus();
                } else {
                    $('#estimate_check_val').css("border-color", "");
                    $('#result_zip_code');
                    var passData = 'estimate_check_val=' + estimate_check_val;
                    //alert(passData);
                    $.ajax({
                        type: 'GET',
                        data: passData,
                        url: '<?php echo url('check_estimate_zipcode'); ?>',
                        success: function (responseText) {
                            if (responseText != 0) {
                                $('#result_zip_code').html('<span style="color:green;margin-top:10px;" ><b>Product can be dispatched at your location in ' + responseText + ' bussiness days</b></span>');
                            } else {
                                $('#result_zip_code').html('<span style="color:red;margin-top:10px;" ><b>Sorry!! No dispatched item for your location</b></span>');
                            }
                        }
                    });
                }
                return false;
            });

        });

        function add(sno, pid) {
            var id = document.getElementById('pro_qty' + sno).value;
            document.getElementById('pro_qty' + sno).value = parseInt(id) + 1;
            var new_id = document.getElementById('pro_qty' + sno).value;
            var passData = 'id=' + new_id + '&pid=' + pid;
            $.ajax({
                type: 'GET',
                data: passData,

                url: '<?php echo url('set_quantity_session_cart'); ?>',
                success: function (responseText) {
                    window.location.href = 'cart';
                }
            });
            return false;
        }

        function minus(sno, pid) {
            var id = document.getElementById('pro_qty' + sno).value;
            if (id <= 10 && id > 0) {
                document.getElementById('pro_qty' + sno).value = parseInt(id) - 1;
                var new_id = document.getElementById('pro_qty' + sno).value;
                var passData = 'id=' + new_id + '&pid=' + pid;
                $.ajax({
                    type: 'GET',
                    data: passData,
                    url: '<?php echo url('set_quantity_session_cart'); ?>',
                    success: function (responseText) {
                        //alert(responseText);
                        window.location.href = 'cart';
                    }
                });
                return false;
            }
        }


        function del(id) {
            var passData = 'id=' + id;
            $.ajax({
                type: 'GET',
                data: passData,
                url: '<?php echo url('remove_session_cart_data'); ?>',
                success: function (responseText) {
                    window.location.href = 'cart';
                }
            });
            return false;
        }

        function add_dealcart(sno, pid, max_deal_qty) {
            var id = document.getElementById('pro_qty' + sno).value;
            if (id < max_deal_qty) {
                document.getElementById('pro_qty' + sno).value = parseInt(id) + 1;
                var new_id = document.getElementById('pro_qty' + sno).value;
                var passData = 'id=' + new_id + '&pid=' + pid;
                $.ajax({
                    type: 'GET',
                    data: passData,
                    url: '<?php echo url('set_quantity_session_dealcart'); ?>',
                    success: function (responseText) {
                        window.location.href = 'cart';
                    }
                });
                return false;
            }
        }

        function minus_dealcart(sno, pid) {
            var id = document.getElementById('pro_qty' + sno).value;
            if (id <= 10 && id > 0) {
                document.getElementById('pro_qty' + sno).value = parseInt(id) - 1;
                var new_id = document.getElementById('pro_qty' + sno).value;
                var passData = 'id=' + new_id + '&pid=' + pid;
                $.ajax({
                    type: 'GET',
                    data: passData,
                    url: '<?php echo url('set_quantity_session_dealcart'); ?>',
                    success: function (responseText) {
                        window.location.href = 'cart';
                    }
                });
                return false;
            }
        }

        function del_dealcart(id) {
            var passData = 'id=' + id;
            $.ajax({
                type: 'GET',
                data: passData,
                url: '<?php echo url('remove_session_dealcart_data'); ?>',
                success: function (responseText) {
                    window.location.href = 'cart';
                }
            });
            return false;
        }

    </script>
@endsection

