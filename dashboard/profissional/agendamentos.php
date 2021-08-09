<?php
session_start();
include '../../content/header.php';
?>

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
			
				<?php include 'sidebar.php' ?>
				
			</div>
			
			<div class="col-md-7 col-lg-8 col-xl-9">
				<div class="appointments"></div>
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include '../../content/footer.php'; ?>

<!-- Appointment Details Modal -->
<div class="modal fade custom-modal" id="appt_details">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Appointment Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul class="info-details">
					<li>
						<div class="details-header">
							<div class="row">
								<div class="col-md-6">
									<span class="title">#APT0001</span>
									<span class="text">21 Oct 2019 10:00 AM</span>
								</div>
								<div class="col-md-6">
									<div class="text-right">
										<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<span class="title">Status:</span>
						<span class="text">Completed</span>
					</li>
					<li>
						<span class="title">Confirm Date:</span>
						<span class="text">29 Jun 2019</span>
					</li>
					<li>
						<span class="title">Paid Amount</span>
						<span class="text">$450</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- /Appointment Details Modal -->

<script type="text/javascript">

	$.post("../../app/controllers/agendamentosController.php?function=retorna_agendamentos", 
	{
		id_profissional: <?php echo $_SESSION['IDPROFISSIONAL']; ?>
	},
	function(result){
		$(".appointments").html(result);
	});

</script>