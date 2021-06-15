<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Living Lectionary</title>
</head>
  <?php $logopath="/public/assets/images/logo/Ecartlogo.png"; ?>

<body style="max-width:800px; margin:0px auto">
<div style="border:1px solid #ddd; padding:10px">
  <div style="text-align:center"><img src="<?php echo url('').$logopath;?>" /></div>
  <div>

    <h3>Hello, <?php echo $customername;?></h3>
    <h5>Password Reset Link</h5>
 
  </div>
  
  <center><table width="500px" border="0">
  <tr>
    <td colspan="2" align="center"  style="background:#f3f3f3; padding:10px" >PAssword Link</td>
    </tr>
  <tr>
    <td>Username</td>
    <td><?php echo $user_email ;?></td>
  </tr>
  <tr>
    <td>Password Link</td>
    <td ><a href="<?php echo url('forgot_pwd_email/'.$encode_email); ?>">Please click this link to reset your password!</a></td>
  </tr>
</table>
</center>

 
</div>
 <div style="text-align:center; background:#f3f3f3; padding:5px"><a href="">nexecart.nexecommerce.com/</a></div>

</body>
</html>
