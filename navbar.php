<?php
    include_once("checkLogin.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
        <link href="css/navbar.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/mascaras/jquery.mask.js"></script>
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
                <li class="navbar" onclick="carregar('suporteFunprev.php', 'Suporte - AdvoPREV - FUNPREV BAURU')">
                    <a class="navbar" href='#'><span>Suporte</span></a>
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
<?php
                    if($data->getUsuarios_grupo() < 3){
?>
                    <li onclick="carregar('controle-acesso.php', 'Controle de acesso - AdvoPREV - FUNPREV BAURU')"><a href='controle-acesso.php'><span>Controle de Acesso</span></a></li>
<?php
                    }
?>
                    <li onclick="carregar('selecionar.php', 'Pessoas - AdvoPREV - FUNPREV BAURU')"><a href='cadastroPessoas.php'><span>Pessoas</span></a></li>
                    <li onclick="carregar('indices.php', 'Indices - AdvoPREV - FUNPREV BAURU')"><a href='indices.php'><span>Assuntos/Índices</span></a></li>
                    <li onclick="carregar('varas.php', 'Varas - AdvoPREV - FUNPREV BAURU')"><a href='varas.php'><span>Varas</span></a></li>
                    <li onclick="carregar('tipos.php', 'Tipos/Situações - AdvoPREV - FUNPREV BAURU')"><a href='#'><span>Tipos/Situações</span></a></li>
                    <li onclick="carregar('processos.php', 'Processos - AdvoPREV - FUNPREV BAURU')"><a href='#'><span>Processos</span></a></li>
                    <li onclick="carregar('relatorios.php', 'Relatórios - AdvoPREV - FUNPREV BAURU')"><a href='#'><span>Relatórios</span></a></li>
                </ul>
            </div>

        </div>
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