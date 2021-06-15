@extends('includes/page_master')

@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/Markdown.Editor.hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/CLEditor1_4_3/jquery.cleditor.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/jquery.cleditor-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/bootstrap-wysihtml5-hack.css"/>
    <link rel="stylesheet" href="<?php echo url('')?>/public/plugins/wysihtml5/lib/css/wysiwyg-color.css">

    <style type="text/css" id="enject"></style>
    <style type="text/css">
        .carousel {
            margin-bottom: 0;
            padding: 0 40px 30px 40px;
        }

        /* Reposition the controls slightly */
        .carousel-control {
            left: -12px;
        }

        .carousel-control.right {
            right: -12px;
        }

        /* Changes the position of the indicators */
        .carousel-indicators {
            right: 50%;
            top: auto;
            bottom: 0px;
            margin-right: -19px;
        }

        /* Changes the colour of the indicators */
        .carousel-indicators li {
            background: #c0c0c0;
        }

        .carousel-indicators .active {
            background: #333333;
        }

        .store-product a.btn {
            padding: 5px;
        }

    </style>
@endsection
@section('content')
    {{--Store Details--}}
    <div class="container exist_content">
        <div class="row-fluid">
            <div class="col-md-6">
                <div class="store-image-wrapper">
                    <img src="<?php echo url(); ?>/public/assets/images/storeimage/<?php echo $store->stor_img;  ?>"
                         class="img-res store-img tab-store-img img-responsive">
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="og_text"><?php echo $store->stor_name; ?></h2>
            <!--
                <?php
            $product_count = $one_count + $two_count + $three_count + $four_count + $five_count;

            //echo $product_count;
            $multiple_countone = $one_count * 1;

            $multiple_counttwo = $two_count * 2;

            $multiple_countthree = $three_count * 3;

            $multiple_countfour = $four_count * 4;

            $multiple_countfive = $five_count * 5;
            $product_total_count = $multiple_countone + $multiple_counttwo + $multiple_countthree + $multiple_countfour + $multiple_countfive;
            //echo $product_total_count;
            if($product_count)
            {
            $product_divide_count = $product_total_count / $product_count;
            if($product_divide_count <= '1')
            {
            ?>
                    <img src='<?php echo url('images/stars-1.png'); ?>' style='margin-bottom:10px;'>Ratings
                <?php
            }
            elseif($product_divide_count >= '1')
            {
            ?>

                    <img src='<?php echo url('public/assets/images/stars-1.png'); ?>' style='margin-bottom:10px;'>Ratings
                <?php
            }
            elseif($product_divide_count >= '2')
            {
            ?>
                    <img src='<?php echo url('public/assets/images/stars-2.png'); ?>' style='margin-bottom:10px;'>Ratings
                <?php
            }
            elseif($product_divide_count >= '3')
            {
            ?>
                    <img src='<?php echo url('public/assets/images/stars-3.png'); ?>' style='margin-bottom:10px;'>Ratings
                <?php

            }
            elseif($product_divide_count >= '4')
            {
            ?>
                    <img src='<?php echo url('public/assets/images/stars-4.png'); ?>' style='margin-bottom:10px;'>Ratings
                <?php
            }
            elseif($product_divide_count >= '5')
            {
            ?>
                    <img src='<?php echo url('public/assets/images/stars-5.png'); ?>' style='margin-bottom:10px;'>Ratings
                <?php
            }
            else {
                echo "<br/>No Rating for this Store";
            }
            }
            elseif ($product_count) {
                $product_divide_count = $product_total_count / $product_count;
            }
            else {
                echo "<br/>No Rating for this Store";
            }
            //echo $product_divide_count;
            ?>

                    <label>Address: <span><?php echo $store->st_name . ' ' . $store->ci_name . ', ' . $store->co_name; ?></span>
                </label>
                <?php if($store->stor_address1) { ?>
                    <label>
                            <span style="margin-left: 61px;"><?php echo $store->stor_address1;  ?> <?php echo $store->stor_address2;?></span>
                </label>
                <?php } ?>
                    <label>Zip : <span><?php echo $store->stor_zipcode;  ?></span> </label>
                <label>Mobile: <?php echo $store->stor_phone;  ?></label>
                -->
                <div>
                    {!! $store->stor_orgdesc !!}
                </div>
                @if($store->stor_website)
                    <h4>Website: <a class="deal_web_link og_text" target="blank"
                                    href="<?php echo $store->stor_website;  ?>"> <?php echo $store->stor_website;  ?></a>
                    </h4>
                @endif

                @if($store->stor_show_map != '0' && $store->stor_latitude && $store->stor_longitude)
                    <div id="map" style="width: 100%; height: 300px;" class="store-map"></div>
                @endif
            </div>
        </div>
    </div>

    {{--Store Resources--}}
    <div class="container" id="store_products">
        <h4 class="text-center">Content from <?php echo ucwords($store->stor_name);  ?></h4>
        <legend></legend>
        <div class="row-fluid">

            <?php if($get_store_product_by_id) {
            $i = 0;
            ?>
            <?php foreach($get_store_product_by_id as $fetch_most_visit_pro) {
            $mostproduct_img = explode('/**/', $fetch_most_visit_pro->pro_Img);
            $res = base64_encode($fetch_most_visit_pro->pro_id);

            if ($i == 0) {
                echo "<div class='row'>";
            }
            ?>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="thumbnail product store-product">
                    <a href="{!! url('productview').'/'.$res!!}">
                        <img alt=""
                             src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>"
                             style="height:200px;"/>
                        <h4><p class="s_detail product_title"
                               style="margin-top:15px;"><?php echo substr($fetch_most_visit_pro->pro_title, 0, 20);  ?>
                                ...</p>
                        </h4>
                        <span class="dolor_text">$ <?php echo $fetch_most_visit_pro->pro_price;  ?> </span>
                    </a>
                    <div class="row-fluid">
                        <h4 class="text-center">
                            <a class="btn btn-warning"
                               href="{!! url('productview').'/'.$res!!}">
                                <i class="icon-large icon-shopping-cart icon_me"></i>&emsp;<span class="action__text">Add to cart</span>
                            </a>
                        </h4>
                    </div>
                </div>
            </div>

            <?php
            if ($i == 3) {
                echo "</div>";
            }
            $i++;
            if ($i == 4) {
                $i = 0;
            }

            }

            } else { ?>
            <h5 style="color:#933;">No records found under <?php echo ucwords($store->stor_name);  ?> products.</h5>
            <?php } ?>
        </div>
    </div>

    {{--Store Branch --}}
    <div class="container" id="store_branch" style="display:none;">
        <div class="row">
            <div class="span12">
                <h4>Branches</h4>
                <div class="well">
                    <div id="myCarousel" class="carousel slide">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row-fluid">
                                    <?php
                                    foreach($get_storebranch as $row_store)  {
                                    ?>
                                    <div class="span3"><a href="#x"><img
                                                    src="<?php echo url(); ?>/public/assets/images/storeimage/<?php echo $row_store->stor_img;;  ?>"
                                                    alt="Image"
                                                    style="max-width:100%;height:200px"/></a><br><br><?php echo $row_store->stor_name; ?>
                                        <br><br>
                                        <a href="<?php echo url('storeview/' . base64_encode(base64_encode(base64_encode($row_store->stor_id)))); ?>"
                                           target="_blank">
                                            <button class="sub-but">View Details</button>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div><!--/row-fluid-->
                            </div><!--/item-->
                        </div><!--/carousel-inner-->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i
                                    class="icon icon-left"></i></a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><i
                                    class="icon icon-right"></i></a>
                    </div><!--/myCarousel-->

                </div><!--/well-->
            </div>
        </div>
    </div>


    <?php
    if(Session::has('customerid'))
    {
    ?>
    {{--Store Post Comment--}}
    <div class="container" id="store_post">
        <div style="border-radius:3px; border:1px solid #ccc;">
            <h4 style="padding-left:13px;">Write a post comments</h4>
            <div class="row-fluid">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::open(array('url'=>'storecomments','class'=>'form-horizontal loginFrm')) !!}
                    <input type="hidden" name="customem_id" value="<?php echo Session::get('customerid');?>">
                    <input type="hidden" name="store_id" value="{!!$store->stor_id!!}">

                    <div class="control-group">
                        <input type="text" placeholder="Enter Comment Title" name="title" class="input-xlarge"
                               style="width:100%" required/>
                    </div>
                    <div class="control-group">
                            <textarea rows="5" name="comments" class="input-xlarge" style="width:100%"
                                      placeholder="Enter Comments Queries" required></textarea>
                    </div>
                    <div class="control-group">
                        <input type="radio" name="ratings" value="1" required>1 Star</input>
                        <input type="radio" name="ratings" value="2" required>2 Star</input>
                        <input type="radio" name="ratings" value="3" required>3 Star</input>
                        <input type="radio" name="ratings" value="4" required>4 Star</input>
                        <input type="radio" name="ratings" value="5" required>5 Star</input>
                    </div>
                    <div class="control-group">
                        <input type="submit" class="btn btn-large me_btn btnb-success" value="Post Comments"
                               style="background: #2F3234; border-radius: 0px;"/>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <br class="clr">
    <div class="container" id="store_review">
        <h4>Reviews</h4>
        <?php
        if($product_count >= 1)
        {

        foreach($customer_details as $col)
        {
        $customer_name = $col->mem_fname . ' ' . $col->mem_lname;
        $customer_mail = $col->mem_email;
        $customer_img = $col->mem_pic;
        $customer_comments = $col->comments;
        $customer_date = $col->created_date;
        $customer_product = $col->store_id;
        $change_format = date('d/m/Y', strtotime($col->created_date));
        $customer_title = $col->title;
        $customer_name_arr = str_split($customer_name);
        $start_letter = $customer_name_arr[0];
        $customer_ratings = $col->ratings;
        $date_exp = explode('/', $change_format);
        //$date_exp[0];
        $date_date = $date_exp[0];
        $date_month = $date_exp[1];
        $date_year = $date_exp[2];
        //echo $customer_product;

        if($customer_product == $store->stor_id)
        {
        ?>
        <div class="commentlist">
            <div class='userimg'><span class='reviewer-imgName' style='background:#fba565; text-transform:capitalize;'>$customer_name_arr[0]</span>
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
                    <img src='<?php echo url('public/assets/images/stars-' . $customer_ratings . '.png'); ?>'
                         style='margin-bottom:10px;'>Ratings
                    <div class="head"><?php echo $customer_title; ?></div>
                    <span style="font-weight:bold"><?php echo $customer_comments; ?></span>
                </div>
            </div>
        </div>
        <?php } } }else{?>No Review Ratings.<?php }?>
        <br>
    </div>
    <?php } else { ?>
    <div class="container" id="store_post">
        <h4>Reviews</h4>
        <h4>
            <span style="margin-top:-33px; float:right;">
                <a class="btn btn-orange  btn-line rippleWhite js-userReviewed" href="#login" role="button"
                   data-toggle="modal" id="login_a_click" value="Login">Write a Review</a>
            </span>
        </h4>
        <?php
        if($product_count >= 1)
        {

        foreach($customer_details as $col)
        {
        $customer_name = $col->mem_fname . ' ' . $col->mem_lname;
        $customer_mail = $col->mem_email;
        $customer_img = $col->mem_pic;
        $customer_comments = $col->comments;
        $customer_date = $col->created_date;
        $customer_product = $col->store_id;
        $change_format = date('d/m/Y', strtotime($col->created_date));
        $customer_title = $col->title;
        $customer_name_arr = str_split($customer_name);
        $start_letter = $customer_name_arr[0];
        $customer_ratings = $col->ratings;
        $date_exp = explode('/', $change_format);
        //$date_exp[0];
        $date_date = $date_exp[0];
        $date_month = $date_exp[1];
        $date_year = $date_exp[2];
        //echo $customer_product;
        if($customer_product == $store->stor_id)
        {
        ?>
        <div class="commentlist">
            <div class='userimg'><span class='reviewer-imgName'
                                       style='background:#fba565; text-transform:capitalize;'><?php echo $customer_name_arr[0]; ?></span>
            </div>
            <span class="text-center _reviewUserName" title="Prateek"
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
                <div class="date LTgray"><b><?php echo $month; ?> - <?php echo $date_date; ?>
                        - <?php echo $date_year; ?></b></div>
                <?php
                if($customer_ratings != '')
                {
                ?>
                <img src='<?php echo url('public/assets/images/stars-' . $customer_ratings . '.png'); ?>'
                     style='margin-bottom:10px;'>Ratings
                <?php } ?>
                <div class="head"><?php echo $customer_title; ?></div>
                <span style="font-weight:bold"><?php echo $customer_comments; ?></span></p>
            </div>
        </div>

        <?php } } }else{?>No Review Ratings.<br><?php }?>
    </div>
    <?php } ?>
    <br>

    <!-- Themes switcher section ============================================================================================= -->
    <span id="themesBtn"></span>
