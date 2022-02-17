<?php
	$query = "SELECT (SELECT COUNT(id) FROM users) AS 'total_users', ";
	$query .= "(SELECT COUNT(id) FROM dronerecord) AS 'total_drone_record', ";
	$query .= "(SELECT COUNT(id) FROM jobsheetrecord) AS 'total_it_record'";
	$result = GetRowData($query);
	if(count($result)){
		$total_users = $result[0]['total_users'];
		$total_it_record = $result[0]['total_it_record'];
		$total_drone_record = $result[0]['total_drone_record'];
	}
?>
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-4">
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?=$total_it_record;?></h3>

							<p>IT Record</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="?record&it" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?=$total_drone_record;?></h3>

							<p>Drone Record</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="?record&drone" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?=$total_users;?></h3>

							<p>Personel</p>
						</div>
						<div class="icon">
							<i class="ion ion-person"></i>
						</div>
						<a href="?personel" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>