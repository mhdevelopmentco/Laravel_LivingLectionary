@extends('sitemerchant.layout.merchant_master')
@section('title', 'Cash On Delivery')
@section('css')
    <link rel="stylesheet" href="<?php echo url('')?>/public/assets/css/success.css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Shipping Delivery</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Shipping Delivery</h5>
                </header>
                <div class="accordion-body collapse in body" id="div-1">
                    <div id="dataTables-example_wrapper"
                         class="dataTables_wrapper form-inline" role="grid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="dataTables-example_length"
                                     class="dataTables_length"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_filter"
                                     id="dataTables-example_filter"></div>
                            </div>
                        </div>
                        <table aria-describedby="dataTables-example_info"
                               class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="dataTables-example">
                            <thead>
                            <tr role="row">
                                <th aria-sort="ascending"
                                    aria-label="S.No: activate to sort column ascending"
                                    style="width: 99px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting_asc">S.No
                                </th>
                                <th aria-label="Members: activate to sort column ascending"
                                    style="width: 111px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Resources
                                    Name
                                </th>
                                <th aria-label="Product Title: activate to sort column ascending"
                                    style="width: 219px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Name
                                </th>
                                <th aria-label="Amount(S/): activate to sort column ascending"
                                    style="width: 125px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Email
                                </th>
                                <th aria-label="Amount(S/): activate to sort column ascending"
                                    style="width: 125px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Date
                                </th>
                                <th aria-label=" Tax (S/): activate to sort column ascending"
                                    style="width: 119px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Address
                                </th>
                                <th aria-label=" Tax (S/): activate to sort column ascending"
                                    style="width: 119px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Resource
                                    Details
                                </th>
                                <th aria-label="Transaction Date: activate to sort column ascending"
                                    style="width: 125px;" colspan="1"
                                    rowspan="1"
                                    aria-controls="dataTables-example"
                                    tabindex="0" class="sorting">Delivery
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 1;
                            foreach($coddetail as $cod)
                            {

                            $orderstatus = "";
                            $status = $cod->cod_status;
                            if ($cod->cod_status == 1) {
                                $orderstatus = "success";
                            } else if ($cod->cod_status == 2) {
                                $orderstatus = "completed";
                            } else if ($cod->cod_status == 3) {
                                $orderstatus = "Hold";
                            } else if ($cod->cod_status == 4) {
                                $orderstatus = "failed";
                            }


                            ?>

                            <tr class="gradeA odd">
                                <td class="sorting_1"><?php echo $i;?></td>
                                <td class="text-center"><?php echo $cod->pro_title;?></td>
                                <td class="text-center"><?php echo $cod->mem_fname . ' ' . $cod->mem_lname;?></td>
                                <td class="text-center"><?php echo $cod->mem_email;?></td>
                                <td class="text-center"><?php echo $cod->cod_date;?></td>
                                <td class="text-center"><?php echo $cod->ship_address1;?></td>

                                <td class="text-center"><a
                                            data-target="<?php echo '#uiModal' . $i;?>"
                                            data-toggle="modal">view
                                        details</a></td>
                                <td class="text-center"><?php echo $orderstatus;?></td>
                            </tr>

                            <?php   $i = $i + 1;} ?>

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_paginate"
                                     class="dataTables_paginate paging_simple_numbers"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="formModal" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="form-group">
                            <label>Enter coupen code</label>
                            <input class="form-control">

                        </div>
                        <div class="form-group">
                            <label>Address&nbsp;:&nbsp;</label>
                            asdsa,,California,Canadian
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea id="text4" class="form-control"></textarea>
                        </div>


                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success" type="button">Send</button>
                </div>
            </div>
        </div>
    </div>

    <?php  $i = 1;
    foreach($coddetail as $coddetails)
    {
    $status = $coddetails->cod_status;
    if ($coddetails->cod_status == 1) {
        $orderstatus = "success";
    } else if ($coddetails->cod_status == 2) {
        $orderstatus = "completed";
    } else if ($coddetails->cod_status == 3) {
        $orderstatus = "Hold";
    } else if ($coddetails->cod_status == 4) {
        $orderstatus = "failed";
    }
    ?>

    <div id="<?php echo 'uiModal' . $i?>" class="modal fade in" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:none;">
                    <div class="col-md-12 text-center">
                        <strong>TAX INVOICE </strong>
                        <a href="" class="btn btn-default pull-right" data-dismiss="modal"><i
                                    class="icon-remove icon-1x"></i></a>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" style="border-right:1px dotted #666;">
                            <h4>CASH ON DELIVERY</h4>
                            <b>Amount Paid :<?php echo "$" . $coddetails->cod_amt;?></b>
                            <br>
                            <span>(inclusive of all charges)</span>
                            <br>
                            <br>
                            <span>Order Date: <?php echo $coddetails->cod_date;?></span>
                        </div>
                        <div class="col-md-6">
                            <h4>Shipping Address</h4>
                            <p><?php echo $coddetails->ship_address1;?></p>
                            <h4>Phone</h4>
                            <p><?php echo $coddetails->ship_phone;?></p>
                        </div>


                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="span12 text-center">
                        <h4 class="text-center">Invoice Details</h4>
                        <span>This shipment contains following items </span>
                    </div>
                </div>
                <hr>
                <h4 class="text-center"><?php echo $i . "   " . $coddetails->pro_title;?></h4>

                <div class="col-md-12">
                    <table>
                        <tr style="border-bottom:1px solid #666;">
                            <td width="13%" align="center">Color</td>
                            &nbsp;
                            <td width="13%" align="center">Size</td>
                            <td width="13%" align="center">Quantity</td>
                            <td width="13%" align="center">Original Price</td>
                            <td width="13%" align="center">Sub Total</td>

                            <?php $subtotal = $coddetails->cod_qty * $coddetails->cod_amt;  ?>
                        </tr>

                        <tr>
                            <td width="13%" align="center"><?php echo $coddetails->cf_name;?></td>
                            &nbsp;
                            <td width="13%" align="center"><?php echo $coddetails->si_name;?></td>
                            <td width="13%" align="center"><?php echo $coddetails->cod_qty;?> </td>
                            <td width="13%" align="center"><?php echo $coddetails->cod_amt;?> </td>
                            <td width="13%" align="center"><?php echo $subtotal;?> </td>


                        </tr>
                    </table>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <span>Shipment Value<b class="pull-right"
                                               style="margin-right:15px;"><?php echo $subtotal;?> </b></span><br>
                    <span>Tax<b class="pull-right"
                                style="margin-right:15px;"><?php echo $coddetails->cod_tax;?></b></span>
                        <hr>
                        <?php $totamt = $subtotal + $coddetails->cod_tax;?>
                        <span>Amount<b class="pull-right" style="margin-right:15px;"><?php echo $totamt;?></b></span>
                    </div>
                </div>


                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>

                </div>
            </div>
        </div>
    </div>
    <?php $i = $i + 1; }?>

@endsection
@section('script')
@endsection

