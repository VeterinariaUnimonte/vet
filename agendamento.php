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
    <title><?php echo $app->name; ?> - Agendamento</title>
  </head>
  <body>
    <!-- Navegação -->
    <?php
    $page_id = 4;
    require 'includes/header.php';
    ?>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
             
            <h1 class="text-center">Agendamento</h1>
            <?php
            if (isset($_POST['HORA'])) {
              echo '<div class="text-center"><a href="agendamento.php">&laquo; Calendário</a></div>';
            }

            ?>
            <hr>
            <?php

        
        if (isset($_POST['HORA'])) {



            $agendamento = VeterinariaUnimonte\Agendamento::adicionar_agendamento($_POST);





            
            if ($agendamento['status'] == true) {


                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $agendamento['message'] . '</div>';
               
                
            } else {
                
                echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $agendamento['message'] . '</div>';
            }
            echo '<hr><a href="agendamento.php">Realizar outro agendamento</a>';
            
        } else {
?>

            <form method="POST" action="agendamento.php">
            <div class="form-group">
              <label for="COD_TIPO_PROCEDIMENTO">Tipo de Procedimento <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_TIPO_PROCEDIMENTO" name="COD_TIPO_PROCEDIMENTO"> 

              <option disabled selected>Selecione...</option> 
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
              <label for="COD_PROCEDIMENTO">Procedimento <span style="color: red;">*</span></label>
              <select class="form-control" name= "COD_PROCEDIMENTO" id="COD_PROCEDIMENTO" disabled> 
               </select>
            </div>


            <div class="form-group">
              <label for="COD_FUNCIONARIO">Funcionário <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_FUNCIONARIO" name="COD_FUNCIONARIO" disabled>  
               </select>
            </div>


            <div class="form-group">
              <label for="COD_CLIENTE">Cliente <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_CLIENTE" name="COD_CLIENTE" disabled> 
               </select>
            </div>




            <div class="form-group">
              <label for="DATA">Data <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="DATA" name="DATA" data-inputmask="'mask': '99/99/9999'" disabled>
              <div id="suporte"></div>
            </div>
            <div class="form-group">
              <label for="HORA">Selecione um Horário <span style="color: red;">*</span></label>
              <select class="form-control" id="HORA" name="HORA" disabled> 
               </select>
            </div>
              <hr>
            <div class="text-right">
              <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Agendar Horário</button>
            </div>
            <div id="error_message" style="margin-top: 2%;"></div>

            </div>
            
            </div>
            </form>
            </div>
            <br><br>
            <script src='<?php echo $app->url; ?>/js/agendamento.js'></script>
            <script src='<?php echo $app->url; ?>/js/conferir_campos4.js'></script>
<?php
}
?>
            <script src='<?php echo $app->url; ?>/vendor/robinherbots/jquery.inputmask/dist/jquery.inputmask.bundle.js'></script>
            <script>$(document).ready(function() {$(":input").inputmask();});</script>
  </body>
</html>
    
