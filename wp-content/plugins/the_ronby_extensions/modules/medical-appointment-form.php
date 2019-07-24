<?php
/*************************************************
Contact form Ajax-PHP mail function starts here
*****************************************************/

if (isset($_POST['name']) && isset($_POST['phone']))
{
$sendername = strip_tags(trim($_POST["name"]));

$senderphone = strip_tags(trim($_POST["phone"]));

$sendersubject = strip_tags(trim($_POST["email_subject"]));

$recepient = strip_tags(trim($_POST["recipient_email"]));

$recipient_name = strip_tags(trim($_POST["recipient_name"]));

//Output in receiver email

$message= 'Sender-name: '. $sendername ."\r\n";

$message.= 'Sender-phone: '. $senderphone ."\r\n";

$pagetitle = $sendersubject;

$mail= mail($recepient, $pagetitle, $message);

}