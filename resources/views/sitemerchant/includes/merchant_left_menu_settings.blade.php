<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading">SETTINGS</h5>
        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li <?php if ($current_route == "merchant_profile" || $current_route == "edit_contributor_profile") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('merchant_profile'); ?>">
                <i class="icon-cog"></i>&nbsp; Profile
            </a>
        </li>
        <li  <?php if ($current_route == "merchant_settings") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('merchant_settings'); ?>">
                <i class="icon-envelope"></i>&nbsp; Settings
            </a>
        </li>
        <li  class="panel <?php if($current_route == "change_merchant_password") echo "active" ?>" >
            <a href="<?php echo url('change_merchant_password'); ?>">
                <i class="icon-mail-reply"></i>&nbsp;Change Password
            </a>
        </li>
    </ul>
</div>



