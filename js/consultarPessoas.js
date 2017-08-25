$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_pesquisa").click(function(){
		pesquisaPessoa($("#soflow"), $("#campo"));
	});

	$("#campo").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            pesquisaPessoa($("#soflow"), $("#campo"));
        }
    });

    $("#btn_limpar").click(function(){
    	//$("#soflow").option["0"]; //option[value="Janeiro"]').prop('selected', true);
    	$("#campo").val("");
    });

});


function pesquisaPessoa(tipo, campo){
	if(campo.val() == ""){
		alert("Digite no campo pesquisar");
		campo.focus();
		return;
	}else if(tipo.val() == "pesNome"){
		$.post("control/consultarControl.php?action=pesNome", {nome: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				
				if(retorno2){
					$("#tb1 tbody").html(retorno2);

				}else{
					$("#tb1 tbody").html("<td align=\"center\" colspan=\"4\">Usuário não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}else if(tipo.val() == "pesCpf"){
		$.post("control/consultarControl.php?action=pesCPF", {cpf: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td align=\"center\" colspan=\"4\">Usuário não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}else if(tipo.val() == "pesRG"){
		$.post("control/consultarControl.php?action=pesRG", {rg: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td align=\"center\" colspan=\"4\">Usuário não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}
	return;
}