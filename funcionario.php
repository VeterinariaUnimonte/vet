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
    <title><?php echo $app->name; ?> - Funcionários</title>
  </head>
  <body>
    <!-- Navegação -->
    <?php
    $page_id = 2;
    require 'includes/header.php';
    ?>
    <!-- Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
             
            <h1 class="text-center">Funcionários</h1>
            <?php
            if (isset($_GET['f'])) {
              echo '<div class="text-center"><a href="funcionario.php">&laquo; Retornar a lista de funcionários</a></div>';
            }

            ?>
            <hr>
            <?php

if (!isset($_GET['f'])) {
    echo '<div class="text-center"><a href="?f=cadastrar" class="btn btn-dark">Cadastrar novo Funcionário</a></div>';


    echo '
    <table id="medicos" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Cadastrado em</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Tipo</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            ';
            
            $funcionarios_data = VeterinariaUnimonte\Funcionario::obter_funcionarios();

            foreach ($funcionarios_data as $funcionario) {
            if (isset($funcionario['COD_FUNCIONARIO'])) {
            echo '<tr>
                <td>'.$funcionario['CADASTRO'].'</td>
                <td>'.$funcionario['NOME_FUNCIONARIO'].'</td>
                <td>'.VeterinariaUnimonte\Especialidade::obter_especialidade($funcionario['COD_ESPECIALIDADE']).'</td>
                <td>'.$funcionario['TIPO'].'</td>
                <td>'.$funcionario['TELEFONE'].'</td>
                <td><a class="btn btn-primary btn-sm" href="?f=edit&id='.$funcionario['COD_FUNCIONARIO'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a> <a class="btn btn-danger btn-sm" href="?f=remove&id='.$funcionario['COD_FUNCIONARIO'].'"><i class="fa fa-times" aria-hidden="true"></i> Deletar</a></td>
            </tr>';
            }
          }
      
    echo '</tbody>
        <tfoot>
            <tr>
                <th>Cadastrado em</th>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Tipo</th>
                <th>Telefone</th>
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

    $remover_funcionario = VeterinariaUnimonte\Funcionario::deletar_funcionario($_GET['id']);

    if ($remover_funcionario['status'] == true) {
      echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $remover_funcionario['message'] . '</div>';

    } else if ($remover_funcionario['status'] == false) {
      echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> ' . $remover_funcionario['message'] . '</div>';
    }




  } else if ($_GET['f'] == "edit" and isset($_GET['id'])) {

    $funcionario_data = VeterinariaUnimonte\Funcionario::obter_funcionario($_GET['id']);

    if (isset($funcionario_data['COD_FUNCIONARIO'])) {



      if (isset($_POST['NOME_FUNCIONARIO'])) {


        $funcionario = VeterinariaUnimonte\Funcionario::alterar_funcionario($funcionario_data['COD_FUNCIONARIO'], $_POST);





            
            if ($funcionario['status'] == true) {

              $disponibilidade = VeterinariaUnimonte\Disponibilidade::alterar_disponibilidade($_POST, $funcionario_data['COD_FUNCIONARIO']);

                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $funcionario['message'] . '</div>';
                if ($disponibilidade['status'] == true) {
                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $disponibilidade['message'] . '</div>';
                } else {
                  echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> ' . $disponibilidade['message'] . '</div>';
                }
                
            } else {
                
                echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $funcionario['message'] . '</div>';
            }











        
    } else {
      ?>
      <form method="POST" action="funcionario.php?f=edit&id=<?php echo $_GET['id']; ?>">
      <div class="form-group">
              <label for="nome">Nome do Funcionário <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="NOME_FUNCIONARIO" name="NOME_FUNCIONARIO" placeholder="Ex: Fulano da Silva" value="<?php echo $funcionario_data['NOME_FUNCIONARIO']; ?>">
            </div>
            <div class="form-group">
              <label for="nome">Especialidade <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_ESPECIALIDADE" name="COD_ESPECIALIDADE"> <option disabled>Selecione...</option> 
              <?php
              foreach (VeterinariaUnimonte\Especialidade::obter_especialidades() as $especialidade) { 
              if (isset($especialidade['COD_ESPECIALIDADE'])) {
              echo '<option value="'.$especialidade['COD_ESPECIALIDADE'].'"';
              if ($funcionario_data['COD_ESPECIALIDADE'] == $especialidade['COD_ESPECIALIDADE']) {
                echo ' selected';
              }
              echo '>'.$especialidade['DESCRICAO'].'</option>\n';
              }
              }
              ?>
               </select>
            </div>
            <div class="form-group">
              <label for="cpf">CPF <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="CPF" name="CPF" placeholder="Ex: 999.999.999-99" data-inputmask="'mask': '999.999.999-99'" value="<?php echo $funcionario_data['CPF']; ?>">
            </div>
            <div class="form-group">
              <label for="rg">RG <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="RG" name="RG" placeholder="Ex: 999.999.999" data-inputmask="'mask': '99.999.999-9'" value="<?php echo $funcionario_data['RG']; ?>">
            </div>
              <div class="form-group">
                <label for="TELEFONE">Telefone <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="TELEFONE" name="TELEFONE" placeholder="Ex: (13) 99999-9999" data-inputmask="'mask': '(99) 99999-9999'" value="<?php echo $funcionario_data['TELEFONE']; ?>">
              </div>
              <div class="form-group">
                <label for="Tipo">Tipo <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="TIPO" name="TIPO" placeholder="Ex: Tipo de médico" value="<?php echo $funcionario_data['TIPO']; ?>">
              </div>
              <div class="form-group">
                <label for="EMAIL">Email <span style="color: red;">*</span></label>
                <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Ex: seuemail@victornaweb.com" value="<?php echo $funcionario_data['EMAIL']; ?>">
                </div>
              <br>
              <br>
              <h2>Disponibilidade</h2>

              <?php

              $disponibilidade = VeterinariaUnimonte\Disponibilidade::obter_disponibilidade($funcionario_data['COD_FUNCIONARIO']);
              ?>
              <hr>
              <div class="form-group">
              <label for="DIAS_SEMANA">Dias da Semana <span style="color: red;">*</span>
              <br><br>
              <div class="checkbox">
              
              <label><input type="checkbox" value="0" name="domingo"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "0") > 0) echo " checked"; ?>> Domingo</label> 
              
              <label><input type="checkbox" value="1" name="segunda"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "1") > 0) echo " checked"; ?>> Segunda</label> 
              
              <label><input type="checkbox" value="2" name="terca"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "2") > 0) echo " checked"; ?>> Terça</label> 
              
              <label><input type="checkbox" value="3" name="quarta"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "3") > 0) echo " checked"; ?>> Quarta</label> 
              
              <label><input type="checkbox" value="4" name="quinta"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "4") > 0) echo " checked"; ?>> Quinta</label> 
              
              <label><input type="checkbox" value="5" name="sexta"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "5") > 0) echo " checked"; ?>> Sexta</label> 
              
              <label><input type="checkbox" value="6" name="sabado"<?php if (substr_count($disponibilidade['DIAS_SEMANA'], "6") > 0) echo " checked"; ?>> Sabádo</label></div>
    
              </div>

              <div class="form-group">
                <label for="HORARIOS">Horários <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="HORARIOS" name="HORARIOS" placeholder="Ex: 09:00-12:00, 13:00-17:00" value="09:00-12:00, 13:00-17:00" value="<?php echo $disponibilidade['HORARIOS']; ?>">
              </div>


              <div class="form-group">
              <label for="DURACAO">Duração média de cada atendimento <span style="color: red;">*</span></label>
              <select class="form-control" id="DURACAO" name="DURACAO"> <option disabled>Selecione...</option> 
              <option value="5"<?php if ($disponibilidade['DURACAO'] == 5) echo " selected"; ?>>5 minutos</option>
              <option value="10"<?php if ($disponibilidade['DURACAO'] == 10) echo " selected"; ?>>10 minutos</option>
              <option value="15"<?php if ($disponibilidade['DURACAO'] == 15) echo " selected"; ?>>15 minutos</option>
              <option value="20"<?php if ($disponibilidade['DURACAO'] == 20) echo " selected"; ?>>20 minutos</option>
              <option value="30"<?php if ($disponibilidade['DURACAO'] == 30) echo " selected"; ?>>30 minutos</option>
              <option value="40"<?php if ($disponibilidade['DURACAO'] == 40) echo " selected"; ?>>40 minutos</option>
              <option value="50"<?php if ($disponibilidade['DURACAO'] == 50) echo " selected"; ?>>50 minutos</option>
              <option value="60"<?php if ($disponibilidade['DURACAO'] == 60) echo " selected"; ?>>1 hora</option>
               </select>
            </div>

            <div class="form-group">
              <label for="ATENDER_FERIADOS">Atender em Feriados Nacionais? <span style="color: red;">*</span></label>
              <select class="form-control" id="ATENDER_FERIADOS" name="ATENDER_FERIADOS"> <option disabled>Selecione...</option> 
              <option value="0"<?php if ($disponibilidade['ATENDER_FERIADOS'] == 0) echo " selected"; ?>>Não</option>
              <option value="1"<?php if ($disponibilidade['ATENDER_FERIADOS'] == 1) echo " selected"; ?>>Sim</option>
               </select>
            </div>


             <div class="form-group">
                <label for="EXCECOES">Exceções <span style="color: black;font-weight: 900;">(datas em que o funcionário não estará disponível por emergências ou ocasições especiais)</span></label>
                <input type="text" class="form-control" id="EXCECOES" name="EXCECOES" placeholder="Ex: 05/08/2018, 20/04/2018" value="<?php echo $disponibilidade['EXCECOES']; ?>">
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
            <script src='<?php echo $app->url; ?>/js/conferir_campos2.js'></script>



    <?php
    }
    } else {
      echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> Esse funcionário não existe ou acabou de ser removido.</div>';
    }



    
  } else {
    if ($_GET['f'] == "cadastrar") {
        
        if (isset($_POST['NOME_FUNCIONARIO'])) {

            $funcionario = VeterinariaUnimonte\Funcionario::adicionar_funcionario($_POST);





            
            if ($funcionario['status'] == true) {

              $disponibilidade = VeterinariaUnimonte\Disponibilidade::adicionar_disponibilidade($_POST, $funcionario['funcionario_id']);

                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $funcionario['message'] . '</div>';
                if ($disponibilidade['status'] == true) {
                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $disponibilidade['message'] . '</div>';
                } else {
                  echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> ' . $disponibilidade['message'] . '</div>';
                }
                
            } else {
                
                echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $funcionario['message'] . '</div>';
            }
            echo '<hr><a href="funcionario.php?f=cadastrar">Realizar outro cadastro</a>';
            
        } else {
?>

            <form method="POST" action="funcionario.php?f=cadastrar">
            <div class="form-group">
              <label for="nome">Nome do Funcionário <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="NOME_FUNCIONARIO" name="NOME_FUNCIONARIO" placeholder="Ex: Fulano da Silva">
            </div>
            <div class="form-group">
              <label for="nome">Especialidade <span style="color: red;">*</span></label>
              <select class="form-control" id="COD_ESPECIALIDADE" name="COD_ESPECIALIDADE"> <option disabled selected>Selecione...</option> 
              <?php
              foreach (VeterinariaUnimonte\Especialidade::obter_especialidades() as $especialidade) { 
              if (isset($especialidade['COD_ESPECIALIDADE'])) {
              echo '<option value="'.$especialidade['COD_ESPECIALIDADE'].'">'.$especialidade['DESCRICAO'].'</option>\n';
              }
              }
              ?>
               </select>
            </div>
            <div class="form-group">
              <label for="cpf">CPF <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="CPF" name="CPF" placeholder="Ex: 999.999.999-99" data-inputmask="'mask': '999.999.999-99'">
            </div>
            <div class="form-group">
              <label for="rg">RG <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="RG" name="RG" placeholder="Ex: 999.999.999" data-inputmask="'mask': '99.999.999-9'">
            </div>
              <div class="form-group">
                <label for="TELEFONE">Telefone <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="TELEFONE" name="TELEFONE" placeholder="Ex: (13) 99999-9999" data-inputmask="'mask': '(99) 99999-9999'">
              </div>
              <div class="form-group">
                <label for="Tipo">Tipo <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="TIPO" name="TIPO" placeholder="Ex: Tipo de médico">
              </div>
              <div class="form-group">
                <label for="EMAIL">Email <span style="color: red;">*</span></label>
                <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Ex: seuemail@victornaweb.com">
              </div>
              <br>
              <br>
              <h2>Disponibilidade</h2>
              <hr>
              <div class="form-group">
              <label for="DIAS_SEMANA">Dias da Semana <span style="color: red;">*</span>
              <br><br>
              <div class="checkbox"><label><input type="checkbox" value="0" name="domingo"> Domingo</label> <label><input type="checkbox" value="1" name="segunda" checked> Segunda</label> <label><input type="checkbox" value="2" name="terca" checked> Terça</label> <label><input type="checkbox" value="3" name="quarta" checked> Quarta</label> <label><input type="checkbox" value="4" name="quinta" checked> Quinta</label> <label><input type="checkbox" value="5" name="sexta" checked> Sexta</label> <label><input type="checkbox" value="6" name="sabado"> Sabádo</label></div>
    
              </div>

              <div class="form-group">
                <label for="HORARIOS">Horários <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="HORARIOS" name="HORARIOS" placeholder="Ex: 09:00-12:00, 13:00-17:00" value="09:00-12:00, 13:00-17:00">
              </div>


              <div class="form-group">
              <label for="DURACAO">Duração média de cada atendimento <span style="color: red;">*</span></label>
              <select class="form-control" id="DURACAO" name="DURACAO"> <option disabled>Selecione...</option> 
              <option value="5">5 minutos</option>
              <option value="10">10 minutos</option>
              <option value="15">15 minutos</option>
              <option value="20">20 minutos</option>
              <option value="30" selected>30 minutos</option>
              <option value="40">40 minutos</option>
              <option value="50">50 minutos</option>
              <option value="60">1 hora</option>
               </select>
            </div>

            <div class="form-group">
              <label for="ATENDER_FERIADOS">Atender em Feriados Nacionais? <span style="color: red;">*</span></label>
              <select class="form-control" id="ATENDER_FERIADOS" name="ATENDER_FERIADOS"> <option disabled>Selecione...</option> 
              <option value="0" selected>Não</option>
              <option value="1">Sim</option>
               </select>
            </div>


             <div class="form-group">
                <label for="EXCECOES">Exceções <span style="color: black;font-weight: 900;">(datas em que o funcionário não estará disponível por emergências ou ocasições especiais)</span></label>
                <input type="text" class="form-control" id="EXCECOES" name="EXCECOES" placeholder="Ex: 05/08/2018, 20/04/2018">
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
            <script src='<?php echo $app->url; ?>/js/conferir_campos2.js'></script>
<?php
}
}
}
?>
            <script src='<?php echo $app->url; ?>/vendor/robinherbots/jquery.inputmask/dist/jquery.inputmask.bundle.js'></script>
            <script>$(document).ready(function() {$(":input").inputmask();});</script>
  </body>
</html>
    
