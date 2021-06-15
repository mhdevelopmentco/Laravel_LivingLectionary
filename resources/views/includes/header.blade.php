<!--required: $logodetails, $inverse_logodetails, $theme_list!-->
<?php
$loggedin = false;
if (Session::has('customerid')) {
    $loggedin = true;
    $id = Session::get('customerid');
    $connect = DB::table('nm_member')->where('mem_id', '=', $id)->first();
    $logintype = $connect->mem_logintype;
    $subscribe = Session::get('subscribe');
};

if (isset($menu_inverse))
    $inverse_class = "inverse";
else
    $inverse_class = "";

$logoimgpath = "themes/images/logo/sitelogo1.png";

if (isset($logodetails)) {
    if (count($logodetails) > 0) {
        $logoimgpath = "themes/images/logo/" . $logodetails[0]->imgs_name;
    }
}

$logoimgpath2 = "themes/images/logo/sitelogo2.png";
if (isset($inverse_logodetails)) {
    if (count($inverse_logodetails) > 0) {
        $logoimgpath2 = "themes/images/logo/" . $inverse_logodetails[0]->imgs_name;
    }
}

?>

<div id="siteheader" class=" navbar para-nav navbar-fixed-top <?php echo $inverse_class; ?>">

    <div class="mobile_menu">
        <div class="mobile_toggle_div">
            <a id="smallScreen" href="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <i class="icon-align-justify"></i>
            </a>
        </div>

        <a href="{{url('home')}}" class="mobile_logo_href text-center">
            <img class="mobile_logo" src="<?php echo url('') . '/' . $logoimgpath; ?>">
        </a>

        <div class="mobile_search_div">
            <button type="button" class="btn" onclick="location.href='{{url('search')}}'" id="mobile_search_bt">
                <i class="icon icon-search" aria-hidden="true"></i>
            </button>
        </div>

    </div>
    <div class="header-left">

        <a class="brand inverse_hide" id="firstlogo" href="<?php echo url('index'); ?>"><img
                    class="img-responsive"
                    src="<?php echo url('') . '/' . $logoimgpath; ?>"
                    alt="Living Lectionary"/></a>
        <a class="brand hidden inverse_show" id="inverselogo" href="<?php echo url('index'); ?>"><img
                    class="img-responsive"
                    src="<?php echo url('') . '/' . $logoimgpath2; ?>" alt="Living Lectionary"/></a>
    </div>
    <div class="header-right menu-bgg">
        <div class="search_short pull-right">
            <div class="navbar-search">
                <div class="input-group">
                    <div class="btn-group pull-left" role="group" id="dropdown-bt-ppp">
                        <div class="dropdown dropdown-md">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    id="dropdown_toggle_bt"><i
                                        class="icon icon-caret-down"></i></button>
                            <div id="drop-down-div" area-expanded="false">
                                <form class="form-horizontal" role="form"
                                      action="{!!action('HomeController@do_search')!!}">
                                    <h5>Resources and Stores</h5>
                                    <input type="hidden" name="normal_search" value="0"/>
                                    <div class="form-group row-fluid">
                                        <label for="product_theme" class="control-label span4">Theme</label>
                                        <div class="span8">
                                            <select class="form-control" id="product_theme"
                                                    name="product_theme[]" required>
                                                <option value="0">--select--</option>
                                                @foreach($theme_list as $tdd)
                                                    @if($tdd->parent_theme == 0)
                                                        <option value="{{$tdd->theme_id}}">{{$tdd->theme_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row-fluid">
                                        <label for="product_category"
                                               class="control-label span4">Category</label>
                                        <div class="span8">
                                            <select class="form-control category_search"
                                                    id="product_category"
                                                    name="product_category" data-level="1"
                                                    data-child="product_main_category,product_sub_category,product_secsub_category">
                                                <option value="0">--select--</option>
                                                @foreach($catg_list as $cat)
                                                    <option value="{{$cat->mc_id}}">{{$cat->mc_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--div class="form-group row-fluid">
                                        <label for="pass1" class="control-label span5">Main Category</label>
                                        <div class="span7">
                                            <select class="form-control category_search"
                                                    id="product_main_category"
                                                    name="product_main_category" data-level="2"
                                                    data-child="product_sub_category,product_secsub_category">
                                                <option selected value="0">--select--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row-fluid">
                                        <label for="pass1" class="control-label span5">Sub Category</label>
                                        <div class="span7">
                                            <select class="form-control category_search"
                                                    id="product_sub_category"
                                                    name="product_sub_category" data-level="3"
                                                    data-child="product_secsub_category">
                                                <option selected value="0">--select--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row-fluid">
                                        <label for="pass1" class="control-label span5">Second Sub
                                            Category</label>
                                        <div class="span7">
                                            <select class="form-control" id="product_secsub_category"
                                                    name="product_secsub_category">
                                                <option selected value="0">--select--</option>
                                            </select>
                                        </div>
                                    </div-->
                                    <div class="form-group row-fluid">
                                        <label for="product_contributor"
                                               class="control-label span4">Contributor</label>
                                        <div class="span8">
                                            <input type="text" class="form-control" id="product_contributor"
                                                   name="product_contributor"/>
                                        </div>
                                    </div>
                                    <div class="form-group row-fluid">
                                        <label for="product_name"
                                               class="control-label span4">Keyword or <br> Scripture</label>
                                        <div class="span8">
                                            <input type="text" class="form-control" id="product_name"
                                                   name="search_token"/>
                                        </div>
                                    </div>
                                    <div class="form-group row-fluid">
                                        <div class="span12">
                                            <button type="submit" id="adv_search_bt"
                                                    class="btn btn-primary pull-right">
                                                <i class="icon icon-search" aria-hidden="true"></i>&emsp;Search
                                                Now
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <form class="form-inline  pull-left" action="{!!action('HomeController@do_search')!!}"
                          id="normal-search">
                        <input type="text" class="form-control"
                               placeholder="" name="search_token" required id="normal_search_input"/>
                        <input type="hidden" name="normal_search" value="1"/>
                        <button type="submit" class="btn btn-primary" id="pri_search_bt">
                            <i class="icon icon-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <ul id="topMenu" class="nav pull-left collapse">
            <li <?php if(Route::getCurrentRoute()->getPath() == 'home' || Route::getCurrentRoute()->getPath() == '/') { ?>class="active"
                <?php } else {?> class=""
            <?php } ?>><a href="<?php echo url('home'); ?>">Home</a>
            </li>
            <li <?php if(Route::getCurrentRoute()->getPath() == 'about_us') { ?>class="active dropdown"
                <?php } else {?> class="dropdown"
            <?php } ?>><a>ABOUT US</a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="theme_menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                               href="{{url('about_us')}}">About the Lectionary</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                               href="{{url('contributors')}}">For Contributors</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                               href="{{url('faq')}}">Lectionary FAQ</a></li>
                </ul>
            </li>
            <?php if(!$loggedin){?>
            <li <?php if(Route::getCurrentRoute()->getPath() == 'join') { ?>class="active"
                <?php } else {?> class=""
            <?php } ?>><a href="<?php echo url('join'); ?>">Join</a>
            </li>
            <?php } ?>

            <?php if ($loggedin && $logintype == \App\Member::MEMBER_LOGIN_CUSTOMER ) {?>
            <li <?php if(Route::getCurrentRoute()->getPath() == 'become_a_contributor') { ?>class="active"
                <?php } else {?> class=""
            <?php } ?>><a href="<?php echo url('become_a_contributor'); ?>">Contribute</a>
            </li>
            <?php } ?>

            <li <?php if(Route::getCurrentRoute()->getPath() == 'affirmations') { ?>class="active dropdown"
                <?php } else {?> class="dropdown"<?php } ?>>
                <a id="theme_menu" class="dropdown-toggle" data-toggle="dropdown">Affirmations</a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="theme_menu">
                    @foreach($theme_list as $tdd)
                        @if($tdd->parent_theme == 0)
                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="<?php echo url('affirmations/' . strtolower($tdd->theme_name)); ?>">{{$tdd->theme_name}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li <?php if(Route::getCurrentRoute()->getPath() == 'search') { ?>class="active"
                <?php } else {?> class=""
            <?php } ?>><a href="<?php echo url('search'); ?>">Search</a>
            </li>
            <li class="dropdown">
                <a id="navbar_user" class="dropdown-toggle"
                   data-toggle="dropdown" style="cursor:pointer;">
                    <img src="<?php echo url(''); ?>/themes/images/user.png" class="menu_img">
                <!--span style="margin-left: 5px;"><?php echo Session::get('username');?></span-->
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="navbar_user">
                    <?php if($loggedin)  {?>

                    <?php if($logintype == \App\Member::MEMBER_LOGIN_MERCHANT) { ?>
                    <li role="presentation"><a role="menuitem"
                                               href="<?php echo url('add_my_resource')?>"><i
                                    class="icon icon-cloud-upload"></i>&emsp;&emsp;Add My Resource</a></li>

                    <li role="presentation">
                        <a href="<?php echo url('settings');?>" role="menuitem"><i
                                    class="icon icon-cogs"></i>&emsp;&emsp;Settings
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" href="<?php echo url('my_buys');?>">
                            <i class="icon icon-usd"></i> &emsp;&emsp;Selected & Purchased Resources</a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" href="<?php echo url('my_wishlist');?>"><i
                                    class="icon icon-heart"></i>&emsp;&emsp;My wishlist</a>
                    </li>

                    <li role="presentation">
                        <a href="<?php echo url('sitemerchant');?>" role="menuitem"><i
                                    class="icon icon-desktop"></i>&emsp;&emsp;Go to My Dashboard
                        </a>
                    </li>
                    <?php  } else { ?>
                <!--($logintype == \App\Member::MEMBER_LOGIN_CUSTOMER)-->
                    <li role="presentation">
                        <a role="menuitem" href="<?php echo url('become_a_contributor')?>"><i
                                    class="icon icon-trophy"></i>&emsp;&emsp;Become A Contributor</a></li>
                    <li role="presentation">
                        <a href="<?php echo url('settings');?>" role="menuitem"><i
                                    class="icon icon-cogs"></i>&emsp;&emsp;Settings
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" href="<?php echo url('my_buys');?>">
                            <i class="icon icon-usd"></i> &emsp;&emsp;Selected & Purchased Resources</a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" href="<?php echo url('my_wishlist');?>"><i
                                    class="icon icon-heart"></i>&emsp;&emsp;My wishlist</a>
                    </li>
                    <?php } ?>

                    <?php } else { ?>
                    <li role="presentation">
                        <a role="menuitem" href="#login" role="button" data-toggle="modal"
                        ><i class="icon icon-signin"></i>&emsp;&emsp;Sign In</a>
                    </li>
                    <?php } ?>
                    <li role="presentation" class="bdt">
                        <!--Facebook Logout
                        <a href="#" onclick="logout();"><i class="icon icon-signout"></i>&emsp;&emsp;Log Out</a>
                        -->
                        <a href="<?php echo url('user_logout');?>"><i class="icon icon-signout"></i>&emsp;&emsp;Sign Out</a>
                    </li>
                </ul>

            </li>
            <li>
                <?php
                $count1 = $count2 = $total_count = 0;

                if (isset($_SESSION['cart'])) {
                    $item_count_header1 = count($_SESSION['cart']);
                    for ($i = 0; $i < $item_count_header1; $i++) {
                        $count1 += $_SESSION['cart'][$i]['qty'];
                    }
                } else {
                    $count1 = 0;
                }

                if (isset($_SESSION['deal_cart'])) {
                    $count2 = count($_SESSION['deal_cart']);
                } else {
                    $count2 = 0;
                }

                $total_count = $count1 + $count2;
                ?>
                <a class="navbar-cart" href="<?php echo url('cart'); ?>">
                <!--img data-toggle="tooltip" data-placement="bottom" class="menu_img inverse_hide"
                         title="{{$total_count}} items in your cart"
                         src="<?php echo url(''); ?>/themes/images/cart2.png"-->

                    <img data-toggle="tooltip" data-placement="bottom" class="menu_img"
                         title="{{$total_count}} items in your cart"
                         src="<?php echo url(''); ?>/themes/images/cart1.png">
                    <?php if($total_count) {?>
                    <span class="cart_count">{{$total_count}}</span>
                    <?php } ?>
                </a>
            </li>
        </ul>
    </div>
    <!--a onclick="fb_login()"><span class="btn btn-mini btn-primary"><i class=" icon-facebook icon-white"></i> Facebook Login </span>
    </a-->

</div>
<!--end of fixed Site menu -->
