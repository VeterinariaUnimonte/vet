<?php
require '../vendor/autoload.php';


header('Content-Type: application/json');

$clientes = VeterinariaUnimonte\Cliente::obter_clientes();

$result = array();
$result['status'] = true;
$result['html'] = "";
foreach ($clientes as $cliente) {
    if (isset($cliente['COD_CLIENTE'])) {
    $result['html'] .= '<option value="'.$cliente['COD_CLIENTE'].'">'.$cliente['NOME_CLIENTE'].' - '.$cliente['TELEFONE'].'</option>\n';
    }
}


echo json_encode($result);