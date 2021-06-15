@extends('sitemerchant.layout.merchant_master')
@section('title', 'Withdraw Report')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li class=""><a href="<?php echo url('sitemerchant_dashboard'); ?>">Home</a></li>
                <li class="active"><a href="#">Withdraw Report</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Withdraw Report</h5>
                </header>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>W.No</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Batch ID</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;
                                        foreach($withdraws as $withdraw) { ?>
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo $i;?></td>
                                            <td class="center"><?php echo $withdraw->created_at;?></td>
                                            <td class="center">$<?php echo $withdraw->amount;?></td>
                                            <td class="center"><?php echo $withdraw->payout_batch_id;?></td>
                                            <td class="center"><?php echo $withdraw->status_message;?></td>
                                        </tr>
                                        <?php $i++;}?>
                                        </tbody>
                                    </table>
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
@endsection
