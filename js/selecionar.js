$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click
	$("#btn_mostra1").click(function(){
		
		$("#container1").html('');
		$("#container1").load('cadastroUsuarios.php');
	});

	$("#btn_mostra2").click(function(){
		$("#container1").html('');
		$("#container1").load('consultarPessoas.php');
	});

	$("#btn_mostra3").click(function(){
		$("#container1").html('');
		$("#container1").load('cadastroPessoas.php');
	});

	$("#btn_processo1").click(function(){
		$("#container1").html('');
		$("#container1").load('cadastroProcesso.php');
	});

	$("#btn_processo2").click(function(){
		$("#container1").html('');
		$("#container1").load('consultarProcessos.php');
	});
});