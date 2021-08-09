<?php 

session_start();

require_once 'app/dao/daoProfissional.php';

$teste = new daoProfissional;

$result = $teste->retornaProfissional($_GET['id']);

?>
		
<?php include 'content/header.php' ?>

<!-- Page Content -->
<div class="content">
	<div class="container">

		<!-- Doctor Widget -->
		<div class="card">
			<div class="card-body">
				<div class="doctor-widget">
					<div class="doc-info-left">
						<div class="doctor-img">
							<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $result['FOTO']); ?>" class="img-fluid" alt="User Image">
						</div>
						<div class="doc-info-cont">
							<h4 class="doc-name"><?php echo $result['NOMEP']; ?></h4>
							<p class="doc-speciality"><?php echo $result['ESPECIALIDADES']; ?></p>

							<div class="clinic-services">
								<div class="clini-infos">
									<ul>
										<li><i class="fas fa-map-marker-alt"></i> <?php echo utf8_encode($result['CIDADE']).", ".utf8_encode($result['ESTADO']); ?></li>
										<li><i class="far fa-money-bill-alt"></i> R$<?php echo $result['VALORSESSAO']." / ".$result['DURACAOSESSAO']." min"; ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="doc-info-right">
						<div class="doctor-action">
							<a href="javascript:void(0)" class="btn btn-white fav-btn">
								<i class="far fa-bookmark"></i>
							</a>
						</div>
						<div class="clinic-booking">
							<a class="apt-btn" href="booking.php?id=<?php echo $_GET['id']; ?>">Agendamento</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Doctor Widget -->
		
		<!-- Doctor Details Tab -->
		<div class="card">
			<div class="card-body pt-0">
			
				<!-- Tab Menu -->
				<nav class="user-tabs mb-4">
					<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
						<li class="nav-item">
							<a class="nav-link active" href="#doc_overview" data-toggle="tab">Perfil Profissional</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#doc_business_hours" data-toggle="tab">Disponibilidade</a>
						</li>
					</ul>
				</nav>
				<!-- /Tab Menu -->
				
				<!-- Tab Content -->
				<div class="tab-content pt-0">
				
					<!-- Overview Content -->
					<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
						<div class="row">
							<div class="col-md-12 col-lg-9">
							
								<!-- About Details -->
								<div class="widget about-widget">
									<h4 class="widget-title">Sobre</h4>
									<p><?php echo $result['RESUMO']; ?></p>
								</div>
								<!-- /About Details -->
							
								<!-- Education Details -->
								<div class="widget education-widget">
									<h4 class="widget-title">Formação</h4>
									<div class="experience-box">
										<ul class="experience-list" id="formacoesretorno"></ul>
									</div>
								</div>
								<!-- /Education Details -->
						
								<!-- Experience Details -->
								<div class="widget experience-widget">
									<h4 class="widget-title">Experiência</h4>
									<div class="experience-box">
										<ul class="experience-list" id="experienciasretorno"></ul>
									</div>
								</div>
								<!-- /Experience Details -->
					
								
								<!-- Specializations List -->
								<div class="service-list">
									<h4>Especialidades</h4>
									<ul class="clearfix" id="especialidadesretorno"></ul>
								</div>
								<!-- /Specializations List -->

							</div>
						</div>
					</div>
					<!-- /Overview Content -->
				
					
					<!-- Business Hours Content -->
					<div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
						<div class="row">
							<div class="col-md-6 offset-md-3">
							
								<!-- Business Hours Widget -->
								<div class="widget business-widget">
									<div class="widget-content">
										<div class="listing-hours">
											<div id="retornoDisponHoje" class="listing-day current"></div>
											<div id="retornoDispon"></div>	
										</div>
									</div>
								</div>
								<!-- /Business Hours Widget -->
						
							</div>
						</div>
					</div>
					<!-- /Business Hours Content -->
					
				</div>
			</div>
		</div>
		<!-- /Doctor Details Tab -->

	</div>
</div>		
<!-- /Page Content -->

<?php include 'content/footer.php' ?>

<script type="text/javascript">

    function funRetornaFormacoes() {
		$.ajax({
		    type: 'GET',
		    url: 'app/controllers/profissionalPerfilController.php?function=retorna_formacoes_profile&id=' + <?php echo $_GET['id']; ?>
		}).then(function (data) {
		    // create the option and append to Select2

		    $("#formacoesretorno").html(data);
			
		});
    }
	funRetornaFormacoes();

    function funRetornaExperiencias() {
		$.ajax({
		    type: 'GET',
		    url: 'app/controllers/profissionalPerfilController.php?function=retorna_experiencias_profile&id=' + <?php echo $_GET['id']; ?>
		}).then(function (data) {
		    // create the option and append to Select2

		    $("#experienciasretorno").html(data);
			
		});
    }
	funRetornaExperiencias();

    function funRetornaEspecialidades() {
		$.ajax({
		    type: 'GET',
		    url: 'app/controllers/profissionalPerfilController.php?function=retorna_especialidades_profile&id=' + <?php echo $_GET['id']; ?>
		}).then(function (data) {

		    $("#especialidadesretorno").html(data);
			
		});
    }
	funRetornaEspecialidades();

    function funRetornaDisponibilidade() {
		$.ajax({
		    type: 'GET',
		    url: 'app/controllers/profissionalPerfilController.php?function=retorna_disponibilidade&id=' + <?php echo $_GET['id']; ?>
		}).then(function (data) {

		    $("#retornoDispon").html(data);
			
		});
    }
	funRetornaDisponibilidade();

    function funRetornaHorarioHoje() {
		$.ajax({
		    type: 'GET',
		    url: 'app/controllers/profissionalPerfilController.php?function=retorna_horarios_hoje&id=' + <?php echo $_GET['id']; ?>
		}).then(function (data) {

		    $("#retornoDisponHoje").html(data);
			
		});
    }
	funRetornaHorarioHoje();
</script>