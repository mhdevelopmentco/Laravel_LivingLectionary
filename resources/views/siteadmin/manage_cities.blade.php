@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Cities')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a>Manage Cities</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Cities</h5>

                </header>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>{!! Session::get('success') !!}</div>
                @endif


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
                                   class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="dataTables-example">
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
                                        class="sorting text-center">City
                                    </th>
                                    <th aria-label="Browser: activate to sort column ascending"
                                        style="width: 100px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting text-center">State
                                    </th>
                                    <th aria-label="Browser: activate to sort column ascending"
                                        style="width: 200px;" colspan="1" rowspan="1"
                                        aria-controls="dataTables-example" tabindex="0"
                                        class="sorting text-center">City Country
                                    </th>

                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Delete</th>

                                    <th style="text-align:center; width:200px;">Default
                                        {!! Form::open(array('url'=>'update_default_city_submit','class'=>'form-horizontal inline-form')) !!}
                                        <input type="hidden" name="default_city_id" id="default_city_id"
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
                                @foreach($citydetails as $citydet)
                                    <tr class="gradeA odd">
                                        <td class="text-center"><?php echo $i;?></td>
                                        <td class="text-center">{!! $citydet->ci_name!!}</td>
                                        <td class="text-center">{!! $citydet->st_name!!}</td>
                                        <td class="text-center">{!! $citydet->co_name!!}</td>
                                        <td class="text-center"><a
                                                    href="{!! url('edit_city').'/'.$citydet->ci_id!!}"><i
                                                        class="icon icon-edit icon-2x"></i></a></td>

                                        <td class="text-center"><?php if($citydet->ci_status == 1){ ?><a
                                                    href="{!! url('status_city_submit').'/'.$citydet->ci_id.'/'.'0'!!}"
                                                    title="Block"><i class="icon icon-ok icon-2x"></i>
                                            </a> <?php } else { ?> <a
                                                    href="{!! url('status_city_submit').'/'.$citydet->ci_id.'/'.'1'!!}"
                                                    title="UnBlock">
                                                <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?>
                                        </td>
                                        <td class="text-center"><a
                                                    href="{!! url('delete_city').'/'.$citydet->ci_id!!}"><i
                                                        class="icon icon-trash icon-2x"></i></a></td>


                                        <td class="text-center"><input type="radio"
                                                                       value="{!!$citydet->ci_id!!}"
                                                                       <?php if($citydet->ci_default == 1){ ?>checked
                                                                       <?php } ?> name="default_city"
                                                                       id="default_city"></td>
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
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.dataTables').dataTable();
        });
        $('input[name=default_city]').click(function () {

            var value = $('input[name=default_city]:checked').val();
            $('#default_city_id').val(value);

        });
    </script>
@endsection

