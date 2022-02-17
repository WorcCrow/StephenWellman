<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">New Jobsheet</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="./">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="#">Jobsheet</a></li>
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
						<div class="card-body job-form">
						
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									  <label>Client</label>
									  <select class="form-control select2 client" style="width: 100%;" placeholder="Select Company">
										<option value="" selected hidden>Select Company</option>
										<?php
											$data = GetRowData("SELECT company FROM clients");
											forEach($data as $d):
										?>
										<option><?=$d[0]?></option>
										<?php endforeach?>
									  </select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Contact</label>
										<input type="text" class="form-control contact" value="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Date</label>
										<input id="date" type="date" class="form-control date" value="<?=Date("Y-m-d")?>">
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label>Time In</label>
										<div class="input-group date" id="timein" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input timein" data-target="#timein">
											<div class="input-group-append" data-target="#timein" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label>Time Out</label>
										<div class="input-group date" id="timeout" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input timeout" data-target="#timeout">
											<div class="input-group-append" data-target="#timeout" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Job</label>
										<textarea class="form-control job" value=""></textarea>
									</div>
								</div>
								<div class="col-sm-12 d-flex justify-content-center">
									<div class="form-group sigPad">
										<label>Signature</label>
										<div class="sig sigWrapper">
										  <div class="typed"></div>
										  <canvas class="pad" width="298" height="100"></canvas>
										  <input type="hidden" name="output" class="output signature">
										</div>
										
										<button type="submit" class="btn btn-danger float-right ml-2 clearButton">Clear</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-danger float-right ml-2 job-reset">Reset</button>
							<button type="submit" class="btn btn-success float-right job-submit">Submit</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>



<script>
	function previewJobsheet(data){
		$("#preview-modal span.jobid").text(data[0]['id'])
		$("#preview-modal span.client").text(data[0]['client'])
		$("#preview-modal span.date").text(data[0]['date'])
		$("#preview-modal span.timein").text(data[0]['timein'])
		$("#preview-modal span.timeout").text(data[0]['timeout'])
		$("#preview-modal span.totaltime").text(data[0]['totaltime'])
		$("#preview-modal span.jobdesc").text(data[0]['job'])
		$("#preview-modal span.contact").text(data[0]['contact'])
		$("#preview-modal img.signature").attr("src",data[0]['signature'])
		
		$("#preview-modal").modal()
	}
	
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
		$('#timein').datetimepicker({
		  format: 'LT'
		})
		$('#timeout').datetimepicker({
		  format: 'LT'
		})
		
		$('.job-reset').on("click",function(){
			$('.job-form input').each(function(){
				$(this).val("")
			})
			$('.job-form textarea').each(function(){
				$(this).val("")
			})
			$('.job-form select').each(function(){
				$(this).val("Select Company")
			})
		})
		
		$('.job-submit').click(function(){
			event.preventDefault()
			var data = "newjobsheet"
			data += "&client=" + $('.job-form select.client').val()
			data += "&contact=" + $('.job-form input.contact').val()
			data += "&date=" + $('.job-form input.date').val()
			data += "&timein=" + $('.job-form input.timein').val()
			data += "&timeout=" + $('.job-form input.timeout').val()
			data += "&job=" + $('.job-form textarea.job').val()
			data += "&signature=" + $('.job-form input.signature').val()
			
			
			SendPOST({
				url:webroot+'update.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					switch(receiveData.status){
						case 'success':
						var newdata = {
							
						}
						Toast.fire({
							type: 'success',
							title: "&nbsp;"+receiveData.desc
						})
						previewJobsheet(receiveData.data)
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

<script src="<?=$webroot?>aextra/plugins/jquery-signaturepad/jquery.signaturepad.js"></script>
<script>
$(document).ready(function() {
  $('.sigPad').signaturePad({drawOnly:true});
});
</script>
<script src="<?=$webroot?>aextra/plugins/jquery-signaturepad/assets/json2.min.js"></script>
