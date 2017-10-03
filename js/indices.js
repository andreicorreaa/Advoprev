$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_pesquisa").click(function(){
		pesquisaIndice($("#campo"));
	});

	$("#campo").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            pesquisaIndice($("#campo"));
        }
    });

    $("#btn_cadIndice").click(function(){
		var check = document.getElementById('desc').value;
		if(buscarIndice(check) == true){
			//alert("Indice já cadastrado!");
			$("#desc").val("");
			$("#desc").focus();
		}else{
			cadIndice($("#desc"));	
		}
	});

	$("#desc").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            var check = document.getElementById('desc').value;
			if(buscarIndice(check) == true){
				//alert("Indice já cadastrado!");
				$("#desc").val("");
				$("#desc").focus();
			}else{
				cadIndice($("#desc"));	
			}
        }
    });

});

function cadIndice(campo){
	$.post("control/cadastroControl.php?action=cadIndice", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
		function(retorno2){ //resultado da control	
			//console.log(retorno2);
			if(retorno2 == true){
				campo.val("");
				alert("Cadastro Efetuado Com Sucesso!");
			}else{
				alert("Erro :(");
			}
		} //function(retorno)
	); //$.post()
	return;
}

function pesquisaIndice(campo){
	if(campo.val() == ""){
		alert("Digite no campo pesquisar");
		campo.focus();
		return;
	}else{
		$.post("control/consultarControl.php?action=pesIndice", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td align=\"center\">Indice não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}
}

function buscarIndice(valor){
	if(valor == ""){
		alert("Digite algo!");
		return;
	}else{
		var aux = false;
		$.post("control/consultarControl.php?action=checkIndice", {desc: valor}, // envia variaveis por POST para a control cadastroControl
			function(retorno){ //retorno é o resultado que a control retorna
				if(retorno){ // se retornar 1, neste caso o login ja existe no banco
					alert("Indice já cadastrado!");
					aux = true;
				}else{
					aux =  false;
				}
			}
		);
	}
	//console.log(aux);
	return aux;
}

function procuraProcesso(value){
	if(value == ""){
		alert("Selecione um processo");
		document.getElementById('cad-indices').style.display = 'none';
		return;
	}
	$.post("control/consultarControl.php?action=pesProcessoP", {aux: value},
		function(retorno){
			if(retorno){
				document.getElementById('cad-indices').style.display = 'block';
			}else{
				alert("Erro!, contate o CPD");
				console.log(retorno);
			}
		}
	);
	return;
}


function deleteRow(i){
    document.getElementById('tb-partes').deleteRow(i)
}

function insereIndice(){
	var row = document.getElementById("linhas1");
	var table = document.getElementById("tb-indices");
	var clone = row.cloneNode(true);
	clone.id = "linhaClone2";
	clone.style.display = "table-row";
	table.appendChild(clone);
}

function cadastrarIndices(){
	var continua = false;
	var value = $("select[name='processo_id'] option:selected").val();
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
    debugger
    if(!(indi[0] == null)){
    	continua = true;
    }else{
    	alert("Selecione um índice!");
    	return;
    }

    if(continua){
    	$.post("control/cadastroControl.php?action=cadastrarIndices", {indices: indi, processo: value},
			function(retorno){
				if(retorno){
					alert("Índices(s) cadastrados!");
					$("#container1").html('');
					$("#container1").load('consultarProcessos.php');
				}else{
					alert("Erro!, contate o CPD");
					console.log(retorno);
				}
			}
		);
    }
}