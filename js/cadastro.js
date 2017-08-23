$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_cadastro").click(function(){
		//Aqui chamamos a função validaLogin(), e passamos a ela o que foi digitado no campo com id='login' e no campo com id='senha'
		validaCadastro($("#nome"), $("#senha"), $("#confirma_s"));
	});

	$("#btn_cadpessoa").click(function(){
		//Aqui chamamos a função validaCadPessoa, e passamos a ela o que foi digitado nos campos de cadastro de pessoa
		validaCadPessoa($("#nome1"), $("#cpf"), $("#email"), $("#rg"), $("#data"), $("#telefone"), $("#sexo"), $("#oab"), $("#endereco"));

	});
});
/* ---------------------------- CADASTRO DE USUARIOS ------------------------------------ */
function validaCadastro(nome, senha, confirma_s){
	var name = nome.val();
	var name = name.length;
	var senha1 = senha.val();
	var senha1 = senha1.length;

	if(nome.val() == ""){
		login.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}else if(senha.val() == ""){
		senha.focus(); //Adiciona foco ao campo com id='senha'
		return; //retorna nulo
	}else if(confirma_s.val() == ""){ 
		confirma_s.focus(); //Adiciona foco ao campo com id='confima_s'
		return; //retorna nulo
	}else if(name < 6){
		login.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}else if(senha1 < 6){
		senha.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}else if(confirma_s.val() !=  senha.val()){
		confirma_s.focus(); //Adiciona foco ao campo com id='confirma_s'
		return; //retorna nulo
	}
	else{ // caso todos os campos foram preenchidos corretamente
		$.post("control/cadastroControl.php?action=cad", {nome: nome.val(), senha: senha.val()}, // envia variaveis por POST para a control cadastroControl
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
					$(retorno1).html("<strong>Erro ao efetuar o cadastro, verifique o login ou a conexão</strong> ");
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

//função para checar login no cadastro de usuarios
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


/* ------------------------- CADASTRO DE PESSOAS --------------------------*/


function validaCadPessoa(nome, cpf, emails, rg, data, tel, sexo, oab, endereco){
	var email = IsEmail(emails.val());
	var rg_check = buscarRG(rg.val());
	var cpf_check = verificaCPF(cpf.val());
	tel_check = buscarTel(tel.val());
	//alert(endereco.val());
	if(nome.val() == ""){
		nome.focus();
		return;
	}
	else if(cpf.val() == "" || cpf_check == false){
		cpf.focus();
		return;
	}else if(email == false) {
		alert("email inválido");
		return;
	}else if(rg.val() == "" || rg_check == false){
		rg.focus();
		return;
	}else if(data.val() == ""){
		data.focus();
		return;
	}else if(tel.val() == "" || tel_check == false){
		tel.focus();
		return;
	}else if(endereco.val() == ""){
		endereco.focus();
		return;
	}else{
		$.post("control/cadastroControl.php?action=cadastro", {cpf: cpf.val(), rg: rg.val(),
		nome: nome.val(), data: data.val(),	email: emails.val(), telefone: tel.val(), 
		sexo: sexo.val(), oab: oab.val(), endereco: endereco.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2 == 1){
					$("#nome1").val("");
					$("#cpf").val("");
					$("#email").val(""); 
					$("#rg").val("");
					$("#data").val("");
					$("#telefone").val("");
					$("#sexo").val("");
					$("#oab").val("");
					$("#endereco").val("");
					$("#verifica1").html("");
					alert("Cadastro efetuado com sucesso");
				}else{
					alert(retorno2);
				}
			} //function(retorno)
		); //$.post()
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
				return false;
			}else{
				return true;
			}

		}
	);
}
//validar RG
function buscarRG(valor){
	debugger
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