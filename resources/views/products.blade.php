@extends('includes/page_master')
@section('title', 'Living Lectionary | Resources')
@section('css')
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

    <div class="container">
        @if(Session::has('wish'))
            <p class="alert {!! Session::get('alert-class', 'alert-success') !!}">{!! Session::get('wish') !!}</p>
        @endif
        <div class="row-fluid">
            {{--Left Sidebar--}}
            <div class="span3" id="sidebar" style="margin-top:10px;">
                <div class="side-menu-head"><strong>Categories</strong></div>
                <ul id="css3menu1" class="topmenu">
                    <input type="checkbox" id="css3menu-switcher" class="switchbox"><label onclick="" class="switch"
                                                                                           for="css3menu-switcher"></label>
                    <?php foreach($main_category as $fetch_main_cat) { $pass_cat_id1 = "1," . $fetch_main_cat->mc_id; ?>
                    <?php if(count($sub_main_category[$fetch_main_cat->mc_id]) != 0) { ?>
                    <li class="topfirst"><a
                                href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id1); ?>"><?php echo $fetch_main_cat->mc_name; ?> </a>
                        <ul>
                            <?php foreach($sub_main_category[$fetch_main_cat->mc_id] as $fetch_sub_main_cat)  { $pass_cat_id2 = "2," . $fetch_sub_main_cat->smc_id; ?>
                            <?php if(count($second_main_category[$fetch_sub_main_cat->smc_id]) != 0) { ?>
                            <li class="subfirst"><a
                                        href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id2); ?>"><?php echo $fetch_sub_main_cat->smc_name; ?> </a>
                                <ul>
                                    <?php  foreach($second_main_category[$fetch_sub_main_cat->smc_id] as $fetch_sub_cat) { $pass_cat_id3 = "3," . $fetch_sub_cat->sb_id;?>  <?php if(count($second_sub_main_category[$fetch_sub_cat->sb_id]) != 0) { ?>
                                    <li class="subsecond"><a
                                                href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id3); ?>"><?php echo $fetch_sub_cat->sb_name; ?> </a>

                                        <ul>
                                            <?php  foreach($second_sub_main_category[$fetch_sub_cat->sb_id] as $fetch_secsub_cat) { $pass_cat_id4 = "4," . $fetch_secsub_cat->ssb_id; ?>
                                            <li class="subthird"><a
                                                        href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id4); ?>"><?php echo $fetch_secsub_cat->ssb_name ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>

                    </li>
                    <?php } ?>
                    <?php } ?>
                </ul>
                <br>
                <div class="clearfix"></div>
                <br/>
                <?php if($most_visited_product) { ?>
                <div class="side-menu-head"><strong>Most Visited Resources</strong></div>
                <?php foreach($most_visited_product as $fetch_most_visit_pro) {
                $mostproduct_saving_price = $fetch_most_visit_pro->pro_price - $fetch_most_visit_pro->pro_price;
                $mostproduct_img = explode('/**/', $fetch_most_visit_pro->pro_Img);
                $res = base64_encode($fetch_most_visit_pro->pro_id);
                ?>
                <div class="thumbnail" style="margin: 10px 0;">
                    <a href="{!! url('productview').'/'.$res!!}">
                        <img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>"
                             alt="<?php echo $fetch_most_visit_pro->pro_title; ?>" style="height:150px">
                        <div class="caption product_show">
                            <h3 class="prev_text">
                                <?php
                                $title = $fetch_most_visit_pro->pro_title;
                                echo substr($title, 0, 20);
                                if (strlen($title) > 20) {
                                    echo '...';
                                }
                                ?>
                            </h3>
                            <h4 class="top_text dolor_text">$<?php echo $fetch_most_visit_pro->pro_price;  ?></h4>
                        </div>
                    </a>
                </div>
                <?php }} ?>
            </div>

            {{--Resources--}}
            <div id="demo" class="span9 box jplist jplist-grid-view tab-land-wid">
                <!-- ios button: show/hide panel -->
                <div class="jplist-ios-button">
                    <i class="icon icon-sort"></i>
                    More Filters
                </div>

                {{--Panel Top--}}
                <div class="jplist-panel box panel-top">
                    <!-- reset button -->
                    <button type="button" class="jplist-reset-btn" data-control-type="reset"
                            data-control-name="reset" data-control-action="reset">
                        Reset &nbsp;<i class="icon icon-share"></i>
                    </button>

                    <div class="jplist-drop-down" data-control-type="drop-down" data-control-name="paging"
                         data-control-action="paging">
                        <div class="jplist-dd-panel"> 12 per page</div>
                        <ul style="display: none;">
                            <li class=""><span data-number="8"> 8 per page </span></li>
                            <li class="active"><span data-number="12" data-default="true"> 12 per page </span></li>
                            <li><span data-number="all"> view all </span></li>
                        </ul>
                    </div>

                    <div class="jplist-drop-down" data-control-type="drop-down" data-control-name="sort"
                         data-control-action="sort">
                        <div class="jplist-dd-panel">Likes asc</div>
                        <ul style="display: none;">
                            <li class=""><span data-path="default">Sort by</span></li>
                            <li class="active"><span data-path=".like" data-order="asc" data-type="number"
                                                     data-default="true">Price low - high</span></li>
                            <li><span data-path=".like" data-order="desc" data-type="number">Price high -low</span>
                            </li>
                            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                        </ul>
                    </div>

                    <!-- filter by title -->
                    <div class="text-filter-box">
                        <i class="icon icon-search jplist-icon"></i>
                        <input data-path=".title" value="" placeholder="Filter by Title" data-control-type="textbox"
                               data-control-name="title-filter" data-control-action="filter" type="text"
                               class="filt">
                    </div>

                    <div class="jplist-views" data-control-type="views" data-control-name="views"
                         data-control-action="views"
                         data-default="jplist-grid-view" style="visibility:hidden;">
                        <button type="button" class="jplist-view jplist-list-view"
                                data-type="jplist-list-view"></button>
                        <button type="button" class="jplist-view jplist-grid-view"
                                data-type="jplist-grid-view"></button>
                        <button type="button" class="jplist-view jplist-thumbs-view"
                                data-type="jplist-thumbs-view"></button>
                    </div>

                    <div class="jplist-label" data-type="Page {current} of {pages}"
                         data-control-type="pagination-info" data-control-name="paging"
                         data-control-action="paging" style="visibility:hidden;">
                    </div>
                </div>
                <!-- Compare basket -->
                <div class="compare-basket">
                    <button class="action action--button action--compare">
                        <i class="icon icon-check"></i>
                        <span class="action__text">Compare</span>
                    </button>
                </div>

                <div class="view">

                    <div class="list" style="margin-left:-5px">
                        <div class="grid row-fluid">
                            <?php  if(count($product_details) != 0) {?>
                            <?php
                            foreach($product_details as $product_det){
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
                                            <i class="icon icon-shopping-cart"></i><span class="action__text">Add to cart</span>
                                        </button>
                                        <input type="hidden" name="addtocart_pro_id"
                                               value="<?php echo $product_det->pro_id; ?>"/>
                                        <input type="hidden" name="addtocart_qty" value="1"/>
                                        <input type="hidden" name="pro_id"
                                               value="<?php echo $product_det->pro_id; ?>">
                                        {!! Form::close() !!}
                                    </a>
                                </div>
                                <label class="action action--compare-add">
                                    <input class="check-hidden" type="checkbox"/><i class="icon icon-plus"></i><i
                                            class="icon icon-check"></i><span
                                            class="action__text action__text--invisible">Add to compare</span>
                                </label>
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

                <section class="compare">
                    <button class="action action--close">
                        <i class="icon icon-remove"></i><span class="action__text action__text--invisible">Close comparison overlay</span>
                    </button>
                </section>

                <!-- ios button: show/hide panel -->
                <div class="jplist-ios-button">
                    <i class="icon icon-sort"></i>
                    More Filters
                </div>

                <div class="clearfix"></div>

                <div class="jplist-panel box panel-bottom">

                    <div class="jplist-drop-down" data-control-type="drop-down" data-control-name="paging"
                         data-control-action="paging" data-control-animate-to-top="true">
                        <div class="jplist-dd-panel"> 10 per page</div>
                        <ul style="display: none;">
                            <li class=""><span data-number="5"> 5 per page </span></li>
                            <li class="active"><span data-number="10" data-default="true"> 10 per page </span></li>
                            <li><span data-number="15"> 15 per page </span></li>
                            <li><span data-number="all"> view all </span></li>
                        </ul>
                    </div>
                    <div class="jplist-drop-down" data-control-type="drop-down" data-control-name="sort"
                         data-control-action="sort" data-control-animate-to-top="true">
                        <div class="jplist-dd-panel">Likes asc</div>
                        <ul style="display: none;">
                            <li class=""><span data-path="default">Sort by</span></li>
                            <li class="active"><span data-path=".like" data-order="asc" data-type="number"
                                                     data-default="true">Price low - high</span></li>
                            <li><span data-path=".like" data-order="desc" data-type="number">Price high -low</span>
                            </li>
                            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
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
                    <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging"
                         data-control-action="paging" data-control-animate-to-top="true">
                        <div class="jplist-pagingprev jplist-hidden" data-type="pagingprev">
                            <button type="button" class="jplist-first" data-number="0" data-type="first">«</button>
                            <button data-number="0" type="button" class="jplist-prev" data-type="prev">‹</button>
                        </div>
                        <div class="jplist-pagingmid" data-type="pagingmid">
                            <div class="jplist-pagesbox" data-type="pagesbox">
                                <button type="button" data-type="page" class="jplist-current" data-active="true"
                                        data-number="0">1
                                </button>
                                <button type="button" data-type="page" data-number="1">2</button>
                                <button type="button" data-type="page" data-number="2">3</button>
                                <button type="button" data-type="page" data-number="3">4</button>
                            </div>
                        </div>
                        <div class="jplist-pagingnext" data-type="pagingnext">
                            <button data-number="1" type="button" class="jplist-next" data-type="next">›</button>
                            <button data-number="3" type="button" class="jplist-last" data-type="last">»</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="<?php echo url(); ?>/themes/js/compare-products/classie.js"></script>
    <script src="<?php echo url(); ?>/themes/js/compare-products/main.js"></script>
@endsection