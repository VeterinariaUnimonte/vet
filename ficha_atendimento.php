<?php
require 'vendor/autoload.php';

$app = new VeterinariaUnimonte\App;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'includes/global.php';?>
    <title><?php echo $app->name; ?> - Ficha de Atendimento</title>
</head>

<body>
    <!-- Navegação -->
    <?php
    $page_id = 0;
    require 'includes/header.php';
    ?>
    <!-- Container -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <br>

                <h1 class="text-center">Ficha de Atendimento</h1>
                <hr>
            </div>

            <div class="col-lg-12 text-center">
            <?php

            if (!isset($_GET['add'])) {
                echo "<p>Não é possível adicionar uma ficha de atendimento para esse agendamento</p>";
                die();
            } else {

                $agendamento = VeterinariaUnimonte\Agendamento::obter_agendamento($_GET['add']);
                $cliente = VeterinariaUnimonte\Cliente::obter_cliente($agendamento['COD_CLIENTE']);
            }
            ?>
            <h4><?php echo $cliente['NOME_CLIENTE']; ?> (<?php echo $cliente['EMAIL']; ?>)</h4>
            <p><a href="calendario.php?view=<?php echo $_GET['add']; ?>">&laquo; Retornar as informações do agendamento</a></p>
            <hr>
            <div class="col-lg-12 text-left">
            <form method="POST" action="calendario.php?view=<?php echo $_GET['add']; ?>&action=add_ficha_atendimento">
                <div class="form-group">
                        <label for="QUEIXA_PRINCIPAL">Queixa Principal</label>
                        <textarea class="form-control" id="QUEIXA_PRINCIPAL" name="QUEIXA_PRINCIPAL" placeholder="Descreva uma queixa principal..."></textarea>
                </div>
                <div class="form-group">
                        <label for="MANEJO">Manejo</label>
                        <textarea class="form-control" id="MANEJO" name="MANEJO" placeholder="Descreva um manejo..."></textarea>
                </div>
                <div class="form-group">
                        <label for="ANTECEDENTES_MORBIDOS">Antecedentes Mórbidos</label>
                        <textarea class="form-control" id="ANTECEDENTES_MORBIDOS" name="ANTECEDENTES_MORBIDOS" placeholder="Descreva antecedentes morbido..."></textarea>
                </div>
                <div class="form-group">
                        <label for="INCIDENTES_PREVIOS">Incidentes Prévios</label>
                        <textarea class="form-control" id="INCIDENTES_PREVIOS" name="INCIDENTES_PREVIOS" placeholder="Descreva incidentes prévios..."></textarea>
                </div>
                <hr>
                <div class="text-right">
                    <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Dados</button>
                </div>
            </form>    
            <br><br>
        </div>
    </div>
    <br>
    <br>
    </div>
    </div>
    </div>
    </div>