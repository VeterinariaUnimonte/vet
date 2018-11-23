    var errors = 0;
$('form').submit(function () {
    var funcionario = ["NOME_FUNCIONARIO", "COD_ESPECIALIDADE", "CPF", "RG","TELEFONE", "TIPO", "EMAIL", "HORARIOS", "DURACAO", "ATENDER_FERIADOS"]; 
    for (x = 0; x < funcionario.length; x++) {
        var field = $.trim($('#'+funcionario[x]+'').val());
    if (field  === '') { 
    
        if (funcionario[x] == "NOME_FUNCIONARIO") {
          label_name = "Nome do Funcionário";
        } else if (funcionario[x] == "COD_ESPECIALIDADE") {
          label_name = "Especialidade";
        } else if (funcionario[x] == "CPF") {
          label_name = "CPF";
        } else if (funcionario[x] == "RG") {
          label_name = "RG";
        } else if (funcionario[x] == "TELEFONE") {
          label_name = "Celular";
        } else if (funcionario[x] == "TIPO") {
          label_name = "Tipo";
        } else if (funcionario[x] == "EMAIL") {
          label_name = "Email";
        }  else if (funcionario[x] == "HORARIOS") {
          label_name = "Horários";
        } else if (funcionario[x] == "DURACAO") {
          label_name = "Duração média de cada atendimento";
        }  else if (funcionario[x] == "ATENDER_FERIADOS") {
          label_name = "Atender em feriados Nacionais";
        } 
        if(!$('#r_'+funcionario[x]+'').length) {
        $('#error_message').append('<div class="alert alert-danger alert-dismissable" id="r_'+funcionario[x]+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> O campo "'+label_name+'" não pode ficar vazio.</div>');
        $('#'+funcionario[x]+'').css( "border", "1px solid #ff0000");
        }
        errors += 1;
    } else {
        $('#'+funcionario[x]+'').css( "border", "1px solid #ccc");
        $('#r_'+funcionario[x]+'').remove();
        if (errors != 0) {
        errors -= 1;
        }
    }
    }
    
    if (errors > 0) {
    return false;
    } else {
    return true;
    }
    
    
    
    });