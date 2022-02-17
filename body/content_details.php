<?php
	$id = sanitize("string",$_POST['id']);
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
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="p-3 mb-3">
                    <div class="row">
                        <div class="col-12" align="center">
                            <img width="200px" class="img-fluid" src="<?=$webroot?>swnew.jpg" alt="Photo">
                        </div>
                    </div>
					<div class="row">
						<h3>Jobsheet #<?=$sw_data[0]->id?></h3>
					</div>
                    <div class="row">
                        <div class="col-sm-6 callout callout-success">
                            <i class="text-secondary">Client</i>
                            <div class="info"><?=$sw_data[0]->client?></div>
                        </div>
                        <div class="col-sm-6 callout callout-success">
                            <i class="text-secondary">Date</i>
                            <div class="info"><?=DateFormat($sw_data[0]->date)?></div>
                        </div>
                        <div class="col-sm-6 callout callout-success">
                            <i class="text-secondary">Time</i>
                            <div class="info"><?=$sw_data[0]->timein?> - <?=$sw_data[0]->timeout?></div>
                        </div>
                        <div class="col-sm-6 callout callout-success">
                            <i class="text-secondary">Total Hours</i>
                            <div class="info"><?=totalTime($sw_data[0]->timein,$sw_data[0]->timeout) . " hrs"?></div>
                        </div>
                        <div class="col-sm-12 card card-outline card-success">
                            <div class="card-body">
                                <i class="text-secondary">Description</i>
                                <div class="info"><?=$sw_data[0]->job?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" align="center">
                            <i>Authorized By</i>
                            <h6 class="info"><?=$sw_data[0]->contact?></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" align="center">
                            <img width="250px" src="data:image/png;base64,<?=base64_encode($sw_data[0]->signature)?>">
                        </div>
                    </div>
                    <div class="row no-print mt-5">
                        <div class="col-12">
                            <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
							<button class="btn btn-danger float-right" onclick="window.close()">Close</button>
							<button class="btn btn-warning float-right mr-2" onclick="window.open('<?=$webroot . "?mail&type=it&id=" . $sw_data[0]->id?>')"><i class="fas fa-envelope"></i> Preview</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>