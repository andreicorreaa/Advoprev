var comb;
$(document).ready(function(){
	$("#btn_pesquisa").click(function(){
		if(comb == "pesNProcesso"){
			var campo = document.getElementById('proc_numero').value;

			pesquisaProcesso(campo);
		}else if(comb == "pesOrdemProcesso"){
			var campo = document.getElementById('proc_ordem').value;

			pesquisaProcesso(campo);
		}else if(comb == "pesVaraProcesso"){
			var campo = document.getElementsByName('proc_vara');

			pesquisaProcesso(campo[0].value);
		}else if(comb == "pesPartesProcesso"){
			var campo = document.getElementById('proc_indice').value;

			pesquisaProcesso(campo[0]);
		}else if(comb == "pesIndicesProcesso"){
			var campo = document.getElementById('proc_parte').value;

			pesquisaProcesso(campo[0]);
		}
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

	comb = document.getElementById("soflow").value;
});

function pesquisaProcesso(value){
	if(value == ""){
		alert("Selecione ou escreva algum argumento para a pesquisa!");
	}
	console.log(value);
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