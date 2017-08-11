$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_pesquisa").click(function(){
		pesquisaIndice($("#campo"));
	})

	$("#campo").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            pesquisaIndice($("#campo"));
        }
    });

    $("#btn_cadIndice").click(function(){
		cadIndice($("#desc"));
	})

	$("#desc").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            cadIndice($("#desc"));
        }
    });

});

function cadIndice(campo){
	var checkindice = buscarIndice(campo.val());
	console.log(checkindice);
	if(campo.val() == ""){
		alert("Digite no campo pesquisar");
		campo.focus();
		return;
	}else if(checkindice == false){
		alert("Indice já cadastrado");
		campo.val("");
		return;
	}else{
		$.post("control/cadastroControl.php?action=cadIndice", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				console.log(retorno2);
				if(retorno2){
					campo.val("");
					//alert("Cadastro Efetuado Com Sucesso!");
				}else{
					alert(retorno2);
				}
			} //function(retorno)
		); //$.post()
		return;
	}
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
					$("#tb1 tbody").html("<td align=\"center\">Assunto não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}
}

function buscarIndice(valor){
	
	$.post("control/consultarControl.php?action=checkIndice", {desc: valor}, // envia variaveis por POST para a control cadastroControl
		function(retorno){ //retorno é o resultado que a control retorna
			//console.log(retorno);
			if(retorno == true){
				return false;
			}else{
				return true;
			}

		}
	);
}