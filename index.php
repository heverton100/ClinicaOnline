<?php 

session_start();

include("content/session-validation.php");

?>

<?php include 'content/header.php' ?>

<section class="section section-doctor">
	<div class="container-fluid">
	   <div class="row">
			<div class="col-lg-4">
				<div class="section-header ">
					<h2>Encontre Seu Especialista</h2>
					<p>Converse com um profissional sem sair de casa</p>
				</div>
				<div class="about-content">
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.</p>
					<a href="javascript:;">Busca</a>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="doctor-slider slider">

					
				</div>
			</div>
	   </div>
	</div>
</section>

<?php include 'content/footer.php' ?>

<script type="text/javascript">
	$.ajax({
	    type: 'GET',
	    url: 'app/controllers/controller.php?function=retorna_profissionais'
	}).then(function (data) {
	    $(".doctor-slider").append(data);
    	if($('.doctor-slider').length > 0) {
			$('.doctor-slider').slick({
				dots: false,
				autoplay:false,
				infinite: true,
				variableWidth: true,
			});
		}
	});

</script>