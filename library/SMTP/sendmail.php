<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = "chalesvictor.info@gmail.com";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->IsHTML(true); // send as HTML
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host       = "smtp.gmail.com"; // Amazon SES server, note "tls://" protocol
$mail->Port       = 443;                    // set the SMTP port
$mail->Username   = "chalesvictor.info@gmail.com";  // SES SMTP  username
$mail->Password   = "tn66c0793";  // SES SMTP password
$mail->SetFrom($from, 'laravelecommerce');
$mail->AddReplyTo($from,'laravelecommerce');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);

if(!$mail->Send())
return false;
else
return true;

}
?>

