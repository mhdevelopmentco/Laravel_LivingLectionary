<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<title>Email Template</title>
	
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css" media="screen">

		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#fff; -webkit-text-size-adjust:none }
		a { color:#a88123; text-decoration:none }
		p { padding:0 !important; margin:0 !important;font-family: Montserrat } 

		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 680px) { 
			div[class='mobile-br-5'] { height: 5px !important; }
			div[class='mobile-br-10'] { height: 10px !important; }
			div[class='mobile-br-15'] { height: 15px !important; }
			div[class='mobile-br-20'] { height: 20px !important; }
			div[class='mobile-br-25'] { height: 25px !important; }
			div[class='mobile-br-30'] { height: 30px !important; }
td[class='hide']{
	display: none !important;
}

			th[class='m-td'], 
			td[class='m-td'], 
			div[class='hide-for-mobile'], 
			span[class='hide-for-mobile'] { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			span[class='mobile-block'] { display: block !important; }

			div[class='wgmail'] img { min-width: 320px !important; width: 320px !important; }

			div[class='img-m-center'] { text-align: center !important; }

			div[class='fluid-img'] img,
			td[class='fluid-img'] img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			table[class='mobile-shell'] { width: 100% !important; min-width: 100% !important; }
			td[class='td'] { width: 100% !important; min-width: 100% !important; }
			
			table[class='center'] { margin: 0 auto; }
			
			td[class='column-top'],
			th[class='column-top'],
			td[class='column'],
			th[class='column'] { float: left !important; width: 100% !important; display: block !important; }

			td[class='content-spacing'] { width: 15px !important; }

			div[class='h2'] { font-size: 44px !important; line-height: 48px !important; }

		} 
@media only screen and (max-device-width:480px), only screen and (max-width: 640px) { 
	.hide{
		display: none !important;
	}
}
	</style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#fff; -webkit-text-size-adjust:none">
<?php $customer_info = DB::table('nm_ordercod')->where('cod_transaction_id', '=', $transaction_id)
        ->LeftJoin('nm_product', 'nm_product.pro_id', '=', 'nm_ordercod.cod_pro_id')
        ->LeftJoin('nm_member', 'nm_member.mem_id', '=', 'nm_product.pro_mr_id')
        ->get(); 
foreach($customer_info as $ci) { } ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
		<tr>
			<td align="center" valign="top">
				<!-- Top -->
				
				<!-- END Top -->

				<table width="600" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
					<tr>
						<td class="td" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; width:600px; min-width:600px; Margin:0" width="600">
							<!-- Header -->
							
							<!-- END Header -->

							<!-- Main -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: separate;border-left-style: solid;
    border-top-left-radius: 10px; 
    border-bottom-left-radius: 10px;">
								<tr>
									<td>
										<!-- Head -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-image: -moz-linear-gradient( 90deg, #066ca9 0%, rgb(15, 122, 172) 100%);
  background-image: -webkit-linear-gradient( 90deg, #066ca9 0%, rgb(15, 122, 172) 100%);
  background-image: -ms-linear-gradient( 90deg, #066ca9 0%, rgb(15, 122, 172) 100%);">
											<tr>
												<td>
													
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor=""></td>
															<td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="10"></td>
															<td>
																<table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="15" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table>

																<div class="h3-2-center" style="color:#1e1e1e; font-family:Montserrat; min-width:auto !important; font-size:20px; line-height:26px; text-align:center; letter-spacing:5px"><img class="img-responsive" src="<?php echo url();?>/images/logo.png"></div>
																<table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="5" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table>
																<div class="h2" style="color:#ffffff; font-family:Georgia, serif; min-width:auto !important; font-size:60px; line-height:64px; text-align:center">
																	
																</div>
																<table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table>

															</td>
															<td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="10"></td>
															<td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor=""></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- END Head -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#fff;border-left: 3px solid #BF463D;border-right: 3px solid #BF463D;">
											<tr>
												<td>
													
													
												</td>
											</tr>
										</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#fff;border-left: 3px solid #BF463D;border-right: 3px solid #BF463D;" class="hide">
											<tr>
												<td>
													
												
												</td>
											</tr>
										</table>
										<!-- Body -->
										
										

										<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #086fa9;border-right:solid 1px #086fa9"> <tbody><tr> <td align="left" valign="top" style="color:#2c2c2c;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f9f9f9;padding:20px" bgcolor="#F9F9F9"> <p style="padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px"> Hi <?php echo $ci->mem_fname; ?>, </p><br> <p style="padding:0;margin:0;color:#565656;font-size:13px"> Thank you for your order!</p><br> <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px">
 We will send you another email once the items in your order have been shipped.  
 Meanwhile, you can check the status of your order on  
 <a alt="Flipkart.com" style="text-decoration:none" href="www.laravelecommerce.com" target="_blank"><span style="color:#666;font-size:13px">laravelecommerce.com</span></a></p><br><p style="text-align:center;padding:0;margin:0;line-height:22px;font-size:13px" align="center">Your Transaction Id :  <?php echo $ci->cod_transaction_id; ?></p><br> <p style="text-align:center;padding:0;margin:0" align="center"> <a style="width:200px;margin:0px auto;background-color: #FF9800;
    text-align: center;
    border: #ff9800 solid 1px;padding:8px 0;text-decoration:none;border-radius:2px;display:block;color:#fff;font-size:13px" href="" align="center" target="_blank"> <span style="color:#ffffff;font-size:13px;">VIEW YOUR ORDER</span> </a> </p> </td> </tr> </tbody></table>
										
										<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #086fa9;border-right:solid 1px #086fa9;line-height:1.5"> <tbody>

<tr> <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">S.no</p> </td>
<td width="60%" align="center" valign="top" style="padding:12px 15px 0 10px;margin:0;vertical-align:top;min-width:100px"> <p style="padding:0;margin:0"> <a style="text-decoration:none;color:#000" href="" target="_blank"><p style="white-space:nowrap;padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">Item Name</p>  </a> </p>  
 </td> 
 <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">Qty</p> </td>
 <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">Item Price</p> </td>
<td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">Tax</p> </td>
<td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">Ship Amount</p>  </td> 

<?php //$total = ($item_price + $tax) + $ship_amount; ?>

 <td width="33%" valign="top" align="center" style="padding:12px 20px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;padding:0;margin:0;color:#000;font-size:12px; font-weight:bold;">Subtotal </p>  </td>
</tr> 
									
<?php 
$i = 1;
$value = DB::table('nm_ordercod')->where('cod_transaction_id', '=', $transaction_id)->where('cod_merchant_id','=',$merchant_id)
        ->LeftJoin('nm_product', 'nm_product.pro_id', '=', 'nm_ordercod.cod_pro_id')
		->LeftJoin('nm_deals', 'nm_deals.deal_id', '=', 'nm_ordercod.cod_pro_id')
		->LeftJoin('nm_member', 'nm_member.mem_id', '=', 'nm_product.pro_mr_id')
        ->get(); 
foreach($value as $v) { 

        ?>
<tr>  <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px">  
 <?php echo $i; ?>
</p> </td><td width="33%" align="center" valign="top" style="padding:12px 10px 0 10px;margin:0;vertical-align:top;min-width:100px"> <p style="padding:0;margin:0"> <a style="text-decoration:none;color:#000" href="" target="_blank"><p style="color:#565656;font-size:13px"><?php if($v->cod_order_type==1) { echo $v->pro_title; } elseif($v->cod_order_type==2) { echo $v->deal_title; } ?>&nbsp;<sup></sup></p>  
 </td>  
 <td width="33%" valign="top" align="center" style="padding:12px 10px 0 5px;margin:0;text-align:center"> <p style="padding:7px 0 0 0;margin:0;color:#565656;font-size:13px">  
<?php echo $v->cod_qty; ?>
</p> </td>
 <td width="33%" valign="top" align="center" style="padding:12px 10px 0 5px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px">  
  <?php echo $v->cod_amt; ?>
</p> </td>
<td width="33%" valign="top" align="center" style="padding:12px 10px 0 5px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px">  
  <?php echo $v->cod_tax; ?>
</p> </td>
<td width="33%" valign="top" align="center" style="padding:12px 10px 0 5px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px">  
 <?php if($v->cod_order_type==1) { echo $v->pro_shippamt; } else { echo "0.00"; } ?>
</p> </td> 

<?php $total = ($v->cod_amt + $v->cod_tax) + $v->pro_shippamt; ?>

 <td width="33%" valign="top" align="center" style="padding:12px 20px 0 5px;margin:0;text-align:center"> <p style="white-space:nowrap;padding:7px 0 0 0;margin:0;color:#565656;font-size:13px">  
 <?php echo $total; ?>
</p> </td>
</tr> 

<?php $i++; }  ?>

<tr>  <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px">  
 &nbsp;
</p> </td><td width="60%" align="center" valign="top" style="padding:12px 10px 0 10px;margin:0;vertical-align:top;min-width:100px"> <p style="padding:0;margin:0"> <a style="text-decoration:none;color:#000" href="" target="_blank"><p style="color:#565656;font-size:13px">&nbsp;&nbsp;<sup></sup></p>  
 </td> 
 <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="padding:7px 0 0 0;margin:0;color:#565656;font-size:13px; font-weight:bold;">  
Total
</p> </td>
 <td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px; font-weight:bold;">  
 <?php echo $Sub_total; ?>
</p> </td>
<td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px; font-weight:bold;">  
 <?php echo $Tax; ?>
</p> </td>
<td width="33%" valign="top" align="center" style="padding:12px 10px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;margin:0;padding:7px 0 0 0;color:#565656;font-size:13px; font-weight:bold;">  
<?php echo $Shipping_amount; ?>
</p> </td> 

<?php $total = ($Sub_total + $Tax) + $Shipping_amount; ?>

 <td width="33%" valign="top" align="center" style="padding:12px 20px 0 10px;margin:0;text-align:center"> <p style="white-space:nowrap;padding:7px 0 0 0;margin:0;color:#565656;font-size:13px; font-weight:bold;">  
 <?php echo $total; ?>
</p> </td>
</tr> 

</tbody></table>
<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #086fa9;border-right:solid 1px #086fa9;line-height:2.5"> <tbody><tr> <td valign="top" align="center" style="background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:5px 20px 0 20px" bgcolor="#fff"> <table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin:0"> <tbody><tr> <td colspan="4" align="center" valign="top" style="border-bottom:#ccc dashed 1px;padding:0 0 17px 0">  
     
      <p style="padding:4px 5px;background-color: #f7f7f7;
    border: 1px solid #ff9800;
    color: #191919;margin:10px 0 0 0;text-align:center;font-size:12px">  
   Will be delivered by <span class="aBn" data-term="goog_231825889" tabindex="0"><span class="aQJ">2 to 3 days</span></span>  
  </p>  
 </td> </tr> </tbody></table> </td> </tr> </tbody>
 </table>
									<table width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;border-left:solid 1px #086fa9;border-right:solid 1px #086fa9;"> <tbody> <tr> <td valign="top" align="left" style="background-color:#ffffff;color:#565656;display:block;font-weight:300;margin:0;padding:0;clear:both" bgcolor="#ffffff"> <table width="100%" cellspacing="0" cellpadding="0"> <tbody><tr> <td valign="top" align="left" style="padding:20px 20px 0 20px;margin:0"> <p style="margin:0;padding:0;color:#565656;font-size:16px;line-height:28px;font-weight:bold">  
  DELIVERY ADDRESS 
<?php
$allpas = explode(",",$ci->cod_ship_addr);
$mem_name = $allpas[0];
$cus_addr1 = $allpas[1];
$cus_addr2 = $allpas[2];
$state = $allpas[3];
$zip = $allpas[4];
$mem_phone = $allpas[5];
$cus_mail = $allpas[6];

?>  
</p> <p style="padding:0;margin:15px 0 10px 0;font-size:14px;color:#333333;line-height:24px">  
<span style='font-weight: bold;'>Name:</span><span><?php echo $mem_name; ?></span><br>
<span style='font-weight: bold;'>Address:</span><span><?php echo $cus_addr1.$cus_addr2; ?></span><br>
<span style='font-weight: bold;'>State:</span><span><?php echo $state; ?></span><br>
<span style='font-weight: bold;'>Zip code:</span><span><?php echo $zip; ?></span><br>
<span style='font-weight: bold;'>Phone:</span><span><?php echo $mem_phone; ?></span><br>
<span style='font-weight: bold;'>Email:</span><span><?php echo $cus_mail; ?></span><br>
</p> <p style="line-height:18px;line-height:20px;padding:0;margin:0;color:#565656;font-size:13px;line-height:24pox">  

</p> </td><td>
	<center style="padding-right:15px"><p style="white-space:nowrap;padding:0;margin:0;color:#848484;font-size:15px;line-height:1.5">Any Questions?</p><br>
	<p style="white-space:nowrap;padding:0;margin:0;color:#848484;font-size:15px;line-height:1.5">Get in touch with our 24x7 Member Care team.</p>|</center>
</td> 
</tr> </tbody></table> </td> 
</tr> </tbody> </table>
										<!-- END Body -->

										<!-- Foot -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="" style="background-image: -moz-linear-gradient( 90deg, #066ca9 0%, rgb(15, 122, 172) 100%);
  background-image: -webkit-linear-gradient( 90deg, #066ca9 0%, rgb(15, 122, 172) 100%);
  background-image: -ms-linear-gradient( 90deg, #066ca9 0%, rgb(15, 122, 172) 100%);">
  
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor=""></td>
															<td>
																<table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%;margin-top:20px;font-family:Montserrat"><tr><td height="0" class="spacer" style="font-size:11pt; line-height:1.5pt; text-align:center; width:100%; min-width:100%;color:#fff;">&copy; Laravel Ecommerce, All rights reserved</td></tr></table>

																
																


																<!-- Socials -->
															
																<!-- END Socials -->
																<table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"><tr><td height="15" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">&nbsp;</td></tr></table>

															</td>
															<td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="3" bgcolor=""></td>
														</tr>
													</table>
													
												</td>
											</tr>
										</table>
										<!-- END Foot -->
									</td>
								</tr>
							</table>
							<!-- END Main -->
							
							<!-- Footer -->
							
							<!-- END Footer -->
						</td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
</body>
</html>