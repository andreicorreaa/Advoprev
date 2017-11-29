<?php
    require_once("model/servico.php");
    $Processos = Servico::SelecionarProcessos();
    $tipos_andamento = Servico::SelecionarTipos_andamento();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <link href="css/andamentos.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/andamentos.js"></script>
        <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Andamentos</h1>
            <div id="buscarP">
                <span style="width: 10%;">Nº do processo:  </span>
                <select id="soflow" style="width: 80%" class="comb chosen-select" name="andamento" onchange="javascript: procuraProcesso(this.value);">
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
            <div class="div-btn-andamento">
                <button type="button" name="btn_abrirAndamento" id="btn_abrirAndamento" onclick="javascript: abrirCadastro();">Cadastrar Andamento!</button>
            </div>
            <div id="andamento" style="display: none;">
                <center><h1>Registro de andamento</h1></center>
                <form method="post" enctype="multipart/form-data" id="formulario">
                    <input type="hidden" id="processos_id" name="processos_id"/>
                    <table border="0px" width="100%" id="tb-andamento">
                        <tr>
                            <td width="20%"><span>Situação/Tipo do andamento*:</span></td>
                            <td>
                                <select id="and_tipo" name="and_tipo">
                                    <option value="" selected="true"> </option>
<?php                                      foreach ($tipos_andamento as $tipo_andamento){
?>                                             <option value="<?php echo $tipo_andamento->getTipos_andamento_id(); ?>">
                                                   <?php echo $tipo_andamento->getTipos_andamento_desc(); ?>
                                               </option>
<?php                                       }
?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Comentários*:</span></td>
                            <td>
                                <textarea style="width: 99%;" rows="5" name="and_com" id="and_com" required="true"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="and_check_resumo" name="and_check_resumo" onchange="cadResumo(this)">&nbsp Resumo/Súmula:
                            </td>
                            <td>
                                <input type="text" id="and_text_resumo" name="and_text_resumo" style="display: none">
                            </td>
                        </tr>
                        <tr>
                            <td width="15%"><label>Data do andamento*:</label></td>
                            <td><input type="date" name="and_data" id="and_data" min="1900-01-01" max="2050-02-18" required/></td>
                        </tr>
                        <tr id="arq">
                            <td><span>Arquivo:</span></td>
                            <td>
                                <input type="hidden" name="MAX_FILE_SIZE" value="8388608" />
                                <input type="file" name="arquivo[]">
                                <a href="#x" onclick="javascript: insereArquivo();"><img src="assets/add.png" alt="Adicionar mais arquivos" width="20px" height="20px"></a>
                                <a href="#x" onclick="javascript: deleteRow(this.parentNode.parentNode.rowIndex);"><img src="assets/remove.png" alt="remover arquivo" width="20px" height="20px"></a>
                            </td>
                        </tr>
                        <tr id="btn-and">
                            <td colspan="4" align="center">
                                <button type="submit" name="btn_cadAndamento" id="btn_cadAndamento">Cadastrar</button>
                                <button type="reset">Limpar</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><span style="color: grey;font-size: 12px;"><i>obs: Limite de upload de 8 MB por arquivo.</i></span></td>
                        </tr>
                        <tr>
                            <td colspan="4"><span style="color: grey;font-size: 12px;"><i>obs: Arquivos suportados: doc|docx|pdf|png|jpg|jpeg|xls|odt|xlsx|ods </i></span></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="cadAndamento" style="display: none;">
                <center>
                    <h2>Processo não contém um andamento cadastrado!</h2>
                    <button type="button" name="btn_abrirAndamento" id="btn_abrirAndamento" onclick="javascript: abrirCadastro();">Cadastrar Andamento!</button>
                </center>
            </div>
        </div>
    </body>
</html>