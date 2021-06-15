@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Ads')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage Ads</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Ads</h5>
                </header>
                <div class="row">
                    <div class="col-md-11 panel_marg">
                        @if (Session::has('updated_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('updated_result') !!}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @endif
                        @if (Session::has('insert_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('insert_result') !!}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @endif
                        @if (Session::has('delete_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('delete_result') !!}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width:10%;" class="text-center">Ad Id</th>
                                <th class="text-center">Ad Title</th>
                                <th class="text-center">Ads Position</th>

                                <th class="text-center">Edit</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @foreach($adresult as $info)
                                <?php
                                if ($info->ad_position == "1") {
                                    $positionname = "Header Left";
                                } else if ($info->ad_position == "2") {
                                    $positionname = "Header Right";
                                } else if ($info->ad_position == "3") {
                                    $positionname = "Left Sidebar";
                                } else if ($info->ad_position == "4") {
                                    $positionname = "Right Sidebar";
                                } else if ($info->ad_position == "3") {
                                    $positionname = "Bottom Footer";
                                } else {
                                    $positionname = "Not defined";
                                }
                                ?>
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!!$info->ad_name!!}</td>
                                    <td class="text-center">{!!$positionname!!}</td>
                                    <td class="text-center"><a href="{!! url('edit_ad').'/'.$info->ad_id!!}"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>
                                    <td class="text-center"><?php if($info->ad_status == 0){ ?><a
                                                href="{!! url('status_ad_submit').'/'.$info->ad_id.'/'.'1'!!}"><i
                                                    class="icon icon-ok icon-2x"></i>
                                        </a> <?php } else { ?> <a
                                                href="{!! url('status_ad_submit').'/'.$info->ad_id.'/'.'0'!!}">
                                            <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?></td>
                                    <td class="text-center"><a href="{!! url('delete_ad').'/'.$info->ad_id!!}"><i
                                                    class="icon icon-trash icon-2x"></i></a></td>
                                </tr>
                                <?php $i = $i + 1; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
