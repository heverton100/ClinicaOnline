<?php 

session_start();

require_once 'app/dao/daoProfissional.php';

$teste = new daoProfissional;

$result = $teste->retornaProfissional($_GET['id']);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (isset($_SESSION['IDPACIENTE'])) {
	$id_paciente = $_SESSION['IDPACIENTE'];
}else{
	$id_paciente = 0;
}

include 'content/header.php';

?>

<style type="text/css">
	a.slotfree.timing {
		background-color: #bbffe3;
	}

	a.slotfull.timing {
		background-color: #ffbbbb;
	}
</style>

<!-- Page Content -->
<div class="content">
	<div class="container">
	
		<div class="row">
			<div class="col-12">
			
				<div class="card">
					<div class="card-body">
						<div class="booking-doc-info">
							<a href="profissional-perfil.php?id=<?php echo $_GET['id']; ?>" class="booking-doc-img">
								<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $result['FOTO']); ?>" alt="User Image">
							</a>
							<div class="booking-info">
								<h4><a href="profissional-perfil.php?id=<?php echo $_GET['id']; ?>"><?php echo $result['NOMEP']; ?></a></h4>
								<p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo utf8_encode($result['CIDADE'].', '.$result['ESTADO']); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-4 col-md-6">
						<h4 class="mb-1"><?php echo strftime('%d %B %Y', strtotime('today')); ?></h4>
						<p class="text-muted"><?php echo utf8_encode(ucfirst(strftime('%A', strtotime('today')))); ?></p>
					</div>

                </div>
				<!-- Schedule Widget -->
				<div class="card booking-schedule schedule-widget">
				
					<!-- Schedule Header -->
					<div class="schedule-header">
						<div class="row">
							<div class="col-md-12">
							
								<!-- Day Slot -->
								<div class="day-slot">
									<ul id="listweek"></ul>
								</div>
								<!-- /Day Slot -->
								
							</div>
						</div>
					</div>
					<!-- /Schedule Header -->
					
					<!-- Schedule Content -->
					<div class="schedule-cont">
						<div class="row">
							<div class="col-md-12">
							
								<!-- Time Slot -->
								<div class="time-slot">
									<ul class="clearfix" id="listhoras"></ul>
								</div>
								<!-- /Time Slot -->
								
							</div>
						</div>
					</div>
					<!-- /Schedule Content -->
					
				</div>
				<!-- /Schedule Widget -->
				
				<!-- Submit Section -->
				<div class="submit-section proceed-btn text-right">
					<a href="checkout.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary submit-btn">Prosseguir para Pagamento</a>
				</div>
				<!-- /Submit Section -->
				
			</div>
		</div>
	</div>

</div>		
<!-- /Page Content -->

<?php include 'content/footer.php' ?>

<!-- Modal Novo Agendamento-->
<div class="modal fade bd-example-modal" id="md_novo_agendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="novoagendamento" method="post" action="app/controllers/bookingController.php?function=novoagendamento">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Inserir Agendamento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row form-row">
            <div class="col-md-6">
				<div class="form-group">
					<label>Data:</label>
					<div id="dataagendamento"></div>
				</div>
            </div>
            <input type="hidden" class="dataagendamento" value="" name="txt_dataagendamento">
          </div>

          <div class="row form-row">
            <div class="col-md-6">
				<div class="form-group">
					<label>Hora:</label>
					<div id="horaagendamento"></div>
				</div>
            </div>
            <input type="hidden" class="horaagendamento" value="" name="txt_horaagendamento">
          </div>

          <div class="row form-row">
            <div class="col-md-6">
				<div class="form-group">
					<label>Valor:</label>
					<div id="valoragendamento"></div>
				</div>
            </div>
            <input type="hidden" class="valoragendamento" value="" name="txt_valoragendamento">
          </div>

          <div class="row form-row">
            <div class="col-md-12">
				<div class="form-group">
					<label>Motivo/Descrição:</label>
					<textarea class="form-control" rows="5" name="txt_motivo" id="txt_motivo" required></textarea>
				</div>
            </div>
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txt_idprofissional">
            <input type="hidden" value="<?php echo $_SESSION['IDPACIENTE']; ?>" name="txt_idpaciente">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Gravar</button>
        </div>
      </form> 
    </div>
  </div>
