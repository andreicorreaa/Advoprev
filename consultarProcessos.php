<?php
    require_once("model/servico.php");
    $varas = Servico::SelecionarVaras();
    $pessoas = Servico::SelecionarPessoas();
    $indices = Servico::SelecionarIndices();
?>
<!DOCTYPE html>
<head>
	<link href="css/cons.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/consultarProcessos.js"></script>
	<link href="modal/modalP.css" rel="stylesheet" type="text/css" />
    <link href="assets/Chosen/chosen.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="assets/Chosen/chosen.jquery.js"></script>
</head>
<body>
	<h1>Consultar Processos</h1>
	<div id="pesquisa">
		<table align="center" id="tb2">
			<tr>
				<td><select id="soflow" name="tipo" class="comb" onchange="javascript: mudaCampo(this.value)">
					  <!-- This method is nice because it doesn't require extra div tags, but it also doesn't retain the style across all browsers. -->
					  <option value="pesNProcesso" selected>Nº do processo</option>
					  <option value="pesOrdemProcesso">Ordem</option>
					  <option value= "pesVaraProcesso">Vara</option>
					  <option value= "pesPartesProcesso">Partes</option>
					  <option value= "pesIndicesProcesso">Indices</option>
					</select>
				</td>
				<td id="Numero">
					<input type="text" name="proc_numero" onclick="javascript: atualizar();" class="text" id="proc_numero" placeholder="Digite o número do processo" size="60" required/>
				</td>
				<td style="display: none;" id="Ordem">
					<input type="text" name="proc_ordem" id="proc_ordem" onclick="javascript: atualizar();" class="text" placeholder="Digite o número do processo" size="60" required/>
				</td>
				<td style="display: none;" id="Vara">
                    <select id="soflow" class="comb chosen-select" name="proc_vara" onclick="javascript: atualizar();">
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
                <td style="display: none;" id="Indice">
                    <select id="soflow" class="comb chosen-select" name="proc_indice" onclick="javascript: atualizar();">
                        <option></option>
                <?php   if(count($indices) > 0){
                            foreach($indices as $indice){ ?>
                                <option value="<?php echo $indice->getIndices_id();?>"><?php echo $indice->getIndices_desc(); ?></option>
                <?php       }
                        }else{ ?>
                            <option align="center" selected="true">Nenhum indíce cadastrado</option>
                <?php   } ?>
                    </select>
                </td>
                <td style="display: none;" id="Parte">
                    <select id="soflow" class="comb chosen-select" name="proc_parte" onclick="javascript: atualizar();">
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
		<div style="overflow-x:auto;">
			<table id="tb1" class="fixo">
				<caption>Processos</caption>
					<thead>
						<th width="9%">Nº Processo</th>
						<th width="9%">Nº Ordem</th>
						<th width="50%">Ação</th>
						<th width="20%">Vara</th>
						<th width="9%">Apenso</th>
						<th width="3%"></th>
					</thead>
					<tbody>
					</tbody>
        	</table>
        </div>
	</div>
</body>