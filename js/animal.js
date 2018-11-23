var i = 1;

function remover_id(id) {
    $("#" + id).remove();
}

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}

function addAnimal() {
    var id = makeid();
    $("#animais").append('<div id="' + id + '"><div class="card border-dark mb-3"> <div class="card-header">Registro do Animal <span style="text-align: right; float: right;"><a class="btn btn-danger" onclick="remover_id(\'' + id + '\');" style="mouse: pointer; color: white;"><i class="fa fa-times"></i></a></span></div> <div class="card-body"> <p class="card-text"> <label for="nome_animal">Nome do Animal <span style="color: red;">*</span></label><input type="text" class="form-control NOME_PET" id="nome_animal" name="NOME_PET[]" placeholder="Ex: Rex"> <label for="especie">Espécie <span style="color: red;">*</span></label><input type="text" class="form-control TIPO" id="especie" name="TIPO[]" placeholder="Ex: Cachorro"> <label for="raca">Raça <span style="color: red;">*</span></label><input type="text" class="form-control RACA" id="raca" name="RACA[]" placeholder="Ex: Shitzu"> <label for="sexo">Sexo <span style="color: red;">*</span></label> <select class="form-control SEXO" id="SEXO" name="SEXO[]"> <option disabled selected>Selecione...</option> <option value="m">Macho</option> <option value="f">Fêmea</option> <option value="x">Não identificado</option> </select> <label for="idade">Idade <span style="color: red;">*</span></label> <select class="form-control IDADE" id="idade" name="IDADE[]"> <option disabled selected>Selecione...</option> <option value="0.00">menos de um mês</option> <option value="0.01">1 mês</option> <option value="0.02">2 meses</option> <option value="0.03">3 meses</option> <option value="0.04">4 meses</option> <option value="0.05">5 meses</option> <option value="0.06">6 meses</option> <option value="0.07">7 meses</option> <option value="0.08">8 meses</option> <option value="0.09">9 meses</option> <option value="0.10">10 meses</option> <option value="0.11">11 meses</option> <option value="1.00">1 ano</option> <option value="2.00">2 anos</option> <option value="3.00">3 anos</option> <option value="4.00">4 anos</option> <option value="5.00">5 anos</option> <option value="6.00">6 anos</option> <option value="7.00">7 anos</option> <option value="8.00">8 anos</option> <option value="9.00">9 anos</option> <option value="10.00">10 anos</option> <option value="11.00">11 anos</option> <option value="12.00">12 anos</option> <option value="13.00">13 anos</option> <option value="14.00">14 anos</option> <option value="15.00">15 anos</option> <option value="16.00">Mais de 15 Anos</option> </select> ' +
        '<div class="form-group"> <label for="pelagem">Pelagem / Tipo de Pelo <span style="color: red;">*</span></label> <input type="text" class="form-control PELAGEM" id="pelagem" name="PELAGEM[]" placeholder="Ex: Castanho"> </div> </p> </div> </div></div>');
    i++;
}

