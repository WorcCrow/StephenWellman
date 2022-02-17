<?php
	require("config.php");
	
	
	if(isset($_POST['settings'])){
		$group = sanitize("string",$_POST['group']);
		if($group === 'email'){
			$default_sender = sanitize("string",$_POST['sender']);
			$automail_it = sanitize("string",$_POST['automail_it']);
			$automail_drone = sanitize("string",$_POST['automail_drone']);
			
			$query = "UPDATE settings SET value='$default_sender' WHERE config='email_default_sender';";
			$query .= "UPDATE settings SET value='$automail_it' WHERE config='email_automail_it';";
			$query .= "UPDATE settings SET value='$automail_drone' WHERE config='email_automail_drone';";
			ExecuteSQL($query);	
			$data = array("status" => "success",
				"desc" => "Saved Successfully!");
				
			echo json_encode($data);
		}
	}
?>