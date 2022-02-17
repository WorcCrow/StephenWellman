<?php
	$query = "SELECT * FROM settings";
	$result = GetRowData($query);
	if(count($result)){
		foreach($result as $res){
			if($res['config'] === 'email_default_sender' ){
				$email_default_sender = $res['value'];
				
			}else if($res['config'] === 'email_automail_it' ){
				$email_automail_it = $res['value'];
				
			}else if($res['config'] === 'email_automail_drone' ){
				$email_automail_drone = $res['value'];
				
			}
		}
		
	}
?>
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Settings</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="#">Settings</a></li>
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
							<h3 class="card-title">Email</h3>
						</div>
						<div class="card-body email-form">
						
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Default Sender</label>
										<input type="email" class="form-control sender" maxlength="50" value="<?=$email_default_sender?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-12">
										<div class="form-group">
											<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
												<input type="checkbox" class="custom-control-input" id="itmail" <?=($email_automail_it==='true')?'checked':''?>>
												<label class="custom-control-label" for="itmail">IT Auto Mail</label>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
												<input type="checkbox" class="custom-control-input" id="dronemail" <?=($email_automail_drone==='true')?'checked':''?>>
												<label class="custom-control-label" for="dronemail">Drone Auto Mail</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success float-right email-save">Save</button>
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
		$('button.email-save').click(function() {
			event.preventDefault()
			var data = "settings"
			data += "&group=email"
			data += "&sender=" + $('.email-form input.sender').val()
			data += "&automail_it=" + $('.email-form input#itmail').prop('checked')
			data += "&automail_drone=" + $('.email-form input#dronemail').prop('checked')

			SendPOST({
				url: webroot + 'settings.php',
				data: data,
				callback: function(data) {
					receiveData = JSON.parse(data)
					switch (receiveData.status) {
						case 'success':
							Toast.fire({
								type: 'success',
								title: "&nbsp;" + receiveData.desc
							})
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
	});
</script>