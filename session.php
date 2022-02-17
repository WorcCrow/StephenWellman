<?php
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require("config.php");
	//echo "<pre>";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: SW Jobsheet <jobsheet@wellman.technology>' . "\r\n";
			$headers .= 'Cc: info@stephenwellman.com' . "\r\n";
//Mail ('francismickobienes@gmail.com', 'TEst', 'Test', $headers);
$automail->setFrom('jobsheet@wellman.technology', 'SW Stephen Wellman');

//$automail->addReplyTo('francismickobienes@gmail.com', 'Mirg Perrea');
$automail->addAddress('francismickobienes@gmail.com', 'Mirg Perrea');
$automail->Subject = 'Email Test';

$automail->Body = 'PHPMAILER IS MAIL';

if (!$automail->send()) {
	//return 'Mailer Error: ' . $automail->ErrorInfo;
	echo 'false';
} else {
	//return 'Message sent!';
	echo 'true';
}
?>