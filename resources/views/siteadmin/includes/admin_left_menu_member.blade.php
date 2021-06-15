<?php  $current_route = Route::getCurrentRoute()->getPath();
?>
<div id="left">
    <div class="media user-media well-small">
        <!-- <a class="user-link" href="#">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
        </a> -->

        <div class="media-body">
            <h5 class="media-heading">CUSTOMERS</h5>

        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li <?php if ($current_route == 'member_dashboard') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?> >
            <a href="<?php echo url('member_dashboard'); ?>">
                <i class="icon-dashboard"></i>&nbsp; Dashboard</a>
        </li>
        <li <?php if ($current_route == 'add_member') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?> >
            <a href="<?php echo url('add_member'); ?>">
                <i class="icon-user"></i>&nbsp;Add Member
            </a>
        </li>
        <li <?php if ($current_route == 'manage_member') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('manage_member'); ?>">
                <i class="icon-ok-sign"></i>&nbsp;Manage Members
            </a>
        </li>
        <li <?php if ($current_route == 'manage_news_subscribers') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('manage_news_subscribers'); ?>">
                <i class="icon-circle-arrow-right"></i>&nbsp;Manage Subscribers
            </a>
        </li>
    </ul>

</div>
