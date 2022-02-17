<?php
	function sanitize($type,$value){
		$type = strtolower($type);
		switch($type){
			case "int":
				$value = (int)$value;
			break;
			
			case "float":
				$value = (float)$value;
			break;
			
			case "string":
			$value = (string)preg_replace('/[^a-zA-Z0-9@\._ -\:]/', '', $value);
			break;
		}
		return $value;
	}
	
?>