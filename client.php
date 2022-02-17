<?php
	require("config.php");
	
	if(isset($_POST['client'])){
		$action = sanitize("string",$_POST['action']);
		$data = array("status" => "invalid",
				"desc" => "System Abnormality Detected.");
		if($action === 'create'){
			$type = sanitize("string",$_POST['type']);
			$company = sanitize("string",$_POST['company']);
			$representative = sanitize("string",$_POST['representative']);
			$email = sanitize("string",$_POST['email']);
			$telephone = sanitize("int",$_POST['telephone']);
			$location = sanitize("string",$_POST['location']);
			$rate = sanitize("int",$_POST['rate']);
			
			if($company !== ''){
				$query = "INSERT INTO clients(type, company, representative, email, telephone, location, rate) ";
				$query .= "VALUES ('$type','$company','$representative','$email','$telephone','$location','$rate')";
				ExecuteSQL($query);
				
				$data = array("status" => "success",
							"desc" => "Successfully Added $company");
			}else{
				$data = array("status" => "invalid",
							"desc" => "Company cannot be empty.");
			}
		}else if($action === 'remove'){
			$clientid = sanitize("string",$_POST['clientid']);
			$company = sanitize("string",$_POST['company']);
			if($clientid !== ''){
				$query = "DELETE FROM clients WHERE id = '$clientid'";
				ExecuteSQL($query);
				$data = array("status" => "success",
					"desc" => "Removed &nbsp;$company&nbsp; Successfully.",);
			}else{
				$data = array("status" => "invalid",
						"desc" => "User ID is Invalid");
			}
		}else if($action === 'list'){
			$query = "SELECT * FROM clients";
			$result = GetRowData($query);
			$sw_data = array();
			$sw_table = array();
			if(count($result)){
				foreach($result as $res){
					array_push($sw_data,(object)array(
					"id" => $res['id'],
					"type" => $res['type'],
					"company" => $res['company'],
					"representative" => $res['representative'],
					"email" => $res['email'],
					"telephone" => $res['telephone'],
					"location" => $res['location'],
					"rate" => $res['rate']));
					
					array_push($sw_table,(object)array(
					$res['id'],
					$res['type'],
					$res['company'],
					$res['representative'],
					$res['email'],
					$res['telephone'],
					$res['rate']));
				}
				
				$data = array("status" => "success",
						"data" => $sw_data,
						"table" => $sw_table);
				
			}
		}
		echo json_encode($data);
	}
?>