var id_form = 0;

$(document).ready(function(){
	$(".chosen-select").chosen({width: "100%"});
	//abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click
	$("#formulario").submit(function (event) {
		event.preventDefault();
		var processos_id = document.getElementById('soflow').value;
		document.getElementById('processos_id').value = processos_id;

		var formData = new FormData(this);
    	$.ajax({
	        url: "control/andamentos.php?action=cadastrar",
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	            if(data == "1"){
	            	alert("Tamanho do arquivo é superior a 8 MB");
	            	return false;
	            }else if(data == "2"){
	            	alert("Formato de arquivos inválido!");
	            	return false;
	            }else if(data == "3"){
	            	alert("Dados inválidos!");
	            	return false;
	            }else if(data == "4"){
	            	alert("Andamento e arquivos inseridos com sucesso!");
	            	$("#container1").html('');
					$("#container1").load('andamentos.php');
	            	return false;
	            }else if(data == "5"){
	            	alert("Andamento inserido com sucesso!");
	            	$("#container1").html('');
					$("#container1").load('andamentos.php');
	            	return false;
	            }else if(data == "6"){
	            	alert("Erro ao inserir o andamento!");
	            	return false;
	            }else{
	            	console.log(data);
	            	alert("Erro ao salvar o andamento! Entre em contato com o CPD!");
	            }
	        },
	        cache: false,
	        contentType: false,
	        processData: false,
    	});
    });
});

function procuraProcesso(value){
	if(value == ""){
		document.getElementById('cadAndamento').style.display = 'none';
		document.getElementById('andamento').style.display = 'none';
		$("#consultaAndamento").remove();
		return;
	}
	$.post("control/consultarControl.php?action=pesProcessoA", {aux: value},
		function(retorno){
			if(retorno){
				$("#consultaAndamento").remove();
				document.getElementById('cadAndamento').style.display = 'none';
				document.getElementById('andamento').style.display = 'none';
				$("#pessoa").append(retorno);
				return;
			}
			else{
				$("#and_tipo").val("");
				$("#and_com").val('');
				$("#and_data").val("");
				document.getElementById('andamento').style.display = 'none';
				document.getElementById('cadAndamento').style.display = 'block';
				$("#consultaAndamento").remove();
				return;
			}
		}
	);
}

function alterarAnd(value){
	var formElement = document.querySelector("#alterarAndamentoClone");
	var formData = new FormData(formElement);

	$.ajax({
        url: "control/andamentos.php?action=alterar",
        type: 'POST',
        data: formData,
        success: function (data) {
            if(data == "1"){
	            	alert("Tamanho do arquivo é superior a 8 MB");
	            	return false;
	            }else if(data == "2"){
	            	alert("Formato de arquivos inválido!");
	            	return false;
	            }else if(data == "3"){
	            	alert("Dados inválidos!");
	            	return false;
	            }else if(data == "4"){
	            	alert("Andamento e arquivos alterados com sucesso!");
	            	$("#container1").html('');
					$("#container1").load('andamentos.php');
	            	return false;
	            }else if(data == "5"){
	            	alert("Erro ao inserir os arquivos!");
	            	return false;
	            }else if(data == "6"){
	            	alert("Andamento alterado com sucesso!");
	            	$("#container1").html('');
					$("#container1").load('andamentos.php');
	            	return false;
	            }else if(data == "7"){
	            	alert("Erro ao inserir o andamento!");
	            	return false;
	            }else{
	            	console.log(data);
	            	alert("Erro ao salvar o andamento! Entre em contato com o CPD!");
	            }
        },
        cache: false,
        contentType: false,
        processData: false,
	});
}

function abrirCadastro(){
	$("#consultaAndamento").remove();
	document.getElementById('cadAndamento').style.display = 'none';
	document.getElementById('andamento').style.display = 'block';
}

function insereArquivo(){
	var row = document.getElementById("arq");
	var table = document.getElementById("tb-andamento");
	var clone = row.cloneNode(true);
	clone.id = "linhaClone";
	clone.style.display = "table-row";
	var row1 = document.getElementById("btn-and");
	row1.parentNode.insertBefore(clone,row1);
}

function deleteRow(i){
    document.getElementById('tb-andamento').deleteRow(i)
}
function deleteRow1(i){
    var a = i.parentNode;
    a.remove();
}

function mostraAndamento(value){
	event.preventDefault();
	var div = document.getElementById('mostraAndamento'+value);
	var filho = div.cloneNode(true);
	filho.style.display = "block";
	filho.id = "mostraAndamento"+value+"_clone";
	var form = filho.querySelector("#alterarAndamento");
	form.id = "alterarAndamentoClone";
	$("#andLista").html(filho);
}

function alteraAndamento(value){
	event.preventDefault();
	var div = document.getElementById('mostraAndamento'+value+"_clone");
	
	div.querySelector('#tipo_and_'+value).disabled = false;
	div.querySelector('#data_and_'+value).disabled = false;
	div.querySelector('#com_and_'+value).disabled = false;
	div.querySelector('#btn_abrirAndamento').style.display = 'none';	
	div.querySelector('#btn_alterarAndamento').style.display = 'inline';
	if(div.querySelector('.removeline')){
		var remove = div.querySelectorAll('.removeline');
		for(i=0;i<remove.length;i++){
			remove[i].style.display = 'inline';	
		}
	}
	div.querySelector('#btn_adicionarArquivo').style.display = 'inline';
	div.querySelector('#a-alterar').style.display = 'none';

	id_form = value;

}

function adicionaArquivo(value){
	 var html = "<tr><td>";
	 html += "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"8388608\" />";
     html += "<input type=\"file\" class=\"files\" id=\"arquivos\" name=\"arquivo[]\">";
     html += "<a onclick=\"deleteRow1(this)\" id=\"teste123\" href=\"#a\"><img src=\"assets/remove.png\" width=\"10px\" height=\"10px\"></a>"
     html += "</td></tr>";
	var div = document.getElementById('mostraAndamento'+value+"_clone");
    var linha_file = div.querySelector('#linha-file');
    $(html).insertBefore(linha_file);
}