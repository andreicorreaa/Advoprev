<?php
	include_once('../model/servico.php');
	$id = $_GET['id'];
	$result = Servico::selecionarArquivos($id);
	if($result){
		header("Content-length:".$result[0]['arquivos_tamanho']);
		header("Content-type:".$result[0]['arquivos_tipo']);
		header("Content-Disposition: inline; filename=".$result[0]['arquivos_nome']);
		echo $result[0]['arquivos_arq'];
	}
?>