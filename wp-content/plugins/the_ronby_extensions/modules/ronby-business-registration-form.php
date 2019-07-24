<?php
/*************************************************
Contact form Ajax-PHP mail function starts here
*****************************************************/

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']))
{
$sendername = strip_tags(trim($_POST["name"]));

$emailaddress = strip_tags(trim($_POST["email"]));

$senderphone = strip_tags(trim($_POST["phone"]));

$sendersubject = strip_tags(trim($_POST["email_subject"]));

$recepient = strip_tags(trim($_POST["recipient_email"]));

$recipient_name = strip_tags(trim($_POST["recipient_name"]));

$select   = '';

$checkbox = '';

$yourselect = strip_tags(trim($_POST["select_title"]));

$yourcheckbox = strip_tags(trim($_POST["checkbox_title"]));



// sanitize form values

if( !empty($_POST["select"])){

$select = $_POST["select"];

} else {

$select = '';

}

if( !empty($_POST["checkbox"])){

$comma_separated = implode(",", $_POST["checkbox"]);

$checkbox =  $comma_separated ;

} else {

$checkbox = '';

}


//Output in receiver email

$message= 'Sender-name: '. $sendername ."\r\n";

$message.= 'Sender-email: '. $emailaddress ."\r\n";

$message.= 'Sender-phone: '. $senderphone ."\r\n";

if($select){
$message.= $yourselect.': ' . $select ."\r\n";
}

if($checkbox){
$message.= $yourcheckbox.': ' . $checkbox ."\r\n";
}

$pagetitle = $sendersubject;

$mail= mail($recepient, $pagetitle, $message);

}