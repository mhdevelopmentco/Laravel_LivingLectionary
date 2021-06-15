<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading"> TRANSACTIONS </h5>
        </div>
        <br/>
    </div>
    <ul id="menu" class="collapse">
        <li <?php if ($current_route == "show_merchant_transactions" || $current_route == "merchant_resource_all_orders" || $current_route == "merchant_resource_success_orders" || $current_route == "merchant_resource_completed_orders") {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>>
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#form-nav2">
                <i class="icon-dashboard"></i>&nbsp;Resource Transaction <span class="pull-right"> <i class="icon-angle-right"></i></span>
            </a>
            <ul class="collapse
                <?php if ($current_route == "show_merchant_transactions" ||  $current_route == "merchant_resource_all_orders" || $current_route == "merchant_resource_ship_orders" || $current_route == "merchant_resource_completed_orders") {
                echo 'in';
            } ?>"
                id="form-nav2">
                <li class="<?php if ($current_route == "merchant_resource_all_orders") echo 'active' ?>">
                    <a href="<?php echo url('merchant_resource_all_orders');?>">
                        <i class="icon-globe"></i> All Orders
                    </a>
                </li>
                <li class="<?php if ($current_route == "merchant_resource_ship_orders") echo 'active' ?>">
                    <a href="<?php echo url('merchant_resource_ship_orders');?>">
                        <i class="icon-glass"></i> Orders to be Shipped
                    </a>
                </li>
                <li class="<?php if ($current_route == "merchant_resource_completed_orders") echo 'active' ?>">
                    <a href="<?php echo url('merchant_resource_completed_orders');?>">
                        <i class="icon-check"></i> Completed Orders
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
        
        



