<?php
        if(!isset($routemenu))
        {
            $routemenu = Route::getCurrentRoute()->getPath();
        }
?>
<div id="top">
    <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip"
           class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu"
           id="menu-toggle">
            <i class="icon-align-justify"></i>
        </a>

        <header class="navbar-header">
            <a href="<?php echo url('')?>" class="navbar-brand">
                <img src="<?php echo url();?>/themes/images/logo/curatorlogo.png" alt="Logo"/></a>
        </header>

        <ul class="nav navbar-top-links navbar-right">
            <li><a href="<?php echo url('curator_profile');?>" class="btn btn-default"><i class="icon-user"></i> My
                    Profile </a>
            </li>
            <li><a href="<?php echo url('curator_logout');?>" class="btn btn-default"><i class="icon-signout"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <div class="mainmenu">
        <ul class="">
            <li><a href="<?php echo url('one_curator_dashboard');?>"
                   <?php if($routemenu == "one_curator_dashboard"){?>class="active"<?php } ?>>Dashboard</a></li>
            <li><a href="<?php echo url('curator_profile');?>" <?php if($routemenu == "curator_profile"){?>class="active"<?php } ?>>Profile</a>
            </li>

            <li><a href="<?php echo url('curator_pending_resource');?>"
                   <?php if($routemenu == "curator_pending_resource"){?>class="active"<?php } ?>>
                    Pending Resources</a></li>

            <li><a href="<?php echo url('curator_approved_resource');?>"
                   <?php if($routemenu == "curator_approved_resource"){?>class="active"<?php } ?>>
                    Approved Resources </a></li>

            <li><a href="<?php echo url('curator_disapproved_resource');?>"
                   <?php if($routemenu == "curator_disapproved_resource"){?> class="active" <?php } ?> >
                    Disapproved Resources </a>
            </li>
        </ul>
    </div>

</div>
