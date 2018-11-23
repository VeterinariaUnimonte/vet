<?php

require '../vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: application/json');


if (isset($_POST['COD_FUNCIONARIO'])) {


$search_dates = 0;

$convert_to_date = strtotime("now");
$result = array();
$result['html'] = "";
while ($search_dates < 5) {

    $date_to_these = date("Y-m-d", $convert_to_date);

    $these_date = VeterinariaUnimonte\Agendamento::listar_horarios($_POST['COD_FUNCIONARIO'], $date_to_these);

    if ($these_date['status'] == true) {
        $result['html'] .= "<b>".date("d/m/Y", $convert_to_date)."</b>, ";
        $search_dates++;
    }
    $convert_to_date = strtotime('+1 day', $convert_to_date);
}

if (!empty($result['html'])) {
    $result['status'] = true;
    $result['html'] = substr($result['html'], 0, -2);


    switch (date("w")) {
        case 0:
            $dia_semana = "Domingo";
            break;
        case 1:
            $dia_semana = "Segunda-feira";
            break;
        case 2:
            $dia_semana = "Terça-feira";
            break;
        case 3:
            $dia_semana = "Quarta-feira";
            break;
        case 4:
            $dia_semana = "Quinta-feira";
            break;
        case 5:
            $dia_semana = "Sexta-feira";
            break;
        case 6:
            $dia_semana = "Sabádo";
            break;
    }

    $result['html_current_date'] = "<b>".date("d/m/Y")."</b> - ".$dia_semana."";
}

} else {
$result = array(
    "status" => false, 
    "reason" => "COD_FUNCIONARIO & DATA  não definidos."
); 

}


echo json_encode($result);