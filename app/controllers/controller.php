<?php

session_start();

require '../dao/daoProfissional.php';

$teste = new daoProfissional;

switch($_GET["function"]) {

	case 'retorna_profissionais':

		$result = $teste->retornaProfissionais();

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= 	'<div class="profile-widget">';
			$table .= 		'<div class="doc-img">';
			$table .=			'<a href="profissional-perfil.php?id='.$resultado['ID'].'">';
			$table .=			'<img class="img-fluid" alt="User Image" src="'.$resultado['FOTO'].'">';
			$table .=			'</a>';
			$table .=		'</div>';
			$table .=		'<div class="pro-content">';
			$table .=			'<h3 class="title">';
			$table .=				'<a href="profissional-perfil.php?id='.$resultado['ID'].'">'.$resultado['NOME'].'</a>';
			$table .=				'<i class="fas fa-check-circle verified"></i>';
			$table .=			'</h3>';
			$table .=			'<p class="speciality">'.$resultado['ESPECIALIDADES'].'</p>';
			$table .=			'<ul class="available-info">';
			$table .=				'<li>';
			$table .=					'<i class="fas fa-map-marker-alt"></i> '.utf8_encode($resultado['CIDADE']).', '.utf8_encode($resultado['ESTADO']);
			$table .=				'</li>';
			$table .=				'<li>';
			$table .=					'<i class="far fa-money-bill-alt"></i> R$'.$resultado['VALORSESSAO'].' / '.$resultado['DURACAOSESSAO'].'min ';
			$table .=					'<i class="fas fa-info-circle" data-toggle="tooltip" title="Duração"></i>';
			$table .=				'</li>';
			$table .=			'</ul>';
			$table .=			'<div class="row row-sm">';
			$table .=				'<div class="col-6">';
			$table .=					'<a href="profissional-perfil.php?id='.$resultado['ID'].'" class="btn view-btn">Ver Perfil</a>';
			$table .=				'</div>';
			$table .=				'<div class="col-6">';
			$table .=					'<a href="booking.php?id='.$resultado['ID'].'" class="btn book-btn">Agendar</a>';
			$table .=				'</div>';
			$table .=			'</div>';
			$table .=		'</div>';
			$table .=	'</div>';
		}

		echo $table;

		break;

}

?>