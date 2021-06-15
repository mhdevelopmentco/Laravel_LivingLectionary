<?php $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <!-- <a class="user-link" href="#">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
        </a> -->

        <div class="media-body">
            <h5 class="media-heading">RESOURCES</h5>

        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <!--  <li class="panel">
              <a href="#">
                  <i class="icon-dashboard"></i>&nbsp;Resources Dashboard</a>
          </li>-->
        <li <?php if($current_route == 'mer_add_product' ) { ?> class="panel active"
            <?php } else { ?> class="panel" <?php } ?> >

            <a href="<?php echo url('mer_add_product');?>">
                <i class=" icon-plus-sign"></i>&nbsp;Add Resources
            </a>
        </li>
        <li <?php if($current_route == 'mer_manage_pending_approved_product' ) { ?> class="panel active"
            <?php } else { ?> class="panel" <?php } ?> >
            <a href="<?php echo url('mer_manage_pending_approved_product');?>">
                <i class=" icon-edit"></i>&nbsp; Manage Pending or Approved Resources
            </a>
        </li>
        <li <?php if($current_route == 'mer_manage_disapproved_product' ) { ?> class="panel active"
            <?php } else { ?> class="panel" <?php } ?> >
            <a href="<?php echo url('mer_manage_disapproved_product');?>">
                <i class=" icon-edit"></i>&nbsp; Manage Disapproved Resources
            </a>
        </li>
        <li <?php if($current_route == 'mer_sold_product' ) { ?> class="panel active"
            <?php } else { ?> class="panel" <?php } ?> >
            <a href="<?php echo url('mer_sold_product');?>">
                <i class="icon-tag"></i>&nbsp; Sold Resources
            </a>
        </li>
        <li <?php if( $current_route == "mer_manage_product_shipping_details" ) { ?> class="panel active" <?php } else {
            echo 'class="panel"';
        }?>>
            <a href="<?php echo url('mer_manage_product_shipping_details');?>">
                <i class="icon-ambulance"></i>&nbsp;Shipping And Delivery
            </a>
        </li>
    </ul>

</div>



