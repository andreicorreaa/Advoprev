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
            <h1>Pessoas</h1>

            <div id="selecionar">
            <?php if($data->getUsuarios_grupo() < 2){ ?>
                <button type="button" name="btn_mostra1" id="btn_mostra1">Cadastrar Usuário</button>
            <?php } ?>
                <button type="button" name="btn_mostra2" id="btn_mostra2">Consultar</button>
                <button type="button" name="btn_mostra3" id="btn_mostra3">Cadastrar</button>
            </div>
            <div id="container1">

            </div>
        </div>
    </body>
</html>