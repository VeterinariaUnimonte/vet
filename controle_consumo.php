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
    <title><?php echo $app->name; ?> - Controle Consumo</title>
  </head>
  <body>
    <!-- Navegação -->
    <?php
    $page_id = 6;
    require 'includes/header.php';
    ?>
   <!-- Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
             
            <h1 class="text-center">Controle Consumo</h1>
            <?php
            ?>
            <hr>
			</div>
			<div class="col-lg-12 text-left">
      <?php
      if (isset($_GET['action'])) {
        if ($_GET['action'] == 'add_item') {
          $output = VeterinariaUnimonte\ControleConsumo::adicionar_item_consumo($_POST);
          echo '<br><br>';
        } else if ($_GET['action'] == "remove") {
          $output = VeterinariaUnimonte\ControleConsumo::deletar_item_consumo($_GET['id']);
        }
        switch ($output['status']){
          case true:
            echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> ' . $output['message'] . '</div>';
            break;
          case false:
            echo '<div class="alert alert-danger" role="alert"><i class="fa fa-times"></i> <strong>Error!</strong> ' . $output['message'] . '</div>';
            break;
        }
      }
      ?>
      <table class="table table-bordered">
        <thead style="background-color: white;">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome Item</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Data/Hora</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $consumo = VeterinariaUnimonte\ControleConsumo::obter_consumo();
          foreach($consumo as $item) {
            if (!is_bool($item)) {
            echo '<th scope="row">'.$item['COD_ITEM'].'</th>
            <td>'.$item['NOME_ITEM'].'</td>
            <td>'.$item['QUANTIDADE'].'</td>
            <td>'.$item['timestamp'].'</td>
            <td><a class="btn btn-danger btn-sm" href="?action=remove&id='.$item['COD_ITEM'].'"><i class="fa fa-times" aria-hidden="true"></i> Deletar</a></td>
          </tr>';
            }
          }
          ?>
        </tbody>
      </table>
      <hr>
      <form method="POST" action="controle_consumo.php?&action=add_item">
      <div class="form-group">
              <div class="row">
                <div class="col-lg-8">
                  <label for="NOME_ITEM">Nome Item </label>
                  <input type="text" class="form-control" id="NOME_ITEM" name="NOME_ITEM">
                </div>
                <div class="col-lg-2">
                  <label for="QUANTIDADE">Quantidade </label>
                  <select class="form-control" id="QUANTIDADE" name="QUANTIDADE">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
                </div>
                <div class="col-lg-2">
                <label>Ação</label>
                <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar item</button>
                </div>
              </div>
              </form>    

            <br>
            <br>
			
			</div>
			</div>
			</div>
			</div>
