@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Themes')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Settings</a></li>
                <li class="active"><a> Manage Affirmations </a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>

                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5> Manage Affirmations </h5>

                </header>
                @if (Session::has('result'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('result') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                @if ($errors->any())
                    <br>
                    <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all(':message<br>')) !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>
                    </div>
                @endif

                <div class="accordion-body collapse in body" id="div-1">

                    <div role="grid" class="dataTables_wrapper form-inline"
                         id="dataTables-example_wrapper">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="dataTables-example_length">
                                    <label></label></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter"
                                     class="dataTables_filter"></div>
                            </div>
                        </div>
                        <table aria-describedby="dataTables-example_info"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="dataTables-example">
                            <thead>
                            <tr role="row">
                                <th aria-label="S.No: activate to sort column ascending"
                                    style="width: 61px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting_asc" aria-sort="ascending">T.No
                                </th>
                                <th aria-label="Theme Name: activate to sort column ascending"
                                    style="width: 69px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Name
                                </th>
                                <th aria-label="Banner Title: activate to sort column ascending"
                                    style="width: 81px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Banner Title
                                </th>
                                <th aria-label="Banner Image"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0">Banner Image
                                </th>
                                <th aria-label="Heading: activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Heading
                                </th>

                                <th aria-label="Add Sub Affirmations: activate to sort column ascending"
                                    style="width: 75px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Add Sub theme.
                                </th>


                                <th aria-label="Sub Affirmations: activate to sort column ascending"
                                    style="width: 75px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Manage Sub Affirmations
                                </th>

                                <th aria-label=" Resource Image : activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                >Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach($themeresult as $theme_group) {
                                $theme_details = $theme_group[0];
                            ?>
                            <tr class="gradeA odd">
                                <td class=" text-center sorting_1"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $theme_details->theme_name;?></td>
                                <td class="text-center"><?php echo $theme_details->theme_banner_title;?></td>
                                <td class="text-center"><img
                                            src="<?php echo url('public/assets/images/themes') . '/' . $theme_details->theme_banner_img; ?>"
                                            height="45px"></td>
                                <td class="text-center"><?php echo $theme_details->theme_heading;?></td>
                                <td class="text-center">
                                    <a href="{{url('add_sub_affirmation').'/'.$theme_details->theme_id}}">
                                        <i class="icon icon-2x icon-plus-sign"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('manage_sub_affirmations').'/'.$theme_details->theme_id}}">
                                        <i class="icon icon-th-large"></i><span  style="color:#2574c4;padding-left:5px;">(<?php echo $theme_details->sub_theme_count;?>) Affirmations</span>
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a href="<?php echo url('edit_affirmation' . '/' . $theme_details->theme_id); ?>">
                                        <i class="icon icon-edit icon-2x"
                                           style="margin-right:10px;"></i></a>
                                    <a href="<?php echo url('delete_affirmation' . '/' . $theme_details->theme_id); ?>">
                                        <i class="icon icon-trash icon-2x"
                                           style="margin-right:10px;"></i></a>
                                    <?php if($theme_details->theme_status == 1){ ?>
                                    <a href="<?php echo url('status_affirmation_submit') . '/' . $theme_details->theme_id . '/0'; ?>"><i
                                                class="icon icon-ok icon-2x"></i>
                                    </a> <?php } else { ?> <a
                                            href="<?php echo url('status_affirmation_submit') . '/' . $theme_details->theme_id . '/1'; ?>">
                                        <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?>
                                </td>
                            </tr>
                            <?php
                            $i++; }
                            ?>

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info"
                                     role="alert" aria-live="polite" aria-relevant="all"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="dataTables-example_paginate"></div>
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
            $('#dataTables-example').dataTable();
        });
    </script>
@endsection