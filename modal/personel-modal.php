<form id="editModal" method="GET" action="">
	<div class="modal fade" id="personel-modal" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Account Manager</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>ID</label>
						<input type="text" class="form-control" value="1" disabled>
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control">
					</div>
					<div class="form-group">
						<label>Privilege</label>
						<select class="form-control privilege">
							<option value="" hidden>Select Privilege</option>
							<option value="administrator">Admin</option>
							<option value="it">IT</option>
							<option value="drone">Drone</option>
						</select>
					</div>
					<div class="form-group">
						<label>Position</label>
						<input type="text" class="form-control position" disabled>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success float-right">Save</button>
					<button type="submit" class="btn btn-danger float-right ml-2" data-dismiss="modal" aria-label="Close">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$("#personel-modal .privilege").on("change",function(){
		switch($(this).val()){
			case 'administrator':
				$("#personel-modal .position").val("Administrator")
			break;
			case 'it':
				$("#personel-modal .position").val("IT Specialist")
			break;
			case 'drone':
				$("#personel-modal .position").val("Drone Specialist")
			break;
		}
	})
</script>