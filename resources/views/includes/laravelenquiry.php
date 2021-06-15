<?php
/*session_start();
if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code']) ) {
		unset($_SESSION['security_code']);
} 
else 
{
	    $url="mail-sent-error.html";
        header("Location: ". $url);
		exit(0);
}
*/

$name=$_POST['Name']; 
$mobile=$_POST['Phonenumber'];
$alterphone=$_POST['AlterPhonenumber']; 
$email=$_POST['address'];
$amount=$_POST['landmark'];
$order=$_POST['order'];
$ref=$_SERVER['HTTP_REFERER'];

$message='<table width=100% border=0 border-color:none cellspacing=3 cellpadding=3 class=text style="font-family:Arial; line-height:160% word-spacing:0.4em font-size:18px; border: 1px solid" bgcolor="#CCCCCC" color:"#fffff">
<tr >
<td colspan="4"  align="center" bgcolor="#CCCCCC"><strong>laravel Enquiry</strong></td>
</tr>
   <tr>
    <td>Name</td>
    <td>:</td>
    <td >'.$name.'</td>
  </tr>
  <tr>
    <td>E-mail Id</td>
    <td>:</td>
    <td>'.$amount.'</td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td>:</td>
    <td>'.$mobile.'</td>
  </tr>
    
  <tr>
    <td>Message</td>
    <td>:</td>
   <td>'.$email.'</td>
  </tr>
 
    
   </table>';
    
/*echo $message;*/

/*echo "<b>Order Details</b>"."<br>";
foreach($_POST['Checkbox1'] as $selected)
{echo $selected."</br>";}*/
/*
$headers  = 'MIME-Version: 1.0' . "\r\n";*/
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$name;

if(@mail("contact@livinglectionary.com",'laravel Enquiry',"$message",$headers))
{
	
	$url="header.blade.php";
	header("Location: ". $url);
	
/*	echo "Thank you for contacting.";*/
}
else
{
	$url="404.html";
	header("Location: ". $url);
}

?>