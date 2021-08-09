<?php

session_start();

require '../dao/daoAgendamento.php';

$teste = new daoAgendamento;

switch($_GET["function"]) {

	case 'retornaWeek':

		if (isset($_POST['lastday'])) {
			$primdiasemana = $_POST['lastday'];
			$primdiasemana = strtotime($primdiasemana);
			$primdiasemana = date('Y-m-d', strtotime('+1 day', $primdiasemana));
		}elseif(isset($_POST['firstday'])){
			$primdiasemana = $_POST['firstday'];
			$primdiasemana = strtotime($primdiasemana);
			$primdiasemana = date('Y-m-d', strtotime('-1 day', $primdiasemana));
		}else{
			$primdiasemana = date("Y-m-d", strtotime("now"));
		}

		$semana = render($primdiasemana);

		$table = "";
		$table1 = "";
		$table2 = "";
		$table3 = "";

		foreach($semana as $x => $val) {


			$table2 .=				'<li>';
			$table2 .=					'<span>'.$x.'</span>';
			$table2 .=					'<span class="slot-date">'.date("d M", strtotime($val)).' <small class="slot-year">'.date("Y", strtotime($val)).'</small><input type="hidden" id="'.$x.'" value="'.date("d/m/Y", strtotime($val)).'"></span>';
			$table2 .=				'</li>';

			if ($x == 'sab') {
				$param = $val;
			}

			if ($x == 'dom') {
				$param2 = $val;
			}

		}


		$table1 .=					'<li class="left-arrow">';
		$table1 .=						'<a href="#" onclick="funRetornaBackWeek(\''.$param2.'\')">';
		$table1 .=							'<i class="fa fa-chevron-left"></i>';

		$table1 .=	'<input type="hidden" value="'.$param2.'" id="txt_primeiro_dia_semana">';

		$table1 .=						'</a>';
		$table1 .=					'</li>';


		$table3 .=					'<li class="right-arrow">';
		$table3 .=						'<a href="#" onclick="funRetornaNextWeek(\''.$param.'\')">';
		$table3 .=							'<i class="fa fa-chevron-right"></i>';
		$table3 .=						'</a>';
		$table3 .=					'</li>';

		$table = $table1.$table2.$table3;

		echo $table;

		break;

	case 'retornaHoras':

		$horas = '';
		$idprof = $_POST['profissional'];
		$primeiro_dia = $_POST['primeiro_dia'];
		$id_paciente = $_POST['id_paciente'];

		$resultValor = $teste->retornaValor($idprof);
		$valorSessao = 'R$ '.number_format($resultValor['valor_sessao'],2,",",".");

		$resultAgenda = $teste->retornaAgendamentos($idprof);

		$resultAgendaPac = $teste->retornaAgendamentosPaciente($idprof,$id_paciente);

		for ($i = 1; $i <= 7; $i++) {

		    $range = '+60 minute';
			$horainicial = "07:00";
			$horafinal = "18:00";

			$horas .= '<li>';

			if ($i == 1) {
				$dia = "dom";
			}elseif ($i == 2) {
				$dia = "seg";
			}elseif ($i == 3) {
				$dia = "ter";
			}elseif ($i == 4) {
				$dia = "qua";
			}elseif ($i == 5) {
				$dia = "qui";
			}elseif ($i == 6) {
				$dia = "sex";
			}else{
				$dia = "sab";
			}

			$diaSemana = strtotime($primeiro_dia);
			$diaSemana = date('Y-m-d', strtotime('-1 day', $diaSemana));
			$diaSemana = strtotime($diaSemana);
			$diaSemana = date('Y-m-d', strtotime('+'.$i.' day', $diaSemana));


			$result = $teste->retornaHorariosDia($idprof,$i);


			while ($horainicial < $horafinal) {

				$horainicial = date('H:i', strtotime($range, strtotime($horainicial)));

				$TTTTT = $diaSemana." ".$horainicial.":00";

				

				

				if(in_array($TTTTT, $resultAgendaPac)){
					$horas .= '			<a class="timing selected" href="#" onclick="funExcluirAgenda(\''.$TTTTT.'\')">';
				}elseif (in_array($TTTTT, $resultAgenda)) {
					$horas .= '			<a class="slotfull timing" href="#">';
				}elseif (in_array($horainicial, $result)) {
					$horas .= '			<a class="slotfree timing" href="#" onclick="funAgenda(\''.$dia.'\',\''.$horainicial.'\',\''.$valorSessao.'\')">';
				}else{
					$horas .= '			<a class="timing" href="#">';
				}


				
				
				$horas .= '				<span>'.$horainicial.'</span>';
				$horas .= '			</a>';


			}

			$horas .= '</li>';

		}

		echo $horas;

		break;

	case 'novoagendamento':

		$dataagendamento = $_POST['txt_dataagendamento'];
		$horaagendamento = $_POST['txt_horaagendamento'];

		$dataTemp = explode('/', $dataagendamento);
		$dataNew = $dataTemp[2]."-".$dataTemp[1]."-".$dataTemp[0];

		$datahora = $dataNew." ".$horaagendamento;

		$valoragendamento = $_POST['txt_valoragendamento'];

		$valor = str_replace('R$ ', "", str_replace(',', ".", $valoragendamento));

		$motivo = $_POST['txt_motivo'];
		$idprofissional = $_POST['txt_idprofissional'];
		$idpaciente = $_POST['txt_idpaciente'];

		$resultValor = $teste->novoAgendamento($idpaciente,$idprofissional,$datahora,$motivo,$valor);

		echo $resultValor;

		break;

	case 'excluiragendamento':

		$data_agenda = $_POST['txt_data_agenda'];
		$idprofissional = $_POST['txt_idprofissional'];
		$idpaciente = $_POST['txt_idpaciente'];

		$resultValor = $teste->excluirAgendamento($idpaciente,$idprofissional,$data_agenda);

		break;
	

}






function render($date = null) {
	$current = is_null($date)
		? date('w')		
		: date('w', strtotime($date));

	$now = is_null($date)
		? strtotime('now')
		: strtotime($date);

	$week = ['dom' => '',
		'seg' => '',
		'ter' => '',
		'qua' => '',
		'qui' => '',
		'sex' => '',
		'sab' => ''];		
	$keys = array_keys($week);
	if ($current > 0)
	{ 
		$now = strtotime('-'.($current).' day', $now);		
	}
	for($i = 0; $i < 7; $i++)
	{
		$week[$keys[$i]] = date('Y-m-d', 
			strtotime("+$i day", $now));			
	}
	return $week;
}

?>