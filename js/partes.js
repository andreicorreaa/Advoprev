$(document).ready(function(){
	$(".chosen-select").chosen({width: "100%"});
});

function procuraProcesso(value){
	if(value == ""){
		alert("Selecione um processo");
		document.getElementById('cad-partes').style.display = 'none';
		return;
	}
	$.post("control/consultarControl.php?action=pesProcessoP", {aux: value},
		function(retorno){
			if(retorno){
				document.getElementById('cad-partes').style.display = 'block';
			}else{
				alert("Erro!, contate o CPD");
				console.log(retorno);
			}
		}
	);
	return;
}

function insereParte(){
	var row = document.getElementById("linhas");
	var table = document.getElementById("tb-partes");
	var clone = row.cloneNode(true);
	clone.id = "linhaClone";
	clone.style.display = "table-row";
	table.appendChild(clone);
}

function deleteRow(i){
    document.getElementById('tb-partes').deleteRow(i)
}

function cadastrarParte(){
	var value = $("select[name='processo_id'] option:selected").val();
	//DADOS DAS PARTES
	var nome = document.getElementsByName('proc_partes_n');
	var desc = document.getElementsByName('proc_partes_p');
	var e = [null];
	var p = [null];
	var a = 0;
	var continua = false;
	for(i=0;i<nome.length;i++){
        if(nome[i].value != "" && desc[i].value != ""){
        	e[a] = nome[i].value;
        	p[a] = desc[i].value;
        	var continua = true;
        	a++;
        }else if(nome[i].value != "" && desc[i].value == ""){
        	alert("preencha corretamenete o tipo da parte! linha: "+i);
        	return;
        }else if(nome[i].value == "" && desc[i].value != ""){
        	alert("preencha corretamenete o nome da parte! linha: "+i);
        	return;
        }else if(nome[i].value == "" && desc[i].value == ""){
        	if(i != 0){
	        	alert("preencha corretamenete os campos! linha: "+i);
	        	return;
	        }
        }
    }
    if(continua){
    	$.post("control/cadastroControl.php?action=cadastrarPartes", {pessoas: e, partes: p, processo: value},
			function(retorno){
				if(retorno){
					alert("Partes cadastradas!");
					$("#container1").html('');
					$("#container1").load('consultarPartes.php');
				}else{
					alert("Erro!, contate o CPD");
					console.log(retorno);
				}
			}
		);
    }
}