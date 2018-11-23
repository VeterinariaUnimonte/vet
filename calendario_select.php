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
    <title><?php echo $app->name; ?> - Calendário</title>
  </head>
  <body>
    <!-- Navegação -->
    <?php
    $page_id = 3;
    require 'includes/header.php';
    ?>
    <!-- Container -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
             
            <h1 class="text-center">Selecione um calendário</h1>
            <?php
            ?>
            <hr>
			</div>
			<div class="col-lg-3"></div>
			<div class="col-lg-9">
            <ul>
      <?php
      foreach (VeterinariaUnimonte\Funcionario::obter_funcionarios() as $funcionario) {
      if (isset($funcionario['COD_FUNCIONARIO'])) {
			echo '<li><a href="calendario.php?id='.$funcionario['COD_FUNCIONARIO'].'">'.$funcionario['NOME_FUNCIONARIO'].' <b>('.VeterinariaUnimonte\Especialidade::obter_especialidade($funcionario['COD_ESPECIALIDADE']).')</b></a></li>';
      }
    }
      ?>

			</ul>
			
            <br>
            <br>
			
			</div>
			</div>
			</div>
	</body>
</html>
