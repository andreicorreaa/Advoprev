<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <link href="css/relatorios.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/relatorios.js"></script>
		<script type="text/javascript" src="js/jquery.printElement.js"></script>
		<script type="text/javascript" src="js/print/printThis.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Relatório de Assuntos/índices</h1>
            <div id="buscarP">
                <center>
                    <span>Data de ínicio:</span>
                    <input type="date" id="data-inicio">
                    <span>Data final:</span>
                    <input type="date" id="data-final">
                    <button type="button" id="btn-pesquisa" onclick="procuraIndice()">Gerar</button>
                </center>
            </div>
            <div id="relatorio">
            	<center>
            		<h1>Selecione as datas para montar o relatório</h1>
            	</center>
            </div>
        </div>
    </body>
</html>