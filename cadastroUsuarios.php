<?php
    include_once("checkLogin.php");
?>
<link href="css/cadastro.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/usuarios.js"></script>
<link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>

<!DOCTYPE html>
<html>
    <div id="cadUser">
        <h1>Cadastro de Usuários</h1>
        <div id="painel1" style="margin-left: 25%">
            <form name ="frmCadastro" action="control/cadastroControl.php" method="POST">
                <table>
                    <tr align="left">
                        <td><label>Login:</label></td>
                        <td><input type="text" name="nome" id="nome" onkeyup="buscarUser(this.value)" placeholder="Mínimo de 6 caracteres" required/></td>
                        <td width="4%"><div id="verifica"></div></td>
                    </tr> 
                    <tr align="left">
                        <td><label>Senha:</label></td>    
                        <td><input type="password" name="senha" id="senha" placeholder="Mínimo de 6 caracteres"  required/></td>
                    </tr>
                    <tr align="left">
                        <td><label>Confirmar senha:</label></td>    
                        <td><input type="password" name="confirma_senha" id="confirma_s" placeholder="Mínimo de 6 caracteres" required/></td>
                    </tr>
                    <tr align="left">
                        <td><label>Grupo:</label></td>    
                        <td>
                            <select id="grupo" class="chosen-select">
                                <option value="" selected="true"></option>
<?php
                                if($data->getUsuarios_grupo() == 2){
?>
                                    <option value="2">Moderador</option>
                                    <option value="3">Comum</option>
<?php
        
                                }else{
?>
                                    <option value="1">Administrador</option>
                                    <option value="2">Moderador</option>
                                    <option value="3">Comum</option>
<?php
                                }
?>
                            </select>

                        </td>
                    </tr>
                    <br>
                </table>
                <br>
                <center>
                    <button type="button" name="btn_cadastro" id="btn_cadastro">Cadastrar</button>
                    <button type="reset">Limpar</button>
                </center>
            </form>
        </div>
        <div id="painel2">
            <div id="alert1" class="" style="display: none;">
                  
            </div>
        </div>
    </div>
</html>