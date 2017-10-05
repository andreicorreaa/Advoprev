<?php
    require_once("model/servico.php");
    $pessoas = Servico::SelecionarPessoas();
?>
<!DOCTYPE html>
<head>
	<link href="css/cons.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/consultarPartes.js"></script>
	<link href="modal/modalP.css" rel="stylesheet" type="text/css" />
	
</head>
<body>
	<h1>Consultar Partes</h1>
	<div id="pesquisa">
		<table align="center" id="tb2">
			<tr>
				<td><select id="soflow" name="tipo" class="comb" onchange="javascript: mudaCampo(this.value)">
					  	<option value="pesNProcesso" selected>Nº do processo</option>
						<option value="pesParte">Parte</option>
						<option value= "pesNUsuario">Pessoas</option>
					</select>
				</td>
				<td id="Numero">
					<input type="text" name="proc_numero" onclick="javascript: atualizar();" class="text" id="proc_numero" placeholder="Digite o número do processo" size="60" required/>
				</td>
				<td style="display: none;" id="Parte">
					<input type="text" name="proc_parte" id="proc_parte" onclick="javascript: atualizar();" class="text" placeholder="Digite o número do processo" size="60" required/>
				</td>
				<td style="display: none;" id="Usuario">
                    <select id="soflow" class="comb" name="proc_usuario" onclick="javascript: atualizar();">
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
                <td><button type="button" name="btn_pesquisa" id="btn_pesquisa">Pesquisar</button></td>
	            <td><button type="reset" id="btn_limpar">Limpar</button></td>
            </tr>
        </table>
	</div>
	<div id="mostra">
			<table id="tb1" class="fixo">
				<caption>Partes</caption>
					<thead>
						<th width="30%">Nº Processo</th>
						<th width="40%">Nome</th>
						<th width="27%">Parte</th>
						<th width="3%"></th>
					</thead>
					<tbody>
					</tbody>
        	</table>
	</div>
</body>