<?php  $current_route = Route::getCurrentRoute()->getPath(); ?>
<div id="left">
    <div class="media user-media well-small">
        <div class="media-body">
            <h5 class="media-heading">Withdraw</h5>
        </div>
        <br/>
    </div>

    <ul id="menu" class="collapse">
        <li <?php if ($current_route == 'withdraw_report') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>><a href="<?php echo url('withdraw_report'); ?>"> <i class="icon-dashboard"></i>&nbsp;Withdraw Report
            </a></li>
        <li <?php if ($current_route == 'withdraw_request') {
            echo 'class="panel active"';
        } else {
            echo 'class="panel"';
        } ?>><a href="<?php echo url('withdraw_request'); ?>" data-parent="#menu" data-toggle="collapse"
                class="accordion-toggle" data-target="#form-nav">
                <i class="icon-resize-small"></i>&nbsp;Withdraw Request<span class="pull-right">
        <i class="icon-angle-right"></i> </span> </a></li>
    </ul>
</div>



