<?php
	require("config.php");
	
	if(isset($_POST['record'])){
		$record = sanitize("string",$_POST['record']);
		if($record === 'drone'){
			$data = array("status" => "invalid",
					"desc" => "System Abnormality Detected.");
			if($_POST['type'] === 'id'){
				$id = sanitize("string",$_POST['id']);
				$query = "SELECT company, contact, location, date, timein, timeout FROM dronerecord ";
				$query .= "WHERE id = '$id'";
				$result = GetRowData($query);
				$sw_data = array();
				if(count($result)){
					foreach($result as $res){
						array_push($sw_data,(object)array(
						$id,
						$res['company'],
						$res['location'],
						DateFormat($res['date']),
						$res['timein'],
						$res['timeout']));
					}
					
					$data = array("status" => "success",
							"data" => $sw_data);
					
				}else{
					$data = array("status" => "invalid",
									"desc" => "The ID you have entered do not exist.",
									"query" => "$query");
				}
			}else if($_POST['type'] === 'date'){
				$dfrom = sanitize("string",$_POST['dfrom']);
				$dto = sanitize("string",$_POST['dto']);
				$query = "SELECT id, company, location, contact, date, timein, timeout FROM dronerecord ";
				$query .= "WHERE date BETWEEN '$dfrom' and '$dto'";
				$result = GetRowData($query);
				$sw_data = array();
				if(count($result)){
					foreach($result as $res){
						array_push($sw_data,(object)array(
						$res['id'],
						$res['company'],
						$res['location'],
						DateFormat($res['date']),
						$res['timein'],
						$res['timeout']));
					}
					
					$data = array("status" => "success",
							"data" => $sw_data);
					
				}else{
					$data = array("status" => "invalid",
									"desc" => "Select date range is Invalid.",
									"query" => "$query");
				}
			}
			echo json_encode($data);
		}else if($record === 'it'){
			$data = array("status" => "invalid",
					"desc" => "System Abnormality Detected.");
			if($_POST['type'] === 'id'){
				$id = sanitize("string",$_POST['id']);
				$query = "SELECT id, client, contact, date, timein, timeout, job, (SELECT rate FROM clients WHERE company = client LIMIT 1) as rate FROM jobsheetrecord ";
				$query .= "WHERE id = '$id'";
				$result = GetRowData($query);
				$sw_data = array();
				if(count($result)){
					foreach($result as $res){
						array_push($sw_data,(object)array(
						$res['id'],
						$res['client'],
						DateFormat($res['date']),
						totalTime($res['timein'],$res['timeout']) . " hrs",
						"€" . $res['rate']*totalTime($res['timein'],$res['timeout'])));
					}
					
					$data = array("status" => "success",
							"data" => $sw_data);
					
				}else{
					$data = array("status" => "invalid",
									"desc" => "The ID you have entered do not exist.",
									"query" => "$query");
				}
				echo json_encode($data);
			}else if($_POST['type'] === 'date'){
				$dfrom = sanitize("string",$_POST['dfrom']);
				$dto = sanitize("string",$_POST['dto']);
				$query = "SELECT id, client, contact, date, timein, timeout, job, (SELECT rate FROM clients WHERE company = client LIMIT 1) as rate FROM jobsheetrecord ";
				$query .= "WHERE date BETWEEN '$dfrom' and '$dto'";
				$result = GetRowData($query);
				$sw_data = array();
				if(count($result)){
					foreach($result as $res){
						array_push($sw_data,(object)array(
						$res['id'],
						$res['client'],
						DateFormat($res['date']),
						totalTime($res['timein'],$res['timeout']) . " hrs",
						"€" . $res['rate']* totalTime($res['timein'],$res['timeout'])));
					}
					
					$data = array("status" => "success",
							"data" => $sw_data);
					
				}else{
					$data = array("status" => "invalid",
									"desc" => "Select date range is Invalid.",
									"query" => "$query");
				}
				echo json_encode($data);
			}
		}
	
	}
	
?>