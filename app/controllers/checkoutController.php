<?php

session_start();

require '../dao/daoCheckout.php';

$teste = new daoCheckout;

switch($_GET["function"]) {

	case 'retorna_agendamentos':

		$idProf = $_POST['id_profissional'];
		$idPac = $_POST['id_paciente'];

		$result = $teste->retorna_agendamentos($idProf,$idPac); 

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){		

			$table .= '<div class="custom-checkbox">';

        	$table .= '<input type="checkbox" name="agenda" value="'.$resultado['ID_AGENDAMENTO'].'" id="'.$resultado['ID_AGENDAMENTO'].'"> ';
        	$table .= '<label for="'.$resultado['ID_AGENDAMENTO'].'">'. date("d M Y", strtotime($resultado['data_hora'])).' - <span class="text-info">'.date("H:i", strtotime($resultado['data_hora'])).'</span></label>';

        	$table .= '</div>';

    	}

		echo $table;
		
		break;

	case 'retornaValorTotal':

		$arrayAgenda = $_POST['arrayAgenda'];

		$result = $teste->retornaValorTotal($arrayAgenda); 
		$resultado = mysqli_fetch_assoc($result);

		echo $resultado['SOMA'];
		
		break;

}

?>