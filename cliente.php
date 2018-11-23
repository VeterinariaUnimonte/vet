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
    <title><?php echo $app->name; ?> - Clientes</title>
  </head>
  <body>
    <!-- Navegação -->
    <?php
    $page_id = 1;
    require 'includes/header.php';
    ?>
    <!-- Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
             
            <h1 class="text-center">Clientes</h1>
            <?php
            if (isset($_GET['f'])) {
              echo '<div class="text-center"><a href="cliente.php">&laquo; Retornar a lista de clientes</a></div>';
            }

            ?>
            <hr>
            <?php

if (!isset($_GET['f'])) {
    echo '<div class="text-center"><a href="?f=cadastrar" class="btn btn-dark">Cadastro novo Cliente</a></div>';


    echo '
    <table id="clientes" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Cadastrado em</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Pets</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            ';
            
            $clientes_data = VeterinariaUnimonte\Cliente::obter_clientes();

            foreach ($clientes_data as $cliente) {
            if (isset($cliente['COD_CLIENTE'])) {
            echo '<tr>
                <td>'.$cliente['CADASTRO'].'</td>
                <td>'.$cliente['NOME_CLIENTE'].'</td>
                <td>'.$cliente['CPF'].'</td>
                <td>'.$cliente['TELEFONE'].'</td>
                <td>'.VeterinariaUnimonte\Animal::total_de_animais($cliente['COD_CLIENTE']).'</td>
                <td><a class="btn btn-primary btn-sm" href="?f=edit&id='.$cliente['COD_CLIENTE'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a> <a class="btn btn-danger btn-sm" href="?f=remove&id='.$cliente['COD_CLIENTE'].'"><i class="fa fa-times" aria-hidden="true"></i> Deletar</a></td>
            </tr>';
            }
          }
      
    echo '</tbody>
        <tfoot>
            <tr>
                <th>Cadastrado em</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Pets</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
    <br><br>
    <link rel="stylesheet" href="'.$app->url.'/vendor/datatables/datatables/media/css/dataTables.bootstrap4.min.css">
          <script src="'.$app->url.'/vendor/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
          <script src="'.$app->url.'/vendor/datatables/datatables/media/js/dataTables.bootstrap4.min.js"></script>

          <script>$(document).ready(function() {
            $("#clientes").DataTable({
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

    $remover_cliente = VeterinariaUnimonte\Cliente::deletar_cliente($_GET['id']);

    if ($remover_cliente['status'] == true) {
      echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $remover_cliente['message'] . '</div>';

    } else if ($remover_cliente['status'] == false) {
      echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> ' . $remover_cliente['message'] . '</div>';
    }




  } else if ($_GET['f'] == "edit" and isset($_GET['id'])) {

    $cliente_data = VeterinariaUnimonte\Cliente::obter_cliente($_GET['id']);

    if (isset($cliente_data['COD_CLIENTE'])) {



      if (isset($_POST['NOME_CLIENTE'])) {
        $dados_cliente = array();
        $dados_animais = array();
        foreach ($_POST as $key => $value) {
            
            if (!is_array($value)) {
                $dados_cliente[$key] = $value;
            } else {
                $x = 0;
                foreach ($value as $value2) {
                    $dados_animais[$x][$key] = $value2;
                }
                $x++;
                
            }
            
        }
        
        
        $cliente = VeterinariaUnimonte\Cliente::alterar_cliente($cliente_data['COD_CLIENTE'], $dados_cliente);
        
        if ($cliente['status'] == true) {
            echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $cliente['message'] . '</div>';
            foreach ($dados_animais as $animal_info) {
                VeterinariaUnimonte\Animal::deletar_animal_cliente($cliente_data['COD_CLIENTE']);
                $animal = VeterinariaUnimonte\Animal::adicionar_animal($cliente_data['COD_CLIENTE'], $animal_info);
                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> Animais alterados com sucesso</div>';
            }
            
        } else {
            
            echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $cliente['message'] . '</div>';
        }
        
    } else {
      ?>
      <form method="POST" action="cliente.php?f=edit&id=<?php echo $_GET['id']; ?>">
            <div class="form-group">
              <label for="nome">Nome do Proprietário <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="NOME_CLIENTE" name="NOME_CLIENTE" placeholder="Ex: Fulano da Silva" value="<?php echo $cliente_data['NOME_CLIENTE']; ?>">
            </div>
            <div class="form-group">
              <label for="cpf">CPF <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="CPF" name="CPF" placeholder="Ex: 999.999.999-99" data-inputmask="'mask': '999.999.999-99'" value="<?php echo $cliente_data['CPF']; ?>">
            </div>
            <div class="form-group">
              <label for="rg">RG <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="RG" name="RG" placeholder="Ex: 99.999.999-9" data-inputmask="'mask': '99.999.999-9'" value="<?php echo $cliente_data['RG']; ?>">
            </div>
            <div class="form-group">
              <label for="CEP">CEP <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="CEP" name="CEP" placeholder="Ex: 99.999.999-9" data-inputmask="'mask': '99999-999'" value="<?php echo $cliente_data['CEP']; ?>">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3">
                  <label for="cidade">Cidade <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="CIDADE" name="CIDADE" value="<?php echo $cliente_data['CIDADE']; ?>">
                </div>
                <div class="col-lg-1">
                  <label for="estado">Estado <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="UF" name="UF" value="<?php echo $cliente_data['UF']; ?>">
                </div>
                <div class="col-lg-4">
                  <label for="bairro">Bairro <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="BAIRRO" name="BAIRRO" value="<?php echo $cliente_data['BAIRRO']; ?>">
                </div>
                <?php
                $split_endereco = preg_split("/\s+(?=\S*+$)/",$cliente_data['ENDERECO']);
                ?>
                <div class="col-lg-3">
                  <label for="endereco">Rua <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="RUA" name="RUA" value="<?php echo $split_endereco[0]; ?>">
                </div>
                <div class="col-lg-1">
                  <label for="numero">nº <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="NUMERO" name="NUMERO" value="<?php echo $split_endereco[1]; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TELEFONE">Celular <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="TELEFONE" name="TELEFONE" placeholder="Ex: (13) 99999-9999" data-inputmask="'mask': '(99) 99999-9999'" value="<?php echo $cliente_data['TELEFONE']; ?>">
              </div>
              <div class="form-group">
                <label for="EMAIL">Email <span style="color: red;">*</span></label>
                <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Ex: seuemail@victornaweb.com" value="<?php echo $cliente_data['EMAIL']; ?>">
              </div>
              <br>
              <h3>Informações do Animal</h3>
              <hr>
              <div id="animais"></div>
              <div class="text-right">
                <a class="btn btn-primary" onclick="addAnimal();" style="pointer: cursor; color: white;"><i class="fa fa-plus" aria-hidden="true"></i> Novo animal</a>
              </div>
            </div>
            <hr>
            <div class="text-left">
              <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Dados</button>
            </div>
            <div id="error_message" style="margin-top: 2%;"></div>
            </div>
            </form>
            </div>
            <br><br>
            <script src='<?php echo $app->url; ?>/js/animal.js'></script>
            <script>
            <?php
            $cliente_animais = VeterinariaUnimonte\Animal::obter_animais($cliente_data['COD_CLIENTE']);

             
            foreach ($cliente_animais as $animal) {
              if (isset($animal['COD_PET'])) {
                echo "EditAnimal('".$animal['NOME_PET']."', '".$animal['TIPO']."', '".$animal['RACA']."', '".$animal['SEXO']."', '".$animal['IDADE']."', '".$animal['PELAGEM']."');";
              }
              }

            ?>
            </script>
            <script src='<?php echo $app->url; ?>/js/conferir_campos.js'></script>



    <?php
    }
    } else {
      echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> Esse cliente não existe ou acabou de ser removido.</div>';
    }



    
  } else {
    if ($_GET['f'] == "cadastrar") {
        
        if (isset($_POST['NOME_CLIENTE'])) {
            $dados_cliente = array();
            $dados_animais = array();
            foreach ($_POST as $key => $value) {
                
                if (!is_array($value)) {
                    $dados_cliente[$key] = $value;
                } else {
                    $x = 0;
                    foreach ($value as $value2) {
                        $dados_animais[$x][$key] = $value2;
                    }
                    $x++;
                    
                }
                
            }
            
            
            $cliente = VeterinariaUnimonte\Cliente::adicionar_cliente($dados_cliente);
            
            if ($cliente['status'] == true) {
                echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $cliente['message'] . '</div>';
                foreach ($dados_animais as $animal_info) {
                    $animal = VeterinariaUnimonte\Animal::adicionar_animal($cliente['cliente_id'], $animal_info);
                    echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $animal['message'] . '</div>';
                }
                
            } else {
                
                echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $cliente['message'] . '</div>';
            }
            echo '<hr><a href="cliente.php?f=cadastrar">Realizar outro cadastro</a>';
            
        } else {
?>

            <form method="POST" action="cliente.php?f=cadastrar">
            <div class="form-group">
              <label for="nome">Nome do Proprietário <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="NOME_CLIENTE" name="NOME_CLIENTE" placeholder="Ex: Fulano da Silva">
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
              <label for="cep">CEP <span style="color: red;">*</span></label>
              <input type="text" class="form-control" id="CEP" name="cep" placeholder="Ex: 99999-999" data-inputmask="'mask': '99999-999'">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3">
                  <label for="cidade">Cidade <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="CIDADE" name="CIDADE" disabled>
                </div>
                <div class="col-lg-1">
                  <label for="estado">Estado <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="UF" name="UF" disabled>
                </div>
                <div class="col-lg-4">
                  <label for="bairro">Bairro <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="BAIRRO" name="BAIRRO" disabled>
                </div>
                <div class="col-lg-3">
                  <label for="endereco">Rua <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="RUA" name="RUA" disabled>
                </div>
                <div class="col-lg-1">
                  <label for="numero">nº <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="NUMERO" name="NUMERO" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="TELEFONE">Celular <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="TELEFONE" name="TELEFONE" placeholder="Ex: (13) 99999-9999" data-inputmask="'mask': '(99) 99999-9999'">
              </div>
              <div class="form-group">
                <label for="EMAIL">Email <span style="color: red;">*</span></label>
                <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Ex: seuemail@victornaweb.com">
              </div>
              <br>
              <h3>Informações do Animal</h3>
              <hr>
              <div id="animais"></div>
              <div class="text-right">
                <a class="btn btn-primary" onclick="addAnimal();" style="pointer: cursor; color: white;"><i class="fa fa-plus" aria-hidden="true"></i> Novo animal</a>
              </div>
            </div>
            <hr>
            <div class="text-left">
              <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Dados</button>
            </div>
            <div id="error_message" style="margin-top: 2%;"></div>
            </div>
            </form>
            </div>
            <br><br>
            <script src='<?php echo $app->url; ?>/js/animal.js'></script>
            <script>addAnimal();</script>
            <script src='<?php echo $app->url; ?>/js/conferir_campos.js'></script>
<?php
}
}
}
?>
            <script src='<?php echo $app->url; ?>/vendor/robinherbots/jquery.inputmask/dist/jquery.inputmask.bundle.js'></script>
            <script>$(document).ready(function() {$(":input").inputmask();});</script>
  </body>
</html>
    
