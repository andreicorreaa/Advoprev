<!-- ----------------------------------- DESENVOLVIDO POR EMERSON ANDREI ----------------------------------- -->
<?php
    require_once("checkLogin.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="Sistema de Advocacia">
        <meta name="keywords" content="funprev, advocacia, sistema, advoprev">
        <meta name="author" content="Emerson Andrei">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início - AdvoPREV - FUNPREV BAURU</title>
        
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="body">
            <?php include "navbar.php"; ?>
            <div id="container">
                <?php include_once("inicio.php"); ?>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </body>
</html>