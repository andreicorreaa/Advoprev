<?php
    require_once("checkLogin.php");
?>
<!DOCTYPE html>
<head>
	<link href="css/cons.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/consultarPessoas.js"></script>
	<link href="modal/modal.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<h1>Consultar Pessoas</h1>
	<div id="pesquisa">
		<table align="center" id="tb2">
			<tr>
				<td><select id="soflow" name="tipo">
					  <!-- This method is nice because it doesn't require extra div tags, but it also doesn't retain the style across all browsers. -->
					  <option value="pesNome" selected>Nome</option>
					  <option value="pesCpf">CPF</option>
					  <option value= "pesRG">RG</option>
					</select></td>
				<td><input type="text" name="campo" id="campo" placeholder="Pesquisar" size="60" required/></td>
				<td><button type="button" name="btn_pesquisa" id="btn_pesquisa">Pesquisar</button></td>
	            <td><button type="reset" id="btn_limpar">Limpar</button></td>
            </tr>
        </table>
	</div>
	<div id="mostra">
		<div style="overflow-x:auto;">
			<table id="tb1">
				<caption>Pessoas</caption>
					<thead>
						<th width="40%">Nome</th>
						<th width="28%">CPF</th>
						<th width="28%">RG</th>
						<th width="3%"></th>
					</thead>
					<tbody>
					</tbody>
        	</table>
        </div>
	</div>
</body>