$(document).ready(function() {
        function clean_form_cep() {
          $("#RUA").val("").prop( "disabled", true );
          $("#BAIRRO").val("").prop( "disabled", true );
          $("#CIDADE").val("").prop( "disabled", true );
          $("#UF").val("").prop( "disabled", true );
          $("#NUMERO").val("").prop( "disabled", true );
        }
        $("#CEP").keyup(function() {
          if ($(this).val().replace(/_/g, '').replace(/-/g, '').length == 8) {
          var cep = $(this).val().replace(/\D/g, '');
          if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if(validacep.test(cep)) {
              $("#RUA").val("...");
              $("#BAIRRO").val("...");
              $("#CIDADE").val("...");
              $("#UF").val("...");
              $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                  $('#RUA').removeAttr("disabled")
                  $('#BAIRRO').removeAttr("disabled");
                  $('#CIDADE').removeAttr("disabled");
                  $('#UF').removeAttr("disabled");
                  $('#NUMERO').removeAttr("disabled");
                  $("#RUA").val(dados.logradouro);
                  $("#BAIRRO").val(dados.bairro);
                  $("#CIDADE").val(dados.localidade);
                  $("#UF").val(dados.uf);
                  $("#NUMERO").focus();
                }
                else {
                  clean_form_cep();

                  alert("CEP não encontrado.");
                }
              }
                       );
            }
            else {
              clean_form_cep();
              alert("Formato de CEP inválido.");
            }
          }
          else {
            clean_form_cep();
          }
        }
        }
                      );
      }
                       );

