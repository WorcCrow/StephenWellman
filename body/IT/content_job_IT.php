<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">IT Jobsheet</h1>
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
							<h3 class="card-title">New Jobsheet</h3>
						</div>
						<div class="card-body job-form">
						
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
									  <label>Client</label>
									  <select class="form-control select2 client" style="width: 100%;">
										<option value="0" selected hidden>Select Company</option>
										<?php
											$data = GetRowData("SELECT company FROM clients WHERE type IN('','it') ORDER BY company ASC");
											forEach($data as $d):
										?>
										<option><?=$d[0]?></option>
										<?php endforeach?>
									  </select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Contact</label>
										<input type="text" class="form-control contact">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Method</label>
										<select class="form-control select2 method" style="width: 100%;">
											<option value="remote">Remote</option>
											<option value="onsite">On-Site</option>
										</select>
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
								<div class="col-sm-12 row">
									<div class="col-sm-5 col-lg-8"></div>
									<div class="col-sm-7 col-lg-4">
										<div style="position:relative;width:100%">
											<label>Signature</label><br>
											<img width="100%" class="elevation-2 signature signature-btn" src="<?=$webroot?>media/signature.png">
										</div>
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

<div class="modal fade" id="signature-modal" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div style="width:100%;height:300px">
				<i class="fas fa-times fa-lg clearSig" style="z-index:10;position:absolute;top:3px;right:3px;color:#d01919"></i>
				<div id="signature-pad" class="signature-pad">
					<div class="signature-pad--body">
						<canvas class="signature-canvas"></canvas>
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
		var canvas = document.querySelector(".signature-pad .signature-canvas");
		var signaturePad = new SignaturePad(canvas, {
			penColor: "rgb(66, 133, 244)"
		});
		$(".clearSig").on("click",function(){signaturePad.clear()});
		function resizeImage(url, width, height, callback) {
			var sourceImage = new Image();

			sourceImage.onload = function() {
				// Create a canvas with the desired dimensions
				var canvas = document.createElement("canvas");
				canvas.width = width;
				canvas.height = height;

				// Scale and draw the source image to the canvas
				canvas.getContext("2d").drawImage(sourceImage, 0, 0, width, height);

				// Convert the canvas to a data URL in PNG format
				callback(canvas.toDataURL());
			}

			sourceImage.src = url;
		}
		function resizeCanvas(){
		  var ratio = 1;
		  canvas.width = canvas.offsetWidth * ratio;
		  canvas.height = canvas.offsetHeight * ratio;
		  canvas.getContext("2d").scale(ratio, ratio);
		  
		  signaturePad.clear();
		  return
		}
		window.onresize = resizeCanvas;
		resizeCanvas();
		$('#signature-modal').on('shown.bs.modal', function(){
			resizeCanvas();
			signaturePad.clear();
		})
		$('#signature-modal').on('hide.bs.modal', function(){
			$("img.signature").attr("src",signaturePad.toDataURL('image/png'))
		})
		$(".signature-btn").on("click",function(){
			$("#signature-modal").modal()
		})
		
		
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
		function reset(){
			$('.job-form input').each(function(){
				$(this).val("")
			})
			$('.job-form textarea').each(function(){
				$(this).val("")
			})
			$('.job-form select').each(function(){
				$(this).val("0")
			})
			$("img.signature").attr("src","<?=$webroot?>media/signature.png")
		}
		$('.job-reset').on("click",function(){
			reset()
		})
		
		$('.job-submit').click(function(){
			$('#spinner-modal').modal('show')
			event.preventDefault()
			var data = "newjobsheet=it"
			data += "&client=" + $('.job-form select.client').val()
			data += "&contact=" + $('.job-form input.contact').val()
			data += "&method=" + $('.job-form select.method').val()
			data += "&date=" + $('.job-form input.date').val()
			data += "&timein=" + $('.job-form input.timein').val()
			data += "&timeout=" + $('.job-form input.timeout').val()
			data += "&job=" + $('.job-form textarea.job').val()
			data += "&signature=" + $("img.signature").attr("src")
			
			
			SendPOST({
				url:webroot+'update.php',
				data:data,
				callback:function(data){
					receiveData = JSON.parse(data)
					setTimeout(()=>{$('#spinner-modal').modal('hide')},1000)
					switch(receiveData.status){
						case 'success':
						reset()
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




