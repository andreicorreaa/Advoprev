<?php
    require_once("checkLogin.php");
?>
<!DOCTYPE html>
<head>
	<link href="css/cons.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/usuarios.js"></script>
	<link href="modal/modal.css" rel="stylesheet" type="text/css" />
	<link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
</head>
<body>
	<h1>Consultar Usuários</h1>
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
				<caption>Usuários</caption>
					<thead>
						<th width="49%">Login</th>
						<th width="48%">Grupo</th>
						<th width="3%"></th>
					</thead>
					<tbody>
					</tbody>
        	</table>
        </div>
	</div>
</body>