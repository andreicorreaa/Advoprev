/*

$(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog

	$('#formlogin').submit(function(){ 	//Ao submeter formulário
		var nome=$('#nome').val();	//Pega valor do campo email
		var senha=$('#senha').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"../control/login.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "nome="+nome+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='../view/home.php';//Redireciona
                		}else{
                			$('#errolog').show();		//Informa o erro

                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})

*/

$(document).ready(function(){
	
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click
	$("#btn_login").click(function(){
	
		//Aqui chamamos a função validaLogin(), e passamos a ela o que foi digitado no campo com id='login' e no campo com id='senha'
		validaLogin($("#nome"), $("#senha"));
	
	});

	$("#btn_logout").click(function(){
	
		//funcao para chamar a funcao de logout
		location.href='control/login.php?action=logout';
	
	});

});


function validaLogin(login, senha){
	
	if(login.val() == ""){
		alert("Informe o login!"); //Exibe um alerta 
		login.focus(); //Adiciona foco ao campo com id='login'
		return; //retorna nulo
	}
	else if(senha.val() == ""){
		alert("Informe a senha!");
		senha.focus();
		return;
	}
	//Se o usuário informou login e senha, então é hora do Ajax entrar em ação
	else{
	
		//Adicionamos um texto na DIV #resultado para alertar o usuário que o sistema está autenticando os dados
		$("#resultado").html("Autenticando...");
		
		/**Função ajax nativa da jQuery, onde passamos como parâmetro o endereço do arquivo que queremos chamar, os dados que irá receber, e criamos de forma encadeada a função que irá armazenar o que foi retornado pelo servidor, para poder se trabalhar com o mesmo */
		$.post("control/loginControl.php?action=login", {nome: login.val(), senha: senha.val()}, 
			function(retorno){
				
				//Insere na DIV #resultado o que foi retornado pelas classes de manipulação do Usuário (Se os dados estão corretos ou não)
				

				if(retorno == 1){
					window.location=('home.php');
					//$("#resultado").html(retorno);
				}
				$("#resultado").html(retorno);
				
			} //function(retorno)
		); //$.post()
	}
} //validaLogin()