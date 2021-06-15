@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Main Category')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class=""><a>Categories</a></li>
                <li class=""><a>Top Category</a></li>
                <li class="active"><a>Manage Main Categories</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Main Categories</h5>

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
                                <th style="width:10%;" class="text-center">S.No</th>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Top Category Name</th>
                                <th class="text-center">Add Sub Category</th>
                                <th class="text-center">Manage Category</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($sub_maincatg_list as $maincatg)
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!! $maincatg->smc_name!!}</td>
                                    <td class="text-center">{!! $maincatg->mc_name!!}</td>
                                    <td class="text-center"><a
                                                href="{!! url('add_sub_main_category').'/'.$maincatg->smc_id!!}"><i
                                                    class="icon-plus-sign"></i></a></td>
                                    <td class="text-center"><?php if($subcatg_count_list[$maincatg->smc_id] != 0) { ?><a
                                                href="{!! url('manage_sub_category').'/'.$maincatg->smc_id!!}"><i
                                                    class="icon-shopping-cart"></i><span
                                                    style="color:#2574c4;padding-left:5px;">({!!$subcatg_count_list[$maincatg->smc_id]!!}
                                                ) Categories </span></a><?php }else{?> <i
                                                class="icon-shopping-cart"></i><span
                                                style="color:#2574c4;padding-left:5px;">({!!$subcatg_count_list[$maincatg->smc_id]!!}
                                            ) Categories </span><?php } ?></td>
                                    <td class="text-center"><a
                                                href="{!! url('edit_main_category').'/'.$maincatg->smc_id!!}"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>
                                    <td class="text-center"><?php if($maincatg->smc_status == 1){ ?><a
                                                href="{!! url('status_main_category_submit').'/'.$maincatg->smc_id.'/'.$maincatg->smc_mc_id.'/'.'0'!!}"><i
                                                    class="icon icon-ok icon-2x"></i></a> <?php } else { ?> <a
                                                href="{!! url('status_main_category_submit').'/'.$maincatg->smc_id.'/'.$maincatg->smc_mc_id.'/'.'1'!!}">
                                            <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?></td>
                                    <td class="text-center"><a
                                                href="{!! url('delete_main_category').'/'.$maincatg->smc_id.'/'.$maincatg->smc_mc_id!!}"><i
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
