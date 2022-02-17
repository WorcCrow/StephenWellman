<?php
	$query = "SELECT COUNT(id) AS total_job FROM dronerecord WHERE personel_id = '".GetSession('user')['id']."'";
	$result = GetRowData($query);
	if(count($result)){
		$total_job = $result[0]['total_job'];
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
					<!-- small card -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?=$total_job;?></h3>

							<p>Signed Sheet</p>
						</div>
						<div class="icon">
							<i class="fas fa-signature"></i>
						</div>
						<a href="?job&drone" class="small-box-footer">
							Sign More <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>