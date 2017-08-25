var comb;
$(document).ready(function(){
	$("#btn_pesquisa").click(function(){
		if(comb == "pesNProcesso"){
			var campo = document.getElementById('proc_numero').value;
			var opcao = 1;
			pesquisaProcesso(campo, opcao);
		}else if(comb == "pesOrdemProcesso"){
			var campo = document.getElementById('proc_ordem').value;
			var opcao = 2;
			pesquisaProcesso(campo, opcao);
		}else if(comb == "pesVaraProcesso"){
			var campo = document.getElementsByName('proc_vara');
			var opcao = 3;
			pesquisaProcesso(campo[0].value, opcao);
		}else if(comb == "pesPartesProcesso"){
			var campo = document.getElementsByName('proc_parte');
			var opcao = 4;
			pesquisaProcesso(campo[0].value, opcao);
		}else if(comb == "pesIndicesProcesso"){
			var campo = document.getElementsByName('proc_indice');
			var opcao = 5;
			pesquisaProcesso(campo[0].value, opcao);
		}
	});

	$(".comb").keypress(function handleEnter(e, func) {
        e.preventDefault();
        if (e.keyCode == 13 || e.which == 13) {
            if(comb == "pesNProcesso"){
				var campo = document.getElementById('proc_numero').value;
				var opcao = 1;
				pesquisaProcesso(campo, opcao);
			}else if(comb == "pesOrdemProcesso"){
				var campo = document.getElementById('proc_ordem').value;
				var opcao = 2
				pesquisaProcesso(campo, opcao);
			}else if(comb == "pesVaraProcesso"){
				var campo = document.getElementsByName('proc_vara');
				var opcao = 3
				pesquisaProcesso(campo[0].value, opcao);
			}else if(comb == "pesPartesProcesso"){
				var campo = document.getElementsByName('proc_parte');
				var opcao = 4
				pesquisaProcesso(campo[0].value, opcao);
			}else if(comb == "pesIndicesProcesso"){
				var campo = document.getElementsByName('proc_indice');
				var opcao = 5;
				pesquisaProcesso(campo[0].value, opcao);
			}
        }
    });

    $(".text").keypress(function handleEnter(e, func) {
        
        if (e.keyCode == 13 || e.which == 13) {
            if(comb == "pesNProcesso"){
				var campo = document.getElementById('proc_numero').value;
				var opcao = 1;
				pesquisaProcesso(campo, opcao);
			}else if(comb == "pesOrdemProcesso"){
				var campo = document.getElementById('proc_ordem').value;
				var opcao = 2;
				pesquisaProcesso(campo, opcao);
			}else if(comb == "pesVaraProcesso"){
				var campo = document.getElementsByName('proc_vara');
				var opcao = 3;
				pesquisaProcesso(campo[0].value, opcao);
			}else if(comb == "pesPartesProcesso"){
				var campo = document.getElementsByName('proc_parte');
				var opcao = 4;
				pesquisaProcesso(campo[0].value, opcao);
			}else if(comb == "pesIndicesProcesso"){
				var campo = document.getElementsByName('proc_indice');
				var opcao = 5;
				pesquisaProcesso(campo[0].value, opcao);
			}
        }
    });

    $("#btn_limpar").click(function(){
    	debugger
    	$("#proc_numero").val("");
    	$("#proc_ordem").val("");
    	var vara = document.getElementsByName('proc_vara');
    	vara[0].options['0'].selected = true;
    	var parte = document.getElementsByName('proc_parte');
    	parte[0].options['0'].selected = true;
    	var indice = document.getElementsByName('proc_indice');
    	indice[0].options['0'].selected = true;

    });

	comb = document.getElementById("soflow").value;
});

function pesquisaProcesso(value, opcao){
	if(value == ""){
		alert("Selecione ou escreva algum argumento para a pesquisa!");
	}else{
		$.post("control/consultarControl.php?action=pesProcesso", {campo: value, tipo: opcao},
			function(retorno){ //resultado da control
				//console.log(retorno);
				if(retorno){
					$("#tb1 tbody").html(retorno);

				}else{
					$("#tb1 tbody").html("<td align=\"center\" colspan=\"4\">Processo não encontrado</td>");
				}
			} //function(retorno)
		); //$.post()
		return;
	}
}




function mudaCampo(novo){
	
	if(comb == "pesNProcesso"){
		var row = document.getElementById("Numero");
		row.style.display = "none";
	}else if(comb == "pesOrdemProcesso"){
		var row = document.getElementById("Ordem");
		row.style.display = "none";
	}else if(comb == "pesVaraProcesso"){
		var row = document.getElementById("Vara");
		row.style.display = "none";
	}else if(comb == "pesPartesProcesso"){
		var row = document.getElementById("Parte");
		row.style.display = "none";
	}else if(comb == "pesIndicesProcesso"){
		var row = document.getElementById("Indice");
		row.style.display = "none";
	}

	if(novo == "pesNProcesso"){
		var row = document.getElementById("Numero");
		row.style.display = "table-cell";
		comb = "pesNProcesso";
	}else if(novo == "pesOrdemProcesso"){
		var row = document.getElementById("Ordem");
		row.style.display = "table-cell";
		comb = "pesOrdemProcesso";
	}else if(novo == "pesVaraProcesso"){
		var row = document.getElementById("Vara");
		row.style.display = "table-cell";
		comb = "pesVaraProcesso";
	}else if(novo == "pesPartesProcesso"){
		var row = document.getElementById("Parte");
		row.style.display = "table-cell";
		comb = "pesPartesProcesso";
	}else if(novo == "pesIndicesProcesso"){
		var row = document.getElementById("Indice");
		row.style.display = "table-cell";
		comb = "pesIndicesProcesso";
	}
}