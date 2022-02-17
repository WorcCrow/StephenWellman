<div class="content-wrapper">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title"></h3>
						</div>
						<div class="card-body">
						
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Username</label>
										<input id="username" type="text" class="form-control" value="">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Password</label>
										<input id="password" type="password" class="form-control" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button id="login-btn" type="submit" class="btn btn-success float-right ml-2">Login</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		const Toast = Swal.mixin({
			toast: true,
			position: 'bottom-end',
			showConfirmButton: false,
			timer: 8000
		});
		var receiveData
		$("#login-btn").click(function(){
			event.preventDefault()
			var data = "login"
			data += "&username=" + username.value
			data += "&password=" + password.value
			
			SendPOST({
				url:webroot+'account.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					switch(receiveData.status){
						case 'success':
						window.location = webroot
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