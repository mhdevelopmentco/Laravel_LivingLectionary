@extends('siteadmin.layout.admin_master')
@section('title', 'Mange Security Question')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage Securty Question</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Security Question</h5>
                </header>
                <div class="row">

                    <div class="col-md-11 panel_marg">
                        @if (Session::has('result'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('result') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width:10%;" class="text-center">S.No</th>
                                <th class="text-center">Question</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach ($secqresult as $info)
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!!$info->question!!}</td>
                                    <td class="text-center"><a href="<?php echo url('edit_secq/' . $info->id); ?>"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>
                                    <td class="text-center"><?php if($info->status == 0){ ?><a
                                                href="{!! url('status_secq_submit').'/'.$info->id.'/'.'1'!!}"><i
                                                    class="icon icon-ban-circle icon-2x  icon-me"></i>
                                        </a> <?php } else { ?> <a
                                                href="{!! url('status_secq_submit').'/'.$info->id.'/'.'0'!!}">
                                            <i class="icon icon-ban-circle icon-2x"></i></a> <?php } ?></td>
                                    <td class="text-center"><a href="<?php echo url('delete_secq/' . $info->id); ?>"><i
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