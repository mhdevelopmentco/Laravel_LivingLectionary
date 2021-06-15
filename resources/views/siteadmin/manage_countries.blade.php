@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Countries')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage Countries</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Countries</h5>

                </header>

                <div class="row">

                    <div class="col-md-11 panel_marg">
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                        <table class="table table-bordered datatable">
                            <thead>
                            <tr>
                                <th style="width:10%;" class="text-center">S.No</th>
                                <th class="text-center">Country</th>
                                <th class="text-center">Country Code</th>
                                <th class="text-center">Currency Symbol</th>
                                <th class="text-center">Currency Code</th>
                                <th class="text-center">Edit</th>
                                <th style="text-align:center; width:200px;">Default
                                    {!! Form::open(array('url'=>'update_default_country_submit','class'=>'form-horizontal inline-form')) !!}
                                    <input type="hidden" name="default_country_id" id="default_country_id"
                                           value="1"/>
                                    <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                            style="color:#fff">Update
                                    </button>
                                    {!! Form::close()!!}
                                </th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach ($countryresult as $info)
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!!$info->co_name!!}</td>
                                    <td class="text-center">{!!$info->co_code!!}</td>
                                    <td class="text-center">{!!$info->co_cursymbol!!}</td>
                                    <td class="text-center">{!!$info->co_curcode!!}</td>
                                    <td class="text-center"><a
                                                href="<?php echo url('edit_country/' . $info->co_id); ?>"><i
                                                    class="icon icon-edit icon-2x"></i></a></td>
                                    <td class="text-center">
                                        <input type="radio" value="{!!$info->co_id!!}"
                                               <?php if($info->co_default == 1){ ?>checked
                                               <?php } ?> name="default_country"
                                               class="default_country">
                                    </td>
                                    <td class="text-center"><?php if($info->co_status == 0){ ?><a
                                                href="{!! url('status_country_submit').'/'.$info->co_id.'/'.'1'!!}"><i
                                                    class="icon icon-ban-circle icon-2x"></i>
                                        </a> <?php } else { ?> <a
                                                href="{!! url('status_country_submit').'/'.$info->co_id.'/'.'0'!!}">
                                            <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?></td>
                                    <td class="text-center"><a
                                                href="<?php echo url('delete_country/' . $info->co_id); ?>"><i
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
@section('script')

    <script>
        $(document).ready(function () {
            $('.datatable').dataTable();
        });
        $('input[name=default_country]').click(function () {
            var value = $('input[name=default_country]:checked').val();
            $('#default_country_id').val(value);
        });
    </script>
@endsection


