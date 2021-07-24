			<?php include 'header.php' ?>
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						
						<?php include 'sidebar.php' ?>
							
						</div>
						<div class="col-md-7 col-lg-8 col-xl-9">
						 
							<div class="row">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title">Programar Horários</h4>
											<div class="profile-box">
												<div class="row">

													<div class="col-lg-4">
														<div class="form-group">               
															<label>Duração do Espaço de Tempo</label>
															<select id="range" name="range" class="select form-control" >
																<option value="">-</option>
																<option value="30">30 minutos</option>  
																<option value="60">1 hora</option>
															</select>
														</div>
													</div>

												</div>     
												<div class="row">
													<div class="col-md-12">
														<div class="card schedule-widget mb-0">
														
															<!-- Schedule Header -->
															<div class="schedule-header">
															
																<!-- Schedule Nav -->
																<div class="schedule-nav">
																	<ul class="nav nav-tabs nav-justified">
																		<li class="nav-item">
																			<a class="nav-link" onclick="funGetDay(1)" data-toggle="tab" href="#slot_sunday">Domingo</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link active" onclick="funGetDay(2)" data-toggle="tab" href="#slot_monday">Segunda</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" onclick="funGetDay(3)" data-toggle="tab" href="#slot_tuesday">Terça</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" onclick="funGetDay(4)" data-toggle="tab" href="#slot_wednesday">Quarta</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" onclick="funGetDay(5)" data-toggle="tab" href="#slot_thursday">Quinta</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" onclick="funGetDay(6)"data-toggle="tab" href="#slot_friday">Sexta</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" onclick="funGetDay(7)"data-toggle="tab" href="#slot_saturday">Sábado</a>
																		</li>
																	</ul>
																</div>
																<!-- /Schedule Nav -->
																
															</div>
															<!-- /Schedule Header -->
															
															<!-- Schedule Content -->
															<div class="tab-content schedule-cont">
															
																<!-- Sunday Slot -->
																<div id="slot_sunday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno1"></div>
																</div>
																<!-- /Sunday Slot -->

																<!-- Monday Slot -->
																<div id="slot_monday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno2"></div>
																</div>
																<!-- /Monday Slot -->

																<!-- Tuesday Slot -->
																<div id="slot_tuesday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno3"></div>
																</div>
																<!-- /Tuesday Slot -->

																<!-- Wednesday Slot -->
																<div id="slot_wednesday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno4"></div>
																</div>
																<!-- /Wednesday Slot -->

																<!-- Thursday Slot -->
																<div id="slot_thursday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno5"></div>
																</div>
																<!-- /Thursday Slot -->

																<!-- Friday Slot -->
																<div id="slot_friday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno6"></div>
																</div>
																<!-- /Friday Slot -->

																<!-- Saturday Slot -->
																<div id="slot_saturday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
																	</h4>
																	<div id="retorno7"></div>
																</div>
																<!-- /Saturday Slot -->

															</div>
															<!-- /Schedule Content -->
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   

		<!-- Add Time Slot Modal -->
		<div class="modal fade custom-modal" id="add_time_slot">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Time Slots</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="novoTimeSlot" method="post" action="../../content/controllers/scheduleController.php?function=novo_timeslot">
							<div class="hours-info">
								<div class="row form-row hours-cont">
									<div class="col-12 col-md-12">
										<div class="row form-row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Start Time</label>
													<select id="horainicial" name="horainicial" class="form-control horarios">

													</select>
												</div> 
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>End Time</label>
													<select id="horafinal" name="horafinal" class="form-control horarios">

													</select>
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
							<input type="hidden" id="diadasemana" name="diadasemana">
							<div class="submit-section text-center">
								<button type="submit" class="btn btn-primary submit-btn">Gravar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Time Slot Modal -->
		
		<?php include 'footer.php' ?>
		
		<script>

			$("#range").change(function(){

		        var range = $("#range").val();

				$.post("../../content/controllers/scheduleController.php?function=retorna_horarios",
				{range: range}, 
				function(result){
					$(".horarios").html(result);
				});

			});

			function funGetDay(teste) {
				$("#diadasemana").val(teste);

				$.post("../../content/controllers/scheduleController.php?function=retorna_horarios_dia",
				{dia: teste, id_prof: <?php echo $_SESSION['IDPROFISSIONAL']; ?>}, 
				function(result){
					$("#retorno"+teste).html(result);
				});
			}

			$(document).on('submit','#novoTimeSlot',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        $.ajax({
		            url: '../../content/controllers/scheduleController.php?function=novo_timeslot',
		            method: 'post',
		            dataType: 'html',
		            data: dados,
		            success: function(data){
		            	funGetDay(data);
		                $('#add_time_slot').modal('hide');
		            }
		        });
		    });

			function funDeletarHorario(idHorario,dia) {

				$.post("../../content/controllers/scheduleController.php?function=deleta_horario",
				{id: idHorario}, 
				function(result){
					funGetDay(dia);
				});

			}

		</script>