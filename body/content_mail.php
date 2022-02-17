<style>
	@media print{    
		.no-print, .no-print *
		{
			display: none !important;
		}
	}
</style>
<button class="no-print" style="margin:5px;padding:0px 30px" onclick="window.print()"><h3>Print</h3></button>
<button class="no-print" style="margin:5px;padding:0px 30px;float:right" onclick="window.close()"><h3>Close</h3></button>

<?php
	$id = sanitize("string",$_GET['id']);
	$query = "SELECT * FROM jobsheetrecord ";
	$query .= "WHERE id = '$id'";
	$result = GetRowData($query);
	$sw_data = array();
	if(count($result)){
		foreach($result as $res){
			array_push($sw_data,(object)array(
				'id' => $res['id'],
				'client' => $res['client'],
				'contact' => $res['contact'],
				'date' => $res['date'],
				'timein' => $res['timein'],
				'timeout' => $res['timeout'],
				'job' => $res['job'],
				'signature' => $res['signature']));
		}
	}else{
		echo "The ID you have entered do not exist.<br>";
		echo $query;
		return;
	}
	$receiver = "stephen.wellman@uniplast.com.mt";
		
	$jobid = $sw_data[0]->id;
	$client = $sw_data[0]->client;
	$date = $sw_data[0]->date;
	$timein = $sw_data[0]->timein;
	$timeout = $sw_data[0]->timeout;
	$totaltime = totalTime($sw_data[0]->timein,$sw_data[0]->timeout);
	$jobdesc = $sw_data[0]->job;
	$signature = "data:image/png;base64,".base64_encode($sw_data[0]->signature);
	$contact = $sw_data[0]->contact;
	
	$sendmail = true;
	include($docroot . "template/jobsheet-template.php");
	
?>

