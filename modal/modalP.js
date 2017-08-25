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

function procurarNProcesso(value){
    $.post("control/cadastroControl.php?action=verNProcesso", {aux: value}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                alert("Número de processo já cadastrado");
                $("#proc_numero").val("");
                $("#proc_numero").focus();
            }
            else{
                return false;
            }
        }
    );
}
function procurarNOrdem(value){
    $.post("control/cadastroControl.php?action=verNOrdem", {aux: value}, // envia variaveis por POST para a control cadastroControl
        function(retorno){ //retorno é o resultado que a control retorna
            if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
                alert("Número de ordem já cadastrado");
                $("#proc_ordem").val("");
                $("#proc_ordem").focus();
            }
            else{
                return false;
            }
        }
    );
}

function insereParte(){
    var row = document.getElementById("linhas");
    var table = document.getElementById("tb-proc");
    var clone = row.cloneNode(true);
    clone.id = "linhaClone";
    clone.style.display = "table-row";
    table.appendChild(clone);
}

function insereIndice(){
    var row = document.getElementById("linhas1");
    //var table = document.getElementById("tb-proc");
    var clone = row.cloneNode(true);
    clone.id = "linhaClone2";
    clone.style.display = "table-row";
    var row1 = document.getElementById("linhas-indice");
    row1.parentNode.insertBefore(clone, row1);
}

function deleteRow(i){
    document.getElementById('tb-proc').deleteRow(i)
}

function somenteNum(e) {
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0 || tecla==46) return true;
    else  return false;
    }
}

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
}