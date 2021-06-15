<?php
    $current_route = Route::getCurrentRoute()->getPath();
?>

<div id="left">
    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading">CURATOR</h5>
        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li class="panel <?php if( $current_route == "curator_profile" ) { ?> active <?php } ?>">
            <a href="<?php echo url('curator_profile'); ?>">
                <i class="icon-cog"></i>&emsp;Profile</a>
        </li>
        <li class="panel <?php if( $current_route == "curator_pending_resource" ) { ?> active <?php } ?>">
            <a href="<?php echo url('curator_pending_resource'); ?>">
                <i class="icon-search"></i>&emsp;Pending Resources</a>
        </li>
        <li class="panel <?php if( $current_route == "curator_approved_resource" ) { ?> active <?php } ?>">
            <a href="<?php echo url('curator_approved_resource'); ?>">
                <i class="icon-check"></i>&emsp;Approved Resources</a>
        </li>
        <li class="panel <?php if( $current_route == "curator_disapproved_resource" ) { ?> active <?php } ?>">
            <a href="<?php echo url('curator_disapproved_resource'); ?>">
                <i class="icon-ban-circle"></i>&emsp;Disapproved Resources</a>
        </li>
    </ul>
</div>



