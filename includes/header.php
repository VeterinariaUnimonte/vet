<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo $app->url; ?>/index.php"><?php echo $app->name; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item<?php if ($page_id == 1) echo " active"; ?>">
              <a class="nav-link" href="<?php echo $app->url; ?>/cliente.php">Clientes</a>
            </li>
            <li class="nav-item<?php if ($page_id == 2) echo " active"; ?>">
              <a class="nav-link" href="<?php echo $app->url; ?>/funcionario.php">Funcionários</a>
            </li>
            <li class="nav-item<?php if ($page_id == 3) echo " active"; ?>">
              <a class="nav-link" href="<?php echo $app->url; ?>/calendario_select.php">Calendário</a>
            </li>
            <li class="nav-item<?php if ($page_id == 4) echo " active"; ?>">
              <a class="nav-link" href="<?php echo $app->url; ?>/agendamento.php">Agendamento</a>
            </li>

            <li class="nav-item<?php if ($page_id == 5) echo " active"; ?>">
              <a class="nav-link" href="<?php echo $app->url; ?>/procedimento.php">Procedimentos</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
