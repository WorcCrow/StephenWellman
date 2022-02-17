<?php
	require_once("./config.php");
	
	if(isset($_GET['mail']) && privilege() === 'administrator'){
		if(isset($_GET['type'])){
			if($_GET['type'] === 'it'){
				if(isset($_GET['id'])){
					include($docroot."body/content_mail.php");
					return;
				}
			}
		}
	}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Stephen Wellman</title>

	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=$webroot?>aextra/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$webroot?>aextra/dist/css/adminlte.min.css">
    
	<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	
	<script src="<?=$webroot?>js/jslib.js"></script>
	<!-- jQuery -->
	
    <script src="<?=$webroot?>aextra/plugins/jquery/jquery.min.js"></script>
	<script src="<?=$webroot?>aextra/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=$webroot?>aextra/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=$webroot?>aextra/dist/js/adminlte.min.js"></script>
	
	<script src="<?=$webroot?>aextra/plugins/sweetalert2/sweetalert2.min.js"></script>
	<style>
		.prof_pic{
			width:150px!important;
			height:150px!important;
			border-radius:150px;
		}
		
		.prof_pic_mini{
			width:2.1rem!important;
			height:2.1rem!important;
			border-radius:50px;
		}
		
		.profile_card{
			transition:.9s;
			overflow:hidden;
			width:234px;
		}
		.sidebar-mini.sidebar-collapse div.profile_card{
			display:none;
		}
		
		.sidebar-mini.sidebar-collapse div.profile_card_mini{
			display:flex!important;
		}
		
		
		/**/
		
		.cgellipsis{
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			max-width: 100px;
		}
	</style>
	
	<?php if(isset($_GET['job']) || isset($_GET['client'])): ?>
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		<!--
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/jquery-signaturepad/assets/jquery.signaturepad.css">
		-->
		<script src="<?=$webroot?>aextra/plugins/signature/signature_pad.min.js"></script>
		<style>
			.signature-pad {
			  position: relative;
			  display: -webkit-box;
			  display: -ms-flexbox;
			  display: flex;
			  -webkit-box-orient: vertical;
			  -webkit-box-direction: normal;
				  -ms-flex-direction: column;
					  flex-direction: column;
			  font-size: 10px;
			  width: 100%;
			  height: 100%;
			  max-width: 700px;
			  max-height: 460px;
			  border: 1px solid #e8e8e8;
			  background-color: #fff;
			  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
			  border-radius: 4px;
			  padding: 16px;
			}

			.signature-pad::before,
			.signature-pad::after {
			  position: absolute;
			  z-index: -1;
			  content: "";
			  width: 40%;
			  height: 10px;
			  bottom: 10px;
			  background: transparent;
			  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
			}

			.signature-pad::before {
			  left: 20px;
			  -webkit-transform: skew(-3deg) rotate(-3deg);
					  transform: skew(-3deg) rotate(-3deg);
			}

			.signature-pad::after {
			  right: 20px;
			  -webkit-transform: skew(3deg) rotate(3deg);
					  transform: skew(3deg) rotate(3deg);
			}

			.signature-pad--body {
			  position: relative;
			  -webkit-box-flex: 1;
				  -ms-flex: 1;
					  flex: 1;
			  border: 1px solid #f4f4f4;
			}

			.signature-pad--body
			canvas {
			  position: absolute;
			  left: 0;
			  top: 0;
			  width: 100%;
			  height: 100%;
			  border-radius: 4px;
			  box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
			}

			.signature-pad--footer {
			  color: #C3C3C3;
			  text-align: center;
			  font-size: 1.2em;
			  margin-top: 8px;
			}

			.signature-pad--actions {
			  display: -webkit-box;
			  display: -ms-flexbox;
			  display: flex;
			  -webkit-box-pack: justify;
				  -ms-flex-pack: justify;
					  justify-content: space-between;
			  margin-top: 8px;
			}
		</style>
	<?php endif ?>
	
	<?php if(privilege() === 'administrator'): ?>
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="<?=$webroot?>aextra/plugins/daterangepicker/daterangepicker.css">
	<?php endif ?>
	
</head>

<body class="sidebar-mini layout-navbar-fixed">
    <div class="wrapper">
	<?php
		
		if(isLogin()){
			if(isset($_GET['details']) && privilege() === 'administrator'){
				if(isset($_POST['id'])){
					include($docroot."body/content_details.php");
					return;
				}
			}
				
			
			include($docroot."body/navbar.php");
			include($docroot."body/leftsidebar.php");
				$default = false;
				if(isset($_GET['it']) && (privilege() === 'it' || privilege() === 'administrator')){
					if(isset($_GET['job'])){
						include($docroot."body/IT/content_job_IT.php");
						
					}else if(isset($_GET['record'])){
						if(privilege() === 'administrator'){
							include($docroot."body/IT/content_record_IT.php");
							
						}else{
							include($docroot."body/content_login.php");
							
						}
				
					}else{
						$default = true;
					}
				}else if(isset($_GET['drone']) && (privilege() === 'drone' || privilege() === 'administrator')){
					if(isset($_GET['job'])){
						include($docroot."body/DRONE/content_job_DRONE.php");
						
					}else if(isset($_GET['record'])){
						if(privilege() === 'administrator'){
							include($docroot."body/DRONE/content_record_DRONE.php");
							
						}else{
							include($docroot."body/content_login.php");
							
						}
				
					}else{
						$default = true;
					}
					
				}else if(isset($_GET['personel']) && privilege() === 'administrator'){
					include($docroot."body/ADMIN/content_personel.php");
					
				}else if(isset($_GET['client']) && privilege() === 'administrator'){
					include($docroot."body/ADMIN/content_client.php");
				
				}else if(isset($_GET['settings']) && privilege() === 'administrator'){
					include($docroot."body/ADMIN/content_settings.php");
				
				}else{
					$default = true;
					
				}
				
				if($default){
					switch(privilege()){
						case 'administrator':
							include($docroot."body/ADMIN/content_default_ADMIN.php");
						break;
						
						case 'it':
							include($docroot."body/IT/content_default_IT.php");
						break;
						
						case 'drone':
							include($docroot."body/DRONE/content_default_DRONE.php");
						break;
					}
					
				}
				
			include($docroot."body/footer.php");
			
			include($docroot."modal/modal.php");
		}else{
			//header("Location: " . $webroot . "login.php");
			echo "<script>window.location = '" . $webroot . 'login.php' . "'</script>";
		}
		
		?>
    </div>
	
	<?php if(isset($_GET['job']) || isset($_GET['client'])): ?>
		<script src="<?=$webroot?>aextra/plugins/moment/moment.min.js"></script>
		<script src="<?=$webroot?>aextra/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
		
	<?php endif ?>
	
	<?php if(privilege() === 'administrator'): ?>
		<script src="<?=$webroot?>aextra/plugins/moment/moment.min.js"></script>
		<script src="<?=$webroot?>aextra/plugins/datatables/jquery.dataTables.js"></script>
		<script src="<?=$webroot?>aextra/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>	

		<script src="<?=$webroot?>aextra/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?=$webroot?>aextra/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="<?=$webroot?>aextra/plugins/daterangepicker/daterangepicker.js"></script>		
	<?php endif ?>
</body>

</html>