<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <!-- <a class="user-link" href="#">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
        </a> -->
        <div class="media-body">
            <h5 class="media-heading"> Curators </h5>
        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li <?php if ($current_route == 'curator_dashboard') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?> >
            <a href="<?php echo url('curator_dashboard'); ?>">
                <i class="icon-dashboard"></i>&nbsp; Curators Dashboard</a>
        </li>
        <li <?php if ($current_route == 'add_curator') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?> >
            <a href="<?php echo url('add_curator'); ?>">
                <i class="icon-user"></i>&nbsp;Add Curator Account
            </a>
        </li>
        <li <?php if ($current_route == 'manage_curator') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('manage_curator'); ?>">
                <i class="icon-ok-sign"></i>&nbsp;Manage Curator Accounts
            </a>
        </li>
    </ul>
</div>
