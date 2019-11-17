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
    $page_id = 7;
    require 'includes/header.php';
    ?>
    <!-- Container -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <br>

                <h1 class="text-center">Exame Fisico</h1>
                <?php
                                                ?>
                <hr>
            </div>

            <div class="col-lg-12 text-center">
            <p>Quarta-Feira 06/11/2019 22:44</p>
        


            <div style="text-align: left;" class="form-group">
          <label for="COD_CLIENTE">Cliente Agendado<span style="color: red;">*</span></label>
          <select class="form-control" id="COD_CLIENTE" name="COD_CLIENTE" disabled> 
           </select>
        </div>

            <div class="col-lg-12 text-center">
                <p></p>

            </div>

            <!-- CONTEUDO -->

            <div style="text-align: left;" class="form-group">

                <table style="text-align: left; border-spacing: 5px;" class="" border="0">
                    <tr>
                        <td class="">Mucosas: </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>Hidratação: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Linfonodos: </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                    </tr>
                      
                    <tr>
                        <td>Temperatura: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                      
                    <tr>
                        <td>Palpação Abd.: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                      
                    <tr>
                        <td>ACP: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                      
                    <tr>
                        <td>Postura: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                      
                    <tr>
                        <td>Consciência: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                      
                    <tr>
                        <td>Obs Gerais: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>

                    <tr>
                        <td>Exames Comp.: </td>
                        <td>
                            <input  class="form-control" type="text">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Diagnostico </td>
                        <td>
                            <input placeholder="" size="70%" class="form-control" type="text">
                        </td>
                    </tr>
                    

            </div>
        </div></table><br>
            <!-- TABLE ABAIXO-->
 

                <div style="text-align: left;" class="form-group">
                    <label>Tratamento: </label><br>

                    <textarea name="" id="" cols="100%" rows="5"></textarea>
                </div>

                <div style="text-align: left;" class="form-group">
                    <label>Prescrito: </label><br>

                    <textarea name="" id="" cols="100%" rows="5"></textarea>
                </div>

            </div>
            <!--Botão de Ficha Fisica -->
            <div class="text-right">
                <a class="btn btn-primary" style="pointer: cursor; color: white;"><i class="fa fa-plus"
                        aria-hidden="true"></i> Salvar e retornar para Ficha de Atendimento</a>





                <!--#Botão de Ficha Fisica -->
            </div>
            <hr>
            <!-- Botão de Salvar os Dados-->
            <div class="text-left">
                <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o"
                        aria-hidden="true"></i>
                    Salvar Dados</button>
            </div>
            <div id="error_message" style="margin-top: 2%;"></div>
        </div>
        </form>









    <div id="error_message" style="margin-top: 2%;"></div>
    </div>
    </form>
    </div>
    <br>
    <br>
    </div>
    </div>
    </div>
    </div>