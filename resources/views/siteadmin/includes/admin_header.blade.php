<?php  $current_route = Route::getCurrentRoute()->getPath();

if (isset($routemenu)) {
    $menu = $routemenu;
}
?>
<div oncontextmenu="return false"></div>
<script type="text/javascript">
    var __lc = {};
    __lc.license = 4302571;

    (function () {
        var lc = document.createElement('script');
        lc.type = 'text/javascript';
        lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(lc, s);
    })();
</script>

<div id="top">

    <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip"
           class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu"
           id="menu-toggle">
            <i class="icon-align-justify"></i>
        </a>
        <!-- LOGO SECTION -->
        <header class="navbar-header">

            <a href="<?php echo url('')?>" class="navbar-brand">
                <img src="<?php echo url();?>/themes/images/logo/adminlogo.png" alt="Logo"/></a>
        </header>
        <!-- END LOGO SECTION -->
        <ul class="nav navbar-top-links navbar-right">
        <?php $newsubscriberscount = Session::get('newsubscriberscount');
        $blogcmtcount = Session::get('blogcmtcount');
        $adrequestcnt = Session::get('adrequestcnt');
        ?>
        <!-- MESSAGES SECTION -->
            <li class="dropdown">
                <a href="<?php echo url('manage_blogcmts');?>" data-original-title="Tooltip on bottom"
                   data-toggle="tooltip" data-placement="bottom" title="Blog comments">
                    <span class="label label-success"><?php echo $blogcmtcount;?></span> <i
                            class="icon-comment-alt"></i>&nbsp;
                </a>
            </li>
            <?php /*?> <li class="dropdown">
                        <a href="<?php echo url('manage_news_subscribers');?>" data-original-title="Tooltip on bottom" data-toggle="tooltip" data-placement="bottom" title="New Subscribers">
                            <span class="label label-success"><?php echo $newsubscriberscount;?></span>    <i class="icon-bookmark-empty"></i>&nbsp; 
                        </a>
		  </li><?php */?>
            <li class="dropdown">
                <a href="<?php echo url('manage_ad');?>" data-original-title="Tooltip on bottom" data-toggle="tooltip"
                   data-placement="bottom" title="Advertise request">
                    <span class="label label-success"><?php echo $adrequestcnt;?></span> <i
                            class="icon-bookmark-empty"></i>&nbsp;
                </a>
            </li>
            <li><a href="<?php echo url('admin_profile');?>" class="btn btn-default"><i class="icon-user"></i> My
                    Profile </a>
            </li>
            <li><a href="<?php echo url('admin_settings');?>" class="btn btn-default"><i class="icon-gear"></i> Settings
                </a>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo url('admin_logout');?>" class="btn btn-default"><i class="icon-signout"></i> Logout
                </a>
            </li>

            <!--END ADMIN SETTINGS -->
        </ul>

    </nav>

    <div class="mainmenu">
        <ul class="">
            <li><a href="<?php echo url('siteadmin_dashboard');?>"
                   <?php if($menu=="dashboard"){?>class="active"<?php } ?>>Dashboard</a></li>
            <li><a href="<?php echo url('general_setting');?>" <?php if($menu=="settings"){?>class="active"<?php } ?>>Settings</a>
            </li>
            <li><a href="<?php echo url('resource_dashboard');?>" <?php if($menu=="products"){?>class="active"<?php } ?>>
                    Resources </a></li>
            <li><a href="<?php echo url('transaction_dashboard');?>" <?php if($menu=="transaction"){?>class="active"<?php } ?>>
                    Transactions </a></li>
            <li><a href="<?php echo url('manage_publish_blog');?>" <?php if($menu=="blog"){?>class="active"<?php } ?>>Blogs</a>
            </li>
            <li><a href="<?php echo url('member_dashboard');?>"
                   <?php if($menu=="customer"){?>class="active"<?php } ?>>Members </a></li>
            <li><a href="<?php echo url('merchant_dashboard');?>"
                   <?php if($menu=="merchant"){?>class="active"<?php } ?>>Contributors</a></li>
            <li><a href="<?php echo url('curator_dashboard');?>"
                   <?php if($menu=="curator"){?>class="active"<?php } ?>>Curators </a></li>
        </ul>
    </div>

</div>
