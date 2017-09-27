$(document).ready(function(){
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click
});

function procuraProcesso(value){
	if(value == ""){
		alert("Selecione um processo");
		return;
	}
	$.post("control/consultarControl.php?action=pesProcessoR", {aux: value},
		function(retorno){
			if(retorno){
				$("#relatorio").html("");
				$("#relatorio").html(retorno);
				return;
			}
			else{
				console.log(retorno);
			}
		}
	);
}

function Imprimir(){
	$("#relatorioProcesso").printThis({
		importStyle: true,
		loadCSS: "css/relatorios.css",
		base: "../../advoprev/" ,
	});
}