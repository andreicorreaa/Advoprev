<?php
    require_once("checkLogin.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/selecionar.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/selecionar.js"></script>
    </head>
    <body>
        <div id="conteudo">
            <h1>Relatórios</h1>

            <div id="selecionar">
                <button type="button" name="btn_relatorio1" id="btn_relatorio1">Por Processo</button>
                <button type="button" name="btn_relatorio2" id="btn_relatorio2">Por Andamento</button>
                <button type="button" name="btn_relatorio3" id="btn_relatorio3">Por Assunto/índice</button>
            </div>
            <div id="container1">

            </div>
        </div>
    </body>
</html>