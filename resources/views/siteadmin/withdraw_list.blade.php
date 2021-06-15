@extends('siteadmin.layout.admin_master')
@section('title', 'Withdraw')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                @if($type == \App\Withdraw::WITHDRAW_STATUS_DISALLOWED)
                    <li class="active"><a>Disallowed Withdraws</a></li>
                @elseif($type == \App\Withdraw::WITHDRAW_STATUS_REQUEST)
                    <li class="active"><a>Requested Withdraws</a></li>
                @elseif($type == \App\Withdraw::WITHDRAW_STATUS_SUCCESS)
                    <li class="active"><a>Success Withdraws</a></li>
                @else
                    <li class="active"><a>Failed Withdraws</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    @if($type == \App\Withdraw::WITHDRAW_STATUS_DISALLOWED)
                        <h5>Disallowed Withdraws</h5>
                    @elseif($type == \App\Withdraw::WITHDRAW_STATUS_REQUEST)
                        <h5>Requested Withdraws</h5>
                    @elseif($type == \App\Withdraw::WITHDRAW_STATUS_SUCCESS)
                        <h5>Success Withdraws</h5>
                    @else
                        <h5>Failed Withdraws</h5>
                    @endif
                </header>
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div id="div-1" class="accordion-body collapse in body">
                    <div class="form-group col-md-12">
                        <table class="table table-striped table-bordered table-hover"
                               id="dataTables-example">
                            <thead>
                            <tr>
                                <th class="text-center">W.No</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Contributor Name</th>
                                <th class="text-center">Amount</th>
                                @if($type==\App\Withdraw::WITHDRAW_STATUS_SUCCESS)
                                    <th class="text-center">Batch ID</th>
                                @endif
                                <th class="text-center">Status</th>
                                @if($type==\App\Withdraw::WITHDRAW_STATUS_REQUEST)
                                    <th class="text-center">Allow/Disallow</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach($withdraws as $withdraw) { ?>
                            <tr class="odd gradeX">
                                <td class="text-center"><?php echo $i;?></td>
                                <td class="text-center"><?php echo $withdraw->created_at;?></td>
                                <td class="text-center"><?php echo $withdraw->contributor_name;?></td>
                                <td class="text-center">$<?php echo $withdraw->amount;?></td>
                                @if($type==\App\Withdraw::WITHDRAW_STATUS_SUCCESS)
                                    <td class="text-center"><?php echo $withdraw->payout_batch_id;?></td>
                                @endif
                                <td class="text-center"><?php echo $withdraw->status_message;?></td>
                                @if($type==\App\Withdraw::WITHDRAW_STATUS_REQUEST)
                                    <td class="text-center">
                                        <a href="{{url('allow_withdraw'.'/'.$withdraw->id)}}" style="margin: 0 10px;">
                                            <i class="icon-ok"></i>
                                        </a>
                                        <a href="{{url('disallow_withdraw'.'/'.$withdraw->id)}}"
                                           style="margin: 0 10px;">
                                            <i class="icon-warning-sign"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            <?php $i++;}?>
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


