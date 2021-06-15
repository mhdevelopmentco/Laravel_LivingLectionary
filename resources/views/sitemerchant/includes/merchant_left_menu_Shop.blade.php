<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<?php
if (Session::has('merchantid')) {
    $merchantid = Session::get('merchantid');
}
?>

<div id="left">
    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading">&nbsp;SHOP&nbsp;</h5>
        </div>
        <br/>
    </div>
    <ul id="menu" class="collapse">
        <li <?php if ($current_route == 'merchant_manage_shop') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('merchant_manage_shop'); ?>">
                <i class="icon-dashboard"></i>&nbsp;Manage Shops
            </a>
        </li>
        <li <?php if ($current_route == 'merchant_add_shop') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('merchant_add_shop'); ?>">
                <i class=" icon-plus-sign"></i>&nbsp;Add Shop
            </a>
        </li>
    </ul>
</div>



