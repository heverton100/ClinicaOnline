<?php 

session_start();

if (!isset($_SESSION['email_user']) || isset($_SESSION['IDPROFISSIONAL'])) {
	header("Location: account/login.php");
}

include("content/session-validation.php");

require_once 'app/dao/daoProfissional.php';
$teste = new daoProfissional;

$result = $teste->retornaProfissional($_GET['id']);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

include 'content/header.php';

?>
			
<!-- Page Content -->
<div class="content">
	<div class="container">

		<div class="row">
			<div class="col-md-7 col-lg-8">
				<div class="card">
					<div class="card-body">
					
						<!-- Checkout Form -->
						<form action="https://dreamstechnologies.co.in/docucare/booking-success.html">
						
							<!-- Personal Information -->
							<div class="info-widget">
								<h4 class="card-title">Agendamentos com Pagamento Pendente</h4>
								<div class="row">
									<div class="col-md-6 col-sm-12" id="agendamentos">
										<div class="custom-checkbox">
										   <input type="checkbox" id="terms_accept">
										   <label for="terms_accept">Profissional - Data_Hora</label>
										</div>
										<div class="custom-checkbox">
										   <input type="checkbox" id="terms_accept">
										   <label for="terms_accept">Profissional - Data_Hora</label>
										</div>
										<div class="custom-checkbox">
										   <input type="checkbox" id="terms_accept">
										   <label for="terms_accept">Profissional - Data_Hora</label>
										</div>
									</div>
								</div>
							</div>
							<!-- /Personal Information -->
							
							<div class="payment-widget">
								<h4 class="card-title">Payment Method</h4>
								
								<!-- Credit Card Payment -->
								<div class="payment-list">
									<label class="payment-radio credit-card-option">
										<input type="radio" name="radio" checked>
										<span class="checkmark"></span>
										Credit card
									</label>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group card-label">
												<label for="card_name">Name on Card</label>
												<input class="form-control" id="card_name" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group card-label">
												<label for="card_number">Card Number</label>
												<input class="form-control" id="card_number" placeholder="1234  5678  9876  5432" type="text">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group card-label">
												<label for="expiry_month">Expiry Month</label>
												<input class="form-control" id="expiry_month" placeholder="MM" type="text">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group card-label">
												<label for="expiry_year">Expiry Year</label>
												<input class="form-control" id="expiry_year" placeholder="YY" type="text">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group card-label">
												<label for="cvv">CVV</label>
												<input class="form-control" id="cvv" type="text">
											</div>
										</div>
									</div>
								</div>
								<!-- /Credit Card Payment -->
								
								<!-- Paypal Payment -->
								<div class="payment-list">
									<label class="payment-radio paypal-option">
										<input type="radio" name="radio">
										<span class="checkmark"></span>
										Paypal
									</label>
								</div>
								<!-- /Paypal Payment -->
								
								<!-- Terms Accept -->
								<div class="terms-accept">
									<div class="custom-checkbox">
									   <input type="checkbox" id="terms_accept">
									   <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
									</div>
								</div>
								<!-- /Terms Accept -->
								
								<!-- Submit Section -->
								<div class="submit-section mt-4">
									<button type="submit" class="btn btn-primary submit-btn">Confirmar Pagamento</button>
								</div>
								<!-- /Submit Section -->
								
							</div>
						</form>
						<!-- /Checkout Form -->
						
					</div>
				</div>
				
			</div>
			
			<div class="col-md-5 col-lg-4 theiaStickySidebar">
			
				<!-- Booking Summary -->
				<div class="card booking-card">
					<div class="card-header">
						<h4 class="card-title">Resumo</h4>
					</div>
					<div class="card-body">
					
						<!-- Booking Doctor Info -->
						<div class="booking-doc-info">
							<a href="doctor-profile.php?id=<?php echo $_GET['id']; ?>" class="booking-doc-img">
								<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $result['FOTO']); ?>" alt="User Image">
							</a>
							<div class="booking-info">
								<h4><a href="doctor-profile.php?id=<?php echo $_GET['id']; ?>"><?php echo $result['NOMEP']; ?></a></h4>
								<div class="clinic-details">
									<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?php echo utf8_encode($result['CIDADE'].', '.$result['ESTADO']); ?></p>
								</div>
							</div>
						</div>
						<!-- Booking Doctor Info -->
						
						<div class="booking-summary">
							<div class="booking-item-wrap">
								<ul class="booking-fee" style="margin-top: 1rem;">
									<li>Taxa da Consulta <span>R$ 100</span></li>
								</ul>
								<div class="booking-total">
									<ul class="booking-total-list">
										<li>
											<span>Total</span>
											<span class="total-cost">R$ 0</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Booking Summary -->
				
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include 'content/footer.php'; ?>

<script type="text/javascript">

	$.post("app/controllers/checkoutController.php?function=retorna_agendamentos", 
	{
		id_profissional: <?php echo $_GET['id']; ?>,
		id_paciente: <?php echo $_SESSION['IDPACIENTE']; ?>
	},

	function(result){
		$("#agendamentos").html(result);

		$("input[name='agenda']").change(function(){
			var arrayAgenda = new Array();
			$('input[name="agenda"]:checked').each(function() {
				arrayAgenda.push(this.value);
			});
			

			if (arrayAgenda.length > 0) {
				$.post("app/controllers/checkoutController.php?function=retornaValorTotal", 
				{
					arrayAgenda: arrayAgenda.toString()
				},

				function(result){

					$(".total-cost").html('R$ '+result);
					
					
				});

			}else{
				$(".total-cost").html('R$ 0');
			}

		});

	});
	
</script>