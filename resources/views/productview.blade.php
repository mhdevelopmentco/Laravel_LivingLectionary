@extends('includes/page_master')
@section('title', 'Product')
@section('css')
    <link type="text/css" rel="stylesheet" href="<?php echo url('');?>/public/plugins/magiczoomplus/magiczoomplus.css">
    <style>
        .mz-active span a, .mz-active div a {
            opacity: 0;
            display: none !important;

        }

        .mz-expand span a, .mz-expand div a {
            opacity: 0;
            display: none !important;
        }
    </style>
@endsection
@section('content')

    <?php
    $loggedin = 0;
    $origin_price_class = $discounted_price_class = "";
    $subscribe = 0;
    $free = false;

    if (Session::has('customerid')) {
        $loggedin = 1;

        $subscribe = Session::get('subscribe');

        if ($subscribe == 1) {
            $origin_price_class = "text-through";

            if ($product_details_by_id->pro_present == 1) {
                $discounted_price_class = "text-through";
                $free = true;
            }

        } else {
            $discounted_price_class = "text-through";
        }
    }
    ?>
    <div class="container">
        <div class="row-fluid">
            <!-- Sidebar ================================================== -->
            <div id="sidebar" class="col-md-3 col-sm-3 col-xs-12 pull-right">

                <div class="well well-small btn-warning"><strong>Related Resources</strong></div>
                <div class="row-fluid">
                    <ul class="thumbnails">
                        <?php if($get_related_product){
                        foreach($get_related_product as $product_det){
                        $res = base64_encode($product_det->pro_id);
                        $product_image = explode('/**/', $product_det->pro_Img);
                        ?>
                        <li class="col-sm-12">
                            <div class="thumbnail">
                                <a href="{!! url('productview').'/'.$res!!}">
                                    <img class="" alt=""
                                         src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>">
                                </a>
                                <div class="caption product_show">
                                    <h3 class="prev_text"><?php echo substr($product_det->pro_title, 0, 20);?></h3>
                                    <?php
                                    if ($loggedin == 0) {?>
                                    <h4 class="top_text dolor_text">
                                        <?php
                                        if ($product_det->pro_price == 0)
                                            echo "FREE";
                                        else
                                            echo '$ ' . $product_det->pro_price;
                                        ?>
                                    </h4>
                                    <?php } else {
                                    if ($product_det->pro_price == 0) {?>
                                    <h4 class="top_text dolor_text"> Free </h4>
                                    <?php } else {?>
                                    <h4 class="top_text dolor_text">
                                        <span class="{!! $origin_price_class !!}"> {!! '$ '.$product_det->pro_price !!} </span>
                                        &emsp;
                                        <span class="{!! $discounted_price_class !!}"> {!! '$ '. round($product_det->pro_price*0.7, 2) !!} </span>
                                    </h4>
                                    <?php } ?>
                                    <?php }?>

                                </div>
                            </div>
                        </li>
                        <?php }
                        }?>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar end=============================================== -->

            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="clearfix"></div>

                <!--Bread Crumb-->
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('index');?>">Home</a></li>
                    <li><a href="<?php echo url('products');?>">Resources</a></li>
                    <?php
                    $pass_cat_id1 = "1," . $product_details_by_id->pro_mc_id;
                    $pass_cat_id2 = "2," . $product_details_by_id->pro_smc_id;
                    $pass_cat_id3 = "3," . $product_details_by_id->pro_sb_id;
                    $pass_cat_id4 = "4," . $product_details_by_id->pro_ssb_id;
                    ?>
                    <?php if($product_details_by_id->mc_name != '') { ?>
                    <li>
                        <a href="<?php echo url('catproducts/viewcategorylist/' . base64_encode($pass_cat_id1) . '');?>"><?php echo ucwords(strtolower($product_details_by_id->mc_name)); ?></a>
                    </li>
                    <?php }?>
                    <?php if($product_details_by_id->smc_name != '') {?>
                    <li>
                        <a href="<?php echo url('catproducts/viewcategorylist/' . base64_encode($pass_cat_id2) . '');?>"><?php echo ucwords(strtolower($product_details_by_id->smc_name)); ?></a>
                    </li>
                    <?php } ?>
                    <?php if ($product_details_by_id->sb_name != '') { ?>
                    <li>
                        <a href="<?php echo url('catproducts/viewcategorylist/' . base64_encode($pass_cat_id3) . '');?>"><?php echo ucwords(strtolower($product_details_by_id->sb_name)); ?></a>
                    </li>
                    <?php } ?>
                    <?php if ($product_details_by_id->ssb_name != '') { ?>
                    <li>
                        <a href="<?php echo url('catproducts/viewcategorylist/' . base64_encode($pass_cat_id4) . '');?>"><?php echo ucwords(strtolower($product_details_by_id->ssb_name)); ?></a>
                    </li>
                    <?php } ?>
                    <li class="active"><?php echo $product_details_by_id->pro_title; ?></li>
                </ul>

                <div class="row-fluid">

                    <!--Resource Image and Zoomer-->
                    <?php
                    $product_img = explode('/**/', trim($product_details_by_id->pro_Img, "/**/"));
                    $img_count = count($product_img);
                    ?>
                    <div class="col-md-4 text-center">
                        <a id="Zoomer3"
                           href="{{ url('public/assets/images/product').'/'.$product_img[0] }}"
                           class="MagicZoomPlus"
                           data-options="selectorTrigger: hover; transitionEffect: false;"
                           title="<?php echo $product_details_by_id->pro_title; ?>">
                            <img src="{!! url('public/assets/images/product').'/'.$product_img[0]!!}"/>
                        </a>
                        <br/>
                        <div class="row-fluid">
                            <?php for($i = 0;$i < $img_count;$i++) { ?>
                            <div class="col-xs-4 no-pad-small">
                                <a data-zoom-id="Zoomer3"
                                   href="{!! url('public/assets/images/product').'/'.$product_img[$i]!!}"
                                   data-image="{!! url('public/assets/images/product').'/'.$product_img[$i]!!}">
                                    <img src="{!! url('public/assets/images/product').'/'.$product_img[$i]!!}"
                                         style="height:auto"/></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--Resources Detail s-->
                    <div class="col-md-8 tab-produ-view">
                        <!--Product Name-->
                        <h3><?php echo $product_details_by_id->pro_title; ?></h3>

                    <!--Product Rating
                        <?php
                    $product_count = $one_count + $two_count + $three_count + $four_count + $five_count;

                    $multiple_countone = $one_count * 1;
                    $multiple_counttwo = $two_count * 2;
                    $multiple_countthree = $three_count * 3;
                    $multiple_countfour = $four_count * 4;
                    $multiple_countfive = $five_count * 5;

                    $product_total_count = $multiple_countone + $multiple_counttwo + $multiple_countthree + $multiple_countfour + $multiple_countfive;

                    if($product_count)
                    {
                    $product_divide_count = $product_total_count / $product_count;

                    if($product_divide_count <= 1) {?>
                            Ratings: <img src='<?php echo url('images/stars-1.png'); ?>'>
                        <?php } elseif($product_divide_count >= 5) { ?>
                            Ratings: <img src='<?php echo url('public/assets/images/stars-5.png'); ?>'>
                        <?php } elseif($product_divide_count >= 4) { ?>
                            Ratings: <img src='<?php echo url('public/assets/images/stars-4.png'); ?>'>
                        <?php } elseif($product_divide_count >= 3) { ?>
                            Ratings: <img src='<?php echo url('public/assets/images/stars-3.png'); ?>'>
                        <?php } elseif($product_divide_count >= 2) { ?>
                            Ratings: <img src='<?php echo url('public/assets/images/stars-2.png'); ?>'>
                        <?php } elseif($product_divide_count >= 1) { ?>
                            Ratings: <img src='<?php echo url('public/assets/images/stars-1.png'); ?>'>
                        <?php } else {
                        echo "<br/>No Rating for this Product";
                    }
                    } else {
                        echo "<br/>No Rating for this Product";
                    }?>

                            <br>
                            -->
                        <hr class="soft"/>

                        {!! Form :: open(array('url' => 'add_to_cart','class'=>'form-horizontal qtyFrm','enctype'=>'multipart/form-data')) !!}

                        <input type="hidden" name="addtocart_pro_id"
                               value="<?php echo $product_details_by_id->pro_id; ?>"/>
                        <div class="control-group">
                            <label class="control-label col-md-6">
                                Resource Price<br>
                                <span class="price_txt {!! $origin_price_class !!}">$<?php echo $product_details_by_id->pro_price; ?></span>
                            </label>

                            <!--label class="control-label col-md-6">
                                Discounted Price for Subscriber<br>
                                <span class="price_txt  {!! $discounted_price_class !!}">$<?php echo round(($product_details_by_id->pro_price) * 0.7, 2); ?></span>
                            </label-->
                        </div>

                        <?php if($free) {?>
                        <p class="price_txt col-md-12" style="margin-top:20px;">As you are subscriber, This is Free for you!</p>
                        <?php }?>

                        <hr class="soft"/>

                        <span id="addtocart_qty_error" style="color:red;"></span>

                        <div class="control-group row-fluid">
                            <label class="control-label" for="addtocart_qty">Quantity:&emsp;</label>
                            <?php if($free) {?>
                            <input type="number" name="addtocart_qty" id="addtocart_qty" readonly
                                   placeholder="Qty." value="1" min="1" step="1" max="1"/>
                            <?php }  else { ?>
                            <input type="number" name="addtocart_qty" id="addtocart_qty"
                                   placeholder="Qty." value="1" min="1" step="1"/>
                            <?php } ?>
                        </div>

                        <div class="row-fluid">
                            <div class="pull-right" style="margin-left:20px;">

                                <button type="submit" class="btn btn-primary" id="add_to_cart_session">
                                    <i class="icon icon-shopping-cart"></i> Add to cart
                                </button>
                                {!! Form::close() !!}
                            </div>

                            <div class="pull-right">
                                <!-- Add to Wishlist-->
                                {!! Form :: open(array('url' => 'addtowish','class'=>'form-horizontal qtyFrm','enctype'=>'multipart/form-data')) !!}

                                <?php if(Session::has('customerid')) {?>
                                <input type="hidden" name="pro_id"
                                       value="<?php echo $product_details_by_id->pro_id; ?>">
                                <input type="hidden" name="mem_id" value="<?php echo Session::get('customerid');?>">
                                <button type="submit" class="btn btn-danger" id="login_a_click" name="submit">
                                    <i class="icon icon-heart" aria-hidden="true" style="padding-top: 3px;"></i> Add to
                                    Wishlist
                                </button>
                                <?php } else { ?>
                                <a href="#login" role="button" data-toggle="modal">
                                    <button class="btn btn-danger" id="login_a_click" value="Login">
                                        <i class="icon icon-heart" aria-hidden="true" style="padding-top: 3px;"></i> Add
                                        to Wishlist
                                    </button>
                                </a>
                                <?php }?>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <hr class="soft clr"/>
                </div>


                <div class="row-fluid">
                    <div class="col-md-12 pull-left table-responsive">
                        <!--Product Information-->
                        <table class="table table-bordered">
                            <tbody>
                            <tr class="techSpecRow">
                                <th colspan="2">Resource Information</th>
                            </tr>
                            <tr>
                                <td><?php echo $product_details_by_id->pro_desc; ?></td>
                            </tr>
                            </tbody>
                        </table>

                    <?php
                    foreach ($get_store as $storerow) {
                    $store_name = $storerow->stor_name;

                    $store_address = $storerow->stor_address1;
                    $store_address2 = $storerow->stor_address2;

                    $store_zip = $storerow->stor_zipcode;
                    $store_phone = $storerow->stor_phone;
                    $store_web = $storerow->stor_website;
                    $store_lat = $storerow->stor_latitude;
                    $store_lan = $storerow->stor_longitude;
                    ?>

                    <!-- Product Store Details -->
                        <table class="table table-bordered" style="display: none;">
                            <tbody>
                            <tr class="techSpecRow">
                                <th colspan="2">Store Details</th>
                            </tr>
                            <tr>
                                <td class="hide-mob col-md-6">
                                    <div id="us3"
                                         style="width: 100% !important; height: 240px;margin-bottom:10px;"></div>
                                </td>
                                <td class="col-md-6">


                                    <a title="View Store" target="_blank"
                                       href="<?php echo url('storeview/' . base64_encode(base64_encode(base64_encode($storerow->stor_id)))); ?>">
                                        <h4><?php echo $store_name; ?></h4>
                                    </a>

                                    <?php if ($store_address) {
                                        echo $store_address . '<br>';
                                    } ?>

                                    <?php if ($store_address2) {
                                        echo $store_address2 . '<br>';
                                    }?>

                                    <?php if ($store_zip) {
                                        echo $store_zip . '<br>';
                                    }?>
                                    Mobile:&emsp; <?php echo $store_phone; ?>
                                    <br>
                                    Website:&emsp; <?php echo $store_web; ?>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    <?php } ?>


                    <!--Show Comment -->
                        <?php if(Session::has('customerid'))
                        {
                        ?>
                        <div style="border-radius:3px; border:1px solid #ccc;">
                            <h4 style="padding-left:13px;">Write a post comments</h4>
                            <div class="row-fluid">
                                <div class="col-md-6">

                                    {!! Form::open(array('url'=>'productcomments','class'=>'form-horizontal loginFrm')) !!}
                                    <input type="hidden" name="customer_id"
                                           value="<?php echo Session::get('customerid');?>">
                                    <input type="hidden" name="product_id" value="{!!$product_details_by_id->pro_id!!}">
                                    <div class="control-group">
                                        <input type="text" placeholder="Enter Comment Title" name="title"
                                               class="input-xlarge" style="width:100%" required/>
                                    </div>
                                    <div class="control-group">
                                        <textarea rows="5" name="comments" class="input-xlarge" style="width:100%"
                                                  placeholder="Enter Comments Queries" required></textarea>
                                    </div>
                                    <div class="control-group">
                                        <input type="radio" name="ratings" value="1" required/>1 Star
                                        <input type="radio" name="ratings" value="2" required/>2 Star
                                        <input type="radio" name="ratings" value="3" required/>3 Star
                                        <input type="radio" name="ratings" value="4" required/>4 Star
                                        <input type="radio" name="ratings" value="5" required/>5 Star
                                    </div>
                                    <div class="control-group">
                                        <input type="submit" class="btn btn-large me_btn btnb-success"
                                               value="Post Comments"
                                               style="background: #2F3234; border-radius: 0px;"/>
                                    </div>
                                    {!! Form :: close()  !!}
                                </div>
                            </div>
                        </div>
                        <?php }?>

                        <br class="clr">
                        <!-- Show Reviews-->
                        <h4>Reviews</h4>
                        <?php
                        if($product_count >= 1)
                        {
                        foreach ($review_comments as $col) {
                        $customer_name = $col->mem_fname . ' ' . $col->mem_lname;
                        $customer_mail = $col->mem_email;
                        $customer_img = $col->mem_pic;
                        $customer_comments = $col->comments;
                        $customer_date = $col->created_date;
                        $customer_product = $col->product_id;
                        $customer_title = $col->title;
                        $customer_name_arr = str_split($customer_name);
                        $start_letter = $customer_name_arr[0];
                        $customer_ratings = $col->ratings;

                        $change_format = date('d/m/Y', strtotime($col->created_date));
                        $date_exp = explode('/', $change_format);
                        $date_date = $date_exp[0];
                        $date_month = $date_exp[1];
                        $date_year = $date_exp[2];

                        ?>

                        <div class="commentlist">
                            <?php if ($start_letter == 'a') {
                                echo "<div class='userimg'><span class='reviewer-imgName' style='background:#fba565; text-transform:capitalize;'>$customer_name_arr[0]</span>";
                            } elseif ($start_letter == 'b') {
                                echo "<div class='userimg'><span class='reviewer-imgName' style='background:#fba565; text-transform:capitalize;'>$customer_name_arr[0]</span>";
                            } elseif ($start_letter == 'c') {
                                echo "<div class='userimg'><span class='reviewer-imgName' style='background:#fba565; text-transform:capitalize;'>$customer_name_arr[0]</span>";
                            } elseif ($start_letter == 'd') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'e') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'f') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'g') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'h') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'i') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'j') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'k') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'm') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'n') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'o') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'p') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'q') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'r') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 's') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 't') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'u') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'v') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'w') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'x') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'y') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } elseif ($start_letter == 'z') {
                                echo "<div class='userimg'><center><span class='reviewer-imgName' style='background:#191d86; text-transform:capitalize;'>$customer_name_arr[0]</center></span>";
                            } else {
                            }
                            ?>
                            <span class="_reviewUserName text-center" title="Prateek"
                                  style="text-transform:capitalize;"><?php echo $customer_name; ?></span>
                        </div>

                        <div class="text">
                            <div class="user-review">
                                <?php
                                if ($date_month == '01') {
                                    $month = 'Jan';
                                } elseif ($date_month == '02') {
                                    $month = 'Feb';
                                } elseif ($date_month == '03') {
                                    $month = 'March';
                                } elseif ($date_month == '04') {
                                    $month = 'April';
                                } elseif ($date_month == '05') {
                                    $month = 'May';
                                } elseif ($date_month == '06') {
                                    $month = 'June';
                                } elseif ($date_month == '07') {
                                    $month = 'July';
                                } elseif ($date_month == '08') {
                                    $month = 'Agu';
                                } elseif ($date_month == '09') {
                                    $month = 'Sep';
                                } elseif ($date_month == '10') {
                                    $month = 'Oct';
                                } elseif ($date_month == '11') {
                                    $month = 'Nov';
                                } elseif ($date_month == '12') {
                                    $month = 'Dec';
                                } else {
                                }
                                ?>

                                <div class="date LTgray">
                                    <b><?php echo $month; ?> - <?php echo $date_date; ?> - <?php echo $date_year; ?></b>
                                </div>

                                <?php if($customer_ratings){ ?>
                                <img src='<?php echo url('public/assets/images/stars-' . $customer_ratings . '.png'); ?>'
                                >Ratings
                                <?php } ?>

                                <div class="head"><?php echo $customer_title; ?></div>
                                <p><?php echo $customer_comments; ?></p>
                            </div>
                        </div>
                        <?php
                        }

                        } else { ?> No Review Ratings.<br><?php }?>


                    </div>
                </div>

                <!-- Present Product -->
                @if( ($subscribe == 1) && (count($present_products) >0 ) && ($product_details_by_id->pro_present != 1 ))
                    <br>
                    <div class="row-fluid">
                        <div class="col-md-12">
                            <h4 class="text-success">Present Resources for Subscriber</h4>
                            <div class="view">
                                <section class="grid">
                                    @foreach($present_products as $trp)
                                        <div class=" col-md-4 col-sm-6 col-xs-12">
                                            <div class="product">
                                            <?php
                                            $res = base64_encode($trp->pro_id);
                                            $product_image = explode('/**/', $trp->pro_Img);
                                            ?>
                                            <!-- img -->
                                                <a href="{!! url('productview').'/'.$res!!}">
                                                    <div class="product__info">
                                                        <div class="img">
                                                            <img class="product__image"
                                                                 src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"
                                                                 alt="" title=""/>
                                                        </div>
                                                        <p class="title product__title tab-title">
                                                            <?php if (strlen($trp->pro_title) > 20) {
                                                                echo substr($trp->pro_title, 0, 20) . '...';
                                                            } else {
                                                                echo $trp->pro_title;
                                                            }?>
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </section>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')


    <script src="<?php echo url(''); ?>/public/plugins/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
    <script src="<?php echo url(''); ?>/public/assets/js/locationpicker.jquery.js"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtA9j3NF1CKkSiHi9tVeECFLdlgwT3gGE&libraries=places"></script>
    <script>
                @foreach($get_store as $store_detail)
        var store_lat = "{{$store_detail->stor_latitude}}";
        var store_long = "{{$store_detail->stor_longitude}}";

        $('#us3').locationpicker({
            location: {latitude: store_lat, longitude: store_long},
            radius: 200,
            inputBinding: {},
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                // Uncomment line below to show alert on each Location Changed event
                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            }
        });
        @endforeach
    </script>
@endsection