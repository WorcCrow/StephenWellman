<style>
	.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
	.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
	.autocomplete-selected { background: #F0F0F0; }
	.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
	.autocomplete-group { padding: 2px 5px; }
	.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Drone Works</h1>
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
							<h3 class="card-title">New Drone Work</h3>
						</div>
						<div class="card-body job-form">
						
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
									  <label>Customer</label>
									  <select class="form-control select2 company" style="width: 100%;" placeholder="Select Company">
										<option value="0" selected hidden>Select Customer</option>
										<?php
											$data = GetRowData("SELECT company, representative FROM clients WHERE type IN('drone') ORDER BY company ASC");
											forEach($data as $d):
										?>
										<option data-representative='<?=$d['representative']?>'><?=$d['company']?></option>
										<?php endforeach?>
									  </select>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Representative</label>
										<input type="text" class="form-control representative" disabled>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Contact</label>
										<input type="text" class="form-control contact">
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Location</label>
										<input type="text" class="form-control location" id="autocomplete"/>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Date</label>
										<input id="date" type="date" class="form-control date" value="<?=Date("Y-m-d")?>">
									</div>
								</div>
								
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Time In</label>
										<div class="input-group date" id="timein" data-target-input="nearest">
											<input type="hidden">
											<input type="text" class="form-control datetimepicker-input timein" data-target="#timein">
											<div class="input-group-append" data-target="#timein" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Time Out</label>
										<div class="input-group date" id="timeout" data-target-input="nearest">
											<input type="hidden">
											<input type="text" class="form-control datetimepicker-input timeout" data-target="#timeout">
											<div class="input-group-append" data-target="#timeout" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label>Category</label>
										<select class="form-control select2 category" style="width: 100%;">
											<option value="0" selected hidden>Select Category</option>
											<option value="Wedding">Wedding</option>
											<option value="Property">Property</option>
											<option value="Events">Events</option>
										</select>
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
		$("#drone-preview-modal span.jobid").text(data[0]['id'])
		$("#drone-preview-modal span.client").text(data[0]['company'])
		$("#drone-preview-modal span.location").text(data[0]['location'])
		$("#drone-preview-modal span.date").text(data[0]['date'])
		$("#drone-preview-modal span.totaltime").text(data[0]['totaltime'])
		$("#drone-preview-modal span.category").text(data[0]['category'])
		
		$("#drone-preview-modal").modal()
	}
	
	$(document).ready(function(){
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
									
		var countries = [
			<?php
				$data = GetRowData("SELECT DISTINCT location FROM dronerecord WHERE location != '' ORDER BY location ASC");
				forEach($data as $d):
			?>
			{value: "<?=$d['location']?>", data: "<?=$d['location']?>"},
			<?php endforeach?>
		];
		loadSuggestions(countries)
		function loadSuggestions(options) {
			$('#autocomplete').autocomplete({
				lookup: options,
				onSelect: function (suggestion) {
					$('#selected_option').html(suggestion.value);
				}
			});
		}
		
		$('.job-form select.company').on("change",function(){
			$('.job-form input.representative').val($(this).find(':selected').attr('data-representative'))
		})
		function reset(){
			$('.job-form input').each(function(){
				$(this).val("")
			})
			$('.job-form select').each(function(){
				$(this).val(0)
			})
		}
		$('.job-reset').on("click",function(){
			reset()
		})
		
		$('.job-submit').click(function(){
			$('#spinner-modal').modal('show')
			event.preventDefault()
			var data = "newjobsheet=drone"
			data += "&company=" + $('.job-form select.company').val()
			data += "&contact=" + $('.job-form input.contact').val()
			data += "&location=" + $('.job-form input.location').val()
			data += "&date=" + $('.job-form input.date').val()
			data += "&timein=" + $('.job-form input.timein').val()
			data += "&timeout=" + $('.job-form input.timeout').val()
			data += "&category=" + $('.job-form select.category').find(":selected").val()
			
			
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