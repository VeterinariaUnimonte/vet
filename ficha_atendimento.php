<?php
require 'vendor/autoload.php';

$app = new VeterinariaUnimonte\App;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'includes/global.php';?>
    <title><?php echo $app->name; ?> - Ficha de Atendimento</title>
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

                <h1 class="text-center">Ficha de Atendimento</h1>
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

            <form method="POST" action="cliente.php?f=edit&id=<?php echo $_GET['id']; ?>">

                <div style="text-align: left;" class="form-group">
                    <label for="nome">Queixa principal(problema, duração, frequencia, tratamento utilizado, resposta ao
                        tratamento) <span style="color: red;">*</span></label>
                    <textarea type="text" style="height: 100px; text-align: initial;" class="form-control" id="queixa"
                        name="QUEIXA" placeholder="Ex: Fulano da Silva"
                        value="<?php echo $cliente_data['NOME_CLIENTE']; ?>"> </textarea>
                </div>
                <div style="text-align: left;" class="form-group">
                    <label >Manejo <span style="color: red;">*</span></label>
                    
                    
                    <table style="text-align: left; border-spacing: 5px;" class="form-control" border="0">
                        <tr>
                            <td class="tdColuna">Dieta </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Caseira
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Ração
                            </td>
                            <td>
                                <input placeholder="Frequencia" class="form-control" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Banhos </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Em casa
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Pet shop
                            </td>
                            <td>
                                <input placeholder="Frequencia/Produto" class="form-control" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Parasitas </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Pulgas
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Carrapatos
                            </td>
                            <td>
                                <input placeholder="Preventivo?" class="form-control" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Passeios </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sozinho
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Acompanhado
                            </td>
                            <td>
                                <input placeholder="Frequencia" class="form-control" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Castrado </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sim
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Não
                            </td>
                            <td class="tdEspaco">
                                <input placeholder="Há quanto tempos?" class="form-control" type="text">
                            </td>
                        </tr>
                    </table>
                </div>
                <table style="text-align: left; border-spacing: 5px;" class="form-control" border="0">
                <div class="form-group">
                    
                        <tr>
                            <td>
                                Antecedentes Mórbidos:
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sim
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Não
                            </td>
                            <td class="tdEspaco">
                                <input placeholder="Quais" class="form-control" type="text">
                            </td>
                        </tr>
                    
                </div>
                <div class="form-group">
                    
                        <tr>
                            <td>
                                Procedimentos Cirurgicos Prévio?
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sim
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Não
                            </td>
                            <td class="tdEspaco">
                                <input placeholder="Quais" class="form-control" type="text">
                            </td>
                        </tr>
                   
                </div>
                <div class="form-group">
                    
                        <tr>
                            <td>
                                Tratamentos Medicações Atuais?
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sim
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Não
                            </td>
                            <td>
                                <input placeholder="Quais" class="form-control" type="text">
                            </td>
                        </tr>
                   
                </div>
                <div class="form-group">
                    
                        <tr>
                            <td>
                                Transfusão Sanguinea Prévia?
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sim
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Não
                            </td>
                        </tr>
                   
                </div>
                <div class="form-group">
                    
                        <tr>
                            <td>
                                Gestação Prévia?
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Sim
                            </td>
                            <td>
                                <input type="checkbox" id="" nome=""> Não
                            </td>
                            <td class="tdEspaco">
                                <input placeholder="Ultimo Ciclo" class="form-control" type="text">
                            </td>
                        </tr>
                   </table>
                

                









































































                <div  style="text-align: left;" class="form-group">
                    <label>Marque as alterações que o animal apresenta ou já apresentou: <span
                            style="color: red;">*</span></label>
                    
                            <table style="text-align: left; border-spacing: 5px;" class="form-control" border="0">
                        <tr>
                            <td> <input type="checkbox" id="" nome=""> Convulsão </td>
                            <td> <input type="checkbox" id="" nome=""> Sincope </td>
                            <td><input type="checkbox" id="" nome=""> Cansaço </td>
                            <td><input type="checkbox" id="" nome=""> Tosse</td>
                        </tr>
                        <tr>
                            <td> <input type="checkbox" id="" nome=""> Espirros </td>
                            <td> <input type="checkbox" id="" nome=""> Cianose </td>
                            <td><input type="checkbox" id="" nome=""> Pulgas</td>
                            <td><input type="checkbox" id="" nome=""> Carrapatos</td>
                        </tr>
                    </table><br><br><br>  
                </div>
                
            </div>
                <!--Botão de Ficha Fisica -->
              <div class="text-right">
                    <a class="btn btn-primary"  style="pointer: cursor; color: white;"><i
                            class="fa fa-plus" aria-hidden="true"></i> Salvar e ir para Ficha de Exame Fisico</a>
                
                
                
                
                       
                <!--#Botão de Ficha Fisica -->
        </div>
        <hr>
        <!-- Botão de Salvar os Dados-->
        <div class="text-left">
            <button type="submit" class="btn btn-large btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                Salvar Dados</button>
        </div>
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
</div>