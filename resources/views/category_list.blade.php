{!! $navbar !!}
<body>
<!-- Navbar ================================================== -->
{!! $header !!}
<!-- Header End====================================================================== -->


<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->
            <div id="sidebar" class="span3">
                <div class="well well-small btn-warning"><strong>Categories</strong></div>
                <ul id="css3menu1" class="topmenu">
                    <input type="checkbox" id="css3menu-switcher" class="switchbox"><label onclick="" class="switch"
                                                                                           for="css3menu-switcher"></label>
                    <?php foreach($main_category as $fetch_main_cat) { $pass_cat_id1 = "1," . $fetch_main_cat->mc_id; ?>
                    <li class="topfirst"><a
                                href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id1); ?>"><?php echo $fetch_main_cat->mc_name; ?>
                            [<?php echo count($sub_main_category[$fetch_main_cat->mc_id]); ?>]</a>
                        <?php if(count($sub_main_category[$fetch_main_cat->mc_id]) != 0) { ?>
                        <ul>
                            <?php foreach($sub_main_category[$fetch_main_cat->mc_id] as $fetch_sub_main_cat)  { $pass_cat_id2 = "2," . $fetch_sub_main_cat->smc_id; ?>
                            <li class="subfirst"><a
                                        href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id2); ?>"><?php echo $fetch_sub_main_cat->smc_name; ?>
                                    [<?php echo count($second_main_category[$fetch_sub_main_cat->smc_id]); ?>]</a>
                                <?php if(count($second_main_category[$fetch_sub_main_cat->smc_id]) != 0) { ?>
                                <ul>
                                    <?php  foreach($second_main_category[$fetch_sub_main_cat->smc_id] as $fetch_sub_cat) { $pass_cat_id3 = "3," . $fetch_sub_cat->sb_id;?>
                                    <li class="subsecond"><a
                                                href="<?php echo url('catproducts/viewcategorylist') . "/" . base64_encode($pass_cat_id3); ?>"><?php echo $fetch_sub_cat->sb_name; ?>
                                            [<?php echo count($second_sub_main_category[$fetch_sub_cat->sb_id]); ?>]</a>
                                        <?php if(count($second_sub_main_category[$fetch_sub_cat->sb_id]) != 0) { ?>
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

                <div class="well well-small btn-warning"><strong>Most Visited Resource</strong></div>
                <?php foreach($most_visited_product as $fetch_most_visit_pro) {

                if($fetch_most_visit_pro->pro_no_of_purchase < $fetch_most_visit_pro->pro_qty)
                {

                $mcat = strtolower(str_replace(' ', '-', $fetch_most_visit_pro->mc_name));
                $smcat = strtolower(str_replace(' ', '-', $fetch_most_visit_pro->smc_name));
                $sbcat = strtolower(str_replace(' ', '-', $fetch_most_visit_pro->sb_name));
                $ssbcat = strtolower(str_replace(' ', '-', $fetch_most_visit_pro->ssb_name));
                $res = base64_encode($fetch_most_visit_pro->pro_id);

                $mostproduct_saving_price = $fetch_most_visit_pro->pro_price - $fetch_most_visit_pro->pro_price;



                $mostproduct_discount_percentage = round(($mostproduct_saving_price / $fetch_most_visit_pro->pro_price) * 100, 2);



                $mostproduct_img = explode('/**/', $fetch_most_visit_pro->pro_Img);



                ?>
                <div class="thumbnail">


                    <img src="<?php echo url(''); ?>/public/assets/images/product/<?php echo $mostproduct_img[0]; ?>"
                         alt="panasonic New camera" style="height:200px;"/>


                    <div class="caption product_show">


                        <h4 class="top_text dolor_text">$<?php echo $fetch_most_visit_pro->pro_price;  ?></h4>


                        <h5 class="prev_text"><?php echo substr($fetch_most_visit_pro->pro_title, 0, 50);  ?>...</h5>


                        <div class="product-info">

                            <div class="product-info-cust">

                                <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
                                <a href="<?php echo url('productview/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $ssbcat . '/' . $res); ?>">Add
                                    To Cart</a>
                                <?php } ?>
                                <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
                                <a href="<?php echo url('productview1/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $res); ?>">Add
                                    To Cart</a>
                                <?php } ?>
                                <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
                                <a href="<?php echo url('productview2/' . $mcat . '/' . $smcat . '/' . $res); ?>">Add To
                                    Cart</a>
                                <?php } ?>

                            </div>

                            <div class="product-info-price">
                                <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
                                <a class="btn align_brn"
                                   href="<?php echo url('productview/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $ssbcat . '/' . $res); ?>"><i
                                            class="icon-large icon-shopping-cart icon_me"></i></a>
                                <?php } ?>
                                <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
                                <a class="btn align_brn"
                                   href="<?php echo url('productview1/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $res); ?>"><i
                                            class="icon-large icon-shopping-cart icon_me"></i></a>
                                <?php } ?>
                                <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
                                <a class="btn align_brn"
                                   href="<?php echo url('productview2/' . $mcat . '/' . $smcat . '/' . $res); ?>"><i
                                            class="icon-large icon-shopping-cart icon_me"></i></a>
                                <?php } ?>


                            </div>


                        </div>

                    </div>


                </div>
                <br/>
                <?php } }?>
            </div>
            <!-- Sidebar end=============================================== -->
            <div class="span9 tab-land-wid" style="margin-left:12px;">
                <?php if($product_details) { ?>
                <div class=" well-small">
                    <h4>New Resources </h4>
                    <div class="compare-basket">
                        <button class="action action--button action--compare"><i class="fa fa-check"></i><span
                                    class="action__text">Compare</span></button>
                    </div>
                    <div class="view">
                        <!-- Blueprint header -->
                        <header class="bp-header cf">

                        </header>
                        <!-- Product grid -->
                        <section class="grid">
                        <?php  if(count($product_details) != 0){ foreach($product_details as $product_det){
                        $product_image = explode('/**/', $product_det->pro_Img);
                        $product_saving_price = $product_det->pro_price - $product_det->pro_price;
                        $product_discount_percentage = round(($product_saving_price / $product_det->pro_price) * 100, 2);
                        if($product_det->pro_no_of_purchase < $product_det->pro_qty) {


                        $mcat = strtolower(str_replace(' ', '-', $product_det->mc_name));
                        $smcat = strtolower(str_replace(' ', '-', $product_det->smc_name));
                        $sbcat = strtolower(str_replace(' ', '-', $product_det->sb_name));
                        $ssbcat = strtolower(str_replace(' ', '-', $product_det->ssb_name));
                        $res = base64_encode($product_det->pro_id);
                        ?>
                        <!-- Resources -->


                            <div class="product" style="width:200px;">
                                <div class="product__info">
                                    <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
                                    <a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res!!}"><img
                                                class="product__image" alt=""
                                                src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"></a>

                                    <?php } ?>
                                    <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
                                    <a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$res!!}"><img
                                                class="product__image" alt=""
                                                src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"></a>
                                    <?php } ?>
                                    <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
                                    <a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$res!!}"><img
                                                class="product__image" alt=""
                                                src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"></a>
                                    <?php } ?>


                                    <h3 class="product__title tab-title"><?php echo substr($product_det->pro_title, 0, 25); ?></h3>

                                    <span class="product__price highlight">$<?php echo $product_det->pro_price; ?></span>
                                    <div class="block right">

                                        <?php if($product_det->pro_no_of_purchase >= $product_det->pro_qty) { ?>
                                        <h4 class="text-center"><a class="btn btn-danger">Sold</a>
                                            <?php } else {
                                            $mcat = strtolower(str_replace(' ', '-', $product_det->mc_name));
                                            $smcat = strtolower(str_replace(' ', '-', $product_det->smc_name));
                                            $sbcat = strtolower(str_replace(' ', '-', $product_det->sb_name));
                                            $ssbcat = strtolower(str_replace(' ', '-', $product_det->ssb_name));
                                            $res = base64_encode($product_det->pro_id);
                                            ?></h4>


                                    </div>
                                    <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
                                    <a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$ssbcat.'/'.$res!!}">
                                        <button class="action action--button action--buy"><i
                                                    class="fa fa-shopping-cart"></i><span class="action__text">Add to cart</span>
                                        </button>
                                    </a>
                                    <?php } ?>
                                    <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
                                    <a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$sbcat.'/'.$res!!}">
                                        <button class="action action--button action--buy"><i
                                                    class="fa fa-shopping-cart"></i><span class="action__text">Add to cart</span>
                                        </button>
                                    </a>
                                    <?php } ?>
                                    <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
                                    <a href="{!! url('productview').'/'.$mcat.'/'.$smcat.'/'.$res!!}">
                                        <button class="action action--button action--buy"><i
                                                    class="fa fa-shopping-cart"></i><span class="action__text">Add to cart</span>
                                        </button>
                                    </a>
                                    <?php } ?>

                                    <?php } ?>
                                </div>
                                <label class="action action--compare-add"><input class="check-hidden"
                                                                                 type="checkbox"/><i
                                            class="fa fa-plus"></i><i class="fa fa-check"></i><span
                                            class="action__text action__text--invisible">Add to compare</span></label>
                            </div>

                            <?php
                            }
                            }
                            }
                            elseif(count($product_details) == 0)
                            {
                            ?>
                            <div class="box jplist-no-results text-shadow align-center jplist-hidden">
                                <p style="color: rgb(54, 160, 222);
margin-top: 20px;
font-weight: bold;
padding-left: 8px;">No products available</p></div>
                            <?php
                            }
                            ?>


                        </section>

                    </div>
                    <section class="compare">
                        <button class="action action--close"><i class="fa fa-remove"></i><span
                                    class="action__text action__text--invisible">Close comparison overlay</span>
                        </button>
                    </section>
                </div>
                <?php } ?>
                <?php if($deals_details) { ?>
                <h4>New Deals </h4>
                <ul class="thumbnails">
                    <?php    foreach($deals_details as $fetch_deals) {
                    $deal_img = explode('/**/', $fetch_deals->deal_image);
                    $mcat = strtolower(str_replace(' ', '-', $fetch_deals->mc_name));
                    $smcat = strtolower(str_replace(' ', '-', $fetch_deals->smc_name));
                    $sbcat = strtolower(str_replace(' ', '-', $fetch_deals->sb_name));
                    $ssbcat = strtolower(str_replace(' ', '-', $fetch_deals->ssb_name));
                    $res = base64_encode($fetch_deals->deal_id);
                    ?>
                    <li class="span3">
                        <div class="thumbnail">
                            <i class="tag"><?php echo substr($fetch_deals->deal_discount_percentage, 0, 2); ?>%</i>
                            <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
                            <a href="<?php echo url('dealview/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $ssbcat . '/' . $res); ?>"><img
                                        src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deal_img[0]; ?>"
                                        alt="" style="height:150px; width:auto;"/></a>
                            <?php } ?>
                            <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
                            <a href="<?php echo url('dealview/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $res); ?>"><img
                                        src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deal_img[0]; ?>"
                                        alt="" style="height:150px; width:auto;"/></a>
                            <?php } ?>
                            <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
                            <a href="<?php echo url('dealview/' . $mcat . '/' . $smcat . '/' . $res); ?>"><img
                                        src="<?php echo url(''); ?>/public/assets/images/deals/<?php echo $deal_img[0]; ?>"
                                        alt="" style="height:150px; width:auto;"/></a>
                            <?php } ?>

                            <div class="caption">
                                <h4 class="top_text dolor_text">$<?php echo $fetch_deals->deal_discount_price; ?></h4>
                                <h5 class="prev_text"><?php echo substr($fetch_deals->deal_title, 0, 50); ?>...</h5>
                                <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat != '') { ?>
                                <h4>
                                    <center><a class="btn align_brn"
                                               href="<?php echo url('dealview/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $ssbcat . '/' . $res); ?>"><i
                                                    class="icon-large icon-shopping-cart icon_me"></i></a></center>
                                </h4>
                                <?php } ?>
                                <?php if($mcat != '' && $smcat != '' && $sbcat != '' && $ssbcat == '') { ?>
                                <h4>
                                    <center><a class="btn align_brn"
                                               href="<?php echo url('dealview/' . $mcat . '/' . $smcat . '/' . $sbcat . '/' . $res); ?>"><i
                                                    class="icon-large icon-shopping-cart icon_me"></i></a></center>
                                </h4>
                                <?php } ?>
                                <?php if($mcat != '' && $smcat != '' && $sbcat == '' && $ssbcat == '') { ?>
                                <h4>
                                    <center><a class="btn align_brn"
                                               href="<?php echo url('dealview/' . $mcat . '/' . $smcat . '/' . $res); ?>"><i
                                                    class="icon-large icon-shopping-cart icon_me"></i></a></center>
                                </h4>
                                <?php } ?>

                            </div>
                        </div>
                    </li>
                    <?php } }?>
                </ul>


            </div>
        </div>
    </div>
</div>


<!-- Footer ================================================================== -->

{!! $footer !!}


</body>
</html>