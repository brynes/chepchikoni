<?php
/*************************************************
Restaurant Reservation form Ajax-PHP mail function starts here
*****************************************************/

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['message']) && isset($_POST['date']) && isset($_POST['email']))
{
$sendername = strip_tags(trim($_POST["name"]));

$senderphone = strip_tags(trim($_POST["phone"]));

$sendermessage = strip_tags(trim($_POST["message"]));

$sendersubject = strip_tags(trim($_POST["email_subject"]));

$senderdate = strip_tags(trim($_POST["date"]));

$senderemail = strip_tags(trim($_POST["email"]));

$recepient = strip_tags(trim($_POST["recipient_email"]));

$recipient_name = strip_tags(trim($_POST["recipient_name"]));

$select   = '';

$yourselect = strip_tags(trim($_POST["select_title"]));

// sanitize form values

if( !empty($_POST["select"])){

$select = $_POST["select"];

} else {

$select = '';

}
//Output in receiver email

$message= 'Sender-Name: '. $sendername ."\r\n";

$message.= 'Sender-Phone: '. $senderphone ."\r\n";

$message.= 'Sender-Email: '. $senderemail ."\r\n";

$message.= 'Sender-Appointment-Date: '. $senderdate ."\r\n";

$message .= 'Sender-Message: ' .$sendermessage ."\r\n";

if($yourselect){
$message.= $yourselect.': ' . $select ."\r\n";
}

$pagetitle = $sendersubject;

$mail= mail($recepient, $pagetitle, $message);

}