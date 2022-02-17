<?php
	if(!function_exists('ExecuteSQL')){
		function ExecuteSQL($query){
			//Execute SQL query without return value.
			//Commonly use on updating data.
			GLOBAL $conn;
			$result=$conn->prepare($query); 
			$result->execute();
		}
	}
	
	if(!function_exists('GetRowData')){
		function GetRowData($query){
			//Return an array of data receive from the database.
			GLOBAL $conn;
			
			$result = $conn->query($query);
			$result = $result->fetchAll();
			return $result;
		}
	}

	if(!function_exists('GetSession')){
		function GetSession($name){
			//Safely return session value without returning an error.
			if(isset($_SESSION[$name])){
				return $_SESSION[$name];
			}else{
				return "";
			}
		}
	}
	
	if(!function_exists('SetSession')){
		function SetSession($name,$value){
			$_SESSION[$name] = $value;
		}
	}
	
	if(!function_exists('IsJSON')){
		function IsJSON($string) {
			 json_decode($string);
			 return (json_last_error() == JSON_ERROR_NONE);
		}
	}
	
	if(!function_exists('GetUserIP')){
		function GetUserIP(){
			//Returning user/client IP in or out the proxy server.
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if(isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}
	}
	
	if(!function_exists('RandChar')){
		function RandChar(){
			//Return random 16 character from the list of character.
			$asciiChar = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$max = strlen($asciiChar)-1;
			$result = "";
			for($x=0;$x<16;$x++){
				$result .= $asciiChar[rand(0,$max)];
			}
			return $result;
		}
	}
	
	if(!function_exists('GetTimestamp')){
		function GetTimestamp(){
			$date = new DateTime();
			return $date->getTimestamp();
		}
	}
	
	if(!function_exists('DateTimeTS')){
		function DateTimeTS($timestamp){
			$return = (object)array('time' => date('h:i:s A', $timestamp),
									'date' => date('F jS Y', $timestamp),
									'datetime' => date('F jS Y - h:i:s A', $timestamp));
			return $return;
		}
	}
	
	if(!function_exists('TimeToday')){
		function TimeToday(){
			//Return today time in a format of hour:min:sec pm/am ex. 04:04:04 AM
			return date("h:i:s A");
		}
	}
	
	if(!function_exists('TimeToday')){
		function DateToday(){
			return date("F jS Y - l");
		}
	}
	
	function LoadTemplate($path){
		return addslashes(preg_replace( '/\r|\n|\t/', '',file_get_contents($path)));
	}
	
	function ValidateSign($signature){
		//var_dump(GetSession('user')['signature'] == $signature);
		if(GetSession('user')['signature'] == $signature){
			$_SESSION['user']['signature'] = RandChar();
			return true;
		}
		return false;
	}
	
	function TimeConvertion($timestamp){
		$sec = (int)$timestamp;
		if($sec < 0){
			return '00h:00m:00s';
		}
			
		$day = floor($sec / 86400);
		$day = $day!=0?$day . 'd ':'';
		$sec %= 86400;
		
		$hour = floor($sec / 3600);
		$hour = $hour!=0?$hour . 'h:':'0h:';
		$sec %= 3600;
		
		$min = floor($sec / 60);
		$min = $min!=0?$min . 'm:':'0m:';
		$sec %= 60;
		
		$sec = $sec!=0?$sec . 's':'0s';
		return $day.$hour.$min.$sec;
	}
	
	
	//AutoMailer
	
	if(!function_exists('SendMail')){
		function SendMail($data){
			/*
				$data = array(
					'from_email' => 'francismickobienes@gmail.com',
					'from_name' => 'SW Team',
					'to_email' => 'francismickobienes@gmail.com',
					'to_name' => $client,
					'email_subject' => 'SW - Job Completed [#'.$sw_data[0]->id.']',
					'email_body' => $body,
					'email_base64_attach' => $signatureAttach,
					'email_base64_cid' => 'signature'
				);
			*/
			GLOBAL $automail, $docroot;
			$automail->setFrom($data['from_email'], $data['from_name']);
			$automail->addReplyTo($data['from_email'], $data['from_name']);
			$automail->addAddress($data['to_email'], $data['to_name']);
			$automail->Subject = $data['email_subject'];
			
			if(isset($data['email_base64_attach'])){
				$automail->AddEmbeddedImage($docroot.'temp/'.$data['email_base64_attach'].'.png', $data['email_base64_cid']);
			}

			$automail->Body = $data['email_body'];

			if (!$automail->send()) {
				//return 'Mailer Error: ' . $automail->ErrorInfo;
				return false;
			} else {
				//return 'Message sent!';
				return true;
			}
		}
	}
	
	
?>