$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click

	$("#btn_cadastro").click(function(){
		//Aqui chamamos a função validaLogin(), e passamos a ela o que foi digitado no campo com id='login' e no campo com id='senha'
		validaCadastro($("#nome"), $("#senha"), $("#confirma_s"));
	});

	$("#btn_cadpessoa").click(function(){
		//Aqui chamamos a função validaCadPessoa, e passamos a ela o que foi digitado nos campos de cadastro de pessoa
		if(!$("input:radio[name=tipo-pessoa]:checked").val()){
			alert("Selecione o tipo de pessoa");
			return;
		}
		validaCadPessoa($("#nome1"), $("input:radio[name=tipo-pessoa]:checked").val(), $("#email"), $("#rg"), $("#data"), $("#telefone"), $("#sexo"),  $("#oab"), $("#endereco"));
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


function validaCadPessoa(nome, tipoPessoa, emails, rg, data, tel, sexo, oab, endereco){
	var cpf_cnpj;
	var email = IsEmail(emails.val());
	if(tipoPessoa == "cpf"){
		cpf_cnpj = $("#cpf").val();
		var check = verificaCPF(cpf_cnpj);
	}else{
		cpf_cnpj = $("#cnpj").val();
		var check = validarCNPJ(cpf_cnpj);
	}

	if(nome.val() == ""){
		nome.focus();
		return;
	}else if(email == false) {
		alert("email inválido");
		return;
	}else if(check == false) {
		alert("CPF/CNPJ inválido");
		return;
	}else if(data.val() == ""){
		data.focus();
		return;
	}else if(tel.val() == ""){
		tel.focus();
		return;
	}else if(endereco.val() == ""){
		endereco.focus();
		return;
	}else{
		$.post("control/cadastroControl.php?action=cadastro", {cpf_cnpj: cpf_cnpj, rg: rg.val(),
		nome: nome.val(), data: data.val(),	email: emails.val(), telefone: tel.val(), 
		sexo: sexo.val(), oab: oab.val(), endereco: endereco.val()}, // envia variaveis por POST para a control cadastroControl
			function(retorno2){ //resultado da control	
				if(retorno2 == 1){
					alert("Cadastro efetuado com sucesso");
					$("#container1").html('');
					$("#container1").load('cadastroPessoas.php');
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

function buscarCNPJ(valor){
	var cnpj = valor.length;
	var a = unescape("<img src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
	var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
	if(cnpj < 14){
		$("#verifica1").html(a);
		return; //retorna nulo
	}else if(!validarCNPJ(valor)){
		$("#verifica1").html(a);
		return; //retorna nulo
	}else{
		$.post("control/cadastroControl.php?action=verCPF", {aux: valor}, // envia variaveis por POST para a control cadastroControl
		function(retorno){ //retorno é o resultado que a control retorna
			var a = unescape("<img alt=\"CNPJ inválido ou já cadastrado\" src=\"assets/uncheck.png\" width=\"20px\" height=\"20px\">");
			var b = unescape("<img src=\"assets/check.png\" width=\"20px\" height=\"20px\">");
			if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
				$("#verifica1").html(a);  //mostra na div alert
				//alert("CNPJ já cadastrado");
				return false;
			}else{
				var c = validarCNPJ((valor.replace(/[a-z]/gi,''))); // verifica se o cpf é valido
				if(c == true){
					$("#verifica1").html(b);
					return true;
				}else{
					alert("CPF com formato inválido");
					$("#verifica1").html(a);
					return false;
				}
			}
		});
	}
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
	if(IsEmail(valor)){
		$.post("control/cadastroControl.php?action=verEmail", {aux: valor}, // envia variaveis por POST para a control cadastroControl
			function(retorno){ //retorno é o resultado que a control retorna
				if(retorno == 1){
					setTimeout(window.alert("Email já cadastrado"), 1000);
					$("#email").val("");
					return false;
				}else{
					return true;
				}
			}
		);
	}
}
//validar RG
function buscarRG(valor){
	$.post("control/cadastroControl.php?action=verRG", {aux: valor}, // envia variaveis por POST para a control cadastroControl
		function(retorno){ //retorno é o resultado que a control retorna
			if(retorno == 1){ // se retornar 1, neste caso o login ja existe no banco
				//mostra na div alert
				alert("RG já cadastrado");
				$("#rg").val("");
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

function tipoPessoa(value){
	if(value.value == "cpf"){
		document.getElementById("tipoPessoa").style.display = 'none';
		document.getElementById("lblcpf").style.display = 'table-cell';
		document.getElementById("inputcpf").style.display = 'table-cell';
	}else{

		document.getElementById("tipoPessoa").style.display = 'none';
		document.getElementById("lblcnpj").style.display = 'table-cell';
		document.getElementById("inputcnpj").style.display = 'table-cell';
	}
}

function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}