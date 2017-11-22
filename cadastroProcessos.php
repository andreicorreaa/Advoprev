<?php 
    //require_once("model/entidades.php"); //necessario para acessar os getters e setters da session objeto
    require_once("model/servico.php");
    $varas = Servico::SelecionarVaras();
    $pessoas = Servico::SelecionarPessoas();
    $indices = Servico::SelecionarIndices();
    $processos_apenso = Servico::SelecionarProcessos();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/processos.js"></script>
        <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de Processos</h1>
            <form name ="frmCadastro" method="POST">
                <table id="tb-proc">
                <tbody>
                    <tr align="left">
                        <td width="15%"><label>Nº Processo*:</label></td>
                        <td width="40%"><input type="text" name="proc_numero" maxlength="50" id="proc_numero" onchange="javascript: procurarNProcesso(this.value)" placeholder="Insira o número do processo" size="50"  required/></td>
                        <td><label>Ação*:</label></td>
                        <td><input type="text" name="proc_acao" id="proc_acao" maxlength="100" placeholder="Insira a ação" size="16" required/></td>
                    </tr> 
                    <tr align="left">
                        <td width="15%"><label>Ordem:</label></td>
                        <td><input type="text" name="proc_ordem" onchange="javascript: procurarNOrdem(this.value)" id="proc_ordem" placeholder="Insira a ordem" maxlength="45"/></td>
                        <td><label>Vara*:</label></td>    
                        <td>
                            <select id="proc_vara" class="chosen-select">
                                <option selected="true" value=""></option>
                                <?php if(count($varas) > 0){
                                        foreach($varas as $vara){ ?>
                                            <option value="<?php echo $vara->getVaras_id();?>"><?php echo $vara->getVaras_nome(); ?></option>
                                        <?php }
                                    }else{ ?>
                                        <option align="center" value="" selected="true">Nenhuma vara cadastrada</option>
                                    <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr align="left">
                        <td width="15%"><label>Data de distribuição*:</label></td>
                        <td><input type="date" name="proc_data" id="proc_data" min="1900-01-01" max="2050-02-18" required/></td>
                        <td><label>Oficial*:</label></td>
                        <td><input type="text" size="11" maxlength="50" id="proc_oficial" placeholder="Nome oficial de justiça" name="proc_oficial"/></td>
                    </tr>
                    <tr align="left">
                        <td><label>Juiz(a)*: </label></td>    
                        <td><input type="text"  size="11" maxlength="50" id="proc_juiz" placeholder="Nome juiz responsável" name="proc_juiz"/></td>
                        <td><label>Valor da causa:</label></td>    
                        <td><input type="text" maxlength="13" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl" placeholder="Somente números" required="required" id="proc_valor" name="proc_valor"/></td>
                    </tr>
                    <tr  style="border-bottom: 1px solid black">
                        <td width="15%"><label>Senha:</label></td>
                        <td><input type="text" name="proc_senha" id="proc_senha"  placeholder="Senha do processo" size="16" maxlength="10"/></td>
                        <td><label>Desembargador/<br>Ministro: </label></td>
                        <td><input type="text" size="255" maxlength="255" id="proc_desemb" placeholder="Desembargador/Ministro responsável" name="proc_desemb"/></td>
                    </tr>
                    <tr  style="border-bottom: 1px solid black">
                        <td width="15%"><label>Procurador:</label></td>
                        <td>
                            <input type="text" name="proc_procurador" id="proc_procurador" placeholder="Procurador do processo" size="16" maxlength="255"/>
                        </td>
                        <td><label>Apenso:</label></td>    
                        <td>
                            <select id="soflow" name="proc_apenso" class="chosen-select">
                                <option selected="true">Sem apensos</option>
                                <?php if(count($processos_apenso) > 0){
                                        foreach($processos_apenso as $proc_apenso){ ?>
                                            <option value="<?php echo $proc_apenso->getProcessos_id();?>"><?php echo $proc_apenso->getProcessos_num(); ?></option>
                                        <?php }
                                    } ?>
                            </select>
                        </td>
                    </tr>
                    <tr  style="border-bottom: 1px solid black">
                        <td width="15%"><label>Assistência Judiciária:</label></td>
                        <td>
                            <input type="radio" name="assistencia" value="D" id="assistencia" checked="true" required/>Deferida
                            <input type="radio" name="assistencia" value="I" id="assistencia" required/>Indeferida
                        </td>
                        <td><label>Dicas: </label></td>
                        <td><span style="font-size: 11px;text-align: justify;color:red;">- Campos com * são obrigatórios.</span><br>
                            <span style="font-size: 11px;text-align: justify;color:red;">- Assuntos e partes são opcionais e podem ser incluídos posteriormente.</span></td>
                    </tr>
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
                                    <option align="center" value="" selected="true">Nenhum indíce cadastrado</option>
                        <?php   } ?>
                            </select>
                        </td>
                        <td><a onclick="deleteRow(this.parentNode.parentNode.rowIndex)" href="#a"><img src="assets/remove.png" width="20px" height="20px"></a></td>
                    </tr>
                    <tr id="linhas-indice">
                        <td><h2>Partes</h2></td>
                        <td align="right" colspan="3"><button type="button" onclick="javascript: insereParte();" name="btn-adc" style="background-color: green; border-color: green;" id="btn-adc">Adicionar</button></td>
                    </tr>
                    <tr id="linhas" style="display: none;">
                        <td width="15%"><label>Nome:</label></td>
                        <td>
                            <select id="proc_partes_n" name="proc_partes_n">
                                <option value="" selected></option>
                        <?php   if(count($pessoas) > 0){
                                    foreach($pessoas as $pessoa){ ?>
                                        <option value="<?php echo $pessoa->getPessoas_id();?>"><?php echo $pessoa->getPessoas_nome(); ?></option>
                        <?php       }
                                }else{ ?>
                                    <option align="center" value="">Nenhuma pessoa cadastrada</option>
                        <?php   } ?>
                            </select>
                        </td>
                        <td><label>Parte: </label></td>    
                        <td>
                            <input type="text" maxlength="50" style="width: 90%;" id="proc_partes_p" placeholder="Advogado, réu,  etc" name="proc_partes_p"/>
                            <a onclick="deleteRow(this.parentNode.parentNode.rowIndex)" href="#a"><img src="assets/remove.png" width="20px" height="20px"></a>
                        </td>
                    </tr>
                </tbody>
                </table>
                <table align="center">
                    <tr>
                        <td colspan="4" align="center"><button type="button" name="btn_cadprocesso" id="btn_cadprocesso">Cadastrar</button>
                        <button type="reset">Limpar</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>