$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_pesquisa").click(function(){
		pesquisaTipos($("#campo"));
	});

	$("#campo").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            pesquisaTipos($("#campo"));
        }
    });

    $("#btn_cadTipo").click(function(){
		var check = document.getElementById('desc').value;
		if(buscarTipos(check) == true){
			//alert("Indice já cadastrado!");
			$("#desc").val("");
			$("#desc").focus();
		}else{
			cadTipos($("#desc"));	
		}
	});

	$("#desc").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            var check = document.getElementById('desc').value;
			if(buscarTipos(check) == true){
				//alert("Indice já cadastrado!");
				$("#desc").val("");
				$("#desc").focus();
			}else{
				cadTipos($("#desc"));	
			}
        }
    });

    $("#btn_limpar").click(function(){
    	$("#campo").val("");
    	$("#desc").val("");
    });

});

function cadTipos(campo){
	debugger
	$.post("control/cadastroControl.php?action=cadTipo", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
		function(retorno2){ //resultado da control
			console.log(retorno2);
			/*if(retorno2 == true){
				campo.val("");
				alert("Cadastro Efetuado Com Sucesso!");
			}else{
				alert("Erro :(");
				console.log(retorno2);
			}*/
		}
	);
	return;
}

function pesquisaTipos(campo){
	if(campo.val() == ""){
		alert("Digite no campo pesquisar");
		campo.focus();
		return;
	}else{
		$.post("control/consultarControl.php?action=pesTipo", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td align=\"center\">Tipo/Situação não encontrado</td>");
				}
			}
		);
		return;
	}
}

function buscarTipos(valor){
	if(valor == ""){
		alert("Digite algo!");
		return;
	}else{
		var aux = false;
		$.post("control/consultarControl.php?action=checkTipo", {desc: valor}, // envia variaveis por POST para a control cadastroControl
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
