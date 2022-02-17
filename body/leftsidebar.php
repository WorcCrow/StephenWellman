<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?=$webroot?>" class="brand-link elevation-4 d-none d-sm-block">
      <img src="<?=$webroot?>swnew.jpg" alt="Stephen Wellman Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Stephen Wellman</span>
    </a>

	<div class="sidebar">
		<div class="card-body profile_card elevation-2">
			<div class="text-center">
				<img class="profile-user-img img-fluid img-circle prof_pic" src="<?=$webroot?>aextra/dist/img/avatar.png" alt="User profile picture">
			</div>
			<h3 class="profile-username text-center text-white"><?=GetSession('user')['info']['name']?></h3>
			<p class="m-0 text-muted text-center"><?=GetSession('user')['info']['position']?></p>
		</div>
		<div class="user-panel mt-4 pb-3 mb-2 d-none profile_card_mini">
			<div class="image">
				<img src="<?=$webroot?>aextra/dist/img/avatar.png" class="img-circle elevation-2 prof_pic_mini" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?=GetSession('user')['info']['name']?></a>
			</div>
		</div>
		<nav class="mt-4 mb-5">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="./" class="nav-link">
						<i class="fas fa-tachometer-alt nav-icon"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<?php if(privilege() === 'administrator'):?>
					<li class="nav-item">
						<a href="?settings" class="nav-link">
							<i class="nav-icon fas fa-cogs"></i>
							<p>Settings</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?personel" class="nav-link">
							<i class="nav-icon fas fa-users"></i>
							<p>Manage Account</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="?client" class="nav-link">
							<i class="fas fa-address-card nav-icon"></i>
							<p>Manage Client</p>
						</a>
					</li>
				<?php endif?>
				
				<?php if(privilege() === 'administrator' || privilege() === 'it'):?>
				<li class="nav-header">SW IT</li>
				<?php endif?>
				
				<?php if(privilege() === 'administrator'):?>
					<li class="nav-item">
						<a href="?record&it" class="nav-link">
							<i class="nav-icon fas fa-database"></i>
							<p>Records</p>
						</a>
					</li>
				<?php endif?>
				
				<?php if(privilege() === 'administrator' || privilege() === 'it'):?>
				<li class="nav-item">
					<a href="?job&it" class="nav-link">
						<i class="fas fa-tasks nav-icon"></i>
						<p>Jobsheet</p>
					</a>
				</li>
				<?php endif?>
				
				<?php if(privilege() === 'administrator' || privilege() === 'drone'):?>
				<li class="nav-header">SW DroneMan</li>
				<?php endif?>
				
				<?php if(privilege() === 'administrator'):?>
					<li class="nav-item">
						<a href="?record&drone" class="nav-link">
							<i class="nav-icon fas fa-database"></i>
							<p>Records</p>
						</a>
					</li>
				<?php endif?>
				
				<?php if(privilege() === 'administrator' || privilege() === 'drone'):?>
				<li class="nav-item">
					<a href="?job&drone" class="nav-link">
						<i class="fas fa-tasks nav-icon"></i>
						<p>Drone Works</p>
					</a>
				</li>
				<?php endif?>
				
				<?php if(isLogin()):?>
					<li class="nav-item mt-2">
						<a href="#" class="nav-link logout">
							<i class="nav-icon fas fa-sign-out-alt"></i>
							<p>Logout</p>
						</a>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a href="?login" class="nav-link mt-4">
							<i class="nav-icon fas fa-sign-in-alt"></i>
							<p>Login</p>
						</a>
					</li>
				<?php endif?>
			</ul>
		</nav>
	</div>
</aside>

<script>

	$(document).ready(function(){
		$(".logout").click(function(){
			event.preventDefault()
			var data = "logout"
			
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

