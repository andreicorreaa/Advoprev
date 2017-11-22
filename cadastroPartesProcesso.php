<?php
    require_once("model/servico.php");
    $Processos = Servico::SelecionarProcessos();
    $pessoas = Servico::SelecionarPessoas();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <link href="css/partes.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/partes.js"></script>
        <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de Partes do Processo</h1>
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
            <div id="cad-partes">
                <table width="100%" id="tb-partes">
                    <tr id="linhas-indice">
                        <td><h2>Partes</h2></td>
                        <td align="right" colspan="3"><button type="button" onclick="javascript: insereParte();" name="btn-adc" style="background-color: green; border-color: green;" id="btn-adc">Adicionar</button></td>
                    </tr>
                    <tr id="linhas" style="display: none;">
                        <td width="15%"><label>Nome:</label></td>
                        <td>
                            <select id="proc_partes_n" name="proc_partes_n">
                                <option></option>
                        <?php   if(count($pessoas) > 0){
                                    foreach($pessoas as $pessoa){ ?>
                                        <option value="<?php echo $pessoa->getPessoas_id();?>"><?php echo $pessoa->getPessoas_nome(); ?></option>
                        <?php       }
                                }else{ ?>
                                    <option align="center" selected="true">Nenhuma pessoa cadastrada</option>
                        <?php   } ?>
                            </select>
                        </td>
                        <td><label>Parte: </label></td>    
                        <td>
                            <input type="text" maxlength="50" style="width: 90%;" id="proc_partes_p" placeholder="Advogado, réu,  etc" name="proc_partes_p"/>
                            <a onclick="deleteRow(this.parentNode.parentNode.rowIndex)" href="#a"><img src="assets/remove.png" width="20px" height="20px"></a>
                        </td>
                    </tr>
                </table>
                <center>
                    <button type="button" onclick="javascript: cadastrarParte();">Cadastrar</button>
                </center>
            </div>
        </div>
    </body>
</html>