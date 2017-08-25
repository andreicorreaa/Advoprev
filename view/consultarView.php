<?php
	//include_once ("../model/entidades.php");
	include_once ("../model/servico.php");
	class consultarView{ //classe View da pagina login
		static function respostaConsultaPessoa($resposta){
			
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta){
				?><tr><td><div style="display: none"><script type="text/javascript" src="modal/modal.js"></script></td></tr></div><?php
				foreach($resposta as $val){
        		?>	
		            <tr>
		        		<td width="40%"><?php echo $val['pessoas_nome'];?></td>
		        		<td width="40%"><?php echo $val['pessoas_cpf'];?></td>
		        		<td width="40%"><?php echo $val['pessoas_rg'];?></td>
		        		<td width="40%"><a href="#janela<?php echo $val['pessoas_id'];?>" rel="modal"><img src="assets/change.png" width="20px" height="20px"></a></td>
		                <td>
		                    <div class="window" id="janela<?php echo $val['pessoas_id'];?>">
		                        <a href="#" class="fechar">X Fechar</a>
		                        <form>
		                            <table>
		                                <caption>Alteração</caption>
		                                <tr align="left">
		                                    <td width="15%"><label>Nome:</label></td>
		                                    <td width="40%"><input type="text" value="<?php echo $val['pessoas_nome'];?>" id="n<?php echo $val['pessoas_id'];?>" placeholder="Insira o nome completo" size="50"  /></td>
		                                    <td><label>CPF:</label></td>
		                                    <td><input type="text" id="cpf<?php echo $val['pessoas_id'];?>" value="<?php echo $val['pessoas_cpf'];?>" onkeyup="buscarCPF(this.value)" onkeypress='return somenteNum(event)' maxlength="11" placeholder="CPF válido(somente numeros)" size="16" /></td>
		                                    <td width="4%"><div id="verifica1"></div></td>
		                                </tr> 
		                                <tr align="left">
		                                    <td width="15%"><label>E-mail:</label></td>
		                                    <td><input type="email" onchange="buscarEmail(this.value)" value="<?php echo $val['pessoas_email'];?>" id="email<?php echo $val['pessoas_id'];?>" placeholder="Ex: funprev@funprev.com" /></td>
		                                    <td><label>RG:</label></td>    
		                                    <td><input type="text" id="rg<?php echo $val['pessoas_id'];?>" onchange="buscarRG(this.value)" value="<?php echo $val['pessoas_rg'];?>" placeholder="RG" size="16" maxlength="16" /></td>
		                                </tr>
		                                <tr align="left">
		                                    <td width="15%"><label>Data de Nascimento:</label></td>
		                                    <td><input type="date" id="data<?php echo $val['pessoas_id'];?>" value="<?php echo $val['pessoas_datanasc'];?>" /></td>
		                                    <td><label>Tel.:</label></td>    
		                                    <td>
		                                        <input type="text" maxlength="11" size="11" onkeypress='return somenteNum(event)' onchange="buscarTel(this.value)" value="<?php echo $val['pessoas_tel'];?>" maxlength="11" id="telefone<?php echo $val['pessoas_id'];?>" placeholder="ex: 14996721234" name="telefone"/>
		                                    </td>
		                                </tr>
		                                <tr align="left">
		                                    <td width="15%"><label>Sexo:</label></td>
		                                    <td>
		                                        <input type="radio" name="sexo" value="M" id="sexo<?php echo $val['pessoas_id'];?>" checked="true" />Masculino
		                                        <input type="radio" name="sexo" value="F" id="sexo<?php echo $val['pessoas_id'];?>"/>Feminino
		                                    </td>
		                                    <td><label>Nº OAB:</label></td>    
		                                    <td><input type="text" maxlength="7" placeholder="ex: 23E243,23.243,23243" value="<?php echo $val['pessoas_oab'];?>" id="oab<?php echo $val['pessoas_id'];?>" /></td>
		                                </tr>
		                                <tr>
		                                    <td width="15%"><label>Endereço:</label></td>
		                                    <td><input type="text" id="endereco<?php echo $val['pessoas_id'];?>" value="<?php echo $val['pessoas_endereco'];?>" placeholder="R. Margarida 4-23 Vila Hiponic" size="16" maxlength="50"/></td>
		                                </tr>
		                                <tr>
		                                    <td colspan="4" align="center">
		                                        <button type="button" onclick="alteraPessoa(<?php echo $val['pessoas_id'];?>)">Alterar Dados</button>
		                                        <button type="reset" class="gravar">Limpar</button>
		                                        <button type="button" onclick="excluiPessoa(<?php echo $val['pessoas_id'];?>)" style="background-color: red; border-color: red">Excluir</button>
		                                    </td>
		                                </tr>
		                            </table>
		                        </form>
		                    </div>
		                    <div id="mascara"></div>
		                </td>    	
		        	</tr>
        	<?php }
			}
			else{
				echo false;
				//retorna para o arquivo login.js
			}
		}
		
		static function respostaBusca($resposta){
			if($resposta){
				echo true;
			}else{
				echo false;
			}
		}


		static function respostaIndice($resposta){
			
			if($resposta){
				?><tr><td><div style="display: none"><script type="text/javascript" src="modal/modal.js"></script></td></tr></div><?php
				foreach($resposta as $val){
        		?>	
		            <tr>
		        		<td width="40%"><?php echo $val['indices_desc'];?></td>
		        		<td width="40%"><a href="#janela<?php echo $val['indices_id'];?>" rel="modal"><img src="assets/change.png" width="20px" height="20px"></a></td>
		                <td>
		                    <div class="window" id="janela<?php echo $val['indices_id'];?>">
		                        <a href="#" class="fechar">X Fechar</a>
		                        <form>
		                            <table>
		                                <caption>Alteração</caption>
		                                <tr align="left">
		                                    <td width="15%"><label>Descrição:</label></td>
		                                    <td width="40%"><input type="text" value="<?php echo $val['indices_desc'];?>" id="n<?php echo $val['indices_id'];?>" size="50"/></td>
		                                </tr>
		                                <tr>
		                                    <td colspan="2" align="center">
		                                        <button type="button" onclick="alteraIndice(<?php echo $val['indices_id'];?>)">Alterar Dados</button>
		                                        <button type="reset" class="gravar">Limpar</button>
		                                        <button type="button" onclick="excluiIndice(<?php echo $val['indices_id'];?>)" style="background-color: red; border-color: red">Excluir</button>
		                                    </td>
		                                </tr>
		                            </table>
		                        </form>
		                    </div>
		                    <div id="mascara"></div>
		                </td>    	
		        	</tr>
        	<?php }
			}
			else{
				echo false;
				//retorna para o arquivo login.js
			}
		}


		static function respostaVaras($resposta){
			
			if($resposta){
				?><tr><td><div style="display: none"><script type="text/javascript" src="modal/modal.js"></script></td></tr></div><?php
				foreach($resposta as $val){
        		?>
		            <tr>
		        		<td width="40%"><?php echo $val['varas_nome'];?></td>
		        		<td width="40%"><a href="#janela<?php echo $val['varas_id'];?>" rel="modal"><img src="assets/change.png" width="20px" height="20px"></a></td>
		                <td>
		                    <div class="window" id="janela<?php echo $val['varas_id'];?>">
		                        <a href="#" class="fechar">X Fechar</a>
		                        <form>
		                            <table>
		                                <caption>Alteração</caption>
		                                <tr align="left">
		                                    <td width="15%"><label>Descrição:</label></td>
		                                    <td width="40%"><input type="text" value="<?php echo $val['varas_nome'];?>" id="n<?php echo $val['varas_id'];?>" size="50"/></td>
		                                </tr>
		                                <tr>
		                                    <td colspan="2" align="center">
		                                        <button type="button" onclick="alteraVara(<?php echo $val['varas_id'];?>)">Alterar Dados</button>
		                                        <button type="reset" class="gravar">Limpar</button>
		                                        <button type="button" onclick="excluiVara(<?php echo $val['varas_id'];?>)" style="background-color: red; border-color: red">Excluir</button>
		                                    </td>
		                                </tr>
		                            </table>
		                        </form>
		                    </div>
		                    <div id="mascara"></div>
		                </td>    	
		        	</tr>
        	<?php }
			}
			else{
				echo false;
				//retorna para o arquivo login.js
			}
		}


		static function respostaProcesso($obj){
		?><tr><td><div style="display: none"><script type="text/javascript" src="modal/modalP.js"></script></td></tr></div><?php
			if($obj){
				$varas = Servico::SelecionarVaras();
				for($i=0;$i<count($obj);$i++){
					$vara = Servico::selecionaVara($obj[$i]->getVaras_id());
					$partes = Servico::consultaPartesProcesso($obj[$i]->getProcessos_id());
					
					?>
					<tr>
						<td><?php echo $obj[$i]->getProcessos_num(); ?></td>
						<td><?php echo $obj[$i]->getProcessos_ordem(); ?></td>
						<td><?php echo $obj[$i]->getProcessos_acao(); ?></td>
						<td><?php echo $vara[0]['varas_nome']; ?></td>
						<td><?php echo $obj[$i]->getProcessos_apencos(); ?></td>
						<td><a href="#janela<?php echo $obj[$i]->getProcessos_id();?>" rel="modal"><img src="assets/change.png" width="20px" height="20px"></a></td>
						<td>
		                    <div class="window" id="janela<?php echo $obj[$i]->getProcessos_id();?>">
		                        <a href="#" class="fechar">X Fechar</a>
		                        <h1>Alteração de processo</h1>
		                        <form>
		                        <table id="tb-proc">
					                <tbody>
					                    <tr align="left">
					                        <td width="15%"><label>Nº Processo*:</label></td>
					                        <td width="40%"><input type="text" name="proc_numero" maxlength="50" id="proc_numero<?php echo $obj[$i]->getProcessos_id();?>" onchange="javascript: return procurarNProcesso(this.value)" placeholder="Insira o número do processo" size="50" value="<?php echo $obj[$i]->getProcessos_num(); ?>" required/></td>
					                        <td><label>Ação*:</label></td>
					                        <td><input type="text" name="proc_acao" value="<?php echo $obj[$i]->getProcessos_acao(); ?>" id="proc_acao<?php echo $obj[$i]->getProcessos_id();?>" maxlength="100" placeholder="Insira a ação" size="16" required/></td>
					                    </tr>
					                    <tr align="left">
					                        <td width="15%"><label>Ordem*:</label></td>
					                        <td><input type="text" name="proc_ordem" value="<?php echo $obj[$i]->getProcessos_ordem(); ?>" onchange="javascript: procurarNOrdem(this.value)" id="proc_ordem<?php echo $obj[$i]->getProcessos_id();?>" placeholder="Insira a ordem" maxlength="45" required/></td>
					                        <td><label>Vara*:</label></td>
					                        <td>
					                            <select id="proc_vara<?php echo $obj[$i]->getProcessos_id();?>">
					                            	<option selected="true" value="<?php echo $vara[0]['varas_id']; ?>"><?php echo $vara[0]['varas_nome']; ?></option>
					                                <?php if(count($varas) > 0){
					                                        foreach($varas as $vara1){ 
					                                        	if(!($vara1->getVaras_id() == $vara[0]['varas_id'])){?>
					                                        		<option value="<?php echo $vara1->getVaras_id();?>">
					                                        			<?php echo $vara1->getVaras_nome(); ?>
					                                        		</option>
					                                       <?php }
					                                   	   	}
					                                   	}else{ ?>
					                                        <option align="center" selected="true">Nenhuma vara cadastrada</option>
					                              <?php } ?>
					                            </select>
					                        </td>
					                    </tr>
					                    <tr align="left">
					                        <td width="15%"><label>Data do processo*:</label></td>
					                        <td><input type="date" value="<?php echo $obj[$i]->getProcessos_data(); ?>" name="proc_data" id="proc_data<?php echo $obj[$i]->getProcessos_id();?>" min="1900-01-01" max="2050-02-18" required/></td>
					                        <td><label>Oficial*:</label></td>    
					                        <td><input type="text" size="11" maxlength="50" id="proc_oficial<?php echo $obj[$i]->getProcessos_id();?>"value="<?php echo $obj[$i]->getProcessos_oficial(); ?>" placeholder="Nome oficial de justiça" name="proc_oficial"/></td>
					                    </tr>
					                    <tr align="left">
					                        <td><label>Juiz(a)*: </label></td>    
					                        <td><input type="text"  size="11" value="<?php echo $obj[$i]->getProcessos_juiz(); ?>" maxlength="50" id="proc_juiz<?php echo $obj[$i]->getProcessos_id();?>" placeholder="Nome juiz responsável" name="proc_juiz"/></td>
					                        <td><label>Valor :</label></td>    
					                        <td><input type="text" maxlength="13" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl" placeholder="Somente números" value="<?php echo $obj[$i]->getProcessos_valor(); ?>" required="required" id="proc_valor<?php echo $obj[$i]->getProcessos_id();?>" name="proc_valor"/></td>
					                    </tr>
					                    <tr  style="border-bottom: 1px solid black">
					                        <td width="15%"><label>Senha :</label></td>
					                        <td><input type="text" name="proc_senha" id="proc_senha<?php echo $obj[$i]->getProcessos_id();?>" value="<?php echo $obj[$i]->getProcessos_senha(); ?>" placeholder="Senha do processo" size="16" maxlength="10" required/></td>
					                    </tr>
                    					<tr>
					                        <td><h2>Assuntos</h2></td>
					                        <td align="right" colspan="3"><button type="button" id="btn-indice" onclick="javascript: insereIndice();" style="background-color: #FF4500; border-color: #FF4500;" id="btn-adc">Adicionar</button></td>
                    					</tr>
                    					<tr id="linhas1" style="display: none;">
					                        <td width="15%"><label>Indíce:</label></td>
					                        <td>
					                            <select id="proc_indices<?php echo $obj[$i]->getProcessos_id();?>" name="proc_indices<?php echo $obj[$i]->getProcessos_id();?>">
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
					                        <td><a onclick="deleteRow(this.parentNode.parentNode.rowIndex)" href="#a"><img src="assets/remove.png" width="20px" height="20px"></a></td>
					                    </tr>
					                    <tr id="linhas-indice">
					                        <td><h2>Partes</h2></td>
					                        <td align="right" colspan="3"><button type="button" onclick="javascript: insereParte();" name="btn-adc" style="background-color: green; border-color: green;" id="btn-adc">Adicionar</button></td>
					                    </tr>
					                    <tr id="linhas" style="display: none;">
					                        <td width="15%"><label>Nome:</label></td>
					                        <td>
					                            <select id="proc_partes_n<?php echo $obj[$i]->getProcessos_id();?>" name="proc_partes_n<?php echo $obj[$i]->getProcessos_id();?>">
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
					                            <input type="text" maxlength="10" style="width: 90%;" id="proc_partes_p<?php echo $obj[$i]->getProcessos_id();?>" placeholder="Advogado, réu,  etc" name="proc_partes_p<?php echo $obj[$i]->getProcessos_id();?>"/>
					                            <a onclick="deleteRow(this.parentNode.parentNode.rowIndex)" href="#a"><img src="assets/remove.png" width="20px" height="20px"></a>
					                        </td>
					                    </tr>
					                    <tr>
		                                    <td colspan="4" align="center">
		                                        <button type="button" onclick="alteraVara(<?php echo $val['varas_id'];?>)">Alterar Dados</button>
		                                        <button type="reset" class="gravar">Limpar</button>
		                                        <button type="button" onclick="excluiVara(<?php echo $val['varas_id'];?>)" style="background-color: red; border-color: red">Excluir</button>
		                                    </td>
		                                </tr>
					                </tbody>
					            </table>
					            </form>
		                    </div>
		                    <div id="mascara"></div>
		                </td>
					</tr>
		<?php 	}
			}
		}
	}
?>