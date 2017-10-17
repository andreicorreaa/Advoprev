<?php
    require_once("checkLogin.php");
?>
<!DOCTYPE html>
<head>
	<link href="css/cons.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/varas.js"></script>
	<link href="modal/modal.css" rel="stylesheet" type="text/css" />
	
</head>
<body>
	<h1>Consultar Varas</h1>
	<div id="pesquisa">
		<table align="center" id="tb2">
			<tr>
				<td><input type="text" name="campo" id="campo" placeholder="Pesquisar" size="60" required/></td>
				<td><button type="button" name="btn_pesquisa" id="btn_pesquisa">Pesquisar</button></td>
	            <td><button type="reset" id="btn_limpar">Limpar</button></td>
            </tr>
        </table>
	</div>
	<div id="mostra">
		<div style="overflow-x:auto;">
			<table id="tb1">
				<caption>Varas</caption>
					<thead>
						<th width="80%">Descrição</th>
						<th width="3%">	</th>
					</thead>
					<tbody>
					</tbody>
        	</table>
        </div>
	</div>
</body>