    var errors = 0;
$('form').submit(function () {
    var procedimento = ["DESCRICAO", "COD_TIPO_PROCEDIMENTO", "JEJUM", "VALOR_PROCEDIMENTO","OBSERVACAO"]; 
    for (x = 0; x < procedimento.length; x++) {
        var field = $.trim($('#'+procedimento[x]+'').val());
    if (field  === '') { 
    
        if (procedimento[x] == "DESCRICAO") {
          label_name = "Descrição do Procedimento";
        } else if (procedimento[x] == "COD_TIPO_PROCEDIMENTO") {
          label_name = "Tipo de Procedimento";
        } else if (procedimento[x] == "JEJUM") {
          label_name = "Jejum";
        } else if (procedimento[x] == "VALOR_PROCEDIMENTO") {
          label_name = "Valor Procedimento";
        } else if (procedimento[x] == "OBSERVACAO") {
          label_name = "Observação";
        }
        if(!$('#r_'+procedimento[x]+'').length) {
        $('#error_message').append('<div class="alert alert-danger alert-dismissable" id="r_'+procedimento[x]+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> O campo "'+label_name+'" não pode ficar vazio.</div>');
        $('#'+procedimento[x]+'').css( "border", "1px solid #ff0000");
        }
        errors += 1;
    } else {
        $('#'+procedimento[x]+'').css( "border", "1px solid #ccc");
        $('#r_'+procedimento[x]+'').remove();
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