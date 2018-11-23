<?php
require 'vendor/autoload.php';
$app = new VeterinariaUnimonte\App;
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require 'includes/global.php'; ?>
    <title><?php echo $app->name; ?> - Calendário</title>
    <link href='<?php echo $app->url; ?>/vendor/fullcalendar/fullcalendar/dist/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo $app->url; ?>/vendor/fullcalendar/fullcalendar/dist/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='<?php echo $app->url; ?>/vendor/moment/moment/min/moment.min.js'>
    </script>
    <script src='<?php echo $app->url; ?>/vendor/fullcalendar/fullcalendar/dist/fullcalendar.min.js'>
    </script>
    <script src='<?php echo $app->url; ?>/vendor/fullcalendar/fullcalendar/dist/locale/pt-br.js'>
    </script>
  </head>
  <body>
    <!-- Navegação -->
    <?php
$page_id = 3;
require 'includes/header.php';
?>
    <!-- Container -->
    <div class="container">
    <?php if (!isset($_GET['view'])) {
      ?>
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
        <?php
        if (isset($_GET['id'])) {
        $funcionario = VeterinariaUnimonte\Funcionario::obter_funcionario($_GET['id']);
        }
        if (!isset($funcionario['COD_FUNCIONARIO'])){
          echo '<h1 class="text-center">Calendário não encontrado</h1>
          <p class="text-center"><a href="calendario_select.php">&laquo; Retornar a seleção de funcionários</a></p>';
        } else { ?>
        <h1 class="text-center">Calendário: <?php echo $funcionario['NOME_FUNCIONARIO']; ?></h1>
        <p class="text-center"><a href="calendario_select.php">&laquo; Retornar a seleção de funcionários</a></p>
    <hr>
    <div id='calendar' style="margin-bottom: 10%; max-width: 900px; margin: 0 auto;"></div>
<br>
<br>
    </div>
    <script>
        $(document).ready(function() {
          $('#calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            customButtons: {
              myCustomButton: {
                text: 'Novo Agendamento',
                click: function() {
                  window.location.href = 'agendamento.php';
                }
              }
            }
            ,
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'myCustomButton, month,agendaWeek,agendaDay,listWeek'
            }
            ,
            defaultDate: '<?php echo date('Y-m-d'); ?>',
            navLinks: true, 
            editable: false,
            eventLimit: true,
            events: [ 
              <?php
              $agendamentos = VeterinariaUnimonte\Agendamento::obter_agendamentos($funcionario['COD_FUNCIONARIO']);
              $disponibilidade_funcionario = VeterinariaUnimonte\Disponibilidade::obter_disponibilidade($funcionario['COD_FUNCIONARIO']);

              foreach ($agendamentos as $agendamento) {
                if (isset($agendamento['COD_AGENDAMENTO'])) {




                $data_agendamento = strtotime($agendamento['DATA'] . " " . $agendamento['HORA']);

                $end_date_converted = strtotime('+'.$disponibilidade_funcionario['DURACAO'].' minutes', $data_agendamento);

                $end_date = date('Y-m-d H:i:s', $end_date_converted);

                $end_date = str_replace(" ", "T", $end_date);



                $procedimento = VeterinariaUnimonte\Procedimento::obter_procedimento($agendamento['COD_PROCEDIMENTO']);

                $cliente = VeterinariaUnimonte\Cliente::obter_cliente($agendamento['COD_CLIENTE']);

                $tipo_procedimento = VeterinariaUnimonte\Tipo_procedimento::obter_tipo_procedimento($procedimento['COD_TIPO_PROCEDIMENTO']);
                echo " 
              {
                id: '".$agendamento['COD_AGENDAMENTO']."',
                title: '".$procedimento['DESCRICAO']." (".$tipo_procedimento.") - Cliente: ".$cliente['NOME_CLIENTE']."',
                start: '".$agendamento['DATA']."T".$agendamento['HORA']."',
                end: '".$end_date."',
                url: 'calendario.php?view=".$agendamento['COD_AGENDAMENTO']."'
              }";

              if(next($agendamento) ) {

                echo ", \n";
              }

            }
          }
              ?>
            ]
          }
                                     );
        }
                         );
                         <?php
        }
        ?>
      </script>

      <?php
      } else {


      $agendamento = VeterinariaUnimonte\Agendamento::obter_agendamento($_GET['view']);

      if (isset($agendamento['COD_AGENDAMENTO'])) {



        $disponibilidade_funcionario = VeterinariaUnimonte\Disponibilidade::obter_disponibilidade($agendamento['COD_FUNCIONARIO']);

        $data_agendamento = strtotime($agendamento['DATA'] . " " . $agendamento['HORA']);

        $end_date_converted = strtotime('+'.$disponibilidade_funcionario['DURACAO'].' minutes', $data_agendamento);

        $end_date = date('H:i', $end_date_converted);



        $procedimento = VeterinariaUnimonte\Procedimento::obter_procedimento($agendamento['COD_PROCEDIMENTO']);

        $cliente = VeterinariaUnimonte\Cliente::obter_cliente($agendamento['COD_CLIENTE']);
        $funcionario = VeterinariaUnimonte\Funcionario::obter_funcionario($agendamento['COD_FUNCIONARIO']);

        
        $tipo_procedimento = VeterinariaUnimonte\Tipo_procedimento::obter_tipo_procedimento($procedimento['COD_TIPO_PROCEDIMENTO']);



?>      
        <div class="container" style="margin-top:5%;">
                <div class="jumbotron text-center"><h2><?php echo date("d/m/Y", strtotime($agendamento['DATA'])); ?></h2><p><b><?php echo $funcionario['NOME_FUNCIONARIO']; ?></b></p><?php echo substr($agendamento['HORA'], 0, -3); ?> - <?php echo $end_date; ?><p></b></p>
            <p><a href="calendario.php?id=<?php echo $funcionario['COD_FUNCIONARIO']; ?>">&laquo; Retornar ao Calendário de <?php echo $funcionario['NOME_FUNCIONARIO']; ?></a></p></div>     
          <table class="table table-striped table-bordered" style="width:100%">
              <tbody>
                  <tr>
                    <th>Cadastrado em</th>
                      <td><?php echo date("d/m/Y H:i:s", strtotime($agendamento['CADASTRO'])); ?></td>
                  </tr>
                  <tr>
                  <th>Data</th>
                      <td><?php echo date("d/m/Y", strtotime($agendamento['DATA'])); ?></td>
                  </tr>
                    <th>Início</th>
                      <td><?php echo substr($agendamento['HORA'], 0, -3); ?></td>
                  </tr>
                  <tr>
                    <th>Término</th>
                      <td><?php echo $end_date; ?></td>
                  </tr>
                  <tr>
                    <th>Funcionário</th>
                      <td><?php echo $funcionario['NOME_FUNCIONARIO']; ?></td>
                  </tr>
                  <tr>
                    <th>Cliente</th>
                      <td><?php echo $cliente['NOME_CLIENTE']; ?></td>
                  </tr>
                  <tr>
                    <th>Procedimento</th>
                      <td><?php echo $procedimento['DESCRICAO']; ?></td>
                  </tr>
                  <tr>    <th>Tipo de Procedimento</th>
                  <td><?php echo $tipo_procedimento; ?></td>
                  </tr>
                <tr>
                    <th>Valor</th>
                      <td><?php echo 'R$ '.number_format($procedimento['VALOR_PROCEDIMENTO'], 2, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <th>Jejum</th>
                      <td><?php echo $procedimento['JEJUM']; ?></td>
                  </tr>
                  
                  <tr>
                    <th>Descrição</th>
                      <td><?php echo $procedimento['DESCRICAO']; ?></td>
                  </tr>
                  <tr>
                    <th>Observação</th>
                      <td><?php echo $procedimento['OBSERVACAO']; ?></td>
                  </tr>
                  <tr>
          </tbody>
          </table>


            </div></div>          </div>
            <?php


      
} else {
  echo '<div class="jumbotron text-center"><h2>Agendamento não encontrado</h2>
  <p><a href="calendario.php">&laquo; Retornar a seleção de Calendários</a></p>
  </div>     ';
}
      }
      ?>
  </body>
</html>