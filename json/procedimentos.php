<?php

require '../vendor/autoload.php';


header('Content-Type: application/json');

if (isset($_POST['COD_TIPO_PROCEDIMENTO'])) {

$procedimentos = VeterinariaUnimonte\Procedimento::obter_procedimentos_por_tipo($_POST['COD_TIPO_PROCEDIMENTO']);


$result = array();
$result['status'] = true;
$result['html'] = "";
foreach ($procedimentos as $procedimento) {
    if (isset($procedimento['COD_PROCEDIMENTO'])) {
    $result['html'] .= '<option value="'.$procedimento['COD_PROCEDIMENTO'].'">'.$procedimento['DESCRICAO'].'</option>\n';
    }
}

} else {
$result = array(
    "status" => false, 
    "reason" => "COD_TIPO_PROCEDIMENTO não definido."
); 

}


echo json_encode($result);