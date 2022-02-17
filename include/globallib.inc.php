<?php
	function privilege(){
		if(isset($_SESSION['user'])){
			return $_SESSION['user']['info']['privilege'];
		}
		return false;
	}
	
	function isLogin(){
		if(isset($_SESSION['user'])){
			return true;
		}
		return false;
	}
	
	function totalTime($timein,$timeout){
		$to_time = strtotime($timein);
		$from_time = strtotime($timeout);
		if($to_time < $from_time){
			$to_time = strtotime($timein);
			$from_time = strtotime($timeout);
			$time = round(abs(round(abs($to_time  - $from_time) /60,2)) / 60 , 2);
			return $time;
		}else{
			$ceiling = strtotime("12:00 AM");
			$to_time = strtotime($timein);
			$from_time = strtotime($timeout);
			$time1 = 24 - round(abs(round(abs($ceiling - $to_time) /60,2)) / 60 , 2);
			$time2 = round(abs(round(abs($ceiling - $from_time) /60,2)) / 60 , 2);
			return $time1 + $time2;
		}
	}
	
	function DateFormat($date){
		//2020-02-26
		list($year,$month,$day) = explode("-",$date);
		return $day . '-' . $month . '-' . $year;
	}
	
	function SaveImg($data){
		GLOBAL $docroot;
		$name = uniqid();
		file_put_contents($docroot.'temp/'.$name.'.png', $data);
		return $name;
	}
?>