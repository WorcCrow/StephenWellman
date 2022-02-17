<?php
$query = "SELECT value FROM settings WHERE config='email_default_sender'";
$result = GetRowData($query);
$email_default_sender = $result[0]['value'];

$jobid = $sw_data[0]->id;
$client = $sw_data[0]->company;
$client_email = $sw_data[0]->client_email;
$location = $sw_data[0]->location;
$date = $sw_data[0]->date;
$totaltime = totalTime($sw_data[0]->timein,$sw_data[0]->timeout);
$category = $sw_data[0]->category;

ob_start();
$sendmail = true;
include($docroot . "template/dronework-template.php");
$body = ob_get_clean();
$body = str_replace(["\n","\t"], "",$body);

$data = array(
	'from_email' => $email_default_sender,
	'from_name' => 'SW Team',
	'to_email' => $client_email,
	'to_name' => $client,
	'email_subject' => 'Dronework - Job Completed [#'.$sw_data[0]->id.']',
	'email_body' => $body
);
if(SendMail($data)){
	$data = array("status" => "success",
				"desc" => "Submited Successfully! Email Sent!",
				"data" => $sw_data);
}else{
	$data = array("status" => "invalid",
				"desc" => "An error occured on Automail!");
}
?>