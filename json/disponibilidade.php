<?php

require '../vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: application/json');


if (isset($_POST['DATA']) and isset($_POST['COD_FUNCIONARIO'])) {



$result = VeterinariaUnimonte\Agendamento::listar_horarios($_POST['COD_FUNCIONARIO'], $_POST['DATA']);


} else {
$result = array(
    "status" => false, 
    "reason" => "COD_FUNCIONARIO & DATA  não definidos."
); 

}


echo json_encode($result);