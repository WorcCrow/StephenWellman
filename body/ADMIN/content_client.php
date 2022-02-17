<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">New Client</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="./">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="#">Client</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title"></h3>
						</div>
						<div class="card-body client-form">
						
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Client</label>
										<select class="form-control client">
											<option value="it">IT</option>
											<option value="drone">Drone</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Company</label>
										<input type="text" class="form-control company" maxlength="50">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Representative</label>
										<input type="text" class="form-control representative" maxlength="50">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control email" maxlength="50">
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label>Telephone</label>
										<input type="text" class="form-control telephone numberOnly" maxlength="15">
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label>Location</label>
										<input type="text" class="form-control location" maxlength="100">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Rate</label>
										<input type="text" class="form-control rate numberOnly" maxlength="8">
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-danger float-right ml-2 client-reset">Reset</button>
							<button type="submit" class="btn btn-success float-right client-submit">Submit</button>
						</div>
					</div>
				</div>
				<div class="col-12">
				   <div class="card">
					  <div class="card-header">
						 <h3 class="card-title">Client Lists</h3>
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
									 <th>ID</th>
									 <th>Type</th>
									 <th>Company</th>
									 <th>Representative</th>
									 <th>Email</th>
									 <th>Telephone</th>
									 <th>Rate</th>
									 <th>Action</th>
								  </tr>
							   </thead>
							   <tbody>
							   </tbody>
							   <tfoot>
								  <tr>
									 <th>ID</th>
									 <th>Type</th>
									 <th>Company</th>
									 <th>Representative</th>
									 <th>Email</th>
									 <th>Telephone</th>
									 <th>Rate</th>
									 <th>Action</th>
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
	
	$(document).ready(function(){
		$(".numberOnly").on("keypress",function(e){numericOnly(e)})
		$(".numberOnly").on("input",function(){
			if(isNaN($(this).val())){
				$(this).val(0)
			}
		})
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
					"class": "clientid"
				},
				{
					"targets": 2,
					"width": "50px",
					"class": "company"
				},
				{
					"className": "text-center",
					"targets": -1
				},
				{
					"data": null,
					"defaultContent": "<button class='btn  btn-sm btn-danger ml-2 remove-btn' title='Remove'><i class='fas fa-trash'></i></button>",
					"targets": -1
				}
			],
		});
		function loadAction(){
			$('#sw_table .remove-btn').click(function() {
				var clientid = $(this).parent().parent().find(".clientid").text()
				var company = $(this).parent().parent().find(".company").text()
				
				Swal.fire({
				  title: 'Are you sure?',
				  text: 'Remove ' + company,
				  icon: 'danger',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.value) {
					var data = "client"
					data += "&action=remove"
					data += "&clientid=" + clientid
					data += "&company=" + company
					SendPOST({
						url: webroot + 'client.php',
						data: data,
						callback: function(data) {
							receiveData = JSON.parse(data)
							switch (receiveData.status) {
								case 'success':
									Swal.fire(
									  'Deleted!',
									  '<b>' + company + '</b> has been removed.',
									  'success'
									)
									loadClient()
									break;
								case 'invalid':
									Toast.fire({
										type: 'warning',
										title: "&nbsp;" + receiveData.desc
									})
									break;
								case 'warning':
									Toast.fire({
										type: 'error',
										title: "&nbsp;" + receiveData.desc
									})
									break;
							}
						}
					})
				  }
				})
			})
		}
		function loadClient(){
			var data = "client"
			data += "&action=list"
			SendPOST({
				url: webroot + 'client.php',
				data: data,
				callback: function(data) {
					receiveData = JSON.parse(data)
					switch (receiveData.status) {
						case 'success':
							$("#sw_table").dataTable().fnClearTable();
							$('#sw_table').dataTable().fnAddData(receiveData.table);
							loadAction()
							break;
					}
				}
			})
		}
		loadClient()
		$('.client-form select.client').on("change",function(){
			switch($(this).val()){
				case 'it':
					$('.client-form input.rate').parent().removeClass("d-none")
				break;
				
				case 'drone':
					$('.client-form input.rate').parent().addClass("d-none")
				break;
			}
			
		})
		function reset(){
			$('.client-form input').each(function(){
				$(this).val("")
			})
		}
		$('.client-reset').on("click",function(){
			reset()
		})
		
		$('.client-submit').click(function(){
			event.preventDefault()
			var data = "client"
			data += "&action=create"
			data += "&type=" + $('.client-form select.client').val()
			data += "&company=" + $('.client-form input.company').val()
			data += "&representative=" + $('.client-form input.representative').val()
			data += "&email=" + $('.client-form input.email').val()
			data += "&telephone=" + $('.client-form input.telephone').val()
			data += "&location=" + $('.client-form input.location').val()
			data += "&rate=" + $('.client-form input.rate').val()
			
			SendPOST({
				url:webroot+'client.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					switch(receiveData.status){
						case 'success':
						reset()
						Toast.fire({
							type: 'success',
							title: "&nbsp;"+receiveData.desc
						})
						loadClient()
						break;
						case 'invalid':
						Toast.fire({
							type: 'error',
							title: "&nbsp;"+receiveData.desc
						})
						break;
					}
				}
			})
		})
	})
	
</script>