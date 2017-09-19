// ------------------------ FUNÇÕES PARA MODAL -------------------
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
     
        $(id).css({'top':top-10,'left':left-100});
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

function procurarNProcesso(value, id){
    $.post("control/cadastroControl.php?action=verNProcesso", {aux: value}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                alert("Número de processo já cadastrado");
                $("#proc_numero"+id).val("");
                $("#proc_numero"+id).focus();
            }
            else{
                return false;
            }
        }
    );
};

function procurarNOrdem(value, id){
    $.post("control/cadastroControl.php?action=verNOrdem", {aux: value}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                alert("Número de ordem já cadastrado");
                $("#proc_ordem"+id).val("");
                $("#proc_ordem"+id).focus();
            }
            else{
                return false;
            }
        }
    );
};

function somenteNum(e) {
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0 || tecla==46) return true;
    else  return false;
    }
};
//MASCARA DE VALOR
function maskIt(w,e,m,r,a){
    // Cancela se o evento for Backspace
    if (!e) var e = window.event
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    // Variáveis da função
    var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
    var mask = (!r) ? m : m.reverse();
    var pre  = (a ) ? a.pre : "";
    var pos  = (a ) ? a.pos : "";
    var ret  = "";
    if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
    // Loop na máscara para aplicar os caracteres
    for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
    if(mask.charAt(x)!='#'){
    ret += mask.charAt(x); x++; } 
    else {
    ret += txt.charAt(y); y++; x++; } }
    // Retorno da função
    ret = (!r) ? ret : ret.reverse()    
    w.value = pre+ret+pos; }
    // Novo método para o objeto 'String'
    String.prototype.reverse = function(){
    return this.split('').reverse().join(''); 
};

function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function alteraProcesso(value){
    var str = value;
    var numero = $("#proc_numero"+str).val();
    var acao = $("#proc_acao"+str).val();
    var ordem = $("#proc_ordem"+str).val();
    var vara = $("#proc_vara"+str).val();
    var data = $("#proc_data"+str).val();
    var oficial = $("#proc_oficial"+str).val();
    var juiz = $("#proc_juiz"+str).val();
    var valor = $("#proc_valor"+str).val();
    var senha = $("#proc_senha"+str).val();
    console.log(numero, acao, ordem, vara, data, oficial, juiz, valor, senha);
    if(numero == ""){
        $("#proc_numero"+str).focus();
        return;
    }
    else if(acao == ""){
        $("#proc_acao"+str).focus();
        return;
    }else if(ordem == "") {
        $("#proc_ordem"+str).focus();
        return;
    }else if(vara == ""){
        $("#proc_vara"+str).focus();
        return;
    }else if(data == ""){
        $("#proc_data"+str).focus();
        return;
    }else if(oficial == ""){
        $("#proc_oficial"+str).focus();
        return;
    }else if(juiz == ""){
        $("#proc_juiz"+str).focus();
        return;
    }else{
        $.post("control/alterarControl.php?action=alteraProcesso", {id: str, numero: numero, acao: acao,
        ordem: ordem, vara: vara, data: data, oficial: oficial, juiz: juiz, valor: valor, senha: senha}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control 
                if(retorno == 1){
                    alert("Alteracao efetuada com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarProcessos.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a alteção");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarProcessos.php');
                }
            } //function(retorno)
        ); //$.post()
    }
};

function excluiProcesso(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiProcesso", {id: str},
            function(retorno){
                //debugger
                if(retorno == 1){
                    alert("Processo excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarProcessos.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarProcessos.php');
                    
                }
            }
        );
    }else{
        return;
    }
};

function alteraParte(value){
    var str = value;
    var pessoa = $("#soflow"+str).val();
    var parte = $("#parte_p"+str).val();

    if(pessoa == "" || parte == ""){
        alert("Digite corretamente os campos!");
        return;
    }else{
        $.post("control/alterarControl.php?action=alteraParte", {pessoa: pessoa, parte: parte, id_proc: str}, // envia variaveis por POST para a control cadastroControl
            function(retorno){ //resultado da control 
                if(retorno == 1){
                    alert("Alteracao efetuada com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPartes.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a alteção");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPartes.php');
                }
            } //function(retorno)
        ); //$.post()
    }
};

function excluiParte(value){
    var str = value;
    decisao = confirm("Confirmar exclusão?!");
    if(decisao){
        $.post("control/exclusaoControl.php?action=excluiParte", {id: str},
            function(retorno){
                //debugger
                if(retorno == 1){
                    alert("Parte excluído com sucesso");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPartes.php');
                }else{
                    console.log(retorno);
                    alert("Erro ao efetuar a exclusão");
                    $("#mascara").hide();
                    $(".window").hide();
                    $("#container1").load('consultarPartes.php');
                }
            }
        );
    }else{
        return;
    }
};