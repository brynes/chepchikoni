<?php
/*************************************************
Restaurant Reservation form Ajax-PHP mail function starts here
*****************************************************/

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['message']) && isset($_POST['date']) && isset($_POST['guest']))
{
$sendername = strip_tags(trim($_POST["name"]));

$senderphone = strip_tags(trim($_POST["phone"]));

$sendermessage = strip_tags(trim($_POST["message"]));

$sendersubject = strip_tags(trim($_POST["email_subject"]));

$senderdate = strip_tags(trim($_POST["date"]));

$senderguest = strip_tags(trim($_POST["guest"]));

$recepient = strip_tags(trim($_POST["recipient_email"]));

$recipient_name = strip_tags(trim($_POST["recipient_name"]));

$select   = '';

$radio    = '';

$checkbox = '';

$yourselect = strip_tags(trim($_POST["select_title"]));

$yourradio = strip_tags(trim($_POST["radio_title"]));

$yourcheckbox = strip_tags(trim($_POST["checkbox_title"]));



// sanitize form values

if( !empty($_POST["select"])){

$select = $_POST["select"];

} else {

$select = '';

}

if( !empty($_POST["radio"])){

$radio = $_POST["radio"];

} else {

$radio = '';

}

if( !empty($_POST["checkbox"])){

$comma_separated = implode(",", $_POST["checkbox"]);

$checkbox =  $comma_separated ;

} else {

$checkbox = '';

}


//Output in receiver email



$message= 'Sender-Name: '. $sendername ."\r\n";

$message.= 'Sender-Phone: '. $senderphone ."\r\n";

$message.= 'Sender-Number-of-Guests: '. $senderguest ."\r\n";

$message.= 'Sender-Reservation-Date: '. $senderdate ."\r\n";

$message .= 'Sender-Message: ' .$sendermessage ."\r\n";

if($yourselect){
$message.= $yourselect.': ' . $select ."\r\n";
}
if($yourradio){
$message.= $yourradio.': ' . $radio ."\r\n";
}
if($yourcheckbox){
$message.= $yourcheckbox.': ' . $checkbox ."\r\n";
}

$pagetitle = $sendersubject;

$mail= mail($recepient, $pagetitle, $message);

}