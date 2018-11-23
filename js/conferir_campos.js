    var errors = 0;
$('form').submit(function () {
    var pessoa = ["NOME_CLIENTE", "CPF", "RG", "CEP", "CIDADE", "UF", "BAIRRO", "RUA", "NUMERO", "TELEFONE", "EMAIL"]; 
    for (x = 0; x < pessoa.length; x++) {
        var field = $.trim($('#'+pessoa[x]+'').val());
    if (field  === '') { 
    
        if (pessoa[x] == "NOME_CLIENTE") {
          label_name = "Nome Completo";
        } else if (pessoa[x] == "CPF") {
          label_name = "CPF";
        } else if (pessoa[x] == "RG") {
          label_name = "RG";
        } else if (pessoa[x] == "CEP") {
          label_name = "CEP";
        } else if (pessoa[x] == "CIDADE") {
          label_name = "Cidade";
        } else if (pessoa[x] == "UF") {
          label_name = "Estado";
        } else if (pessoa[x] == "BAIRRO") {
          label_name = "Bairro";
        } else if (pessoa[x] == "RUA") {
          label_name = "Rua";
        } else if (pessoa[x] == "NUMERO") {
          label_name = "Número";
        } else if (pessoa[x] == "TELEFONE") {
          label_name = "Celular";
        } else if (pessoa[x] == "EMAIL") {
          label_name = "Email";
        }  else if (pessoa[x] == "SEXO") {
          label_name = "SEXO";
        }
        if(!$('#r_'+pessoa[x]+'').length) {
        $('#error_message').append('<div class="alert alert-danger alert-dismissable" id="r_'+pessoa[x]+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> O campo "'+label_name+'" não pode ficar vazio.</div>');
        $('#'+pessoa[x]+'').css( "border", "1px solid #ff0000");
        }
        errors += 1;
    } else {
        $('#'+pessoa[x]+'').css( "border", "1px solid #ccc");
        $('#r_'+pessoa[x]+'').remove();
        if (errors != 0) {
        errors -= 1;
        }
    }
    }
    
    
    
    
    
    var pet = ["NOME_PET", "TIPO", "RACA", "SEXO", "IDADE", "PELAGEM"]; 
    for (x = 0; x < pet.length; x++) {
      if (pet[x] == "NOME_PET") {
          label_name = "Nome do Animal";
        } else if (pet[x] == "TIPO") {
          label_name = "Espécie" ;
        } else if (pet[x] == "RACA") {
          label_name = "Raça";
        } else if (pet[x] == "SEXO") {
          label_name = "Sexo";
        } else if (pet[x] == "IDADE") {
          label_name = "Idade";
        } else if (pet[x] == "PELAGEM") {
          label_name = "Pelagem / Tipo de Pelo";
        }
    var animal = $("."+pet[x]+"");

    for (var i = 0; i < animal.length; i++) {
    
       var field = $.trim($(animal[i]).val()); 
       var ix = i + 1;
      if (field == '') {
      
      if(!$('#r_'+pet[x]+ i).length) {
        $('#error_message').append('<div class="alert alert-danger alert-dismissable" id="r_'+pet[x]+ i+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> O campo "'+label_name+' '+ix+'" não pode ficar vazio.</div>');
        $(animal[i]).css( "border", "1px solid #ff0000");
        }
        errors += 1;
    } else {
        $(animal[i]).css( "border", "1px solid #ccc");
        $('#r_'+pet[x]+ i).remove();
        if (errors != 0) {
        errors -= 1;
        }
    }
    
    
    }
    }
    if (errors > 0) {
    return false;
    } else {
    return true;
    }
    
    
    
    });