<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <!-- <a class="user-link" href="#">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
        </a> -->

        <div class="media-body">
            <h5 class="media-heading">BLOGS</h5>

        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li <?php if ($current_route == 'add_blog') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?> >
            <a href="<?php echo url('add_blog');?> ">
                <i class="icon-user"></i>&nbsp;Add Blog
            </a>
        </li>
        <li <?php if ($current_route == 'manage_publish_blog') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('manage_publish_blog');?>">
                <i class="icon-dashboard"></i>&nbsp;Manage Published Blogs</a>
        </li>

        <li <?php if ($current_route == 'manage_draft_blog') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('manage_draft_blog');?>">
                <i class="icon-ok-sign"></i>&nbsp;Manage Drafted Blogs
            </a>
        </li>
        <li <?php if ($current_route == 'blog_settings') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('blog_settings');?>">
                <i class="icon-ok-sign"></i>&nbsp;Blog Settings
            </a>
        </li>
        <li <?php if ($current_route == 'manage_blogcmts') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('manage_blogcmts');?>">
                <i class="icon-ok-sign"></i>&nbsp;Manage Blog Comments
            </a>
        </li>
    </ul>
</div>
