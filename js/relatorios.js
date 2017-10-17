$(document).ready(function(){
	$(".chosen-select").chosen({width: "100%"})
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

function procuraAndamento(){
	var data_inicio = $("#data-inicio").val();
	var data_final = $("#data-final").val();
	
	$.post("control/consultarControl.php?action=pesAndamentoR", {data_inicio: data_inicio, data_final: data_final},
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

function procuraIndice(){
	var data_inicio = $("#data-inicio").val();
	var data_final = $("#data-final").val();
	
	$.post("control/consultarControl.php?action=pesIndiceR", {data_inicio: data_inicio, data_final: data_final},
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
		pageTitle: "&nbsp",
	});
}

function ImprimirAndamento(){
	$("#relatorioAndamento").printThis({
		importStyle: true,
		loadCSS: "css/relatorios.css",
		base: "../../advoprev/" ,
		pageTitle: "&nbsp",
	});
}

function ImprimirIndice(){
	$("#relatorioIndice").printThis({
		importStyle: true,
		loadCSS: "css/relatorios.css",
		base: "../../advoprev/" ,
		pageTitle: "&nbsp",
	});
}