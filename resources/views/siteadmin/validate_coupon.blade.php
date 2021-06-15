@extends('siteadmin.layout.admin_master')
@section('title', 'Validate Coupon Code')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Validate Coupon Code</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Validate Coupon Code</h5>
                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="text1" class="control-label col-md-2">Code<span class="text-sub">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="" id="text1">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                        </div>
                        <div class="form-group">
                            <label for="pass1" class="control-label col-md-2"><span class="text-sub"></span></label>
                            <div class="col-md-8">
                                <button class="btn btn-warning btn-sm btn-grad"><a href="#" style="color:#fff">Update</a>
                                </button>
                                <button class="btn btn-default btn-sm btn-grad"><a href="#" style="color:#000">Cancel</a>
                                </button>
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

