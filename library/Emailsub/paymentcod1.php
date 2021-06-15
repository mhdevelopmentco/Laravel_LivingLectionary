<?php $logopath="/public/assets/images/logo/Ecartlogo.png"; ?>
<table border="0" cellspacing="0" cellpadding="0" width="600" align="center" style="border:2px solid #ff8400;">
					<tr bgcolor="#fff">
					<td style="height:20px;">&nbsp;</td>
				  </tr>
				  <tr bgcolor="#fff">  
				<td align="center"><img src="<?php echo url('').$logopath;?>" width="190" height="90" alt="'.$site_name.'" style="margin:0 30px 20px 40px;"/>          </td>
				  </tr>
				  <tr>
					<td style="border:3px solid #fff;"></td>
				  </tr>
				  <tr>
					<td style="border:1px solid #ff8400;height:30px;"><b><?php echo $emailsubject;?></b></td>
				  </tr>
				  <tr>
					 <td style=" margin:0 auto; font-size:16px;text-align:left; font-family:Arial, Helvetica, sans-serif; padding:10px 10px 10px;">
						<table  cellspacing="10">
						 <tr>
							<th></th>
							 <th></th>
							  <td ><?php echo $subject."<br>";?> <?php echo $subject."<br>";?><h4>Hello, <?php echo $name;?></h4>
       <p> Thank you for your order from Dip Multivendor. Once your package ships we will send you a confirmation email. You can check the status of your order by logging into your account. If you have any questions about your order please contact us at sales@Dip Multivendor.Dip Multivendor or call us at +1 (877) 419-0344 Monday - Friday, 8am - 4pm IST.
Your order confirmation is below. Thank you again for your business.</p></td>
							</tr>
							<tr>
							 <th>Member_Name</th>
							<th>:</th>
							  <td ><?php echo $name;?></td>
							</tr>
                            <tr>
							 <th>TransactionId</th>
							<th>:</th>
							  <td ><?php echo $transid;?></td>
							</tr>
                              <tr>
							 <th>Address</th>
							<th>:</th>
							  <td ><?php echo $shipaddress;?></td>
							</tr>
						 
                           
						 </table>
					 </td>
				  </tr>  
				
				  <tr bgcolor="#101010">
					<td style="height:50px;text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:14px;">
					<a href="http://www.claydip.com/" target="_blank"  style="text-decoration:none;color:#ff8400;font-weight:800;"> 
					&copy; Dip Multivendor 2014</a></td>
				  </tr>
				
				 </table>