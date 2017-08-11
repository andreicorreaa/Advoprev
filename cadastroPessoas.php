<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/cadastro.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de Pessoas</h1>
            <form name ="frmCadastro" method="POST">
                <table>
                    <tr align="left">
                        <td width="15%"><label>Nome*:</label></td>
                        <td width="40%"><input type="text" name="nome1" id="nome1" placeholder="Insira o nome completo" size="50"  required/></td>
                        <td><label>CPF*:</label></td>
                        <td><input type="text" name="cpf" id="cpf" onkeyup="buscarCPF(this.value)" onkeypress='return somenteNum(event)' maxlength="11" placeholder="CPF válido(somente numeros)" size="16" required/></td>
                        <td width="4%"><div id="verifica1"></div></td>
                    </tr> 
                    <tr align="left">
                        <td width="15%"><label>E-mail*:</label></td>
                        <td><input type="email" onkeyup="buscarEmail(this.value)" name="email" id="email" placeholder="Ex: funprev@funprev.com" required/></td>
                        <td><label>RG*:</label></td>    
                        <td><input type="text" name="rg" id="rg" placeholder="RG" size="16" maxlength="16" required/></td>
                    </tr>
                    <tr align="left">
                        <td width="15%"><label>Data de Nascimento*:</label></td>
                        <td><input type="date" name="data" id="data" required/></td>
                        <td><label>Tel.*:</label></td>    
                        <td><input type="text" maxlength="11" size="11" onkeypress='return somenteNum(event)' onkeyup="buscarTel(this.value)" maxlength="11" id="telefone" placeholder="ex: 14996721234" name="telefone"/> </td>
                    </tr>
                    <tr align="left">
                        <td width="15%"><label>Sexo*:</label></td>
                        <td>
                            <input type="radio" name="sexo" value="M" id="sexo" checked="true" required/>Masculino
                            <input type="radio" name="sexo" value="F" id="sexo" required/>Feminino
                        </td>
                        <td><label>Nº OAB:</label></td>    
                        <td><input type="text" maxlength="7" placeholder="ex: 23E243,23.243,23243" required="required" id="oab" name="oab"/></td>
                    </tr>
                    <tr>
                        <td width="15%"><label>Endereço*:</label></td>
                        <td><input type="text" name="endereco" id="endereco"  placeholder="R. Margarida 4-23 Vila Hiponic" size="16" maxlength="50" required/></td>
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