<style>
   th.dt-center, td.dt-center { text-align: center; }
</style>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Manage Account</h1>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card card-dark new-personel">
                  <div class="card-header">
                     <h3 class="card-title">New Personel</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control name">
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control username">
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control password">
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label>Privilege</label>
                              <select class="form-control privilege">
                                 <option value="0" hidden>Select Privilege</option>
                                 <option value="administrator">Admin</option>
                                 <option value="it">IT</option>
                                 <option value="drone">Drone</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group">
                              <label>Position</label>
                              <input type="text" class="form-control position" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
					<div class="card-footer">
						<button type="submit" class="btn btn-danger float-right ml-2 reset" data-dismiss="modal" aria-label="Close">Reset</button>
						<button type="submit" class="btn btn-success float-right create">Create</button>
					</div>
               </div>
            </div>
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Personel Lists</h3>
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
                                 <th>Name</th>
                                 <th>Username</th>
                                 <th>Privilege</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Username</th>
                                 <th>Privilege</th>
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
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'bottom-end',
			showConfirmButton: false,
			timer: 8000
		});
		
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})
		$(".new-personel .privilege").on("change", function() {
			switch ($(this).val()) {
				case 'administrator':
					$(".new-personel .position").val("Administrator")
					break;
				case 'it':
					$(".new-personel .position").val("IT Specialist")
					break;
				case 'drone':
					$(".new-personel .position").val("Drone Specialist")
					break;
			}
		})
		$("#sw_table").DataTable({
			"drawCallback": function( settings ) {
				loadAction()
			},
			'columnDefs': [
				{
					"targets": 0,
					"width": "50px",
					"class": "userid"
				},
				{
					"targets": 1,
					"width": "50px",
					"class": "name"
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
		//"<button class='btn btn-sm btn-success ml-2 edit-btn' title='Edit'><i class='fas fa-edit'></i></button><button class='btn btn-sm btn-warning ml-2 password-btn' title='Password'><i class='fas fa-lock'></i></button><button class='btn  btn-sm btn-danger ml-2 remove-btn' title='Remove'><i class='fas fa-trash'></i></button>"
		function reset(){
			$('.new-personel input').each(function() {
				$(this).val("")
			})
			$('.new-personel select').each(function() {
				$(this).val(0)
			})
		}
		$(".new-personel .reset").on("click", function() {
			reset()
		})

		$('.new-personel .create').click(function() {
			event.preventDefault()
			var data = "personel"
			data += "&action=create"
			data += "&name=" + $('.new-personel input.name').val()
			data += "&username=" + $('.new-personel input.username').val()
			data += "&password=" + $('.new-personel input.password').val()
			data += "&privilege=" + $('.new-personel select.privilege').val()

			SendPOST({
				url: webroot + 'account.php',
				data: data,
				callback: function(data) {
					receiveData = JSON.parse(data)
					switch (receiveData.status) {
						case 'success':
							reset()
							Toast.fire({
								type: 'success',
								title: "&nbsp;" + receiveData.desc
							})
							loadPersonel()
							break;
						case 'invalid':
							Toast.fire({
								type: 'error',
								title: "&nbsp;" + receiveData.desc
							})
							break;
					}
				}
			})
		})
		function loadAction(){
			$('#sw_table .edit-btn').click(function() {
				var id = $(this).parent().parent().find(".userid").text()
				alert("Edi User: " + id)
			})
			$('#sw_table .password-btn').click(function() {
				var id = $(this).parent().parent().find(".userid").text()
				alert("Password User: " + id)
			})
			$('#sw_table .remove-btn').click(function() {
				var userid = $(this).parent().parent().find(".userid").text()
				var name = $(this).parent().parent().find(".name").text()
				
				Swal.fire({
				  title: 'Are you sure?',
				  text: 'Remove ' + name,
				  icon: 'danger',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.value) {
					var data = "personel"
					data += "&action=remove"
					data += "&userid=" + userid
					data += "&name=" + name
					SendPOST({
						url: webroot + 'account.php',
						data: data,
						callback: function(data) {
							receiveData = JSON.parse(data)
							switch (receiveData.status) {
								case 'success':
									Swal.fire(
									  'Deleted!',
									  '<b>' + name + '</b> account has been removed.',
									  'success'
									)
									loadPersonel()
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

		function loadPersonel(){
			var data = "personel"
			data += "&action=list"
			SendPOST({
				url: webroot + 'account.php',
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
		loadPersonel()
	});
</script>