<?php

require '../vendor/autoload.php';


header('Content-Type: application/json');

$funcionarios = VeterinariaUnimonte\Funcionario::obter_funcionarios();

$result = array();
$result['status'] = true;
$result['html'] = "";
foreach ($funcionarios as $funcionario) {
    if (isset($funcionario['COD_FUNCIONARIO'])) {
    $result['html'] .= '<option value="'.$funcionario['COD_FUNCIONARIO'].'">'.$funcionario['NOME_FUNCIONARIO'].' ('.VeterinariaUnimonte\Especialidade::obter_especialidade($funcionario['COD_ESPECIALIDADE']).')</option>\n';
    }
}
echo json_encode($result);