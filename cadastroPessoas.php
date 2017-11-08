<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/cadastro.js"></script>
        <script type="text/javascript" src="js/mascaras/jquery-1.2.6.pack.js"></script>
        <script type="text/javascript" src="js/mascaras/jquery.maskedinput-1.1.4.pack.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de Pessoas</h1>
            <form name ="frmCadastro" method="POST">
                <table>
                    <tr align="left">
                        <td width="15%"><label>Nome*:</label></td>
                        <td width="40%"><input type="text" name="nome1" id="nome1" placeholder="Insira o nome completo" size="50"  required/></td>
                        <td id="tipoPessoa" colspan="3">
                            <input type="radio" name="tipo-pessoa" value="cpf" onclick="javascript: tipoPessoa(this);">Pessoa física
                            <input type="radio" name="tipo-pessoa" value="cnpj" onclick="javascript: tipoPessoa(this);">Pessoa Jurídica
                        </td>
                        <td style="display:none;" id="lblcpf"><label>CPF*:</label></td>
                        <td style="display:none;" id="inputcpf"><input type="text" name="cpf" id="cpf" onchange="buscarCPF(this.value)" onkeypress='return somenteNum(event)' maxlength="11" placeholder="CPF válido(somente numeros)" size="16" required/></td>
                        
                        <td style="display:none;" id="lblcnpj"><label>CNPJ*:</label></td>
                        <td style="display:none;" id="inputcnpj"><input type="text" name="cnpj" id="cnpj" onchange="buscarCNPJ(this.value)" onkeypress='return somenteNum(event)' maxlength="14" placeholder="CNPJ válido(somente numeros)" size="16" required/></td>
                        <td width="4%"><div id="verifica1"></div></td>
                    </tr> 
                    <tr align="left">
                        <td width="15%"><label>E-mail:</label></td>
                        <td><input type="email" onchange="buscarEmail(this.value)" name="email" id="email" placeholder="Ex: funprev@funprev.com"/></td>
                        <td><label>RG:</label></td>    
                        <td><input type="text" name="rg" id="rg" placeholder="RG" size="16" maxlength="16" required onchange="buscarRG(this.value)" /></td>
                    </tr>
                    <tr align="left">
                        <td width="15%"><label>Data de Nascimento*:</label></td>
                        <td><input type="date" name="data" id="data" required/></td>
                        <td><label>Tel.:</label></td>    
                        <td><input type="text" maxlength="11" size="11" onkeypress='return somenteNum(event)' maxlength="11" id="telefone" placeholder="ex: 14996721234" name="telefone"/> </td>
                    </tr>
                    <tr align="left">
                        <td width="15%"><label>Sexo*:</label></td>
                        <td>
                            <input type="radio" name="sexo" value="M" id="sexo" checked="true" required/>Masculino
                            <input type="radio" name="sexo" value="F" id="sexo" required/>Feminino
                        </td>
                        <td><label>Nº OAB:</label></td>    
                        <td><input type="text" maxlength="15" placeholder="ex: 23E243,23.243,23243" required="required" id="oab" name="oab"/></td>
                    </tr>
                    <tr>
                        <td>CEP*:</td>
                        <td><input type="text" id="cep" onblur="buscarAPICorreios(this.value)"></td>
                        <td width="15%"><label>Complemento:</label></td>
                        <td><input type="text" name="complemento" id="complemento"  placeholder="R. Margarida 4-23 Vila Hiponica" size="16" maxlength="50" required/></td>
                    </tr>
                    <tr>
                        <td>Nº:</td>
                        <td><input type="text" id="numero"></td>
                    </tr>
                    <tr class="endereco">
                        <td><span><i>Logradouro:</i></span></td>
                        <td><input type="text" id="logradouro" disabled readonly></td>
                        <td><span><i>Bairro:</i></span></td>
                        <td><input type="text" id="bairro" disabled readonly></td>
                    </tr>
                    <tr class="endereco">
                        <td><span><i>UF:</i></span></td>
                        <td><input type="text" id="uf" disabled readonly></td>
                        <td><span><i>Cidade:</i></span></td>
                        <td><input type="text" id="cidade" disabled readonly></td>
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