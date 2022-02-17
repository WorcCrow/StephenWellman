<?php
$query = "SELECT value FROM settings WHERE config='email_default_sender'";
$result = GetRowData($query);
$email_default_sender = $result[0]['value'];

$jobid = $sw_data[0]->id;
$client = $sw_data[0]->client;
$client_email = $sw_data[0]->client_email;
$date = $sw_data[0]->date;
$timein = $sw_data[0]->timein;
$timeout = $sw_data[0]->timeout;
$totaltime = totalTime($sw_data[0]->timein,$sw_data[0]->timeout);
$jobdesc = $sw_data[0]->job;
$signature = $sw_data[0]->signature;
$signatureAttach = base64_decode(str_replace(" ", "+", substr($signature, strpos($signature, ","))));

$contact = $sw_data[0]->contact;

$signature = SaveImg($signatureAttach);

ob_start();
$sendmail = true;
include($docroot . "template/jobsheet-template.php");
$body = ob_get_clean();
$body = str_replace(["\n","\t"], "",$body);

$data = array(
	'from_email' => $email_default_sender,
	'from_name' => 'SW Team',
	'to_email' => $client_email,
	'to_name' => $client,
	'email_subject' => 'SW - Job Completed [#'.$sw_data[0]->id.']',
	'email_body' => $body,
	'email_base64_attach' => $signature,
	'email_base64_cid' => 'signature'
);
if(SendMail($data)){
	unlink($docroot.'temp/'.$signature.'.png');
	$data = array("status" => "success",
				"desc" => "Submited Successfully! Email Sent!",
				"data" => $sw_data);
}else{
	$data = array("status" => "invalid",
				"desc" => "An error occured on Automail!");
}
?>