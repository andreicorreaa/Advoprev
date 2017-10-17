<?php
    require_once("model/servico.php");
    $Processos = Servico::SelecionarProcessos();
    $indices = Servico::SelecionarIndices();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <link href="css/partes.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/indices.js"></script>
        <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
        <script type="text/javascript">
            $(".chosen-select").chosen({width: "100%"});
        </script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de índices do Processo</h1>
            <div id="buscarP">
                <span style="width: 10%;">Nº do processo:  </span>
                <select id="soflow" style="width: 80%" class="comb chosen-select" name="processo_id" onchange="javascript: procuraProcesso(this.value);">
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
            <style type="text/css">
            	#cad-indices{
            		width: 100%;
            		height: 100%;
            		display: none;
            	}
            </style>
            <div id="cad-indices">
                <table width="100%" id="tb-indices">
                    <tr>
                        <td><h2>Assuntos</h2></td>
                        <td align="right" colspan="3"><button type="button" id="btn-indice" onclick="javascript: insereIndice();" style="background-color: #FF4500; border-color: #FF4500;" id="btn-adc">Adicionar</button></td>
                    </tr>
                    <tr id="linhas1" style="display: none;">
                        <td width="15%"><label>Indíce:</label></td>
                        <td>
                            <select id="proc_indices" name="proc_indices">
                                <option></option>
                        <?php   if(count($indices) > 0){
                                    foreach($indices as $indice){ ?>
                                        <option value="<?php echo $indice->getIndices_id();?>"><?php echo $indice->getIndices_desc(); ?></option>
                        <?php       }
                                }else{ ?>
                                    <option align="center" selected="true">Nenhum indíce cadastrado</option>
                        <?php   } ?>
                            </select>
                        </td>
                        <td><a onclick="deleteRow(this.parentNode.parentNode.rowIndex)" href="#a"><img src="assets/remove.png" width="20px" height="20px"></a></td>
                    </tr>
                </table>
                <center>
                    <button type="button" onclick="javascript: cadastrarIndices();">Cadastrar</button>
                </center>
            </div>
        </div>
    </body>
</html>