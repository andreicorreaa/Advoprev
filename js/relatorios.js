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
				$("#relatorio").html("");
				$("#relatorio").html(retorno);
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

function buscarAPICorreios(value, id){
	console.log("save");
    var cep = value.replace(/\D/g, '');
    if(cep != ""){
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '//viacep.com.br/ws/'+ cep +'/json/?callback=?',
                async: false,
                success: function(response){
                	console.log("save");
                    if(!("erro" in response)){
                        $("#endereco"+id).html("TESTE verdade");
                    }else{
                        //alert("CEP inexistente");
                        $("#endereco"+id).html("TESTE FALSO");
                    }
                }
            });
        }
    }
}

function abrir(id){

	var width = 900;
	var height = 500;

	LeftPosition = (screen.width) ? (screen.width-width)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-height)/2 : 0;
 
	window.open('resumo.php?id='+id,'Resumo', 'width='+width+', height='+height+', top='+TopPosition+', left='+LeftPosition+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}