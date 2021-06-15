@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Curator')
@section('css')
    <style>
        #dataTables-example td a {
            padding: 0 5px;
        }

        #dataTables-example th, #dataTables-example td {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Curator</a></li>
                <li class="active"><a> Manage Curators </a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5> Manage Curators </h5>
                </header>

                @if ($errors->any())
                    <br>
                    <ul>
                        <div class="alert alert-danger alert-dismissable">{!! implode('', $errors->all('<li>:message</li>')) !!}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </ul>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                                    class="sorting_asc" aria-sort="ascending">C.No
                                </th>
                                <th aria-label="Curator First Name: activate to sort column ascending"
                                    style="width: 69px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Name
                                </th>
                                <th aria-label="Email: activate to sort column ascending"
                                    style="width: 81px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Email
                                </th>
                                <th aria-label="User ID: activate to sort column ascending"
                                    style="width: 81px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">User ID
                                </th>
                                <th aria-label="Country: activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Image
                                </th>
                                <th aria-label="State: activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Theme in Charge
                                </th>
                                <th aria-label=" Resource Image : activate to sort column ascending"
                                    style="width: 78px;" colspan="1" rowspan="1"
                                    aria-controls="dataTables-example" tabindex="0"
                                    class="sorting">Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            foreach($curators as $curator)
                            {
                            ?>
                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $curator->curator_name;?></td>
                                <td class="text-center"><?php echo $curator->curator_email;?></td>
                                <td class="text-center"><?php echo $curator->curator_userid;?></td>
                                <td class="text-center">
                                    <?php if($curator->curator_img) {?>
                                    <img style="height:40px;"
                                         src="<?php echo url(''); ?>/public/assets/images/curator/<?php echo $curator->curator_img;?>">

                                    <?php } else {?>
                                    <img style="height:40px;"
                                         src="<?php echo url(''); ?>/public/assets/images/profile/man.png">
                                    <?php }?>
                                </td>
                                <td class="text-center"><?php echo $curator->curator_theme_name;?></td>
                                <td class="text-center">
                                    <a href="<?php echo url('edit_curator/' . $curator->id); ?>">
                                        <i class="icon icon-edit icon-2x"></i>
                                    </a>
                                    <a href="<?php echo url('delete_curator') . "/" . $curator->id; ?>">
                                        <i class="icon icon-trash icon-2x"></i>
                                    </a>
                                    <?php
                                    if($curator->status == 1){
                                    ?>
                                    <a href="<?php echo url('update_curator') . '/' . $curator->id . '/' . '0'; ?>">
                                        <i class="icon-ok icon-2x icon-me"></i>
                                    </a>
                                    <?php } else {?>

                                    <a href="<?php echo url('update_curator') . '/' . $curator->id . '/' . '1'; ?>">
                                        <i class="icon-ban-circle icon-2x icon-me"></i>
                                    </a>
                                    <?php } ?>
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
