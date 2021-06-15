@extends('includes/page_master')

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
    {{--Carouel--}}
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide homCar">
            <div class="carousel-inner">
                <div class="item active">
                    <a><img src="<?php echo url('') . '/public/assets/images/themes/' . $theme_details->theme_banner_img; ?>"
                            alt=""
                            class="img-responsive"/></a>
                    <div class="carousel-caption rd-caption">
                        <p>{!! $theme_details->theme_banner_title !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--endCarousel--}}

    <div class="container">
        <div class="row-fluid">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="theme_narration">
                    <h1>{!! $theme_details->theme_heading !!}</h1>
                    {!! $theme_details->theme_description !!}

                </div>

                <div class="searchTheme">Search</div>
                Click on an icon below to find content categories within this affirmation, or enter a search term in the
                field below.
                <div class="theme_search">
                    <form class="form-inline" action="<?php echo url('search_from_theme')?>">
                        <input type="hidden" name="product_theme" value="{{$theme_details->theme_id}}">
                        <div class="theme_search_gray_div">
                            <input type="text" id="theme_search_input" autocomplete="on" name="search_token"
                                   class="form-control input-large"
                                   placeholder="Enter a keyword to search this theme now">
                        </div>

                        <div class="theme_search_icon_div">
                            <?php if($category_details) {
                            foreach($category_details as $category){?>
                            <div class="theme_search_icon">
                                <div class="check_img_div">
                                    <img class="check_img"
                                         src="<?php echo url(''); ?>/public/assets/images/category/<?php echo $category->mc_img; ?>"
                                         alt="Sermons"
                                         align="center"/>
                                </div>
                                <p><?php echo $category->mc_name;?></p>
                                <input type="checkbox" name="product_category" style="visibility: hidden;"
                                       value="<?php echo $category->mc_id;?>"/>
                            </div>
                            <?php
                            }
                            ?>
                            <?php } else {?>
                            <div class="theme_search_icon">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/t-sermons.png"
                                     alt="Sermons"
                                     align="center"/>
                                <p>Sermons</p>
                                <input type="checkbox" class="hidden" name="select_category[]" value="1"/>
                            </div>
                            <div class="theme_search_icon">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/t-worship.png"
                                     alt="Worship"
                                     align="center"/>
                                <p>WORSHIP RESOURCES</p>
                                <input type="checkbox" class="hidden" name="select_category[]" value="2"/>
                            </div>
                            <div class="theme_search_icon">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/t-children.png"
                                     alt="Children Material"
                                     align="center"/>
                                <p>CHILDREN'S MATERIALS</p>
                                <input type="checkbox" class="hidden" name="select_category[]" value="3"/>
                            </div>
                            <div class="theme_search_icon">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/t-commentary.png"
                                     alt="Commentary"
                                     align="center"/>
                                <p>COMMENTARY</p>
                                <input type="checkbox" class="hidden" name="select_category[]" value="4"/>
                            </div>
                            <div class="theme_search_icon">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/t-small-groups.png"
                                     alt="Small Groups"
                                     align="center"/>
                                <p>SMALL GROUPS</p>
                                <input type="checkbox" class="hidden" name="select_category[]" value="5"/>
                            </div>
                            <div class="theme_search_icon">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/t-forums.png"
                                     alt="Forums"
                                     align="center"/>
                                <p>FORUMS</p>
                                <input type="checkbox" class="hidden" name="select_category[]" value="6"/>
                            </div>
                            <?php } ?>

                        </div>

                        <button class="theme_search_bt" id="search_label"><i class="icon-search"></i>Click Here for
                            Advanced Search
                        </button>
                    </form>
                </div>
            </div>
            <div id="theme_sidebar" class="col-md-4 col-sm-4 col-xs-12">
                <div class="theme-quote">
                    "The Living Lectionary connects prophetic leaders to inspiring resources. If you are committed to
                    creating a more just and generous world, the resources you need are here."
                </div>
                <!--
               <div style="clear:both;">
               <div class="sidebar-share">
               <div class="social-sidebar"><a href="https://facebook.com" target="_blank"><img src="../public/assets/images/icons/fb.jpg" alt="Facebook" width="100%" /></a></div>
                <div class="social-sidebar"><a href="https://twitter.com" target="_blank"><img src="../public/assets/images/icons/tw.jpg" alt="Twitter" width="100%" /></a></div>
                 <div class="social-sidebar"><a href="https://instagram.com" target="_blank"><img src="../public/assets/images/icons/ig.jpg"  alt="Instagram" width="100%" /></a></div>
                  <div class="social-sidebar"><a href="http://youtube.com" target="_blank"><img src="../public/assets/images/icons/youtube.jpg"  alt="YouTube" width="100%" /></a></div>

               </div>
               </div>

               <div style="clear:both;"></div>
               <div class="theme-quote">Trending Content</div>
               -->
                <!--<div class="theme_sidebar_orange_div">
                    TRENDING CONTENT
                </div> -->
            <!--
                <div class="theme_sidebar_trending_contents">
                    @if(isset($trending_products) && count($trending_products) >0)
                <section class="grid">
                    @for($i=0; $i < 2; $i++)
                    <?php
                    if(array_key_exists($i, $trending_products))
                    {
                    $trp = $trending_products[$i];
                    $res = base64_encode($trp->pro_id);
                    $product_image = explode('/**/', $trp->pro_Img);
                    ?>
                            <div class="product_info">
                                <a href="{!! url('productview').'/'.$res!!}">
                                        <img class="product__imageSidebar"
                                             src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"
                                             alt="" title=""/>
                                    </a>
                                </div>
                                <?php
                    }
                    ?>
                @endfor
                        </section>
                    @endif
                    </div>

                    <div class="add_content row-fluid">
                        <div class="span3">
                            <img class="img-responsive" src="<?php echo url('/public/assets/images/plus_content.png')?>">
                    </div>
                    <div class="span9">
                        <p class="">Have content to share? Click here to add or register</p>
                    </div>-->
            </div>
        </div>
    </div>
    </div>


    {{--Trending Resources Section--}}
    <div class="container" id="home_product_section">
        <div style="color:#fff; padding-top:15px; padding-bottom:15px;" class="text-center">
            <span class="llnoteTitle" style="color:black;">FEATURED CONTENT</span>
        </div>
        <div class="row-fluid">
            <div id="demo" class="tab-land-wid" style="margin-left:20px;">
                <div class="view">
                    @if(isset($trending_products))
                        <section class="grid row-fluid">
                            @foreach($trending_products as $trp)
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="product">
                                        <?php
                                        $res = base64_encode($trp->pro_id);
                                        $product_image = explode('/**/', $trp->pro_Img);
                                        ?>

                                        <div class="product__info">
                                            <div class="img">
                                                <a href="{!! url('productview').'/'.$res!!}">
                                                    <img class="product__image"
                                                         src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"
                                                         alt="" title=""/>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="">
                                            <p class="title product__title tab-title">
                                                <?php
                                                $title = $trp->pro_title;
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
                                                if ($trp->pro_price == 0)
                                                    echo "FREE";
                                                else
                                                    echo '$ ' . $trp->pro_price;
                                                ?>
                                            </p>
                                            <?php } else {
                                            if ($trp->pro_price == 0) {?>
                                            <p class="like product__price"> Free </p>
                                            <?php } else {?>
                                            <p class="like product__price">
                                                <span class="{!! $origin_price_class !!}"> {!! '$ '.$trp->pro_price !!} </span>
                                                &emsp;
                                                <span class="{!! $discounted_price_class !!}"> {!! '$ '. round($trp->pro_price*0.7, 2) !!} </span>
                                            </p>
                                            <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <a href="{!! url('productview').'/'.$res!!}">
                                            <button class="action action--button action--buy font-tab">
                                                <i class="icon icon-shopping-cart"></i>
                                                <span class="action__text">Add to cart</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{--endTrending Resources--}}

@endsection

@section ('script')

    <script>
        //        $(document).click(function (e) {
        //            var target = e.target;
        //            var tid = target.id;
        //            if (tid != 'search_label' && tid != "theme_search_input") {
        //                $('#search_label').show();
        //                $('#theme_search_input').hide();
        //            } else if (tid == 'theme_search_input') {
        //                return;
        //            } else if (tid == "search_label") {
        //                $('#search_label').hide();
        //                $('#theme_search_input').val('').show();
        //            }
        //        });

        $('.check_img_div').click(function () {
            $('.check_img_div').each(function () {
                $(this).removeClass('checked_img');
                $(this).parent().find('input[type="checkbox"]').prop('checked', false);
            })

            $(this).addClass('checked_img');
            $(this).parent().find('input[type="checkbox"]').prop('checked', true);

            $('#search_label').trigger('click');
        })
    </script>
@endsection