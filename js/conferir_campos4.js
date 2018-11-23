    var errors = 0;
$('form').submit(function () {
    var agendamento = ["COD_TIPO_PROCEDIMENTO", "COD_PROCEDIMENTO", "COD_FUNCIONARIO", "COD_CLIENTE","DATA","HORA"]; 
    for (x = 0; x < agendamento.length; x++) {
        var field = $.trim($('#'+agendamento[x]+'').val());
    if (field  === '') { 
    
        if (agendamento[x] == "COD_TIPO_PROCEDIMENTO") {
          label_name = "Tipo de Procedimento";
        } else if (agendamento[x] == "COD_PROCEDIMENTO") {
          label_name = "Procedimento";
        } else if (agendamento[x] == "COD_FUNCIONARIO") {
          label_name = "Funcionário";
        } else if (agendamento[x] == "COD_CLIENTE") {
          label_name = "Cliente";
        } else if (agendamento[x] == "DATA") {
          label_name = "Data";
        } else if (agendamento[x] == "HORA") {
          label_name = "Selecione um Horário";
        }
        if(!$('#r_'+agendamento[x]+'').length) {
        $('#error_message').append('<div class="alert alert-danger alert-dismissable" id="r_'+agendamento[x]+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> O campo "'+label_name+'" não pode ficar vazio.</div>');
        $('#'+agendamento[x]+'').css( "border", "1px solid #ff0000");
        }
        errors += 1;
    } else {
        $('#'+agendamento[x]+'').css( "border", "1px solid #ccc");
        $('#r_'+agendamento[x]+'').remove();
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