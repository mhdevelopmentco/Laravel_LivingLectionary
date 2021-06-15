<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

 <?php $logopath="/public/assets/images/logo/Ecartlogo.png"; ?>
<body style="max-width:800px; margin:0px auto">
<div style="border:1px solid #ddd; padding:10px">
  <div style="text-align:center"><img src="<?php echo url('').$logopath;?>" /></div>
  <div>
 
    <h3>Hello, <?php echo $name;?></h3>
    <h5>Thank you for Shopping With the Dip Multivendor!</h5>
   <p> Thank you for your order from Dip Multivendor.Once your package ships we will send you a confirmation email. You can check the status of your order by logging into your account.
Your order confirmation is below. Thank you again for your business.</p>
  </div>
  
  <center><table width="500px" border="0">
  <tr>
    <td colspan="2" align="center"  style="background:#f3f3f3; padding:10px" >PAYMENT DETAILS</td>
    </tr>
<tr>
<td>Payer_Name</td>
<td ><?php echo $name;?></td>
</tr>
<tr>
<td>TransactionId</td>
<td ><?php echo $transid;?></td>
</tr>
<tr>
<td>Payer_Id</td>
<td ><?php echo $payid;?></td>
</tr>
<tr>
<td>Acknowledgement</td>
<td ><?php echo $ack;?></td>
</tr>
</table>
</center>

 
</div>
 <div style="text-align:center; background:#f3f3f3; padding:5px"><a href="">Dip Multivendor</a></div>

</body>
</html>
