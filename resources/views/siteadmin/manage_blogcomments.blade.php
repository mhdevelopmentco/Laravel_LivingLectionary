@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Blog Comments')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a> Manage Blog comments </a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Blog comments </h5>
                </header>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    <div class="form-group col-md-12">
                        <table class="table table-bordered" id="dataTables-example">
                            <thead>
                            <tr>
                                <th class="text-center">S.No</th>
                                <th class="text-center"> Name</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Wesite</th>
                                <th class="text-center">Blog Title</th>
                                <th  class="text-center">Comments</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">(Approve/Unapprove)</th>
                                <th class="text-center">Reply To comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @foreach($blog_comments as $inq_list)
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!!$inq_list->cmt_name!!} </td>
                                    <td class="text-center"> {!!$inq_list->cmt_email!!}    </td>
                                    <td class="text-center">{!!$inq_list->cmt_website!!}        </td>
                                    <td class="text-center">{!!$inq_list->blog_title!!} </td>
                                    <td class="text-center">{!!$inq_list->cmt_msg!!} </td>
                                    <td class="text-center">{!!$inq_list->cmt_date!!} </td>
                                    <td class="text-center"><?php if($inq_list->cmt_admin_approve == 1){ ?><a
                                                href="{!! url('status_blogcmt_submit').'/'.$inq_list->cmt_id.'/'.'0'!!}"><i
                                                    class="icon icon-ok icon-2x"></i>
                                        </a> <?php } else { ?> <a
                                                href="{!! url('status_blogcmt_submit').'/'.$inq_list->cmt_id.'/'.'1'!!}">
                                            <i class="icon icon-ban-circle icon-2x icon-me"></i></a> <?php } ?></td>
                                    <td class="text-center"><a
                                                href="<?php echo url('reply_blogcmts') . "/" . $inq_list->cmt_id; ?>">Reply</a>
                                    </td>
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
            $('#dataTables-example').dataTable();
        });
    </script>
@endsection