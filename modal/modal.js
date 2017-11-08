// ------------------------ FUNÇÕES PARA MODAL -------------------
$(document).ready(function(){
    if($("#cep").lenght){
      $("#cep").mask("99999-999");
    }
    $("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");
 
        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
     
        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela-205,'height':alturaTela-99});
        $('#mascara').fadeIn(1000); 
        $('#mascara').fadeTo("slow",0.8);
 
        var left = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
        $(id).css({'top':top-10,'left':left-200});
        $(id).show();   
    });
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});
// ------------------------ FUNÇÕES DE ALTERAÇÃO -----------------
// ------------------------ ALTERAR PESSOAS ----------------------
function alteraPessoa(value){
    var str = value;
    if(!$("input:radio[name=tipo-pessoa"+value+"]:checked").val()){
        alert("Selecione o tipo de pessoa");
        return;
    }
    var cpf_cnpj;
    var op = $("input:radio[name=tipo-pessoa"+value+"]:checked").val();
    if(op == "cpf"){
        cpf_cnpj = $("#cpf"+str).val();
        var check = verificaCPF(cpf_cnpj);
    }else{
        cpf_cnpj = $("#cnpj"+str).val();
        var check = validarCNPJ(cpf_cnpj);
    }
    var nome = $("#n"+str).val();
    var emails = $("#email"+str).val();
    var rg = $("#rg"+str).val();
    var data = $("#data"+str).val();
    var tel = $("#telefone"+str).val();
    var sexo = $("#sexo"+str).val();
    var oab = $("#oab"+str).val();
    var cep = $("#cep"+str).val();
    var complemento = $("#complemento"+str).val();
    var numero = $("#numero"+str).val();

    if(emails != ""){
        var email = IsEmail(emails);
    }else{
        var email = true;
    }

    if(nome == ""){
        $("#n"+str).focus();
        return;
    }else if(email == false) {
        alert("email inválido");
        return;
    }else if(check == false) {
        alert("CPF/CNPJ inválido");
        return;
    }else if(data == ""){
        $("#data"+str).focus();
        return;
    }else if(cep == ""){
        $("#cep"+str).focus();
        return;
    }else{
        $.post("control/alterarControl.php?action=alterarPessoa", {id: str, cpf_cnpj: cpf_cnpj, rg: rg,
        nome: nome, data: data, email: emails, telefone: tel, 
        sexo: sexo, oab: oab, cep: cep, complemento: complemento, numero: numero}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control  
                if(retorno == 1){
                    alert("Alteracao efetuada com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPessoas.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a alteção");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPessoas.php');
                }
            } //function(retorno)
        ); //$.post()
    }
}
// ------------------------ ALTERAR INDICES ----------------------
function alteraIndice(value){
    var str = value;
    var nome = $("#n"+str).val();
    if(nome == ""){
        $("#n"+str).focus();
        return;
    }else{
        $.post("control/alterarControl.php?action=alteraIndice", {id: str, desc: nome}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control  
                if(retorno == 1){
                    alert("Alterado com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarIndices.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a alteração");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarIndices.php');
                }
            } //function(retorno)
        ); //$.post()
    }
}
// ------------------------ ALTERAR VARAS ------------------------
function alteraVara(value){
    var str = value;
    var nome = $("#n"+str).val();
    if(nome == ""){
        $("#n"+str).focus();
        return;
    }else{
        $.post("control/alterarControl.php?action=alteraVara", {id: str, desc: nome}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control  
                if(retorno == 1){
                    alert("Alterado com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarVaras.php');
                }else{
                    //console.log(retorno);
                    alert("Erro ao efetuar a alteração (verifique se não existe registro com o mesmo nome)");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarVaras.php');
                }
                //console.log(retorno);
            } //function(retorno)
        ); //$.post()
    }
}
// ------------------------ ALTERAR TIPOS/SITUAÇÃO ------------------------
function alteraTipo(value){
    var str = value;
    var nome = $("#n"+str).val();
    if(nome == ""){
        $("#n"+str).focus();
        return;
    }else{
        $.post("control/alterarControl.php?action=alteraTipo", {id: str, desc: nome}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control
                if(retorno == 1){
                    alert("Alterado com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarTipos.php');
                }else{
                    //console.log(retorno);
                    alert("Erro ao efetuar a alteração (verifique se não existe registro com o mesmo nome)");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarTipos.php');
                }
            }
        );
    }
}
// ------------------------ FUNÇÕES DE EXCLUSÃO ------------------
// ------------------------ EXCLUIR PESSOAS ----------------------
function excluiPessoa(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiPessoa", {id: str},
            function(retorno){
                //debugger
                if(retorno == 1){
                    alert("Usuário excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPessoas.php');
                }else{
                    //console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPessoas.php');
                }
            }
        );
    }else{
        return;
    }
}
// ------------------------ EXCLUIR INDICES ----------------------
function excluiIndice(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiIndice", {id: str},
            function(retorno){
                //  debugger
                if(retorno == 1){
                    alert("Indice excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarIndices.php');
                }else{
                    //console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarIndices.php');
                }
            }
        );
    }else{
        return;
    }
}
// ------------------------ EXCLUIR VARAS ------------------------
function excluiVara(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiVara", {id: str},
            function(retorno){
                //debugger
                if(retorno == 1){
                    alert("Vara excluída com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarIndices.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarIndices.php');
                }
            }
        );
    }else{
        return;
    }
}
// ------------------------ EXCLUIR INDICES ----------------------
function excluiTipo(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiTipo", {id: str},
            function(retorno){
                //  debugger
                if(retorno == 1){
                    alert("Tipo/Situação excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarTipos.php');
                }else{
                    //console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarTipos.php');
                }
            }
        );
    }else{
        return;
    }
}
// ------------------------ VALIDAÇÕES ---------------------------
// ------------------------ ACEITAR SOMENTE NUMEROS --------------
function somenteNum(e) {
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0) return true;
    else  return false;
    }
}
// ------------------------ BUSCAR CPF REPETIDO ------------------
function buscarCPF(valor){
    var cpf = valor.length;
    if(cpf < 11){
        var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
        $("#verifica1").html(a);
        return; //retorna nulo
    }
    $.post("control/cadastroControl.php?action=verCPF", {aux: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            var a = unescape("<img alt=\"CPF inválido ou já cadastrado\" src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
            var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                $("#verifica1").html(a);  //mostra na div alert
                alert("CPF já cadastrado");
                return false;
            }
            else{
                var c = verificaCPF((valor.replace(/[a-z]/gi,''))); // verifica se o cpf é valido
                if(c == true){
                    $("#verifica1").html(b);
                    return true;
                }else{
                    alert("CPF com formato inválido");
                    $("#verifica1").html(a);
                    return false;
                }
            }
            
        }
    );
}
// ------------------------ VERIFICA CPF -------------------------
function verificaCPF(strCpf) { // validar CPF

    var soma;
    var resto;
    soma = 0;
    if (strCpf == "00000000000") {
        return false;
    }

    for (i = 1; i <= 9; i++) {
        soma = soma + parseInt(strCpf.substring(i - 1, i)) * (11 - i);
    }

    resto = soma % 11;

    if (resto == 10 || resto == 11 || resto < 2) {
        resto = 0;
    } else {
        resto = 11 - resto;
    }

    if (resto != parseInt(strCpf.substring(9, 10))) {
        return false;
    }

    soma = 0;

    for (i = 1; i <= 10; i++) {
        soma = soma + parseInt(strCpf.substring(i - 1, i)) * (12 - i);
    }
    resto = soma % 11;

    if (resto == 10 || resto == 11 || resto < 2) {
        resto = 0;
    } else {
        resto = 11 - resto;
    }

    if (resto != parseInt(strCpf.substring(10, 11))) {
        return false;
    }

    return true;
}
// ------------------------ VERIFICA EMAIL -----------------------
function IsEmail(email){
    var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check=/@[\w\-]+\./;
    var checkend=/\.[a-zA-Z]{2,3}$/;
    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
    else {return true;}
}
// ------------------------ BUSCAR EMAIL REPETIDO ----------------
function buscarEmail(valor){
    if(IsEmail(valor)){
        $.post("control/cadastroControl.php?action=verEmail", {aux: valor}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //retorno é o resultado que a control retorna
                if(retorno == 1){
                    setTimeout(window.alert("Email já cadastrado"), 1000);
                    $("#email").val("");
                    return false;
                }else{
                    return true;
                }
            }
        );
    }
}
// ------------------------ BUSCAR RG REPETIDO -------------------
function buscarRG(valor){
    $.post("control/cadastroControl.php?action=verRG", {aux: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                //mostra na div alert
                alert("RG já cadastrado");
                $("#rg").val("");
                return false;
            }else{
                return true;
            }

        }
    );
}
// ------------------------ BUSCAR TEL REPETIDO ------------------
function buscarTel(valor){
    $.post("control/cadastroControl.php?action=verTEL", {aux: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                //mostra na div alert
                alert("Telefone/celular já cadastrado");
                return false;
            }else{
                return true;
            }

        }
    );
}

