<?php
	require_once("./config.php");
	if(isset($_SESSION['user'])){
		header("Location: $webroot");
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Stephen Wellman | Portal</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script src="<?=$webroot?>js/jslib.js"></script>
		
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/fontawesome-free/css/all.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?=$webroot?>aextra/dist/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
		<script src="<?=$webroot?>aextra/plugins/sweetalert2/sweetalert2.min.js"></script>
		<style>
			body{
				font-family: "Helvetica Neue", "Open sans", sans-serif;
				background-color: gray;
				background-image: -webkit-linear-gradient(top left, #4caf50, #3f51b5)!important;
				color: white;
			}
		</style>
	</head>

	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="<?=$webroot?>"><img src="<?=$webroot?>swnew.png"></a>
			</div>
			<div class="card" style="background-color:transparent!important">
				<div class="card-body login-card-body" style="background-color:rgba(0,0,0,0.5)">
					<p class="login-box-msg text-gray">Sign in to access the portal</p>

					<form action="<?=$webroot?>index3.html" method="post">
						<div class="input-group-lg mb-3">
							<input type="email" id="username" class="form-control" placeholder="Email">
						</div>
						<div class="input-group-lg mb-3">
							<input type="password" id="password" class="form-control" placeholder="Password">
						</div>
						<div>
							<button type="submit" class="btn btn-primary btn-block mb-4" id="login-btn">Sign In</button>
						</div>
					</form>
					
					<h6 class="login-box-msg text-gray">Contact the Administrator to reset your account.</h6>
				</div>
			</div>
		</div>
		<script src="<?=$webroot?>aextra/plugins/jquery/jquery.min.js"></script>
		<script src="<?=$webroot?>aextra/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?=$webroot?>aextra/dist/js/adminlte.min.js"></script>
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
	</body>

</html>