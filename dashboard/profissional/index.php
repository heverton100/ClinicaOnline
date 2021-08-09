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

				<div class="row">
					<div class="col-md-12">
						<div class="card dash-card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-4">
										<div class="dash-widget dct-border-rht">
											<div class="circle-bar circle-bar1">
												<div class="circle-graph1" data-percent="75">
													<img src="../../assets/img/icon-01.png" class="img-fluid" alt="patient">
												</div>
											</div>
											<div class="dash-widget-info">
												<h6>Total Patient</h6>
												<h3>1800</h3>
												<p class="text-muted">Till Today</p>
											</div>
										</div>
									</div>
									
									<div class="col-md-12 col-lg-4">
										<div class="dash-widget dct-border-rht">
											<div class="circle-bar circle-bar2">
												<div class="circle-graph2" data-percent="65">
													<img src="../../assets/img/icon-02.png" class="img-fluid" alt="Patient">
												</div>
											</div>
											<div class="dash-widget-info">
												<h6>Today Patient</h6>
												<h3>260</h3>
												<p class="text-muted">06, Dec 2020</p>
											</div>
										</div>
									</div>
									
									<div class="col-md-12 col-lg-4">
										<div class="dash-widget">
											<div class="circle-bar circle-bar3">
												<div class="circle-graph3" data-percent="50">
													<img src="../../assets/img/icon-03.png" class="img-fluid" alt="Patient">
												</div>
											</div>
											<div class="dash-widget-info">
												<h6>Appoinments</h6>
												<h3>105</h3>
												<p class="text-muted">06, Aug 2020</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h4 class="mb-4">Agendamentos</h4>
						<div class="appointment-tab">
						
							<!-- Appointment Tab -->
							<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
								<li class="nav-item">
									<a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Próximos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#today-appointments" data-toggle="tab">Hoje</a>
								</li> 
							</ul>
							<!-- /Appointment Tab -->
							
							<div class="tab-content">
							
								<!-- Upcoming Appointment Tab -->
								<div class="tab-pane show active" id="upcoming-appointments">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>Nome Paciente</th>
															<th>Data Agendamento</th>
															<th>Status</th>
															<th>Valor</th>
															<th>Motivo</th>
															<th></th>
														</tr>
													</thead>
													<tbody id="retornoAgendamentos"></tbody>
												</table>		
											</div>
										</div>
									</div>
								</div>
								<!-- /Upcoming Appointment Tab -->
						   
								<!-- Today Appointment Tab -->
								<div class="tab-pane" id="today-appointments">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>Nome Paciente</th>
															<th>Data Agendamento</th>
															<th>Status</th>
															<th>Valor</th>
															<th>Motivo</th>
															<th></th>
														</tr>
													</thead>
													<tbody id="retornoAgendamentosHoje"></tbody>
												</table>		
											</div>	
										</div>	
									</div>	
								</div>
								<!-- /Today Appointment Tab -->
								
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include '../../content/footer.php'; ?>

<script type="text/javascript">

	$.post("../../app/controllers/profissionalController.php?function=retorna_agendamentos", 
	{
		id_profissional: <?php echo $_SESSION['IDPROFISSIONAL']; ?>
	},
	function(result){
		$("#retornoAgendamentos").html(result);
	});

	$.post("../../app/controllers/profissionalController.php?function=retorna_agendamentos_hoje", 
	{
		id_profissional: <?php echo $_SESSION['IDPROFISSIONAL']; ?>
	},
	function(result){
		$("#retornoAgendamentosHoje").html(result);
	});

</script>