function EditAnimal(nome_animal, especie, raca, sexo, idade, pelagem) {
    var id = makeid();
    $("#animais").append('<div id="' + id + '"><div class="card border-dark mb-3"> <div class="card-header">Registro do Animal <span style="text-align: right; float: right;"><a class="btn btn-danger" onclick="remover_id(\'' + id + '\');" style="mouse: pointer; color: white;"><i class="fa fa-times"></i></a></span></div> <div class="card-body"> <p class="card-text"> <label for="nome_animal">Nome do Animal <span style="color: red;">*</span></label><input type="text" class="form-control NOME_PET" id="nome_animal" name="NOME_PET[]" placeholder="Ex: Rex" value="' + nome_animal + '"> <label for="especie">Espécie <span style="color: red;">*</span></label><input type="text" class="form-control TIPO" id="especie" name="TIPO[]" placeholder="Ex: Cachorro" value="' + especie + '"> <label for="raca">Raça <span style="color: red;">*</span></label><input type="text" class="form-control RACA" id="raca" name="RACA[]" placeholder="Ex: Shitzu" value="' + raca + '"> <label for="sexo">Sexo <span style="color: red;">*</span></label> <select class="form-control SEXO" id="sexo" name="SEXO[]"> <option disabled>Selecione...</option> <option value="m"' +
        (sexo == "m" ? ' selected' : '') +
        '>Macho</option> <option value="f"' +
        (sexo == "f" ? ' selected' : '') +
        '>Fêmea</option> <option value="x"' +
        (sexo == "x" ? ' selected' : '') +
        '>Não identificado</option> </select> <label for="idade">Idade <span style="color: red;">*</span></label> <select class="form-control IDADE" id="idade" name="IDADE[]"> <option disabled>Selecione...</option> <option value="0.0"' +
        (idade == "0.00" ? ' selected' : '') +
        '>menos de um mês</option> <option value="0.01"' +
        (idade == "0.01" ? ' selected' : '') +
        '>1 mês</option> <option value="0.02"' +
        (idade == "0.02" ? ' selected' : '') +
        '>2 meses</option> <option value="0.03"' +
        (idade == "0.03" ? ' selected' : '') +
        '>3 meses</option> <option value="0.04"' +
        (idade == "0.04" ? ' selected' : '') +
        '>4 meses</option> <option value="0.05"' +
        (idade == "0.05" ? ' selected' : '') +
        '>5 meses</option> <option value="0.06"' +
        (idade == "0.06" ? ' selected' : '') +
        '>6 meses</option> <option value="0.07"' +
        (idade == "0.07" ? ' selected' : '') +
        '>7 meses</option> <option value="0.08"' +
        (idade == "0.08" ? ' selected' : '') +
        '>8 meses</option> <option value="0.09"' +
        (idade == "0.09" ? ' selected' : '') +
        '>9 meses</option> <option value="0.10"' +
        (idade == "0.10" ? ' selected' : '') +
        '>10 meses</option> <option value="0.11"' +
        (idade == "0.11" ? ' selected' : '') +
        '>11 meses</option> <option value="1.00"' +
        (idade == "1.00" ? ' selected' : '') +
        '>1 ano</option> <option value="2.00"' +
        (idade == "2.00" ? ' selected' : '') +
        '>2 anos</option> <option value="3.00"' +
        (idade == "3.00" ? ' selected' : '') +
        '>3 anos</option> <option value="4.00"' +
        (idade == "4.00" ? ' selected' : '') +
        '>4 anos</option> <option value="5.00"' +
        (idade == "5.00" ? ' selected' : '') +
        '>5 anos</option> <option value="6.00"' +
        (idade == "6.00" ? ' selected' : '') +
        '>6 anos</option> <option value="7.00"' +
        (idade == "7.00" ? ' selected' : '') +
        '>7 anos</option> <option value="8.00"' +
        (idade == "8.00" ? ' selected' : '') +
        '>8 anos</option> <option value="9.00"' +
        (idade == "9.00" ? ' selected' : '') +
        '>9 anos</option> <option value="10.00"' +
        (idade == "10.00" ? ' selected' : '') +
        '>10 anos</option> <option value="11.00"' +
        (idade == "11.00" ? ' selected' : '') +
        '>11 anos</option> <option value="12.00"' +
        (idade == "12.00" ? ' selected' : '') +
        '>12 anos</option> <option value="13.00"' +
        (idade == "13.00" ? ' selected' : '') +
        '>13 anos</option> <option value="14.00"' +
        (idade == "14.00" ? ' selected' : '') +
        '>14 anos</option> <option value="15.00"' +
        (idade == "15.00" ? ' selected' : '') +
        '>15 anos</option> <option value="16.00"' +
        (idade == "16.00" ? ' selected' : '') +
        '>Mais de 15 Anos</option> </select> ' +
        '<div class="form-group"> <label for="pelagem">Pelagem / Tipo de Pelo <span style="color: red;">*</span></label> <input type="text" class="form-control PELAGEM" id="pelagem" name="PELAGEM[]" placeholder="Ex: Castanho" value="' + pelagem + '"> </div> </p> </div> </div></div>');
    i++;
}