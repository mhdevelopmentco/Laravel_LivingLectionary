@extends('includes/page_master')
@section('content')
    {{--Carouel--}}
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
                                <p>Where Creative Ministry
                                    Meets<br/>
                                    Crowd-Sourced Collaboration</p>
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

    {{--LL Tile Section--}}
    <div class="container">
        <!--custom content -->
        <div class="row" style=" padding-top: 20px;">


            <div class="llDesc">
                <div class="lltitle1">WELCOME TO THE LIVING LECTIONARY</div>

                The Living Lectionary is a new approach to a timeless resource. Centered on core affirmations of
                progressive Christian faith, it allows you to draw on the entire narrative of Scripture at any time of
                the year. By allowing any user to contribute resources, it offers diverse perspectives that move your
                faith community to a deeper love of God, others and self. Explore. Contribute. Connect.

            </div>


            <div id="front-buttons">

                <a href="{{url('Join')}}" class="fbutton"> <img
                            src="http://ll.skycrossmedia.com/public/assets/images/buttons/join.jpg" alt="Join Us"
                            width="80%" style="padding-bottom:10px;" align="center"></a>

                <a href="{{url('Become_A_Contributor')}}" class="fbutton"> <img
                            src="http://ll.skycrossmedia.com/public/assets/images/buttons/contribute.jpg"
                            alt="Contribute" width="80%" style="padding-bottom:10px;" align="center"></a>

                <a href="{{ url('Search')}}" class="fbutton"><img
                            src="http://ll.skycrossmedia.com/public/assets/images/buttons/search.jpg" alt="Search"
                            width="80%" align="center"></a>
            </div>

            <div style="clear:both;"></div>

            <div class="llheader">The Affirmations</div>

            <!-- Show Affirmations Gallery -->
            <div id="gallery" class="final-tiles-gallery  caption-top caption-bg">
                <div class="ftg-items">
                    <?php $theme_index = 1;?>
                    @foreach($top_theme_list as $theme)
                        <div class="tile">
                            <div data-lightbox="gallery" data-title="Affirmation #{!! $theme_index !!}"
                                 class="tile-inner"
                                 data-href="{{url('affirmations') . '/' . strtolower($theme->theme_name) }}">
                                <img class="item"
                                     data-src="{{ url('public/assets/images/finalgalleryimage') . '/' . $theme->theme_gallery_img}}">
                                <label class="theme_name">{{'#'.$theme_index.' '.$theme->theme_name}}</label>
                                <span class='title'>{{$theme->theme_heading}}</span>
                            </div>
                        </div>
                        <?php $theme_index++;?>
                    @endforeach
                </div>
            </div>

        <!--div id="gallery" class="final-tiles-gallery  caption-top caption-bg">
                <div class="ftg-items">
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #1" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/1">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/mountain400a.jpg"/>
                            <span class='title'>Walking with Jesus while acknowledging the possibility of other legitimate paths</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #2" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/3">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/prayera.jpg"/>
                            <span class='title'>Listening for God Word's through prayer, scripture, and reflection</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #3" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/4">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/creation400a.jpg"/>
                            <span class='title'>Celebrating God's glory in all of Creation</span>
                        </div>
                    </div>

                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #4" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/12">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/worshipa.jpg"/>
                            <span class='title'>Expressing our love in sincere, artful worship</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #5" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/13">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/diversitya.jpg"/>
                            <span class='title'>Engaging ALL people authentically, as creations in the image of God</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #6" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/14">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/marginalizeda.jpg"/>
                            <span class='title'>Standing with the marginalized, seeking peace and justice</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #7" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/15">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/church-state4a.jpg"/>
                            <span class='title'>Supporting religious freedom and the separation of church and state</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #8" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/16">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/humilitya.jpg"/>
                            <span class='title'>Walking humbly with God while loving our enemies</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #9" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/17">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/loveda.jpg"/>
                            <span class='title'>Living in the knowledge that we and all people are loved for eternity</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #10" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/18">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/science2a.jpg"/>
                            <span class='title'>Recognizing that faith and science serve the pursuit of truth</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #11" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/19">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/healtha.jpg"/>
                            <span class='title'>Caring for our bodies and living holistically</span>
                        </div>
                    </div>
                    <div class="tile">
                        <div data-lightbox="gallery" data-title="Affirmation #12" class="tile-inner"
                             data-href="<?php echo url(); ?>/show_theme/20">
                            <img class="item"
                                 data-src="<?php echo url(); ?>/public/assets/images/finalgalleryimage/purpose2a.jpg"/>
                            <span class='title'>Believing our lives have a meaning and purpose which extend God's realm of love</span>
                        </div>
                    </div>
                </div>
            </div-->

            <div id="lltilemark">
                <a href="http://convergenceus.org/" target="_blank">
                    <img src="<?php echo url('');?>/public/assets/images/convergence400.png" alt="Convergence"
                         style="margin-top:20px;">
                </a>
                <a href="http://sfts.edu/innovation/center-for-innovation-in-ministry/" target="_blank">
                    <img src="<?php echo url('');?>/public/assets/images/sfts400.png"
                         alt="San Francisco Theological Seminary"
                         style="margin-right:5%">
                </a>
            </div>
        </div>
        <!--end custom content -->
    </div>
    {{--endLL Tile Section--}}

    {{--Explore Section--}}
    <div id="explore">
        <div class="exploreContainer">
            <span class="exploreTitle">EXPLORE</span>
            <div style="clear:both; margin-bottom:60px;"></div>

            <div class="row-fluid">
                <?php if($category_details) {
                foreach($category_details as $category){?>
                <div class="exploreIcon">
                    <a href="<?php echo url('search') . '?normal_search=0&product_category=' . $category->mc_id; ?>">
                        <div class="row-fluid">
                            <div class="span4">
                                <img src="<?php echo url(''); ?>/public/assets/images/category/<?php echo $category->mc_img2; ?>"
                                     alt="<?php echo $category->mc_name;?>" class="img-responsive"
                                     align="center"/>
                            </div>
                            <div class="span7 offset1">
                                <div class="exploreT">
                                    <h2><?php echo $category->mc_name;?></h2>
                                    <p><?php echo $category->mc_desc;?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
            <?php } else {?>
            <div class="exploreIcon">
                <a href="<?php echo url();?>/search?normal_search=0&amp;product_category=2">
                    <div class="row-fluid">
                        <div class="span4">
                            <img src="<?php echo url();?>/public/assets/images/category/sermons.png" alt="SERMONS"
                                 class="img-responsive" align="center">
                        </div>
                        <div class="span7 offset1">
                            <div class="exploreT">
                                <h2>SERMONS</h2>
                                <p>Thoughtful, creative teachings that foster love and justice</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="exploreIcon">
                <a href="<?php echo url();?>/search?normal_search=0&amp;product_category=3">
                    <div class="row-fluid">
                        <div class="span4">
                            <img src="<?php echo url();?>/public/assets/images/category/children.png"
                                 alt="CHILDRENDS MATERIAL" class="img-responsive" align="center">
                        </div>
                        <div class="span7 offset1">
                            <div class="exploreT">
                                <h2>CHILDRENDS MATERIAL</h2>
                                <p>Curriculum and activities that nurture the faith of kids and teens</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="exploreIcon">
                <a href="<?php echo url();?>/search?normal_search=0&amp;product_category=4">
                    <div class="row-fluid">
                        <div class="span4">
                            <img src="<?php echo url();?>/public/assets/images/category/worship.png" alt="WORSHIP"
                                 class="img-responsive" align="center">
                        </div>
                        <div class="span7 offset1">
                            <div class="exploreT">
                                <h2>WORSHIP</h2>
                                <p>Music, liturgies and community practices to illuminate God's presence</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="exploreIcon">
                <a href="<?php echo url();?>/search?normal_search=0&amp;product_category=5">
                    <div class="row-fluid">
                        <div class="span4">
                            <img src="<?php echo url();?>/public/assets/images/category/commentary.png" alt="COMMENTARY"
                                 class="img-responsive" align="center">
                        </div>
                        <div class="span7 offset1">
                            <div class="exploreT">
                                <h2>COMMENTARY</h2>
                                <p>Scholarly and practical insights that enliven Scripture &amp; spirituality</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="exploreIcon">
                <a href="<?php echo url();?>/search?normal_search=0&amp;product_category=6">
                    <div class="row-fluid">
                        <div class="span4">
                            <img src="<?php echo url();?>/public/assets/images/category/small-groups.png"
                                 alt="SMALL GROUPS" class="img-responsive" align="center">
                        </div>
                        <div class="span7 offset1">
                            <div class="exploreT">
                                <h2>SMALL GROUPS</h2>
                                <p>Studies and resources to equip communities for positive change</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="exploreIcon">
                <a href="<?php echo url();?>/search?normal_search=0&amp;product_category=7">
                    <div class="row-fluid">
                        <div class="span4">
                            <img src="<?php echo url();?>/public/assets/images/category/forums.png"
                                 alt="OTHER RESOURCES"
                                 class="img-responsive" align="center">
                        </div>
                        <div class="span7 offset1">
                            <div class="exploreT">
                                <h2>OTHER RESOURCES</h2>
                                <p>An eclectic mix of tools for progressive Christian faith</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <?php } ?>
            <div style="clear:both;"></div>
        </div>
    </div>
    {{--endExplore Section--}}

    {{--Trending Resources Section--}}
    <div class="container" id="home_product_section">
        <div class="llheader">Trending Content</div>
        <div class="row">
            <div id="demo" class="tab-land-wid" style="margin-top: 20px;margin-left:20px;">
                <div class="view">
                    @if(isset($trending_products))
                        <section class="grid">
                            @foreach($trending_products as $trp)
                                <div class=" col-md-3 col-sm-6 col-xs-12">
                                    <div class="product">
                                    <?php
                                    $res = base64_encode($trp->pro_id);
                                    $product_image = explode('/**/', $trp->pro_Img);
                                    ?>
                                    <!-- img -->
                                        <a href="{!! url('productview').'/'.$res!!}">
                                            <div class="product__info">
                                                <img class="product__image"
                                                     src="<?php echo url('public/assets/images/product') . '/' . $product_image[0];?>"
                                                     alt="" title=""/>
                                                <p class="title product__title tab-title">
                                                    <?php if (strlen($trp->pro_title) > 20) {
                                                        echo substr($trp->pro_title, 0, 20) . '...';
                                                    } else {
                                                        echo $trp->pro_title;
                                                    }?>
                                                </p>
                                            <!-- <p class="like product__price">{{$trp->pro_price}}</p>  -->
                                            </div>
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
    {{--endTrending Products--}}

    <div class="container" id="featured_section">
        <span class="llnoteTitle">Featured Contributers</span>
        <div style="clear:both; height:20px;"></div>
        <div class="row">
            @foreach($addetails as $adinfo)
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <a href="{{$adinfo->ad_redirecturl}}" target="_blank">
                        <img class="feature_img img-responsive"
                             src="{{url('/public/assets/images/adimage/'.$adinfo->ad_img)}}"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div id="need_to_register" class="modal fade" aria-hidden="true" role="dialog" aria-labelledby="login"
         style="height:260px;display:none; overflow:inherit">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 style="font-style: italic">Ready contribute to the Living Lectionary?</h3>
        </div>
        <div class="modal-body">
            <h2>Let's Get Started.</h2>

            <p style="padding-top:10px;">Please begin the process by <a href="{{url('Join')}}" class="text-info">clicking
                    here</a>.</p>
            <p>If you are already a member, please log in and click
                <a href="http://livinglectionary.org/Become_A_Contributor" class="text-danger">Contribute</a> to
                begin.</p>
        </div>
    </div>

@endsection

@section('script')
    <!-- Final Tiles Grid Gallery script -->
    <script src="<?php echo url(); ?>/public/plugins/finaltilesgallery/js/jquery.finaltilesgallery.js"></script>
    <script>
        $(function () {

            if ($('.final-tiles-gallery').length > 0) {
                //we call Final Tiles Grid Gallery without parameters,
                //see reference for customisations: http://final-tiles-gallery.com/index.html#get-started
                $(".final-tiles-gallery").finalTilesGallery();
            }

            $('.final-tiles-gallery .ftg-items .tile .tile-inner').click(function () {
                var href = $(this).attr('data-href');
                href=href.replace(/%20/g, " ");
                location.href = href;
            });
        });

        var cururl = document.location.hash;
        if (cururl == "#login") {
            $('#login').modal('show');
        } else if (cururl == "#reset_pwd") {
            $('#reset_pwd').modal('show');
        }
    </script>
    <script>
                @if ($errors->any())
        var error_msg = "{!! implode('', $errors->all(':message')) !!}";
        alert(error_msg);
        @endif
    </script>

    <script>
        @if(Session::has('need_to_register'))
            $('#need_to_register').modal('show');
                @endif

                @if(Session::has('message'))
        var message = "{{Session::get('message')}}";
        alert(message);
        @endif
    </script>
    <script>
        @if(Session::has('unsubscribed'))
            alert('You have unsubscribed from our Newsletter.');
        <?php Session::forget('unsubscribed');?>
        @endif
    </script>
@endsection