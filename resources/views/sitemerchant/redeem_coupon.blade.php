@extends('sitemerchant.layout.merchant_master')
@section('title', 'Redeem Coupon List')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Redeem Coupon List</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Redeem Coupon List</h5>

                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="text1" class="control-label col-md-3">Search Deals<span
                                        class="text-sub">*</span></label>
                        </div>

                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Coupon Code<span
                                        class="text-sub">*</span></label>

                            <div class="col-md-8">
                                <div class="col-md-4">
                                    <input type="text" id="text1" placeholder="" class="form-control">
                                </div>
                                <label for="text1" class="control-label col-md-2">Name<span
                                            class="text-sub">*</span></label>
                                <div class="col-md-4"><input type="text" class="form-control" placeholder="" id="text1">
                                </div>
                                <button class="btn btn-warning btn-sm btn-grad">
                                    <a style="color:#fff" href="#">Search</a>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="text1" class="control-label">Deals Name: </label>
                                    </div>

                                    <div class="col-sm-8">
                                        <p>Here is Deal Name</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="text1" class="control-label">Deals Name: </label>
                                    </div>

                                    <div class="col-sm-8">
                                        <p>Here is Store Name</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Found:</label>
                            <div class="col-md-8">
                                <p>No Deals Found</p>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
