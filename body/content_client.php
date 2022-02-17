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
		$('.client-reset').on("click",function(){
			$('.client-form input').each(function(){
				$(this).val("")
			})
		})
		
		$('.client-submit').click(function(){
			event.preventDefault()
			var data = "newclient"
			data += "&company=" + $('.client-form input.company').val()
			data += "&representative=" + $('.client-form input.representative').val()
			data += "&email=" + $('.client-form input.email').val()
			data += "&telephone=" + $('.client-form input.telephone').val()
			data += "&location=" + $('.client-form input.location').val()
			data += "&rate=" + $('.client-form input.rate').val()
			
			SendPOST({
				url:webroot+'update.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					switch(receiveData.status){
						case 'success':
						Toast.fire({
							type: 'success',
							title: "&nbsp;"+receiveData.desc
						})
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