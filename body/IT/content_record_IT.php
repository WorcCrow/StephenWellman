<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">IT Record</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="./">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="#">Report</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
				   <div class="card card-dark collapse-card">
					  <div class="card-header">
						 <h3 class="card-title">Filter</h3>
						 <div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-plus"></i>
							</button>
						 </div>
					  </div>
					  <div class="row">
						 <div class="col-sm-6">
							<div class="card-body">
							   <div class="form-group">
								  <label>Date Range:</label>
								  <div class="input-group">
									 <input type="text" class="form-control float-right" id="daterange">
									 <div class="input-group-append">
										<button class="btn btn-info btn-flat daterange-btn" id="">Search</button>
									 </div>
								  </div>
							   </div>
							</div>
						 </div>
						 <div class="col-sm-6">
							<div class="card-body">
							   <div class="form-group">
								  <label>Jobsheet #:</label>
								  <div class="input-group">
									 <input id="idfilter" type="text" class="form-control float-right" placeholder="Enter Jobsheet ID">
									 <div class="input-group-append">
										<button class="btn btn-info btn-flat idfilter-btn">Search</button>
									 </div>
								  </div>
							   </div>
							</div>
						 </div>
					  </div>
				   </div>
				</div>
				<div class="col-12">
				   <div class="card">
					  <div class="card-header">
						 <h3 class="card-title datequery"></h3>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body">
						<div class="table-responsive">
							<form id="detailForm" target="_NEW" action="?details" method="POST">
								<input type="hidden" name="details">
								<input type="hidden" name="id">
							</form>
							 <table id="sw_table" class="table table-bordered table-hover nowrap" width="100%">
								<thead>
								   <tr>
									  <th>Job#</th>
									  <th>Client</th>
									  <th>Date</th>
									  <th>Time</th>
									  <th>Cost</th>
									  <th></th>
								   </tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
								   <tr>
									  <th>Job#</th>
									  <th>Client</th>
									  <th>Date</th>
									  <th>Time</th>
									  <th>Cost</th>
									  <th></th>
								   </tr>
								</tfoot>
							 </table>
						</div>
					  </div>
				   </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function GetFormattedDate(d) {
		const monthN = ["January", "February", "March", "April", "May", "June",
					  "July", "August", "September", "October", "November", "December"
					];
		var todayTime = new Date(d);
		var month = todayTime.getMonth()
		var day = todayTime.getDate()
		var year = todayTime.getFullYear()
		return monthN[month] + " " + day + ", " + year;
	}
	
	$(function () {
		const Toast = Swal.mixin({
			toast: true,
			position: 'bottom-end',
			showConfirmButton: false,
			timer: 8000
		});
		$("#sw_table").DataTable({
			"drawCallback": function( settings ) {
				loadAction()
			},
			'columnDefs': [
				{
					"targets": 0,
					"width": "50px",
					"class": "jobid"
				},
				{
					"targets": 5,
					"className": "text-center",
					"width": "50px"
				},
				{
					"data": null,
					"defaultContent": "<button type='button' class='btn btn-block btn-primary report-view'>View</button>",
					"targets": -1
				}
			],
		});
		function loadAction(){
			$('.report-view').click(function(){
				var id = $(this).parent().parent().find(".jobid").text()
				$('#detailForm').find("[name='id']").val(id)
				$('#detailForm').submit()
			})
		}
		
		
		$('#daterange').daterangepicker({
			locale: {
				format: 'YYYY-MM-DD'
			}
		})
		
		
		$(".daterange-btn").click(function(){
			event.preventDefault()
			
			var dfrom = $('#daterange').val().split(" - ")[0]
			var dto = $('#daterange').val().split(" - ")[1]
			var data = "record=it"
			data += "&type=date"
			data += "&dfrom=" + dfrom
			data += "&dto=" + dto
			SendPOST({
				url:webroot+'record.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					switch(receiveData.status){
						case 'success':
						$("#sw_table").dataTable().fnClearTable();
						$('#sw_table').dataTable().fnAddData(receiveData.data);
						$(".datequery").text("You have selected from: " + GetFormattedDate(dfrom) + " to " + GetFormattedDate(dto) + ".")
						loadAction()
						break;
						case 'invalid':
						Toast.fire({
							type: 'warning',
							title: "&nbsp;"+receiveData.desc
						})
						break;
					}
				}
			})
		})
		$(".idfilter-btn").click(function(){
			event.preventDefault()
			
			var id = parseInt($('#idfilter').val())
			var data = "record=it"
			data += "&type=id"
			data += "&id=" + id
			SendPOST({
				url:webroot+'record.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					switch(receiveData.status){
						case 'success':
						$("#sw_table").dataTable().fnClearTable();
						$('#sw_table').dataTable().fnAddData(receiveData.data);
						$(".datequery").text("Searched Result for ID: " + id)
						
						$('.report-view').click(function(){
							var id = $(this).parent().parent().find(".jobid").text()
							$('#detailForm').find("[name='id']").val(id)
							$('#detailForm').submit()
						})
						break;
						case 'invalid':
						Toast.fire({
							type: 'warning',
							title: "&nbsp;"+receiveData.desc
						})
						break;
					}
				}
			})
		})
	});
</script>