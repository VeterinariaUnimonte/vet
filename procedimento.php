<?php
require 'vendor/autoload.php';

$app = new VeterinariaUnimonte\App;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    require 'includes/global.php';
    ?>

    
    <script src="<?php echo $app->url; ?>/js/jquery.maskMoney.min.js" type="text/javascript"></script>
    <title><?php echo $app->name; ?> - Procedimentos</title>
  </head>
  <body>
    <!-- Navegação -->
    <?php
    $page_id = 5;
    require 'includes/header.php';
    ?>
   <!-- Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
             
            <h1 class="text-center">Procedimentos</h1>
            <?php
            if (isset($_GET['f'])) {
              echo '<div class="text-center"><a href="procedimento.php">&laquo; Retornar a lista de procedimentos</a></div>';
            }

            ?>
            <hr>
            <?php

if (!isset($_GET['f'])) {
    echo '<div class="text-center"><a href="?f=cadastrar" class="btn btn-dark">Cadastrar novo Procedimento</a></div>';


    echo '
    <table id="medicos" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Tipo de Procedimento</th>
                <th>Jejum</th>
                <th>Valor do Procedimento</th>
                <th>OBS</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            ';
            
            $procedimentos_data = VeterinariaUnimonte\Procedimento::obter_procedimentos();
            foreach ($procedimentos_data as $procedimento) {
            if (isset($procedimento['COD_PROCEDIMENTO'])) {
            echo '<tr>
                <td>'.$procedimento['DESCRICAO'].'</td>
                <td>'.VeterinariaUnimonte\Tipo_procedimento::obter_tipo_procedimento($procedimento['COD_TIPO_PROCEDIMENTO']).'</td>
                <td>'.$procedimento['JEJUM'].'</td>
                <td>R$ '.number_format($procedimento['VALOR_PROCEDIMENTO'], 2, ',', '.').'</td>
                <td>'.$procedimento['OBSERVACAO'].'</td>
                <td><a class="btn btn-primary btn-sm" href="?f=edit&id='.$procedimento['COD_PROCEDIMENTO'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a> <a class="btn btn-danger btn-sm" href="?f=remove&id='.$procedimento['COD_PROCEDIMENTO'].'"><i class="fa fa-times" aria-hidden="true"></i> Deletar</a></td>
            </tr>';
            }
          }
      
    echo '</tbody>
        <tfoot>
            <tr>
            <th>Descrição</th>
                <th>Tipo de Procedimento</th>
                <th>Jejum</th>
                <th>Valor do Procedimento</th>
                <th>OBS</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
    <br><br>
    <link rel="stylesheet" href="'.$app->url.'/vendor/datatables/datatables/media/css/dataTables.bootstrap4.min.css">
          <script src="'.$app->url.'/vendor/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
          <script src="'.$app->url.'/vendor/datatables/datatables/media/js/dataTables.bootstrap4.min.js"></script>

          <script>$(document).ready(function() {
            $("#medicos").DataTable({
              "language": {
                "sEmptyTable":   "Nenhum registro encontrado",
                "sProcessing":   "A processar...",
                "sLengthMenu":   "Mostrar _MENU_ registos",
                "sZeroRecords":  "Não foram encontrados resultados",
                "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registos",
                "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
                "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
                "sInfoPostFix":  "",
                "sSearch":       "Procurar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Seguinte",
                    "sLast":     "Último"
                },
                "oAria": {
                    "sSortAscending":  ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
              }
          });
        } );</script>';
  } else if ($_GET['f'] == "remove" and isset($_GET['id'])) {

    $remover_procedimento = VeterinariaUnimonte\Procedimento::deletar_procedimento($_GET['id']);

    if ($remover_procedimento['status'] == true) {
      echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $remover_procedimento['message'] . '</div>';

    } else if ($remover_procedimento['status'] == false) {
      echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> ' . $remover_procedimento['message'] . '</div>';
    }




  } else if ($_GET['f'] == "edit" and isset($_GET['id'])) {

    $procedimento_data = VeterinariaUnimonte\Procedimento::obter_procedimento($_GET['id']);

    if (isset($procedimento_data['COD_PROCEDIMENTO'])) {

      if (isset($_POST['DESCRICAO'])) {


        $procedimento = VeterinariaUnimonte\Procedimento::alterar_procedimento($procedimento_data['COD_PROCEDIMENTO'], $_POST);





            
            if ($procedimento['status'] == true) {
              
              echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $procedimento['message'] . '</div>';
            } else {
                
                echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $procedimento['message'] . '</div>';
            }











        
    } else {
      ?>
      <form method="POST" action="procedimento.php?f=edit&id=<?php echo $_GET['id']; ?>">
      <div class="form-group">
              <label for="nome">Descrição do Procedimento <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="DESCRICAO" name="DESCRICAO" placeholder="Ex: Castração" value="<?php echo $procedimento_data['DESCRICAO']; ?>">
            </div>
            <div class="form-group">
              <label for="COD_TIPO_PROCEDIMENTO">Tipo de Procedimento <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_TIPO_PROCEDIMENTO" name="COD_TIPO_PROCEDIMENTO"> <option disabled>Selecione...</option> 
              <?php
              foreach (VeterinariaUnimonte\Tipo_procedimento::obter_tipo_procedimentos() as $tipo_procedimento) { 
              if (isset($tipo_procedimento['COD_TIPO_PROCEDIMENTO'])) {
              echo '<option value="'.$tipo_procedimento['COD_TIPO_PROCEDIMENTO'].'"';
              if ($procedimento_data['COD_TIPO_PROCEDIMENTO'] == $tipo_procedimento['COD_TIPO_PROCEDIMENTO']) {
                echo ' selected';
              }
              echo '>'.$tipo_procedimento['DESCRICAO'].'</option>\n';
              }
              }
              ?>
               </select>
            </div>
            <div class="form-group">
              <label for="JEJUM">Jejum? <span style="color: red;">*</span></label>
              <select class="form-control" id="JEJUM" name="JEJUM"> 
              <option disabled>Selecione...</option> 
              <option value="Sim"<?php if ($procedimento_data['JEJUM'] == "Sim") echo " selected"; ?>>Sim</option>
              <option value="Não"<?php if ($procedimento_data['JEJUM'] == "Não") echo " selected"; ?>>Não</option>
              </select>
            </div>
            <div class="form-group">
              <label for="VALOR_PROCEDIMENTO">Valor Procedimento <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="VALOR_PROCEDIMENTO" name="VALOR_PROCEDIMENTO" data-thousands="." placeholder="Ex: R$ 80,00" data-decimal="," data-prefix="R$ " value="<?php echo 'R$ '. number_format($procedimento_data['VALOR_PROCEDIMENTO'], 2, ',', '.'); ?>" />
            </div>
              <div class="form-group">
                <label for="OBSERVACAO">Observação <span style="color: red;">*</span></label>
                <textarea class="form-control" id="OBSERVACAO" name="OBSERVACAO" placeholder="Descreva uma observação (se necessário)..."><?php echo $procedimento_data['OBSERVACAO']; ?></textarea>
              </div>
              <hr>
            <div class="text-right">
              <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Dados</button>
            </div>
            <div id="error_message" style="margin-top: 2%;"></div>

            </div>
            
            </div>
            </form>
            </div>
            <br><br>
            <script src='<?php echo $app->url; ?>/js/conferir_campos3.js'></script>



    <?php
    }
    } else {
      echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> Esse funcionário não existe ou acabou de ser removido.</div>';
    }



    
  } else {
    if ($_GET['f'] == "cadastrar") {
        
        if (isset($_POST['DESCRICAO'])) {
            $procedimento = VeterinariaUnimonte\Procedimento::adicionar_procedimento($_POST);





            
            if ($procedimento['status'] == true) {

             
                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $procedimento['message'] . '</div>';
  
            } else {
                
                echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $procedimento['message'] . '</div>';
            }
            echo '<hr><a href="procedimento.php?f=cadastrar">Realizar outro cadastro</a>';
            
        } else {
?>

            <form method="POST" action="procedimento.php?f=cadastrar">
            <div class="form-group">
              <label for="nome">Descrição do Procedimento <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="DESCRICAO" name="DESCRICAO" placeholder="Ex: Castração">
            </div>
            <div class="form-group">
              <label for="COD_TIPO_PROCEDIMENTO">Tipo de Procedimento <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_TIPO_PROCEDIMENTO" name="COD_TIPO_PROCEDIMENTO"> <option disabled selected>Selecione...</option> 
              <?php
              foreach (VeterinariaUnimonte\Tipo_procedimento::obter_tipo_procedimentos() as $tipo_procedimento) { 
              if (isset($tipo_procedimento['COD_TIPO_PROCEDIMENTO'])) {
              echo '<option value="'.$tipo_procedimento['COD_TIPO_PROCEDIMENTO'].'">'.$tipo_procedimento['DESCRICAO'].'</option>\n';
              }
              }
              ?>
               </select>
            </div>
            <div class="form-group">
              <label for="JEJUM">Jejum? <span style="color: red;">*</span></label>
              <select class="form-control" id="JEJUM" name="JEJUM"> 
              <option disabled selected>Selecione...</option> 
              <option value="Sim">Sim</option>
              <option value="Não">Não</option>
              </select>
            </div>
            <div class="form-group">
              <label for="VALOR_PROCEDIMENTO">Valor Procedimento <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="VALOR_PROCEDIMENTO" name="VALOR_PROCEDIMENTO" data-thousands="." placeholder="Ex: R$ 80,00" data-decimal="," data-prefix="R$ " />
            </div>
              <div class="form-group">
                <label for="OBSERVACAO">Observação <span style="color: red;">*</span></label>
                <textarea class="form-control" id="OBSERVACAO" name="OBSERVACAO" placeholder="Descreva uma observação (se necessário)..."></textarea>
              </div>
              <hr>
            <div class="text-right">
              <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Dados</button>
            </div>
            <div id="error_message" style="margin-top: 2%;"></div>

            </div>
            
            </div>
            </form>
            </div>
            <br><br>
            <script src='<?php echo $app->url; ?>/js/conferir_campos3.js'></script>
<?php
}
}
}
?>
            <script src='<?php echo $app->url; ?>/vendor/robinherbots/jquery.inputmask/dist/jquery.inputmask.bundle.js'></script>
            <script>$(document).ready(function() {
              $('#VALOR_PROCEDIMENTO').maskMoney();
              $(".mask").inputmask();
  
              });</script>
  </body>
</html>
    
