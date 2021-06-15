<?php
require 'Send_Mail.php';
$to = " contact@livinglectionary.com";
$subject = "Test Mail Subject";
$body = "Hi<br/>Test Mail<br/>Amazon SES"; // HTML  tags
$mail=Send_Mail($to,$subject,$body);
if($mail)
{
echo "mail send ";
}
else
{
	echo "try again";
}
?>
