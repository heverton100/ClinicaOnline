<?php

session_start();

require '../dao/daoAgendamento.php';

$teste = new daoAgendamento;

switch($_GET["function"]) {

	case 'retorna_agendamentos':

		$id = $_POST['id_profissional'];

		$result = $teste->retorna_agendamentos($id); 

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<div class="appointment-list">';

			$table .= '		<div class="profile-info-widget">';

			$table .= '		<a href="paciente-perfil.php" class="booking-doc-img">';
			$table .= '			<img src="../../'.$resultado['FOTO'].'" alt="User Image">';
			$table .= '		</a>'; 
			$table .= '		<div class="profile-det-info">';
			$table .= '		<h3><a href="paciente-perfil.php">'.$resultado['NOMEPAC'].'</a></h3>';
			$table .= '		<div class="patient-details">';
			$table .= '			<h5><i class="far fa-clock"></i> '. date("d M Y", strtotime($resultado['AGENDAMENTO'])).', '.date("H:i", strtotime($resultado['AGENDAMENTO'])).'</h5>';
			$table .= '			<h5><i class="fas fa-map-marker-alt"></i> '.utf8_encode($resultado['CIDADE']).', '.utf8_encode($resultado['ESTADO']).'</h5>';
			$table .= '			<h5><i class="fas fa-envelope"></i> '.$resultado['EMAIL'].'</h5>';
			$table .= '			<h5 class="mb-0"><i class="fas fa-phone"></i> '.$resultado['FONE'].'</h5>';
			$table .= '		</div>';
				$table .= '		</div>';
			$table .= '		</div>';
			$table .= '		<div class="appointment-action">';
			$table .= '			<a href="#" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#appt_details">';

			$table .= '			<i class="far fa-eye"></i> View';
			$table .= '			</a>';
			$table .= '			<a href="javascript:void(0);" class="btn btn-sm bg-success-light">';
			$table .= '			<i class="fas fa-check"></i> Accept';
			$table .= '			</a>';
			$table .= '			<a href="javascript:void(0);" class="btn btn-sm bg-danger-light">';
			$table .= '			<i class="fas fa-times"></i> Cancel';
			$table .= '			</a>';
			$table .= '		</div>';
			$table .= '</div>';

    	}

		echo $table;

		break;


}

?>