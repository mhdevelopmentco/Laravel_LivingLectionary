@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Referral Users')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Manage Referral Users </a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Referral Users </h5>

                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    <div class="form-group col-md-12">
                        <table class="table table-bordered" id="dataTables-example">
                            <thead>
                            <tr>
                                <th style="width:10%;" class="text-center">S.No</th>
                                <th style="width:10%;" class="text-center">Name</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Refered By</th>
                                <th class="text-center">Joined Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @foreach($referral_list as $manage_rfr_users)
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!!$manage_rfr_users->ruse_name!!}</td>
                                    <td class="text-center">{!!$manage_rfr_users->ruse_emailid!!}</td>
                                    <td class="text-center"> {!!$manage_rfr_users->mem_name!!}</td>
                                    <td class="text-center"> <?php echo date('M d Y h:m:s', strtotime($manage_rfr_users->ruse_date));?> </td>
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
