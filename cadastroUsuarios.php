<!-- ----------------------------------- DESENVOLVIDO POR EMERSON ANDREI ----------------------------------- -->
<?php
    require_once("checkLogin.php");
?>
<link href="css/cadastro.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/cadastro.js"></script>

<!DOCTYPE html>
<html>
    <div id="cadUser">
        <h1>Cadastro de Usuários</h1>
        <div id="painel1">
            <form name ="frmCadastro" action="control/cadastroControl.php" method="POST">
                <table>
                    <tr align="left">
                        <td><label>Login:</label></td>
                        <td><input type="text" name="nome" id="nome" onkeyup="buscarUser(this.value)" placeholder="Mínimo de 6 caracteres" required/></td>
                        <td width="4%"><div id="verifica"></div></td>
                    </tr> 
                    <tr align="left">
                        <td><label>Senha:</label></td>    
                        <td><input type="text" name="senha" id="senha" placeholder="Mínimo de 6 caracteres"  required/></td>
                    </tr>
                    <tr align="left">
                        <td><label>Confirmar senha:</label></td>    
                        <td><input type="text" name="confirma_senha" id="confirma_s" placeholder="Mínimo de 6 caracteres" required/></td>
                    </tr>
                    <br>
                </table>
                <button type="button" name="btn_cadastro" id="btn_cadastro">Cadastrar</button>
                <button type="reset">Limpar</button>
            </form>
        </div>
        <div id="painel2">
            <div id="alert1" class="" style="display: none;">
                  
            </div>
        </div>
    </div>
</html>