<?php 
    //require_once("model/entidades.php"); //necessario para acessar os getters e setters da session objeto
    require_once("model/servico.php");
    $varas = Servico::SelecionarVaras();
    $pessoas = Servico::SelecionarPessoas();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/processos.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de Processos</h1>
            <form name ="frmCadastro" method="POST">
                <table>
                    <tr align="left">
                        <td width="15%"><label>Nº Processo*:</label></td>
                        <td width="40%"><input type="text" name="proc_numero" id="proc_numero" placeholder="Insira o número do processo" size="50"  required/></td>
                        <td><label>Ação*:</label></td>
                        <td><input type="text" name="proc_acao" id="proc_acao" maxlength="11" placeholder="Insira a ação" size="16" required/></td>
                    </tr> 
                    <tr align="left">
                        <td width="15%"><label>Ordem*:</label></td>
                        <td><input type="text" name="proc_order" id="proc_ordem" placeholder="Insira a ordem" required/></td>
                        <td><label>Vara*:</label></td>    
                        <td>
                            <select id="proc_vara">
                                <option selected="true"></option>
                                <?php if(count($varas) > 0){
                                        foreach($varas as $vara){ ?>
                                            <option value="<?php echo $vara->getVaras_id();?>"><?php echo $vara->getVaras_nome(); ?></option>
                                        <?php }
                                    }else{ ?>
                                        <option align="center" selected="true">Nenhuma vara cadastrada</option>
                                    <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr align="left">
                        <td width="15%"><label>Data do processo*:</label></td>
                        <td><input type="date" name="proc_data" id="proc_data" required/></td>
                        <td><label>Oficial*:</label></td>    
                        <td><input type="text" maxlength="11" size="11" maxlength="11" id="proc_oficial" placeholder="Nome oficial de justiça" name="proc_oficial"/></td>
                    </tr>
                    <tr align="left">
                        <td><label>Juiz(a)*: </label></td>    
                        <td><input type="text" maxlength="11" size="11" maxlength="11" id="proc_juiz" placeholder="Nome juiz responsável" name="proc_juiz"/></td>
                        <td><label>Valor :</label></td>    
                        <td><input type="text" maxlength="7" placeholder="Somente número e vírgula" required="required" id="proc_valor" name="proc_valor"/></td>
                    </tr>
                    <tr>
                        <td width="15%"><label>Senha :</label></td>
                        <td><input type="text" name="proc_senha" id="proc_senha"  placeholder="Senha do processo" size="16" maxlength="50" required/></td>
                    </tr>
                    <tr>
                        <td><h1>Partes</h1></td>
                        <td align="right" colspan="3"><button type="button" onclick="javascript: openParte();" name="btn-adc" style="background-color: green; border-color: green;" id="btn-adc">Adicionar</button></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"><button type="button" name="btn_cadpessoa" id="btn_cadpessoa">Cadastrar</button>
                                                        <button type="reset">Limpar</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>