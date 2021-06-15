<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading"> TRANSACTIONS </h5>
        </div>
        <br/>
    </div>

    <ul id="menu" <?php if ($current_route == "transaction_dashboard" || $current_route == "resource_all_orders" || $current_route == "resource_ship_orders" || $current_route == "resource_completed_orders") {
        echo 'class="collapse in"';
    } else {
        echo 'class="collapse"';
    } ?>>

        <li <?php if ($current_route == "transaction_dashboard" || $current_route == "resource_all_orders" || $current_route == "resource_ship_orders" || $current_route == "resource_completed_orders") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle"
               data-target="#resource_all_orders">
                <i class="icon-dropbox"></i>&nbsp;Resource Transaction
                         <span class="pull-right">
                            <i class="icon-angle-right"></i>
                        </span>
            </a>
            <ul id="resource_all_orders" <?php if ($current_route == "transaction_dashboard" || $current_route == "resource_all_orders" || $current_route == "resource_ship_orders" || $current_route == "resource_completed_orders" || $current_route == "resource_failed_orders" || $current_route == "resource_hold_orders") {
                echo 'class="collapse in"';
            } else {
                echo 'class="collapse"';
            } ?>>
                <li <?php if($current_route == "resource_all_orders" ){?> class="active"<?php }?>>
                    <a href="<?php echo url('resource_all_orders');?>"><i class="icon-angle-right"></i>&nbsp;All Orders
                    </a></li>

                <li <?php if($current_route == "resource_ship_orders" ){?> class="active"<?php }?>>
                    <a href="<?php echo url('resource_ship_orders');?>"><i class="icon-angle-right"></i>&nbsp;Orders to
                        be Shipped</a>
                </li>
                <li <?php if($current_route == "resource_completed_orders" ){?> class="active"<?php }?>>
                    <a href="<?php echo url('resource_completed_orders');?>"><i class="icon-angle-right"></i>&nbsp;Completed
                        Orders </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading"> Withdraws</h5>
        </div>
        <br/>
    </div>

    <ul id="menu" <?php if ($current_route == "requested_withdraws" || $current_route == "disallowed_withdraws"|| $current_route == "success_withdraws" || $current_route == "failed_withdraws") {
        echo 'class="collapse in"';
    } else {
        echo 'class="collapse"';
    } ?>>

        <li <?php if ($current_route == "requested_withdraws") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('requested_withdraws');?>">
                <i class="icon-question"></i>&nbsp;Requested Withdraws
            </a>
        </li>

        <li <?php if ($current_route == "disallowed_withdraws") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('disallowed_withdraws'); ?>">
                <i class="icon-warning-sign"></i>&nbsp; Disallowed Withdraws</a>
        </li>

        <li <?php if ($current_route == "success_withdraws") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('success_withdraws');?>">
                <i class="icon-ok"></i>&nbsp;Success Withdraws
            </a>
        </li>
        <li <?php if ($current_route == "failed_withdraws") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="<?php echo url('failed_withdraws');?>">
                <i class="icon-ban-circle"></i>&nbsp;Failed Withdraws
            </a>
        </li>
    </ul>
</div>
        
        
