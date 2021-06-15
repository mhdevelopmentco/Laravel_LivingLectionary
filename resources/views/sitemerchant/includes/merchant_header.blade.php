<?php
$current_route = Route::getCurrentRoute()->getPath();

if (isset($routemenu)) {
    $menu = $routemenu;
}
if (Session::get('merchantid')) {
    $merchantid = Session::get('merchantid');
}

?>
<div oncontextmenu="return false"></div>
<div id="top">

    <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip"
           class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu"
           id="menu-toggle">
            <i class="icon-align-justify"></i>
        </a>
        <!-- LOGO SECTION -->
        <header class="navbar-header">

            <a href="<?php echo url('sitemerchant_dashboard')?>" class="navbar-brand">
                <img src="<?php echo url(); ?>/themes/images/logo/contributorlogo.png" alt="Logo"/></a>
        </header>
        <!-- END LOGO SECTION -->
        <ul class="nav navbar-top-links navbar-right">

            <?php

            if (Session::get('merchantid')) {
                $merchantid = Session::get('merchantid');
            }
            ?>
            <strong> Hi, <?php echo Session::get('merchantname');?></strong>
            <li><a href="<?php echo url('merchant_profile');?>" class="btn btn-default"><i class="icon-user"></i>
                    Profile </a>
            </li>
            <li><a href="<?php echo url('merchant_settings');?>" class="btn btn-default"><i class="icon-gear"></i>
                    Settings </a>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo url('merchant_logout');?>" class="btn btn-default"><i class="icon-signout"></i>
                    Logout </a>
            </li>
        </ul>
    </nav>

    <div class="mainmenu">
        <ul class="">
            <li>
                <a href="<?php echo url('sitemerchant_dashboard');?>"
                   <?php if($menu == "dashboard"){?>class="active"<?php } ?> >Dashboard</a>
            </li>

            <li>
                <a href="<?php echo url('merchant_profile');?>"
                   <?php if($menu == "settings"){?>class="active"<?php } ?>>Settings</a>
            </li>

            <li>
                <a href="<?php echo url('merchant_manage_shop');?>"
                   <?php if($menu == "shop"){?>class="active"<?php } ?>> Shops </a>
            </li>

            <li>
                <a href="<?php echo url('mer_manage_product');?>"
                   <?php if($menu == "products"){?>class="active"<?php } ?>>
                    Resources </a>
            </li>


            <li><a href="<?php echo url('show_merchant_transactions');?>"
                   <?php if($menu == "transaction"){?>class="active"<?php } ?>> Transactions </a></li>

            <li>
                <a href="<?php echo url('withdraw_report');?>" <?php if($menu == "funds"){?>class="active"<?php } ?>> Withdraw </a>
            </li>
        </ul>
    </div>

</div>
