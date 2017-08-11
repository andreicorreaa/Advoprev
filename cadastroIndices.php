<!DOCTYPE html>
<html>
    <head>
        <link href="css/cadastro.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/indices.js"></script>
    </head>
    <body>
        <div id="pessoa">
            <h1>Cadastro de Índices</h1>
            <table>
                <tr align="left">
                    <td width="15%"><label>Descrição:*:</label></td>
                    <td width="40%"><input type="text" name="desc" id="desc" placeholder="Insira o índice" size="50"  required/></td>
                </tr> 
                <tr>
                    <td colspan="4" align="center">
                        <button type="button" name="btn_cadIndice" id="btn_cadIndice">Cadastrar</button>
                        <button type="reset">Limpar</button>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>