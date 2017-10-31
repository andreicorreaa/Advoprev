<head>
	<link href="css/cadastro.css" rel="stylesheet" type="text/css" />
    <link href="css/resumo.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/relatorios.js"></script>
	<script type="text/javascript" src="js/jquery.printElement.js"></script>
	<script type="text/javascript" src="js/print/printThis.js"></script>
</head>
<?php
	include_once("model/servico.php");
	include_once("view/relatoriosView.php");
	$param      = $_GET['id'];
    $processo   = Servico::consultaProcessoID($param);
    $partes     = Servico::consultaParteID($param);
    $indices    = Servico::consultaIndiceID($param);
    $andamentos = Servico::selecionaProcessoAndamento($param);
    $apensos    = Servico::selecionarApensosProcesso($param);
?>
<body>
	<div id="relatorio">
    	<center>
    		<?php return relatoriosView::Processo($processo, $partes, $indices, $andamentos, $apensos); ?>
    	</center>
    </div>
</body>
?>