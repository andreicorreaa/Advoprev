<!-- ----------------------------------- DESENVOLVIDO POR EMERSON ANDREI ----------------------------------- -->
<?php
    session_start();
        if(isset($_SESSION['login'])){ //checa se existe uma session iniciada
            $data = unserialize($_SESSION['login']); // monta o objeto na variavel $data (o serialize é necessário para transformar o objeto)
            header('location: home.php');
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="Sistema de Advocacia">
        <meta name="keywords" content="funprev, advocacia, sistema, advoprev">
        <meta name="author" content="Emerson Andrei">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AdvoPREV - FUNPREV BAURU</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
        
        <link href="css/login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <center><h1>AdvoPREV</h1></center>

        <form action="../control/loginControl.php" method="post" name ="formLogin">
            <div id="block">
                <label id="user" for="name">U</label>
                <input type="text" name="nome" id="nome" placeholder="Usuário" autofocus="true" required/>
                <label id="pass" for="password">S</label>
                <input type="password" name="senha" id="senha" placeholder="Senha" required />
                
                <button type="button" class="submit" name="btn_login" id="btn_login">Ir</button>
            </div>
            <center><div id="resultado"></div></center>
        </form>
    </body>
</html>