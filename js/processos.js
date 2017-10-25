$(document).ready(function(){
	$(".chosen-select").chosen({width: "100%"});
	
	$("#btn_cadprocesso").click(function(){
		
		cadastrarProcesso($("#proc_numero"), $("#proc_acao"), $("#proc_ordem"), $("#proc_vara"),
		$("#proc_data"), $("#proc_oficial"), $("#proc_juiz"),$("#proc_valor"), $("#proc_senha"), $("#proc_desemb"), $("#proc_procurador"));
		
		//teste();
	});
});

function cadastrarProcesso(numero, acao, ordem, vara, data, oficial, juiz, valor, senha, desemb, procurador){
	var processo_apenso = $("select[name='proc_apenso'] option:selected").val();
	var numero = numero.val();
	var acao = acao.val();
	var ordem = ordem.val();
	var vara = vara.val();
	var data = data.val();
	var oficial = oficial.val();
	var juiz = juiz.val();
	var valor = valor.val();
	var senha = senha.val();
	var desembargador = desemb.val();
	var procurador = procurador.val();
	//DADOS DE INDICES
	var indices = document.getElementsByName('proc_indices');
	var indi = [null];
	var b = 0;
													// bom vamos lá kk
	for(i=0;i<indices.length;i++){
        if(indices[i].value != ""){ 				//checa para ver se o indice não está nulo
        	indi[b] = indices[i].value; 			//seta no array o valor do combo
         	for(j=0;j<b;j++){ 						// esse for verifica se não existe no vetor algum valor igual ao do combo
	        	if(indi[j] == indices[i].value){ 	// se for igual
	        		indi.splice(b); 				// retira do vetor aquele numero;
	        		b--; 							// após retirar, recoloca o ponteiro do vetor 1 posição a trás
	        	}
        	}
        	b++; // se tudo deu certo, soma 1 no indice do vetor indi
        }
    }
    
    //DADOS DAS PARTES
	var nome = document.getElementsByName('proc_partes_n');
	var desc = document.getElementsByName('proc_partes_p');
	var e = [null];
	var p = [null];
	var a = 0;
	for(i=0;i<nome.length;i++){
        if(nome[i].value != "" && desc[i].value != ""){
        	e[a] = nome[i].value;
        	p[a] = desc[i].value;
        	a++;
        }else if(nome[i].value != "" && desc[i].value == ""){
        	alert("preencha corretamenete o tipo da parte "+i);
        	return;
        }else if(nome[i].value == "" && desc[i].value != ""){
        	alert("preencha corretamenete o nome da parte "+i);
        	return;
        }
    }
    if(processo_apenso == "Sem apensos"){
		processo_apenso = null;
	}
	if(numero == ""){
		$("#proc_numero").focus();
		return;
	}else if(acao == ""){
		$("#proc_acao").focus();
		return;
	}else if(vara == ""){
		$("#proc_vara").focus();
		return;
	}else if(data == ""){
		$("#proc_data").focus();
		return;
	}else if(oficial == ""){
		$("#proc_oficial").focus();
		return;
	}else if(juiz == ""){
		$("#proc_juiz").focus();
		return;
	}else{
		$.post("control/cadastroControl.php?action=cadastroProcesso", {numero: numero, acao: acao, ordem: ordem,
		vara: vara, data: data, oficial: oficial, juiz: juiz, valor: valor, senha: senha, nome: e, desc: p, 
		indices: indi, desembargador: desembargador, procurador: procurador, apensos: processo_apenso},
			function(retorno){
				if(retorno){
					alert("Processo cadastrado com sucesso!");
					$("#container1").html('');
					$("#container1").load('cadastroProcessos.php');
				}else{
					alert("Processo não cadastrado! Entre em contato com o CPD");
					$("#container1").html('');
					$("#container1").load('cadastroProcessos.php');
				}
			} //function(retorno);
		); //$.post()
		return;		
	}
}

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


