<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;

	require($docroot . "vendor/autoload.php");

	$automail = new PHPMailer();
	
	if(AM_DEBUG){
		$automail->SMTPDebug = SMTP::DEBUG_SERVER;
	}
	
	if(AM_isMail){
		$automail->isMail();
		$automail->IsHTML(AM_isHTML); 
	}else{
		$automail->isSMTP();
		$automail->Host = AM_HOST;
		$automail->Port = AM_PORT;
		$automail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$automail->SMTPAuth = true;
		$automail->Username = AM_USERNAME;
		$automail->Password = AM_PASSWORD;
		$automail->IsHTML(AM_isHTML); 
	}
?>