@extends('siteadmin.layout.admin_master')
@section('title', 'Manage States')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage States</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage States</h5>
                </header>
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! implode('', $errors->all('<li>:message</li>')) !!}</div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif

                <div id="div-1" class="accordion-body collapse in body">
                    <div class="accordion-body collapse in body" id="div-1">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <div role="grid" class="dataTables_wrapper form-inline"
                                 id="dataTables-example_wrapper">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_length" id="dataTables-example_length">
                                            <label></label></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="dataTables-example_filter" class="dataTables_filter"></div>
                                    </div>
                                </div>

                                <table aria-describedby="dataTables-example_info"
                                       class="table table-striped table-bordered table-hover dataTable no-footer">
                                    <thead>
                                    <tr>
                                        <th style="width: 100px;" colspan="1" rowspan="1"
                                            aria-controls="dataTables-example" tabindex="0"
                                            class="sorting_asc text-center"
                                            aria-sort="ascending">S.No
                                        </th>
                                        <th aria-label="Browser: activate to sort column ascending"
                                            style="width: 100px;" colspan="1" rowspan="1"
                                            aria-controls="dataTables-example" tabindex="0"
                                            class="sorting text-center">State
                                        </th>
                                        <th aria-label="Browser: activate to sort column ascending"
                                            style="width: 100px;" colspan="1" rowspan="1"
                                            aria-controls="dataTables-example" tabindex="0"
                                            class="sorting text-center">State Abbreviation
                                        </th>
                                        <th sstyle="width: 100px;" colspan="1" rowspan="1"
                                            aria-controls="dataTables-example" tabindex="0"
                                            class="sorting text-center">Country
                                        </th>

                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Delete</th>

                                        <th style="text-align:center; width:200px;">Default
                                            {!! Form::open(array('url'=>'update_default_state_submit','class'=>'form-horizontal inline-form')) !!}
                                            <input type="hidden" name="default_state_id" id="default_state_id"
                                                   value="1"/>
                                            <button type="submit" class="btn btn-warning btn-sm btn-grad"
                                                    style="color:#fff">Update
                                            </button>
                                            {!! Form::close()!!}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($statedetails as $statedet)
                                        <tr class="gradeA odd">
                                            <td class="text-center"><?php echo $i;?></td>
                                            <td class="text-center">{!! $statedet->st_name!!}</td>
                                            <td class="text-center">{!! $statedet->st_abbr!!}</td>
                                            <td class="text-center">{!! $statedet->co_name!!}</td>
                                            <td class="text-center"><a
                                                        href="{!! url('edit_state').'/'.$statedet->st_id!!}"><i
                                                            class="icon icon-edit icon-2x"></i></a></td>

                                            <td class="text-center"><?php if($statedet->st_status == 1){ ?><a
                                                        href="{!! url('status_state_submit').'/'.$statedet->st_id.'/'.'0'!!}"
                                                        title="Block"><i class="icon icon-ok icon-2x"></i>
                                                </a> <?php } else { ?> <a
                                                        href="{!! url('status_state_submit').'/'.$statedet->st_id.'/'.'1'!!}"
                                                        title="UnBlock">
                                                    <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?>
                                            </td>
                                            <td class="text-center"><a
                                                        href="{!! url('delete_state').'/'.$statedet->st_id!!}"><i
                                                            class="icon icon-trash icon-2x"></i></a></td>


                                            <td class="text-center">
                                                <input type="radio" value="{!!$statedet->st_id!!}"
                                                       <?php if($statedet->st_default == 1){ ?>checked
                                                       <?php } ?> name="default_state"></td>
                                        </tr>
                                        <?php $i++;?>
                                    @endforeach


                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_info" id="dataTables-example_info" role="alert"
                                             aria-live="polite" aria-relevant="all"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="dataTables-example_paginate">
                                            <ul class="pagination"></ul>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.dataTable').dataTable();
        });
        $('input[name=default_state]').click(function () {

            var value = $('input[name=default_state]:checked').val();
            $('#default_state_id').val(value);

        });
    </script>
@endsection