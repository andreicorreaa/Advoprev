$(document).ready(function(){
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

function alteraPessoa(value){
    var str = value;
    var nome = $("#n"+str).val();
    var cpf = $("#cpf"+str).val();
    var emails = $("#email"+str).val();
    var rg = $("#rg"+str).val();
    var data = $("#data"+str).val();
    var tel = $("#telefone"+str).val();
    var sexo = $("#sexo"+str).val();
    var oab = $("#oab"+str).val();
    var endereco = $("#endereco"+str).val();
    //console.log(nome, cpf, email, rg, data, tel, sexo, oab, endereco);
    var email = IsEmail(emails);
    //var rg_check = buscarRG(rg);
    var cpf_check = verificaCPF(cpf);
    //tel_check = buscarTel(tel);
    if(nome == ""){
        $("#n"+str).focus();
        return;
    }
    else if(cpf == "" || cpf_check == false){
        $("#cpf"+str).focus();
        return;
    }else if(email == false) {
        alert("email inválido");
        return;
    }else if(rg == ""){
        $("#rg"+str).focus();
        return;
    }else if(data == ""){
        $("#data"+str).focus();
        return;
    }else if(tel == ""){
        $("#telefone"+str).focus();
        return;
    }else if(endereco == ""){
        $("#endereco"+str).focus();
        return;
    }else{
        $.post("control/consultarControl.php?action=alterar", {id: str, cpf: cpf, rg: rg,
        nome: nome, data: data, email: emails, telefone: tel, 
        sexo: sexo, oab: oab, endereco: endereco}, // envia variaveis por POST para a control cadastroControl
            function(retorno2){ //resultado da control  
                if(retorno2 == 1){
                    alert("Cadastro efetuado com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                }else{
                    alert(retorno2);
                }
            } //function(retorno)
        ); //$.post()
    }
}

function excluiPessoa(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/consultarControl.php?action=exc", {id: str},
            function(retorno){
                debugger
                if(retorno == 1){
                    alert("Usuário excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPessoas.php');
                }else{
                    alert(retorno);
                }
            }
        );
    }else{
        return;
    }
}



//funcao para aceitar somente numeros nos campos
function somenteNum(e) {
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0) return true;
    else  return false;
    }
}

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

//funcao para validar email
function IsEmail(email){
    var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check=/@[\w\-]+\./;
    var checkend=/\.[a-zA-Z]{2,3}$/;
    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
    else {return true;}
}
//validar email
function buscarEmail(valor){
    $.post("control/cadastroControl.php?action=verEmail", {aux: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                //mostra na div alert
                alert("Email já cadastrado");
            }

        }
    );
}
//validar RG
function buscarRG(valor){
    $.post("control/cadastroControl.php?action=verRG", {aux: valor}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                //mostra na div alert
                alert("RG já cadastrado");
                return false;
            }else{
                return true;
            }

        }
    );
}

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