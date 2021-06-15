@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Banner')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage Banner</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Banner</h5>

                </header>

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif
                <div class="row">

                    <div class="col-md-11 panel_marg">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image Title</th>
                                <th style="width:50%;">Redirect URL</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Block / Unblock</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($mnge_banner as $mnge_banner_list)
                                <tr>
                                    <td>{!!$i!!}</td>
                                    <td>{!! $mnge_banner_list->bn_title !!}</td>
                                    <td>{!! $mnge_banner_list->bn_redirecturl !!}</td>
                                    <td class="text-center"><img
                                                src="{!! url('/public/assets/images/bannerimage/').'/'.$mnge_banner_list->bn_img!!}"
                                                style="height:40px;"></td>
                                    <td class="text-center"><a
                                                href="{!! url('edit_banner_image').'/'.$mnge_banner_list->bn_id!!}"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>

                                    <td class="text-center"><?php if($mnge_banner_list->bn_status == 0){ ?><a
                                                href="{!! url('status_banner_submit').'/'.$mnge_banner_list->bn_id.'/'.'1'!!}"><i
                                                    class="icon icon-ok icon-2x"></i>
                                        </a> <?php } else { ?> <a
                                                href="{!! url('status_banner_submit').'/'.$mnge_banner_list->bn_id.'/'.'0'!!}">
                                            <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?></td>
                                    <td class="text-center"><a
                                                href="{!! url('delete_banner_submit').'/'.$mnge_banner_list->bn_id!!}"><i
                                                    class="icon icon-trash icon-2x"></i></a></td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

