<?php

session_start();

require '../dao/daoProfissional.php';

$teste = new daoProfissional;

switch($_GET["function"]) {

	case 'retorna_formacoes_profile':

		$id = $_GET['id'];
		$result = $teste->retornaFormacoes($id);
		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<li>';
			$table .= '<div class="experience-user">';
			$table .= '<div class="before-circle"></div>';
			$table .= '</div>';
			$table .= '<div class="experience-content">';
			$table .= '<div class="timeline-content">';

			$table .= '<a href="#/" class="name">'.utf8_encode($resultado['nome_instituicao']).'</a>';
			$table .= '<div>'.utf8_encode($resultado['descricao'])." / ".utf8_encode($resultado['nome_curso']).'</div>';
			//$table .= '<span class="time">1998 - 2003</span>';
			$table .= '</div>';
			$table .= '</div>';
			$table .= '</li>';
		}

		echo $table;

		break;

	case 'retorna_experiencias_profile':

		$id = $_GET['id'];
		$result = $teste->retornaExperiencias($id);
		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<li>';
			$table .= '<div class="experience-user">';
			$table .= '<div class="before-circle"></div>';
			$table .= '</div>';
			$table .= '<div class="experience-content">';
			$table .= '<div class="timeline-content">';

			$table .= '<a href="#/" class="name">'.utf8_encode($resultado['empresa'])." / ".utf8_encode($resultado['cargo']).'</a>';
			$table .= '<span class="time">'.$resultado['data_ini']." - ".$resultado['data_fim'].'</span>';
			$table .= '<span class="time">'.$resultado['atividades'].'</span>';
			$table .= '</div>';
			$table .= '</div>';
			$table .= '</li>';

		}

		echo $table;

		break;

	case 'retorna_especialidades_profile':

		$id = $_GET['id'];
		$result = $teste->retornaEspecialidades($id);
		$options = '';

		while($resultado = mysqli_fetch_assoc($result)){
			$options .= '<li>'.$resultado['text'].'</li>';
		}

		echo $options;

		break;

	case 'retorna_disponibilidade':

		$id = $_GET['id'];
		$result = $teste->retornaDisponibilidade($id);
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
		$result = $teste->retornaDisponibilidade($id);

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