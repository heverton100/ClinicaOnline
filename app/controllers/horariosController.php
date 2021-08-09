<?php

session_start();

require '../dao/daoHorarios.php';

$teste = new daoHorarios;

switch($_GET["function"]) {

	case 'retorna_horarios':

		$id = $_POST['id_prof'];

		$result = $teste->retorna_range($id); 

		$range = '+'.$result['VRANGE'].' minute';
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


}

?>