function tipoPessoa(value, id){
    if(value.value == "cpf"){
        document.getElementById("tipoPessoa"+id).style.display = 'none';
        document.getElementById("lblcpf"+id).style.display = 'table-cell';
        document.getElementById("inputcpf"+id).style.display = 'table-cell';
    }else{

        document.getElementById("tipoPessoa"+id).style.display = 'none';
        document.getElementById("lblcnpj"+id).style.display = 'table-cell';
        document.getElementById("inputcnpj"+id).style.display = 'table-cell';
    }
}

function buscarCNPJ(valor){
    var cnpj = valor.length;
    var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
    var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
    if(cnpj < 14){
        $("#verifica1").html(a);
        return; //retorna nulo
    }else if(!validarCNPJ(valor)){
        $("#verifica1").html(a);
        return; //retorna nulo
    }else{
        $.post("control/cadastroControl.php?action=verCPF", {aux: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            var a = unescape("<img alt=\"CNPJ inválido ou já cadastrado\" src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
            var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                $("#verifica1").html(a);  //mostra na div alert
                //alert("CNPJ já cadastrado");
                return false;
            }else{
                var c = validarCNPJ((valor.replace(/[a-z]/gi,''))); // verifica se o cpf é valido
                if(c == true){
                    $("#verifica1").html(b);
                    return true;
                }else{
                    alert("CPF com formato inválido");
                    $("#verifica1").html(a);
                    return false;
                }
            }
        });
    }
}

