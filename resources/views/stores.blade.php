@extends('includes/page_master')
@section('title', 'Stores')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo url('Home');?>">Home</a></li>
                    <li><a href="<?php echo url('stores');?>">Stores</a></li>
                </ul>
                @if (Session::has('success_store'))
                    <div class="alert alert-warning alert-dismissable">
                        {!! Session::get('success_store') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <h4>Contributor's Shops</h4>
                <legend></legend>

                <div class="container">
                    <div class="row">
                        <?php
                        foreach($get_store_details as $store) {
                        $approved_product_count = $get_store_product_count[$store->stor_id];
                        if($approved_product_count > 0) {
                        ?>

                        <div class="col-md-3 col-sm-6 col-xs-12 store_img">
                            <div class="thumbnail stor store-res">
                                <div class="image-wrapper">
                                    <img src="<?php echo url(); ?>/public/assets/images/storeimage/<?php echo $store->stor_img;  ?>">
                                </div>
                                <a href="#"><h4><?php echo $store->stor_name; ?></h4></a>
                                <div class="clearfix"></div>

                                <div class="text-center">
                                    <a href="<?php echo url('storeview/' . base64_encode(base64_encode(base64_encode($store->stor_id)))); ?>">
                                        <button class="btn  btn-warning">Visit</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php }
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
