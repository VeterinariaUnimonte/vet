$("#COD_TIPO_PROCEDIMENTO").change(function(event) {
    event.preventDefault();

    var http = new XMLHttpRequest();
    var COD_TIPO_PROCEDIMENTO = $(this).val();

    var params = 'COD_TIPO_PROCEDIMENTO=' + COD_TIPO_PROCEDIMENTO + '';
    http.open('POST', './json/procedimentos.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var data = JSON.parse(http.responseText);
            if (data.status == true) {
                $('#COD_PROCEDIMENTO').removeAttr("disabled");
                $("#COD_PROCEDIMENTO").html("<option disabled selected>Selecione....</option>\n" + data.html + "");
            }
        }
    }
    http.send(params);

});

$("#COD_PROCEDIMENTO").change(function(event) {
    event.preventDefault();

    var http = new XMLHttpRequest();
    http.open('GET', './json/funcionarios.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var data = JSON.parse(http.responseText);
            if (data.status == true) {
                $('#COD_FUNCIONARIO').removeAttr("disabled");
                $("#COD_FUNCIONARIO").html("<option disabled selected>Selecione....</option>\n" + data.html + "");
            }
        }
    }
    http.send();

});


$("#COD_FUNCIONARIO").change(function(event) {
    event.preventDefault();

    var http = new XMLHttpRequest();
    http.open('GET', './json/clientes.php', true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var data = JSON.parse(http.responseText);
            if (data.status == true) {
                if ($("#COD_CLIENTE").val() == null) {
                $('#COD_CLIENTE').removeAttr("disabled");
                $("#COD_CLIENTE").html("<option disabled selected>Selecione....</option>\n" + data.html + "");
            } else {
                $("#HORA").html('');
                $('#alert_message').html('');
                $("#DATA").val('');
                $('#HORA').prop('disabled', 'disabled');

            }
        }
        }
    }
    http.send();

});



$("#COD_CLIENTE").change(function(event) {
    event.preventDefault();

    var http = new XMLHttpRequest();

    var COD_FUNCIONARIO = $('#COD_FUNCIONARIO').val();

    var params = 'COD_FUNCIONARIO=' + COD_FUNCIONARIO + '';
    http.open('POST', './json/escolhas.php', true);


    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var data = JSON.parse(http.responseText);
            if (data.status == true) {
                $('#DATA').removeAttr("disabled");
                $("#suporte").html('<div id="alert_message"></div>Hoje é '+data.html_current_date+'<br>Datas mais próximas com horários disponíveis: ' + data.html + '.');
            }
        }
    }
    http.send(params);

});


$("#DATA").keyup(function() {
    if ($(this).val().replace(/\//g, '').replace(/_/g, '').length == 8) {

        var date_sep = $(this).val().split('/');

        var date = date_sep[2] + "-" + date_sep[1] + "-" + date_sep[0];

        var http = new XMLHttpRequest();

        var COD_FUNCIONARIO = $('#COD_FUNCIONARIO').val();

        var params = 'COD_FUNCIONARIO=' + COD_FUNCIONARIO + '&DATA='+date+'';

        http.open('POST', './json/disponibilidade.php', true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                var data = JSON.parse(http.responseText);
                if (data.status == true) {
                    $('#alert_message').html('');
                    $('#HORA').removeAttr("disabled");
                    $("#HORA").html("<option disabled selected>Selecione....</option>\n" + data.html + "");
                } else {
                    $('#alert_message').html('<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '+data.reason+'</div>');
                    $("#HORA").html('');
                    $('#HORA').prop('disabled', 'disabled');

                    
                }
            }
        }
        http.send(params);
    } else{
        $("#HORA").html('');
        $('#HORA').prop('disabled', 'disabled');

    }
});