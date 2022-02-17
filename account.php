<?php
	require("config.php");
	
	
	if(isset($_POST['login'])){
		$username = sanitize("string",$_POST['username']);
		$password = sanitize("string",$_POST['password']);
		
		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result = GetRowData($query);
		if(count($result)){
			$data = array("status" => "success");
			SetUserData($result[0]);
		}else{
			$data = array("status" => "invalid",
							"desc" => "username or password is invalid",
							"query" => "$query");
		}
		echo json_encode($data);
		
	}else if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		$data = array("status" => "success");
		echo json_encode($data);
		
	}else if(isset($_POST['personel'])){
		$action = sanitize("string",$_POST['action']);
		$data = array("status" => "invalid",
				"desc" => "System Abnormality Detected.");
		if($action === 'create'){
			$name = sanitize("string",$_POST['name']);
			$username = sanitize("string",$_POST['username']);
			$password = sanitize("string",$_POST['password']);
			$privilege = sanitize("string",$_POST['privilege']);
			if($name !== '' && $username !== '' && $password !== '' && $privilege !== ''){
				if(GetPosition($privilege)){
					$query = "INSERT INTO users(name, username, password, privilege, position) ";
					$query .= "VALUES ('$name','$username','$password','$privilege','".GetPosition($privilege)."')";
					ExecuteSQL($query);
					$data = array("status" => "success",
						"desc" => "Account &nbsp;<b>$name</b>&nbsp;created successfully .",);
				}else{
					$data = array("status" => "invalid",
						"desc" => "Please provide privilege.");
				}
			}else{
				$data = array("status" => "invalid",
						"desc" => "Please fill all fields.");
			}
		}else if($action === 'remove'){
			$userid = sanitize("string",$_POST['userid']);
			$name = sanitize("string",$_POST['name']);
			if($userid !== ''){
				if($userid !== GetSession('user')['id']){
					$query = "DELETE FROM users WHERE id = '$userid'";
					ExecuteSQL($query);
					$data = array("status" => "success",
						"desc" => "Removed &nbsp;$name&nbsp; Successfully.",);
				}else{
					$data = array("status" => "warning",
						"desc" => "You are not allowed to remove your account.");
				}
				
			
			}else{
				$data = array("status" => "invalid",
						"desc" => "User ID is Invalid");
			}
		}else if($action === 'list'){
			$query = "SELECT * FROM users";
			$result = GetRowData($query);
			$sw_data = array();
			$sw_table = array();
			if(count($result)){
				foreach($result as $res){
					array_push($sw_data,(object)array(
					"id" => $res['id'],
					"name" => $res['name'],
					"username" => $res['username'],
					"privilege" => $res['privilege'],
					"position" => $res['position']));
					
					array_push($sw_table,(object)array(
					$res['id'],
					$res['name'],
					$res['username'],
					$res['privilege']));
				}
				
				$data = array("status" => "success",
						"data" => $sw_data,
						"table" => $sw_table);
				
			}
		}
		echo json_encode($data);
	}
	
	function GetPosition($priv){
		switch($priv){
			case 'administrator':
				return "Administrator";
			break;
			case 'it':
				return "IT Specialist";
			break;
			case 'drone':
				return "Drone Specialist";
			break;
			
			default:
			return false;
		}
	}
	
	function SetUserData($data){
		GLOBAL $webroot;
		$value = array(
			"id" => $data["id"],
			"signature" => 	RandChar(),
			"info" => array(
				"name" => $data["name"],
				"username" => $data["username"],
				"privilege" => $data["privilege"],
				"position" => $data["position"]
			)
		);
		SetSession("user",$value);
	}
	
?>