function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true; 
}

function buscarAPICorreios(value, id){
    var cep = value.replace(/\D/g, '');
    if(cep != ""){
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '//viacep.com.br/ws/'+ cep +'/json/?callback=?',
                async: true,
                success: function(response){
                    if(!("erro" in response)){
                        $("#logradouro"+id).val(response.logradouro);
                        $("#bairro"+id).val(response.bairro);
                        $("#uf"+id).val(response.uf);
                        $("#cidade"+id).val(response.localidade);
                    }else{
                        //alert("CEP inexistente");
                        $("#cep"+id).val("");
                    }
                }
            });
        }else{
            alert("CEP inválido");
        }
    }
}

function alteraUsuario(id){
    debugger
    var name = $("#nome-usuario"+id).val();
    var name_l = name.length;
    var senha = $("#senha-usuario"+id).val();
    var senha_l = senha.length;
    var confirma_s = $("#confirma_s-usuario"+id).val();
    var group = $("#grupo-usuario"+id).val();

    if(name == ""){
        $("#nome-usuario"+id).focus(); //Adiciona foco ao campo com id='login'
        return; //retorna nulo
    }else if(senha == ""){
        $("#senha-usuario"+id).focus(); //Adiciona foco ao campo com id='senha'
        return; //retorna nulo
    }else if(confirma_s == ""){ 
        $("#confirma_s-usuario"+id).focus(); //Adiciona foco ao campo com id='confima_s'
        return; //retorna nulo
    }else if(name_l < 6){
        $("#nome-usuario"+id).focus(); //Adiciona foco ao campo com id='login'
        return; //retorna nulo
    }else if(senha_l < 6){
        $("#senha-usuario"+id).focus(); //Adiciona foco ao campo com id='login'
        return; //retorna nulo
    }else if(confirma_s !=  senha){
        $("#confirma_s-usuario"+id).focus(); //Adiciona foco ao campo com id='confirma_s'
        return; //retorna nulo
    }else if(group == ""){
        $("#grupo-usuario"+id).focus(); //Adiciona foco ao campo com id='confirma_s'
        return; //retorna nulo
    }else{
        $.post("control/alterarControl.php?action=alteraUsuario", {id: id, nome: name, senha: senha, grupo: group}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control
                if(retorno == 1){
                    alert("Alteracao efetuada com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarUsuarios.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a alteção - Contate o CPD");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarUsuarios.php');
                }
            } //function(retorno)
        ); //$.post()
    }
}

function excluiUsuario(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiUsuario", {id: str},
            function(retorno){
                //debugger
                if(retorno == 1){
                    alert("Usuário excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarUsuarios.php');
                }else{
                    //console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarUsuarios.php');
                }
            }
        );
    }else{
        return;
    }
}

function buscarUser(valor, id) {
    var name = valor.length;
    if(name < 6){
        var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
        $("#verifica"+id).html(a);
        return; //retorna nulo
    }
    $.post("control/cadastroControl.php?action=ver", {nome: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                $("#verifica"+id).html(a);  //mostra na div alert
            }
            else{
                var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
                $("#verifica"+id).html(b);
            }
        }
    );
}