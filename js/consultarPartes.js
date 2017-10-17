var comb;
var status = false;
$(document).ready(function(){
	$(".chosen-select").chosen({width: "100%"});	
	$("#btn_pesquisa").click(function(){
		if(comb == "pesNProcesso"){
			var campo = document.getElementById('proc_numero').value;
			var opcao = 1;
			pesquisaParte(campo, opcao);
		}else if(comb == "pesParte"){
			var campo = document.getElementById('proc_parte').value;
			var opcao = 2;
			pesquisaParte(campo, opcao);
		}else if(comb == "pesNUsuario"){
			var campo = document.getElementsByName('proc_usuario');
			var opcao = 3;
			pesquisaParte(campo[0].value, opcao);
		}
	});

	$(".comb").keypress(function handleEnter(e, func) {
        e.preventDefault();
        if (e.keyCode == 13 || e.which == 13) {
            if(comb == "pesNProcesso"){
				var campo = document.getElementById('proc_numero').value;
				var opcao = 1;
				pesquisaParte(campo, opcao);
			}else if(comb == "pesParte"){
				var campo = document.getElementById('proc_parte').value;
				var opcao = 2;
				pesquisaParte(campo, opcao);
			}else if(comb == "pesNUsuario"){
				var campo = document.getElementsByName('proc_usuario');
				var opcao = 3;
				pesquisaParte(campo[0].value, opcao);
			}
        }
    });

    $(".text").keypress(function handleEnter(e, func) {
        
        if (e.keyCode == 13 || e.which == 13) {
            if(comb == "pesNProcesso"){
				var campo = document.getElementById('proc_numero').value;
				var opcao = 1;
				pesquisaParte(campo, opcao);
			}else if(comb == "pesParte"){
				var campo = document.getElementById('proc_parte').value;
				var opcao = 2;
				pesquisaParte(campo, opcao);
			}else if(comb == "pesNUsuario"){
				var campo = document.getElementsByName('proc_usuario');
				var opcao = 3;
				pesquisaParte(campo[0].value, opcao);
			}
        }
    });

    $("#btn_limpar").click(function(){
    	debugger
    	$("#proc_numero").val("");
    	$("#proc_parte").val("");
    	var vara = document.getElementsByName('proc_usuario');
    	vara[0].options['0'].selected = true;
    });

	comb = document.getElementById("soflow").value;
});

function mudaCampo(novo){
	
	if(comb == "pesNProcesso"){
		var row = document.getElementById("Numero");
		row.style.display = "none";
	}else if(comb == "pesNUsuario"){
		var row = document.getElementById("Usuario");
		row.style.display = "none";
	}else if(comb == "pesParte"){
		var row = document.getElementById("Parte");
		row.style.display = "none";
	}

	if(novo == "pesNProcesso"){
		var row = document.getElementById("Numero");
		row.style.display = "table-cell";
		comb = "pesNProcesso";
	}else if(novo == "pesNUsuario"){
		var row = document.getElementById("Usuario");
		row.style.display = "table-cell";
		comb = "pesNUsuario";
	}else if(novo == "pesParte"){
		var row = document.getElementById("Parte");
		row.style.display = "table-cell";
		comb = "pesParte";
	}
}

function atualizar(){
	if(status == "true"){
		$("#container1").load('consultarPartes.php');
	}
}

function pesquisaParte(value, opcao){
	if(value == ""){
		alert("Selecione ou escreva algum argumento para a pesquisa!");
	}else{
		status = true;
		$.post("control/consultarControl.php?action=pesParte", {campo: value, tipo: opcao},
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