@endsection
@section('script')
    <script type="text/javascript" src="<?php echo url(); ?>/themes/js/scriptbreaker-multiple-accordion-1.js"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtA9j3NF1CKkSiHi9tVeECFLdlgwT3gGE&libraries=places"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myCarousel').carousel({
                interval: 10000
            })

            $(".topnav").accordion({
                accordion: false,
                speed: 500,
                closedSign: '<span class="icon-chevron-right"></span>',
                openedSign: '<span class="icon-chevron-down"></span>'
            });
        });

    </script>
    <!--script>
        var geocoder; //To use later
        var map; //Your map
        var showmap = "{{$store->stor_show_map}}";
        var lat = "{{$store->stor_latitude}}";
        var long = "{{$store->stor_longitude}}";
        var zipcode = "{{$store->stor_zipcode}}";

        if (showmap) {
            initialize();

            if(lat == 0 || long == 0)
            {
                codeAddress(zipcode);

            } else {
                var latlng = new google.maps.LatLng(lat, long);
                set_maker(latlng);
            }
        }

        function initialize() {
            geocoder = new google.maps.Geocoder();

            //Default setup
            var myOptions = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map"), myOptions);
        }

        function set_maker(latlng){
            var marker = new google.maps.Marker({
                map: map,
                position: latlng
            });
        }

        //Call this wherever needed to actually handle the display
        function codeAddress(zipCode) {
            geocoder.geocode( { 'address': zipCode}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    //Got result, center the map and put it out there
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    </script-->
@endsection