</div>


<!-- Modal Login-->
<div class="modal fade bd-example-modal" id="md_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

		<div class="row form-row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Faça o login para salvar o agendamento.</label>
				</div>
			</div>
		</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" onclick="window.location.href='account/login.php?origem=<?php echo $_SERVER['REQUEST_URI']?>';" class="btn btn-primary">Login</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Excluir Agendamento-->
<div class="modal fade bd-example-modal" id="md_excluir_agendamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<form id="excluiragendamento" method="post" action="app/controllers/bookingController.php?function=excluiragendamento">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel">Deseja excluir esse agendamento?</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">

				<div class="row form-row">
					<div class="col-md-12">
						<div class="form-group">
							<label id="retornoExcluir" style="display:none;">Agendamento cancelado com sucesso!</label>
						</div>
					</div>
				</div>

			    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txt_idprofissional">
			    <input type="hidden" value="<?php echo $_SESSION['IDPACIENTE']; ?>" name="txt_idpaciente">
			    <input type="hidden" value="" name="txt_data_agenda" id="txt_data_agenda">

			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			  <button type="submit" id="btnexcluiragendamento" class="btn btn-danger">Excluir Agendamento</button>
			</div>
		</form>
    </div>
  </div>
</div>
		   

<script type="text/javascript">
	
	function funRetornaWeek() {

		$.post("app/controllers/bookingController.php?function=retornaWeek", 
			{},

			function(result){
				$("#listweek").html(result);
			});
	}
	funRetornaWeek();


	function funRetornaNextWeek($lastday) {

		$.post("app/controllers/bookingController.php?function=retornaWeek", 
			{lastday: $lastday},

			function(result){
				$("#listweek").html(result);
				funRetornaHoras();
			});
	}

	function funRetornaBackWeek($firstday) {

		$.post("app/controllers/bookingController.php?function=retornaWeek", 
			{firstday: $firstday},

			function(result){
				$("#listweek").html(result);
				funRetornaHoras();
			});
	}

	function funAgenda($dia,$hora,$valor){
		//alert($("#"+$dia).val());
		$("#horaagendamento").html($hora);
		$(".horaagendamento").val($hora);

		$("#valoragendamento").html($valor);
		$(".valoragendamento").val($valor);

		$("#dataagendamento").html($("#"+$dia).val());
		$(".dataagendamento").val($("#"+$dia).val());

		<?php if (!isset($_SESSION['email_user'])) {?>
			$('#md_login').modal();
		<?php }else{?>
			$('#md_novo_agendamento').modal();
		<?php } ?>
	}


	function funRetornaHoras() {

		$.post("app/controllers/bookingController.php?function=retornaHoras", 
		{
			profissional: <?php echo $_GET['id']; ?>,
			primeiro_dia: $("#txt_primeiro_dia_semana").val(),
			id_paciente: <?php echo $id_paciente; ?>
		},

		function(result){
			$("#listhoras").html(result);
		});
	}

	setTimeout(function(){ funRetornaHoras(); }, 500);

	$(document).on('submit','#novoagendamento',function(event){
		event.preventDefault();
		var dados=$(this).serialize();

		$.ajax({
			url: 'app/controllers/bookingController.php?function=novoagendamento',
			method: 'post',
			dataType: 'html',
			data: dados,
			success: function(data){
				funRetornaHoras();
				$('#md_novo_agendamento').modal('hide');
			}
		});
	});

	function funExcluirAgenda($agendamento){
		$("#retornoExcluir").css("display", "none"); 
		$("#btnexcluiragendamento").css("display", "block");

		$("#txt_data_agenda").val($agendamento);
		$('#md_excluir_agendamento').modal();
	}

	$(document).on('submit','#excluiragendamento',function(event){
		event.preventDefault();
		var dados=$(this).serialize();

		$.ajax({
			url: 'app/controllers/bookingController.php?function=excluiragendamento',
			method: 'post',
			dataType: 'html',
			data: dados,
			success: function(data){
				$("#retornoExcluir").css("display", "block"); 
				$("#btnexcluiragendamento").css("display", "none");
				funRetornaHoras();

				setTimeout(function(){ 

					$('#md_excluir_agendamento').modal('hide');

				}, 2000);

			}
		});
	});

</script>