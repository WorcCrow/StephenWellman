<form id="previewModal" method="GET" action="">
	<div class="modal fade" id="preview-modal" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="card-title">
						 <i class="fas fa-text-width"></i>
						 Jobsheet <b>#<span class="jobid"></span></b>
					  </h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6 callout callout-success">
							<i class="text-secondary">Client</i>
							<div class="info"><span class="client"></span></div>
						</div>
						<div class="col-sm-6 callout callout-success">
							<i class="text-secondary">Date</i>
							<div class="info"><span class="date"></span></div>
						</div>
						<div class="col-sm-6 callout callout-success">
							<i class="text-secondary">Time</i>
							<div class="info"><span class="timein"></span> to <span class="timeout"></span></div>
						</div>
						<div class="col-sm-6 callout callout-success">
							<i class="text-secondary">Total Hour/s</i>
							<div class="info"><span class="totaltime"></div>
						</div>
						<div class="col-sm-12 card card-outline card-success">
							<div class="card-body">
								<i class="text-secondary">Description</i>
								<div class="info"><span class="jobdesc"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8" align="center">
							<i>Authorized By</i>
							<h6><span class="contact"></h6>
						</div>
						<div class="col-sm-2"></div>
					</div>
					<div class="row d-flex justify-content-center">
						<img width="250px" class="signature">
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<div class="input-group">
						<button class="btn btn-block bg-gradient-danger" data-dismiss="modal" aria-label="Close">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>