<?php
    include_once("checkLogin.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
        <link href="css/navbar.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="topo">
            <ul class="navbar">
                <li>
                    <h1 class="navbar">AdvoPREV</h1>
                </li>
                <li class="navbar">
                    <a class="active navbar" href="index.php">Pagina Inicial</a>
                </li>
                <li class="navbar">
                    <a class="navbar" href="#news">Suporte</a>
                </li>
                <li class="navbar" style="float: right;">
                    <form action="control/loginControl.php?action=logout" method="post">
                        <button class="navbar info">Logout</button>
                    </form>
                </li>
                <li style="float: right;">
                    <p class="navbar">Bem vindo(a), <span style="color: #2196F3;">
                    <?php echo $data->getUsuarios_nome(); ?> </span> </p>   
                </li>
            </ul> 
            <div id='cssmenu'>
                <ul class="trap">
                    <li onclick="carregar('inicio.php','Início - AdvoPREV - FUNPREV BAURU')" class="active"><a href='inicio.php'><span>Página Inicial</span></a></li>
                    <li onclick="carregar('selecionar.php', 'Pessoas - AdvoPREV - FUNPREV BAURU')"><a href='cadastroPessoas.php'><span>Cadastro de Pessoas</span></a></li>
                    <li onclick="carregar('indices.php', 'Assuntos - AdvoPREV - FUNPREV BAURU')"><a href='indices.php'><span>Índices</span></a></li>
                    <li onclick="carregar('processos.php', 'Processos - AdvoPREV - FUNPREV BAURU')"><a href='#'><span>Processos</span></a>
                  </li>
                </ul>
            </div>

        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <!-- para colocar a classe active nas li da lista -->
        <script>
            $('ul.trap > li').click(function (e) {
                e.preventDefault();
                $('ul.trap > li').removeClass('active');
                $(this).addClass('active');
            });
            /* javascript para navegação assíncrona */
            function carregar(pagina, t){
                $("#container").load(pagina);
                document.title = t;
            }
        </script>
    </body>
</html>