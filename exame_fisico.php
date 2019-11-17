<?php
require 'vendor/autoload.php';

$app = new VeterinariaUnimonte\App;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'includes/global.php';?>
    <title><?php echo $app->name; ?> - Exame Fisico</title>
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

                <h1 class="text-center">Exame Fisico</h1>
                <hr>
            </div>

            <div class="col-lg-12 text-center">
            <?php

            if (!isset($_GET['add'])) {
                echo "<p>Não é possível adicionar um exame físico para esse agendamento</p>";
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
            <form method="POST" action="calendario.php?view=<?php echo $_GET['add']; ?>&action=add_exame_fisico">
                <div class="form-group">
                <label for="nome">Mucosas</label>
                <input type="text" class="form-control" id="MUCOSAS" name="MUCOSAS">
                </div>
                <div class="form-group">
                        <label for="nome">Hidratação</label>
                        <input type="text" class="form-control" id="HIDRATACAO" name="HIDRATACAO">
                </div>
                <div class="form-group">
                        <label for="nome">Linfonodos</label>
                        <input type="text" class="form-control" id="LINFONODOS" name="LINFONODOS">
                </div>
                <div class="form-group">
                        <label for="nome">Temperatura</label>
                        <input type="text" class="form-control" id="TEMPERATURA" name="TEMPERATURA">
                </div>
                <div class="form-group">
                        <label for="nome">Palpação Abd</label>
                        <input type="text" class="form-control" id="PALPACAO_ABD" name="PALPACAO_ABD">
                </div>
                <div class="form-group">
                        <label for="nome">ACP</label>
                        <input type="text" class="form-control" id="ACP" name="ACP">
                </div>
                <div class="form-group">
                        <label for="nome">Postura</label>
                        <input type="text" class="form-control" id="POSTURA" name="POSTURA">
                </div>
                <div class="form-group">
                        <label for="nome">Consciência</label>
                        <input type="text" class="form-control" id="CONSCIENCIA" name="CONSCIENCIA">
                </div>
                <div class="form-group">
                        <label for="nome">Obs Gerais</label>
                        <input type="text" class="form-control" id="OBS_GERAIS" name="OBS_GERAIS">
                </div>
                <div class="form-group">
                        <label for="nome">Exames Comp</label>
                        <input type="text" class="form-control" id="EXAMES_COMP" name="EXAMES_COMP">
                </div>
                <div class="form-group">
                        <label for="nome">Diagnostico</label>
                        <input type="text" class="form-control" id="DIAGNOSTICO" name="DIAGNOSTICO">
                </div>
                <div class="form-group">
                        <label for="nome">Tratamento</label>
                        <textarea class="form-control" id="TRATAMENTO" name="TRATAMENTO" placeholder="Descreva um tratamento..."></textarea>
                </div>
                <div class="form-group">
                        <label for="nome">Prescrito</label>
                        <textarea class="form-control" id="PRESCRITO" name="PRESCRITO" placeholder="Descreva um prescritivo..."></textarea>
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