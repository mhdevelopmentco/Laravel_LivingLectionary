@extends('siteadmin.layout.admin_master')
@section('title', 'Manage CMS Page')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage CMS Page</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage CMS Page</h5>
                </header>
                <div class="row">

                    <div class="col-md-11 panel_marg">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissable">{!! Session::get('error_message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        @if (Session::has('updated_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('updated_result') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        @if (Session::has('block_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('block_result') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        @if (Session::has('insert_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('insert_result') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        @if (Session::has('delete_result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('delete_result') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width:10%;" class="text-center">S.No</th>
                                <th class="text-center">Page Title</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach ($result as $info) { ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $info->cp_title; ?></td>
                                <td class="text-center"><a href="<?php echo url('edit_cms_page/' . $info->cp_id); ?>"><i
                                                class="icon icon-edit icon-2x"></i></a></td>
                                <td class="text-center">
                                    <?php if($info->cp_status == 1) { ?>
                                    <a href="<?php echo url('block_cms_page/' . $info->cp_id . "/0"); ?>">
                                        <i class="icon icon-ok icon-2x "></i></a>
                                    <?php } else if($info->cp_status == 0) { ?>
                                    <a href="<?php echo url('block_cms_page/' . $info->cp_id . "/1"); ?>">
                                        <i class="icon icon-ban-circle icon-2x icon-me"></i></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center"><a href="<?php echo url('delete_cms_page/' . $info->cp_id); ?>"><i
                                                class="icon icon-trash icon-2x"></i></a></td>

                            </tr>
                            <?php $i++; }  ?>
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

