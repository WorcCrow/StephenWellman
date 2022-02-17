<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	require("config.php");
	
	$query = "SELECT * FROM settings";
	$result = GetRowData($query);
	if(count($result)){
		foreach($result as $res){
			if($res['config'] === 'email_automail_it' ){
				$email_automail_it = $res['value'];
				
			}else if($res['config'] === 'email_automail_drone' ){
				$email_automail_drone = $res['value'];
				
			}
		}
		
	}
	
	if(isset($_POST['newjobsheet'])){
		$newjobsheet = sanitize("string",$_POST['newjobsheet']);
		if($newjobsheet === 'drone'){
			$personel_id = GetSession('user')['id'];
			$company = sanitize("string",$_POST['company']);
			$contact = sanitize("string",$_POST['contact']);
			$location = sanitize("string",$_POST['location']);
			$date = sanitize("string",$_POST['date']);
			$timein = date("H:i:s",strtotime(sanitize("string",$_POST['timein'])));
			$timeout = date("H:i:s",strtotime(sanitize("string",$_POST['timeout'])));
			$category = sanitize("string",$_POST['category']);
			
			
			if($company !== '' && $contact !== '' && $date !== '' && $timein !== '' && $timeout !== '' && $category !== '0'){	
				$query = "INSERT INTO dronerecord (personel_id, company, contact, location, date, timein, timeout, category) ";
				$query .= "VALUES ('$personel_id','$company', '$contact', '$location', '$date','$timein','$timeout','$category')";
				ExecuteSQL($query);
				
				$query = "SELECT MAX(id) as MAX, (SELECT email FROM clients WHERE company='$company' LIMIT 1) as client_email FROM dronerecord ";
				$result = GetRowData($query);
				if(count($result)){
					$client_email = $result[0]['client_email'];
					$query = "SELECT * FROM dronerecord ";
					$query .= "WHERE id = '".$result[0]['MAX']."'";
					$result = GetRowData($query);
					$sw_data = array();
					if(count($result)){
						foreach($result as $res){
							array_push($sw_data,(object)array(
								'id' => $res['id'],
								'company' => $res['company'],
								'client_email' => $client_email,
								'contact' => $res['contact'],
								'location' => $res['location'],
								'date' => DateFormat($res['date']),
								'timein' => $res['timein'],
								'timeout' => $res['timeout'],
								'totaltime' => totalTime($res['timein'],$res['timeout']),
								'category' => $res['category']));
						}
						
						if($email_automail_drone === 'true'){
							include("AutomailDRONE.php");
						}else{
							$data = array("status" => "success",
								"desc" => "Submited Successfully! Email Disabled!",
								"data" => $sw_data);
						}
					}else{
						$data = array("status" => "invalid",
						"desc" => "an error occurred. please try again later.");
					}
				}else{
					$data = array("status" => "invalid",
						"desc" => "an error occurred. please try again later.");
				}	
			}else{
				$data = array("status" => "invalid",
								"desc" => "Important field cannot be empty.");
			}
		}else if($newjobsheet === 'it' && $_POST['signature'] !== ''){
			$personel_id = GetSession('user')['id'];
			$client = sanitize("string",$_POST['client']);
			$contact = sanitize("string",$_POST['contact']);
			$method = sanitize("string",$_POST['method']);
			$date = sanitize("string",$_POST['date']);
			$timein = date("H:i:s",strtotime(sanitize("string",$_POST['timein'])));
			$timeout = date("H:i:s",strtotime(sanitize("string",$_POST['timeout'])));
			$job = sanitize("string",$_POST['job']);
			$signature = $_POST['signature'];
			$sign = true;
			try{
				$signature = addslashes(base64_decode(str_replace(' ', '+', str_replace('data:image/png;base64,', '', $signature))));
			}catch(Exception $e){
				$sign = false;
			}
			
			if($client !== '' && $contact !== '' && $date !== '' && $timein !== '' && $timeout !== '' && $job !== '' && $sign){	
				$query = "INSERT INTO jobsheetrecord (personel_id, client, contact, method, date, timein, timeout, job, signature) ";
				$query .= "VALUES('$personel_id', '$client', '$contact', '$method', '$date', '$timein', '$timeout', '$job', '$signature')";
				ExecuteSQL($query);
				
				$query = "SELECT MAX(id) as MAX, (SELECT email FROM clients WHERE company='$client' LIMIT 1) as client_email FROM jobsheetrecord ";
				$result = GetRowData($query);
				if(count($result)){
					$client_email = $result[0]['client_email'];
					$query = "SELECT * FROM jobsheetrecord ";
					$query .= "WHERE id = '".$result[0]['MAX']."'";
					$result = GetRowData($query);
					$sw_data = array();
					if(count($result)){
						foreach($result as $res){
							array_push($sw_data,(object)array(
								'id' => $res['id'],
								'client' => $res['client'],
								'client_email' => $client_email,
								'contact' => $res['contact'],
								'date' => DateFormat($res['date']),
								'timein' => $res['timein'],
								'timeout' => $res['timeout'],
								'totaltime' => totalTime($res['timein'],$res['timeout']),
								'job' => $res['job'],
								'signature' =>  "data:image/png;base64,".base64_encode($res['signature'])));
						}
						
						if($email_automail_it === 'true'){
							include("AutomailIT.php");
						}else{
							$data = array("status" => "success",
								"desc" => "Submited Successfully! Email Disabled!",
								"data" => $sw_data);
						}
						
						
					}else{
						$data = array("status" => "invalid",
						"desc" => "an error occurred. please try again later.");
					}
				}else{
					$data = array("status" => "invalid",
						"desc" => "an error occurred. please try again later.");
				}	
			}else{
				$data = array("status" => "invalid",
								"desc" => "Important field cannot be empty.");
			}
		}else if($_POST['signature'] === ''){
			$data = array("status" => "invalid",
						"desc" => "Please sign the form.");
		}
		else{
			$data = array("status" => "invalid",
						"desc" => "System Abnormality Detected.");
		}
		
		echo json_encode($data);
	}
?>