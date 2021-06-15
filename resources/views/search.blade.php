@extends('includes/page_master')
@section('title', 'Living Lectionary | Search Results')
@section('css')
    <link rel="stylesheet"
          href="<?php echo url(); ?>/public/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css"/>
    <style>
        .multiselect-native-select .btn-group, .multiselect {
            width: 100%;
        }

        .multiselect-container li.subtheme {
            padding-left: 30px;
        }

        button.multiselect {
            height: 34px;
        }
    </style>
@endsection
@section('content')
    <?php
    $loggedin = 0;
    $origin_price_class = $discounted_price_class = "";
    if (Session::has('customerid')) {
        $loggedin = 1;

        $subscribe = Session::get('subscribe');
        if ($subscribe == 1) {
            $origin_price_class = "text-through";
        } else {
            $discounted_price_class = "text-through";
        }
    }
    ?>
    @if (Session::has('error'))
        <div>{!! Session::get('error') !!}
        </div>
    @endif
    @if (Session::has('result_success'))
        <div>{!! Session::get('result_success') !!}
        </div>
    @endif
    @if (Session::has('result_cancel'))
        <div>{!! Session::get('result_cancel') !!}
        </div>
    @endif

    <!-- Header End====================================================================== -->
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide homCar">
            <div class="carousel-inner">
                @if(isset($bannerimagedetails))
                    <?php $i = 1;?>
                    @foreach($bannerimagedetails as $banner)
                        <div class="item  <?php if($i == 1){ ?> active <?php } ?>">
                            <a><img src="<?php echo url('') . '/public/assets/images/bannerimage/' . $banner->bn_img; ?>"
                                    alt=""
                                    class="img-responsive"/></a>
                            <div class="carousel-caption ld-caption">
                                <p>Curated Resources.<br> Inspiring Voices.<br> Groundbreaking Content.</p>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                @endif
            </div>

            @if(isset($bannerimagedetails) && count($bannerimagedetails) > 1)
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
            @endif
        </div>
    </div>
    {{--endCarousel--}}


    <div class="container">
        <div style="height:25px"></div>
    </div>

    <div id="mainBody">
        <div class="container searchitems">
            <div class="row">
                <!-- Sidebar ================================================== -->
                <div id="sidebar" class="span3"><br>
                    <div class="well well-small btn-warning"><strong>Categories</strong></div>
                    <ul id="css3menu1" class="topmenu">
                        <input type="checkbox" id="css3menu-switcher" class="switchbox"><label onclick="" class="switch"
                                                                                               for="css3menu-switcher"></label>
                        <?php foreach($main_category as $fetch_main_cat) { $pass_cat_id1 = "1," . $fetch_main_cat->mc_id; ?>

                        <li class="topfirst"><a
                                    href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id1); ?>"><?php echo $fetch_main_cat->mc_name; ?> </a>
                            <?php if(count($sub_main_category[$fetch_main_cat->mc_id]) != 0) { ?>
                            <ul>
                                <?php foreach($sub_main_category[$fetch_main_cat->mc_id] as $fetch_sub_main_cat)  { $pass_cat_id2 = "2," . $fetch_sub_main_cat->smc_id; ?>
                                <?php if(count($second_main_category[$fetch_sub_main_cat->smc_id]) != 0) { ?>
                                <li class="subfirst"><a
                                            href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id2); ?>"><?php echo $fetch_sub_main_cat->smc_name; ?> </a>
                                    <ul>
                                        <?php  foreach($second_main_category[$fetch_sub_main_cat->smc_id] as $fetch_sub_cat) { $pass_cat_id3 = "3," . $fetch_sub_cat->sb_id;?>   <?php if(count($second_sub_main_category[$fetch_sub_cat->sb_id]) != 0) { ?>
                                        <li class="subsecond"><a
                                                    href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id3); ?>"><?php echo $fetch_sub_cat->sb_name; ?> </a>
                                            <ul>
                                                <?php  foreach($second_sub_main_category[$fetch_sub_cat->sb_id] as $fetch_secsub_cat) { $pass_cat_id4 = "4," . $fetch_secsub_cat->ssb_id; ?>
                                                <li class="subthird"><a
                                                            href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id4); ?>"><?php echo $fetch_secsub_cat->ssb_name ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <br/>
                    <div class="clearfix"></div>
                    <br/>

                    <?php foreach ($most_visited_product as $fetch_most_visit_pro) {
                    }

                    $mostproduct_img = explode('/**/', $fetch_most_visit_pro->pro_Img);
                    $res = base64_encode($fetch_most_visit_pro->pro_id);
                    ?>
                    <div class="well well-small btn-warning"><strong>Most Visited Resource</strong></div>
                    <div class="thumbnail">
                        <img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>"
                             style="height:200px;" alt="panasonic New camera"/>
                        <div class="caption product_show">
                            <h4 class="top_text dolor_text">$<?php echo $fetch_most_visit_pro->pro_price;  ?></h4>
                            <h5 class="prev_text"><?php echo substr($fetch_most_visit_pro->pro_title, 0, 50);  ?>
                                ...</h5>
                            <div class="product-info">
                                <div class="product-info-cust">
                                    <a href="<?php echo url('productview/' . $res); ?>">Add To Cart</a>
                                </div>
                                <div class="product-info-price">

                                    <a class="btn align_brn"
                                       href="<?php echo url('productview/' . $res); ?>"><i
                                                class="icon-large icon-shopping-cart icon_me"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>

                </div>
                <br>
                <!-- Sidebar end=============================================== -->
                <div class="span9">
                    <div id="search_page_search_div">
                        <form class="form-horizontal" role="form"
                              action="{!!action('HomeController@do_search')!!}">
                            <h5>Search By Theme, Category, Contributor and Keyword or Scripture</h5>
                            <input type="hidden" name="normal_search" value="0"/>

                            <div class="row-fluid">

                                <div class="form-group span3">
                                    <label for="pass1" class="control-label">Contributor</label>
                                    <input type="text" class="form-control" id="product_contributor"
                                           name="product_contributor"/>
                                </div>
                                <div class="form-group span3">
                                    <label for="pass1" class="control-label">Keyword or Scripture</label>
                                    <input type="text" class="form-control" id="product_name" name="search_token"/>
                                </div>

                                <div class="form-group span3">
                                    <label for="pass1" class="control-label">Category</label>
                                    <select class="form-control category_search" id="sproduct_category"
                                            name="product_category" data-level="1">
                                        <option value="0">--select--</option>
                                        @foreach($catg_list as $cat)
                                            <option value="{{$cat->mc_id}}">{{$cat->mc_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="form-group span9">
                                    <label for="product_theme" class="control-label">Theme</label>
                                    <select id="sproduct_theme" name="product_theme[]" class="form-control" size="8"
                                            multiple="multiple">
                                        @foreach($theme_details as $theme_group)
                                            <option value="{{$theme_group[0]->theme_id}}">{{$theme_group[0]->theme_name}}</option>
                                            @foreach($theme_group[1] as $sub_theme)
                                                <option value="{{$sub_theme->theme_id}}"
                                                        class="subtheme">{{$sub_theme->theme_name}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <button type="submit" id="adv_search_bt" class="btn btn-primary"><i
                                                class="icon icon-search" aria-hidden="true"></i>&emsp;Search Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <?php if($search_products) { ?>
                    <div class="well-small">
                        <div class="row text-center bbdot">
                            <span class="sale-title">Search for Resources</span>
                        </div>
                        <br>
                        <div class="row-fluid">

                            {{--Resources--}}
                            <div id="demo" class="box jplist jplist-grid-view tab-land-wid">

                                <div class="view">

                                    <div class="list" style="margin-left:-5px">
                                        <div class="grid row-fluid">
                                            <?php  if(count($search_products) != 0) {?>
                                            <?php
                                            foreach($search_products as $product_det){
                                            $res = base64_encode($product_det->pro_id);
                                            $product_image = explode('/**/', $product_det->pro_Img);
                                            $product_saving_price = $product_det->pro_price - $product_det->pro_price;
                                            ?>
                                            <div class="list-item product span3" style="margin-right:5px!important;">
                                                <div class="product__info">
                                                    <div class="img">
                                                        <a href="{!! url('productview').'/'.$res!!}">
                                                            <img class="product__image"
                                                                 src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"
                                                                 alt="" title=""/>
                                                        </a>
                                                    </div>
                                                    <div class="block">
                                                        <p class="title product__title tab-title">
                                                            <?php
                                                            $title = $product_det->pro_title;
                                                            echo substr($title, 0, 25);
                                                            if (strlen($title) > 25) {
                                                                echo '...';
                                                            }
                                                            ?>
                                                        </p>

                                                        <?php
                                                        if ($loggedin == 0) {?>
                                                        <p class="like product__price">
                                                            <?php
                                                            if ($product_det->pro_price == 0)
                                                                echo "FREE";
                                                            else
                                                                echo '$ ' . $product_det->pro_price;
                                                            ?>
                                                        </p>
                                                        <?php } else {
                                                        if ($product_det->pro_price == 0) {?>
                                                        <p class="like product__price"> Free </p>
                                                        <?php } else {?>
                                                        <p class="like product__price">
                                                            <span class="{!! $origin_price_class !!}"> {!! '$ '.$product_det->pro_price !!} </span>
                                                            &emsp;
                                                            <!--span class="{!! $discounted_price_class !!}"> {!! '$ '. round($product_det->pro_price*0.7, 2) !!} </span-->
                                                        </p>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <a href="{!! url('productview').'/'.$res!!}">
                                                        {!! Form :: open(array('url' => 'add_to_cart','class'=>'form-horizontal qtyFrm','enctype'=>'multipart/form-data')) !!}
                                                        <button class="action action--button action--buy">
                                                            <i class="icon icon-shopping-cart"></i><span
                                                                    class="action__text">Add to cart</span>
                                                        </button>
                                                        <input type="hidden" name="addtocart_pro_id"
                                                               value="<?php echo $product_det->pro_id; ?>"/>
                                                        <input type="hidden" name="addtocart_qty" value="1"/>
                                                        <input type="hidden" name="pro_id"
                                                               value="<?php echo $product_det->pro_id; ?>">
                                                        {!! Form::close() !!}
                                                    </a>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php } else { ?>
                                            <div class="box jplist-no-results text-shadow align-center jplist-hidden">
                                                <p style="margin-top:20px; color: rgb(54, 160, 222); font-weight: bold; padding-left: 8px;">
                                                    No products available</p>
                                            </div>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="jplist-panel box panel-bottom">

                                    <div class="jplist-drop-down" data-control-type="drop-down"
                                         data-control-name="paging"
                                         data-control-action="paging" data-control-animate-to-top="true">
                                        <div class="jplist-dd-panel"> 10 per page</div>
                                        <ul style="display: none;">
                                            <li class=""><span data-number="5"> 5 per page </span></li>
                                            <li class="active"><span data-number="10"
                                                                     data-default="true"> 10 per page </span></li>
                                            <li><span data-number="15"> 15 per page </span></li>
                                            <li><span data-number="all"> view all </span></li>
                                        </ul>
                                    </div>
                                    <div class="jplist-drop-down" data-control-type="drop-down" data-control-name="sort"
                                         data-control-action="sort" data-control-animate-to-top="true">
                                        <div class="jplist-dd-panel">Likes asc</div>
                                        <ul style="display: none;">
                                            <li class=""><span data-path="default">Sort by</span></li>
                                            <li class="active"><span data-path=".like" data-order="asc"
                                                                     data-type="number"
                                                                     data-default="true">Price low - high</span></li>
                                            <li><span data-path=".like" data-order="desc" data-type="number">Price high -low</span>
                                            </li>
                                            <li><span data-path=".title" data-order="asc"
                                                      data-type="text">Title A-Z</span></li>
                                            <li><span data-path=".title" data-order="desc"
                                                      data-type="text">Title Z-A</span></li>
                                            <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span>
                                            </li>
                                            <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- pagination results -->
                                    <div class="jplist-label" data-type="{start} - {end} of {all}"
                                         data-control-type="pagination-info" data-control-name="paging"
                                         data-control-action="paging">1 - 10 of 32
                                    </div>

                                    <!-- pagination -->
                                    <div class="jplist-pagination" data-control-type="pagination"
                                         data-control-name="paging"
                                         data-control-action="paging" data-control-animate-to-top="true">
                                        <div class="jplist-pagingprev jplist-hidden" data-type="pagingprev">
                                            <button type="button" class="jplist-first" data-number="0"
                                                    data-type="first">«
                                            </button>
                                            <button data-number="0" type="button" class="jplist-prev" data-type="prev">
                                                ‹
                                            </button>
                                        </div>
                                        <div class="jplist-pagingmid" data-type="pagingmid">
                                            <div class="jplist-pagesbox" data-type="pagesbox">
                                                <button type="button" data-type="page" class="jplist-current"
                                                        data-active="true"
                                                        data-number="0">1
                                                </button>
                                                <button type="button" data-type="page" data-number="1">2</button>
                                                <button type="button" data-type="page" data-number="2">3</button>
                                                <button type="button" data-type="page" data-number="3">4</button>
                                            </div>
                                        </div>
                                        <div class="jplist-pagingnext" data-type="pagingnext">
                                            <button data-number="1" type="button" class="jplist-next" data-type="next">
                                                ›
                                            </button>
                                            <button data-number="3" type="button" class="jplist-last" data-type="last">
                                                »
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        <!--div class="carousel slide">
                                <div class="carousel-inner">
                                    <?php
                        echo '<div class="item active" ><ul class="thumbnails">';
                        $i = 1;
                        foreach ($search_products as $fetch_product) {
                        $product_saving_price = $fetch_product->pro_price - $fetch_product->pro_price;
                        $product_img = explode('/**/', $fetch_product->pro_Img);
                        $res = base64_encode($fetch_product->pro_id); ?>

                                <li class="span4">
                                    <div class="thumbnail">
                                        <div class="image-wrapper">
                                            <img src="<?php echo url('') . '/public/assets/images/product/' . $product_img[0]?>"
                                                     alt="">
                                            </div>
                                            <div class="caption product_show">
                                                <h4 class="top_text dolor_text">
                                                    $<?php echo $fetch_product->pro_price?></h4>
                                                <h5 class="prev_text"><?php echo substr($fetch_product->pro_title, 0, 25)?>
                                ...</h5>
                            <div class="product-info">
                                <div class="product-info-cust">
                                    <a href="<?php echo url('productview/' . $res)?>">Add To
                                                            Cart</a>
                                                    </div>
                                                    <div class="product-info-price">
                                                        <a class="btn align_brn"
                                                           href="<?php echo url('productview/' . $res)?>">
                                                            <i class="icon icon-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                        if ($i % 3 == 0) {
                            echo '</ul></div><div class="item" ><ul class="thumbnails">';
                        }
                        $i++;
                        }
                        echo '</ul></div>'; ?>
                                </div>
                            </div-->
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($search_stores) { ?>
                    <div class="well-small">
                        <div class="row text-center bbdot">
                            <span class="sale-title">Search for Stores</span>
                        </div>
                        <br>
                        <div class="row-fluid">
                            <div class="carousel slide">
                                <div class="carousel-inner">
                                    <?php
                                    echo '<div class="item active" ><ul class="thumbnails">';
                                    $i = 1;
                                    foreach($search_stores as $store) { ?>
                                    <li class="span4">
                                        <div class="thumbnail">
                                            <div class="image-wrapper">
                                                <img src="<?php echo url(); ?>/public/assets/images/storeimage/<?php echo $store->stor_img;  ?>">
                                            </div>
                                            <a href="#"><h4><?php echo $store->stor_name; ?></h4></a>
                                            <div class="clearfix"></div>
                                            <a href="<?php echo url('storeview/' . base64_encode(base64_encode(base64_encode($store->stor_id)))); ?>">
                                                <button class="btn  btn-warning">Visit</button>
                                            </a>
                                        </div>
                                    </li>
                                    <?php
                                    if ($i % 3 == 0) {
                                        echo '</ul></div><div class="item" ><ul class="thumbnails">';
                                    }
                                    $i++;
                                    }
                                    echo '</ul></div>'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(count($search_stores) == 0 && count($search_products) == 0) {?>
                    <div class="well-small">
                        <h4 class="text-center bbdot">There are no search results.</h4>
                    </div>
                    <?php } ?>


                </div>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="<?php echo url('')?>/public/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script>
        $('#sproduct_theme').multiselect({
            enableClickableOptGroups: true,
            enableCollapsibleOptGroups: true,
            enableFiltering: true,
            includeSelectAllOption: true,
            disableIfEmpty: true
        });

    </script>
@endsection