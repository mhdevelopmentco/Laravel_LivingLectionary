@extends('includes/page_master')
@section('title', 'Checkout Done')
@section('css')
@endsection
@section('content')

    <div class="container">
        <div class="row">

            <ul class="breadcrumb">
                <li class="active">Home</li>
                <li class="active">Checkout Done</li>
            </ul>

            @if ($message = Session::get('checkout_success'))
                <div class="text-center row-fluid">
                    <div class="col-md-6 col-md-offset-3 check_suc_div col-sm-8 col-sm-offset-2 col-xs-12">
                        <h1>Checkout Success!</h1>
                        <p>Your order has been processed and you will soon be receiving a confirmation email with
                            information about how to access your resources.</p>
                        <p>Members and contributors can also find their selected and purchased resources in their account
                            area, accessibly by clicking the profile icon at the top of the page.</p>
                        <a href="<?php echo url('products'); ?>" class="btn btn-large me_btn">
                            <i class="icon icon-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                </div>
                <?php Session::forget('checkout_success'); ?>
            @endif
            @if ($message = Session::get('checkout_error'))
                <div class="text-center row-fluid">
                    <div class="col-md-6 col-md-offset-3 check_suc_div col-sm-8 col-sm-offset-2 col-xs-12">
                        <h1>Checkout Failed for {{$message}}</h1>
                        <p>There was some error while order processing.</p>
                        <p>Please try again later and if this recurs, please contact us.</p>
                        <a href="<?php echo url('checkout'); ?>" class="btn btn-large me_btn btn-primary">
                            <i class="icon icon-arrow-left"></i> Go to Checkout
                        </a>
                    </div>
                </div>
                <?php Session::forget('checkout_error');?>
            @endif
        </div>
    </div>

@endsection
@section('script')
    <script>
    </script>
@endsection



