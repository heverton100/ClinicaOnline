<?php
	if( $_SERVER['REQUEST_METHOD']=='POST' )
	{
		$values = Array();
		foreach( $_POST['conta'] AS $conta )
		{
			if( !empty( $conta ) )
				$values[] = "(NULL, '{$conta}')";
		}
		$sql = "INSERT INTO `table` ( `id`, `conta` ) VALUES ".implode( ', ', $values );
		echo $sql;
	}
?>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var i = 1;
				$('#campos input').live('blur', function(){
					if( $( this ).val()!='' && $('#campos input:last').val()!='' )
					{
					if( i<10 )//limitar em 10 campos
					{
						i++
						$('#campos').append( '<label>Conta '+i+':<input type="text" name="conta[]" value="" id="'+i+'" /></label>' )
							.find('input:last').focus();
						}
					}
				});
			});
		</script>
	</head>
	<body>
		<form action="" method="post">
			<fieldset id="campos">
				<label>Conta 1:<input type="text" name="conta[]" /></label>

			</fieldset><!-- /campos -->
			<label><input type="submit" name="ok" value="ok" /></label>
		</form>
	</body>
</html>



										<div class="row form-row education-cont">
											<div class="col-12 col-md-10 col-lg-11">
												<div class="row form-row">
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<select class="form-control select required" name="nivel_formacao[]" id="nivel_formacao">
																<option value="">Nível</option>
																<option value="ensino_fundamental">Ensino fundamental</option>
																<option value="ensino_medio">Ensino médio</option>
																<option value="ensino_medio_tecnico">Ensino médio técnico</option>
																<option value="tecnico">Técnico</option>
																<option value="graduacao">Graduação</option>
																<option value="pos">Pós graduação</option>
																<option value="mba">MBA</option>
																<option value="mestrado">Mestrado</option>
																<option value="doutorado">Doutorado</option>
															</select>
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<input type="text" placeholder="Instituição" class="form-control" name="txt_instituicao[]" id="txt_instituicao">
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<input type="text" placeholder="Curso" class="form-control" name="txt_curso[]" id="txt_curso">
														</div> 
													</div>
												</div>
											</div>
										</div>




SELECT CASE 
WHEN dia_semana = 1 THEN 'Domingo' 
WHEN dia_semana = 2 THEN 'Segunda' 
WHEN dia_semana = 3 THEN 'Terça' 
WHEN dia_semana = 4 THEN 'Quarta' 
WHEN dia_semana = 5 THEN 'Quinta' 
WHEN dia_semana = 6 THEN 'Sexta'
WHEN dia_semana = 7 THEN 'Sábado' 
END AS DIASEMANA, GROUP_CONCAT( CONCAT(hora_ini,' - ',hora_fim) SEPARATOR ' | ') AS HORARIO FROM db_clinic.tbl_horarios WHERE ID_PROFISSIONAL = 1
GROUP BY DIASEMANA
ORDER BY dia_semana


SELECT * FROM db_clinic.tbl_horarios WHERE ID_PROFISSIONAL = 1 AND dia_semana = 2
AND now() BETWEEN hora_ini and hora_fim