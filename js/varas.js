$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_pesquisa").click(function(){
		pesquisaVara($("#campo").val());
	});

	$("#campo").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            pesquisaVara($("#campo"));
        }
    });

    $("#btn_cadVara").click(function(){
		var check = document.getElementById('desc').value;
		if(buscarVara(check) == true){
			//alert("Indice já cadastrado!");
			$("#desc").val("");
			$("#desc").focus();
		}else{
			cadVara($("#desc"));	
		}
	});

	$("#desc").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            var check = document.getElementById('desc').value;
			if(buscarVara(check) == true){
				//alert("Indice já cadastrado!");
				$("#desc").val("");
				$("#desc").focus();
			}else{
				cadVara($("#desc"));	
			}
        }
    });

    $("#btn_limpar").click(function(){
    	$("#campo").val("");
    	$("#desc").val("");
    });

});

function cadVara(campo){
	if(campo.val() == ""){
		campo.focus();
		return;
	}else{
		$.post("control/cadastroControl.php?action=cadVara", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
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
	}
	return;
}

function pesquisaVara(campo){
	if(campo == ""){
		campo = "%";
		$.post("control/consultarControl.php?action=pesVara", {desc: campo}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td align=\"center\">Vara não encontrada</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}else{
		$.post("control/consultarControl.php?action=pesVara", {desc: campo}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td align=\"center\">Vara não encontrada</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}
}

function buscarVara(valor){
	if(valor == ""){
		var aux = false;
		alert("Digite Algo!");
		return;
	}else{
		var aux = false;
		$.post("control/consultarControl.php?action=checkVara", {desc: valor}, // envia variaveis por POST para a control cadastroControl
			function(retorno){ //retorno é o resultado que a control retorna
				if(retorno){ // se retornar 1, neste caso o login ja existe no banco
					alert("Vara já cadastrada!");
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