<?php
	require_once("model/servico.php");
    $Processos = Servico::SelecionarProcessos();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <link href="css/relatorios.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/relatorios.js"></script>
		<script type="text/javascript" src="js/jquery.printElement.js"></script>
		<script type="text/javascript" src="js/print/printThis.js"></script>

        <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Relatório de Processo <input type="button" id="btn-imprime" class="btn-imprime" onclick="javascript: Imprimir()" value="Imprimir"></h1>
            <div id="buscarP">
                <span style="width: 10%;">Nº do processo:  </span>
                <select id="soflow" style="width: 87%" class="comb chosen-select" name="andamento" onchange="javascript: procuraProcesso(this.value);">
                    <option selected="true"></option>
<?php                   if(count($Processos) > 0){
                            foreach($Processos as $processo){ 
?>
                                <option value="<?php echo $processo->getProcessos_id();?>"><?php echo $processo->getProcessos_num(); ?></option>
<?php                       }
                        }else{ 
?>
                            <option align="center" selected="true">Nenhum processo cadastrado</option>
<?php                   } 
?>
                </select>
            </div>
            <div id="relatorio">
            	<center>
            		<h1>Selecione o processo para montar o relatório</h1>
            	</center>
            </div>
        </div>
    </body>
</html>