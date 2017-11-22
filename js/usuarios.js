$(document).ready(function(){
	$(".chosen-select").chosen({width: "100%"});
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click
	$("#btn_cadastro").click(function(){
		//Aqui chamamos a função validaLogin(), e passamos a ela o que foi digitado no campo com id='login' e no campo com id='senha'
		validaCadastro($("#nome"), $("#senha"), $("#confirma_s"), $("#grupo"));
	});

	$("#btn_pesquisa").click(function(){
		pesquisaUsuario($("#campo"));
	});

	$("#campo").keypress(function handleEnter(e, func) {
        if (e.keyCode == 13 || e.which == 13) {
            pesquisaUsuario($("#campo"));
        }
    });

	$("#btn_limpar").click(function(){
    	$("#campo").val("");
    });

});

function validaCadastro(nome, senha, confirma_s, grupo){
	var name = nome.val();
	var name = name.length;
	var senha1 = senha.val();
	var senha1 = senha1.length;
	var group = grupo.val();

	if(nome.val() == ""){
		nome.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}else if(senha.val() == ""){
		senha.focus(); //Adiciona foco ao campo com id='senha'
		return; //retorna nulo
	}else if(confirma_s.val() == ""){ 
		confirma_s.focus(); //Adiciona foco ao campo com id='confima_s'
		return; //retorna nulo
	}else if(name < 6){
		nome.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}else if(senha1 < 6){
		senha.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}else if(confirma_s.val() !=  senha.val()){
		confirma_s.focus(); //Adiciona foco ao campo com id='confirma_s'
		return; //retorna nulo
	}else if(group == ""){
		alert("Selecione o grupo");
		grupo.focus(); //Adiciona foco ao campo com id='confirma_s'
		return; //retorna nulo
	}
	else{ // caso todos os campos foram preenchidos corretamente
		$.post("control/cadastroControl.php?action=cad", {nome: nome.val(), senha: senha.val(), grupo: group}, // envia variaveis por POST para a control cadastroControl
			function(retorno1){ //resultado da control
				if(retorno1 == 1){ // neste caso, se for true, o cadastro foi efetuado
					nome.val(""); 
					senha.val("");
					confirma_s.val(""); //reseta os campos
					var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
					$("#verifica").html(a);
					$("#alert1").html("<strong>Cadastro efetuado com sucesso!</strong>"); //exibe mensagem na div alert1
					$("#alert1").removeClass().addClass("success"); // muda a classe da div
					document.getElementById("alert1").style.display = "block"; // deixa a div visivel
					//essa funcao seta um tempo para a div sumir
					setTimeout(function(){
						$("#alert1").fadeOut('fast');
					}, 3000);
				}else{ // caso de algum erro
					$("#alert1").html("<strong>Erro ao efetuar o cadastro, verifique o login ou a conexão</strong> ");
					$("#alert1").removeClass().addClass("alert");
					document.getElementById("alert1").style.display = "block";
					setTimeout(function(){
						$("#alert1").fadeOut('fast');
					}, 3000);
				}
			} //function(retorno)
		); //$.post()
	} //else
}

function buscarUser(valor) {
	var name = valor.length;
	if(name < 6){
		var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
		$("#verifica").html(a);
		return; //retorna nulo
	}
	$.post("control/cadastroControl.php?action=ver", {nome: valor}, // envia variaveis por POST para a control cadastroControl
		function(retorno){ //retorno é o resultado que a control retorna
			var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
			if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
				$("#verifica").html(a);  //mostra na div alert
			}
			else{
				var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
				$("#verifica").html(b);
			}
		}
	);
}

function pesquisaUsuario(campo){
	if(campo.val() == ""){
		campo.val("%");
		$.post("control/consultarControl.php?action=pesUsuario", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td colspan=\"3\" align=\"center\">Usuário não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}else{
		$.post("control/consultarControl.php?action=pesUsuario", {desc: campo.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2){
					$("#tb1 tbody").html(retorno2);
				}else{
					$("#tb1 tbody").html("<td colspan=\"3\" align=\"center\">Usuário não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}
}