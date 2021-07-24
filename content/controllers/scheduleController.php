<?php

session_start();

require '../dao/daoSchedule.php';

$teste = new daoSchedule;

switch($_GET["function"]) {

	case 'retorna_horarios':

		$range = '+'.$_POST['range'].' minute';
		$horainicial = "00:00";
		$horafinal = "23:00";

		$horas = '<option value="'.$horainicial.'">'.$horainicial.'</option>';
		while ($horainicial < $horafinal) {
			
			$horainicial = date('H:i', strtotime($range, strtotime($horainicial)));
			$horas .= '<option value="'.$horainicial.'">'.$horainicial.'</option>';
		}

		echo $horas;

		break;

	case 'novo_timeslot':

		$horainicial = $_POST['horainicial'];
		$horafinal = $_POST['horafinal'];
		$id = $_POST['txt_idprofissional'];
		$diasemana = $_POST['diadasemana'];

		$teste->gravaTimeSlot($horainicial,$horafinal,$id,$diasemana); 

		echo $diasemana;

		break;

	case 'retorna_horarios_dia':

		$dia = $_POST['dia'];
		$id = $_POST['id_prof'];

		$result2 = $teste->retornaHorariosDia($id,$dia);
		$resultado2 = mysqli_fetch_assoc($result2);


		if (isset($resultado2)) {

			$table = '';

			$table = '<div class="doc-times">';
			$result = $teste->retornaHorariosDia($id,$dia);
			while($resultado = mysqli_fetch_assoc($result)){

				$table .= '<div class="doc-slot-list">';

	        	$table .= $resultado['hora_ini'].' - '.$resultado['hora_fim'];

	        	$table .= '<a href="javascript:void(0)" onclick="funDeletarHorario('.$resultado['ID_HORARIO'].','.$resultado['dia_semana'].')" class="delete_schedule">';
	        	$table .= '<i class="fa fa-times"></i>';
	        	$table .= '</a>';

	        	$table .= '</div>';

	    	}

			$table .= '</div>';

			echo $table;

		}else{
			echo "<p class='text-muted mb-0'>-</p>";
		}

		break;

	case 'deleta_horario':

		$idhorario = $_POST['id'];

		$teste->deletaTimeSlot($idhorario); 

		break;

	case 'retorna_horarios_profile':

		$id = $_GET['id'];
		$result = $teste->retornaHorariosProfile($id);


		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<div class="listing-day">';
        	$table .= '		<div class="day">'.$resultado['DIASEMANA'].'</div>';
        	$table .= '		<div class="time-items">';
        	$table .= '			<span class="time">'.$resultado['HORARIO'].'</span>';
        	$table .= '		</div>';
        	$table .= '</div>';

    	}

		echo $table;

		break;

	case 'retorna_horarios_hoje':

		$id = $_GET['id'];
		$result = $teste->retornaHorariosProfile($id);

		switch (date("l")) {
			case 'Sunday':
				$hoje = 'Domingo';
				$dia = 1;
				break;
			case 'Monday':
				$hoje = 'Segunda';
				$dia = 2;
				break;
			case 'Tuesday':
				$hoje = 'Terça';
				$dia = 3;
				break;
			case 'Wednesday':
				$hoje = 'Quarta';
				$dia = 4;
				break;
			case 'Thursday':
				$hoje = 'Quinta';
				$dia = 5;
				break;
			case 'Friday':
				$hoje = 'Sexta';
				$dia = 6;
				break;
			case 'Saturday':
				$hoje = 'Sabado';
				$dia = 7;
				break;
		}

		$result2 = $teste->retornaHorarioRealTime($id,$dia);
		$resultado2 = mysqli_fetch_assoc($result2);
		if (isset($resultado2['dia_semana'])) {
			$check = '<span class="badge bg-success-light">Disponível</span>';
		}else{
			$check = '<span class="badge bg-danger-light">Indisponível</span>';
		}


		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			if ($resultado['DIASEMANA'] == $hoje) {
				$table .= '<div class="day">Hoje <span>'.date("d M Y").'</span></div>';
	        	$table .= '		<div class="time-items">';
	        	$table .= '			<span class="open-status">';
	        	$table .= 				$check;
	        	$table .= '			</span>';
	        	$table .= '			<span class="time">'.$resultado['HORARIO'].'</span>';
	        	$table .= '		</div>';
	        	$table .= '</div>';
			}

    	}
		
		echo $table;

		break;

		

}

?>