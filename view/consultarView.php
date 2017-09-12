<?php
	//include_once ("../model/entidades.php");
	include_once ("../model/servico.php");
	class consultarView{ //classe View da pagina login
		static function respostaAndamento($andamentos, $id){
			if($andamentos != null){
?>
				<div id="consultaAndamento">
					<div id="andLateral">
					<?php for($i=0;$i<count($andamentos);$i++){ //barra lateral?>
						<div id="btnLisAnd">
							<a class="btnLisAnd" style="text-decoration:none;" href="#" onclick="javascript: mostraAndamento(<?php echo $andamentos[$i]->getAndamentos_id(); ?>);"><?php echo $andamentos[$i]->getAndamentos_tipo(); ?></a>
							<p style="font-size: 12px;margin-top: 4px;color:black"><i>Data: <?php echo date('d/m/Y',strtotime($andamentos[$i]->getAndamentos_data())); ?></i></p>
						</div>

						<div class="mostraAndamento" id="mostraAndamento<?php echo $andamentos[$i]->getAndamentos_id(); ?>" style="display: none;">
							<form id="alteraAndamento">
								<table width="100%">
									<tr>
										<td width="60%"><p style="color: black;font-size: 16px;margim:0px;">Situação/Tipo do andamento*:</p></td>
										<td>
											<p style="color: black;font-size: 16px;margim:0px;">
												Data*: 
												<span style="float: right;">
													<a href="#" onclick="javascript: alteraAndamento(<?php echo $andamentos[$i]->getAndamentos_id(); ?>);"><img src="assets/change.png" width="20px" height="20px"></a>
												</span>
											</p>
										</td>
									</tr>
									<tr>
										<td width="40%"><input type="text" id="tipo_and_<?php echo $andamentos[$i]->getAndamentos_id();?>" class="text" value="<?php echo $andamentos[$i]->getAndamentos_tipo(); ?>" disabled require/></td>
										<td><input type="date" id="data_and_<?php echo $andamentos[$i]->getAndamentos_id();?>" value="<?php echo $andamentos[$i]->getAndamentos_data();?>" min="1900-01-01" max="2050-02-18" disabled required/></td>
									</tr>
									<tr>
										<td width="70%"><p style="color: black;font-size: 16px;margim:0px;">Comentários*:</p></td>
										<td width="30%"><p style="color: black;font-size: 16px;margim:0px;">Arquivos*:</p></td>
									</tr>
									<tr>
										<td><textarea id="com_and_<?php echo $andamentos[$i]->getAndamentos_id();?>" style="width: 98%;" rows="16" disabled required><?php echo $andamentos[$i]->getAndamentos_com(); ?></textarea></td>
										<td id="arquivos_alt">
											<?php 
													$arquivos = $andamentos[$i]->getArquivos();
													if($arquivos){
														foreach($arquivos as $arquivo){ ?>
															<div id="btnLisAnd">
																<a class="btnLisAnd" style="text-decoration:none;" target="_blank" href="control/lerArquivos.php?id=<?php echo $arquivo->getArquivos_id(); ?>"><?php echo $arquivo->getArquivos_nome(); ?></a>
															</div>
											<?php		} 
													}else{ ?>
														<p>Não existem arquivos a serem exibidos</p>
											<?php	}	?>
										</td>
									</tr>
								</table>
							</form>
							<center>
								<button type="button" style="margin-top: 5px" name="btn_abrirAndamento" id="btn_abrirAndamento" onclick="javascript: abrirCadastro();">Cadastrar Andamento</button>
							</center>
						</div>

					<?php } ?>
					</div>
					<div id="andLista">
						<p style="color: black;font-size: 30px;text-align: center;padding-top: 20%">Selecione o andamento para ver os detalhes</p>
					</div>
				</div>

<?php
			}else{
				return false;
			}
		}





		static function respostaConsultaPessoa($resposta){
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
<?php 			}
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
<?php 			}
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
<?php 			}
			}
			else{
				echo false;
				//retorna para o arquivo login.js
			}
		}


		static function respostaProcesso($obj){
			if($obj){
				?><tr><td><div style="display: none"><script type="text/javascript" src="modal/modalP.js"></script></td></tr></div><?php
				$varas = Servico::SelecionarVaras();
				for($i=0;$i<count($obj);$i++){
					$vara = Servico::selecionaVara($obj[$i]->getVaras_id()); ?>
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
						                        <td width="40%"><input type="text" name="proc_numero" maxlength="50" id="proc_numero<?php echo $obj[$i]->getProcessos_id();?>" onchange="javascript: return procurarNProcesso(this.value, <?php echo $obj[$i]->getProcessos_num(); ?>)" placeholder="Insira o número do processo" size="50" value="<?php echo $obj[$i]->getProcessos_num(); ?>" required/></td>
						                        <td><label>Ação*:</label></td>
						                        <td><input type="text" name="proc_acao" value="<?php echo $obj[$i]->getProcessos_acao(); ?>" id="proc_acao<?php echo $obj[$i]->getProcessos_id();?>" maxlength="100" placeholder="Insira a ação" size="16" required/></td>
						                    </tr>
						                    <tr align="left">
						                        <td width="15%"><label>Ordem*:</label></td>
						                        <td><input type="text" name="proc_ordem" value="<?php echo $obj[$i]->getProcessos_ordem(); ?>" onchange="javascript: procurarNOrdem(this.value, <?php echo $obj[$i]->getProcessos_num(); ?>)" id="proc_ordem<?php echo $obj[$i]->getProcessos_id();?>" placeholder="Insira a ordem" maxlength="45" required/></td>
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
						                        <td><input type="text" size="11" maxlength="50" id="proc_oficial<?php echo $obj[$i]->getProcessos_id();?>" value="<?php echo $obj[$i]->getProcessos_oficial(); ?>" placeholder="Nome oficial de justiça" name="proc_oficial"/></td>
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
			                                    <td colspan="4" align="center">
			                                        <button type="button" onclick="alteraProcesso(<?php echo $obj[$i]->getProcessos_id();?>)">Alterar Dados</button>
			                                        <button type="reset" class="gravar">Limpar</button>
			                                        <button type="button" onclick="excluiProcesso(<?php echo $obj[$i]->getProcessos_id();?>)" style="background-color: red; border-color: red">Excluir</button>
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

		static function respostaParte($obj){
			if($obj){
				?><tr><td><div style="display: none"><script type="text/javascript" src="modal/modalP.js"></script></td></tr></div><?php
				for($i=0;$i<count($obj);$i++){
					foreach($obj[$i] as $Parte){ 
						$Processo = Servico::selecionaProcesso($Parte->getProcessos_id());
						$Pessoa = Servico::selecionaPessoas($Parte->getPessoas_id());
						$Pessoas_geral = Servico::SelecionarPessoas();
	?>
						<tr>
							<td width="30%"><?php echo $Processo->getProcessos_num();?></td>
			        		<td width="40%"><?php echo $Pessoa->getPessoas_nome();?></td>
			        		<td width="27%"><?php echo $Parte->getPartes_tipo();?></td>
			        		<td width="3%"><a href="#janela<?php echo $Parte->getPartes_id();?>" rel="modal"><img src="assets/change.png" width="20px" height="20px"></a></td>
		                	<td>
			                    <div class="window" style="width: 500px; height: 300px;" id="janela<?php echo $Parte->getPartes_id();?>">
			                        <a href="#" class="fechar">X Fechar</a>
			                        <form>
			                            <table>
			                                <caption>Alteração</caption>
			                                <tr align="left">
			                                    <td width="15%"><label>Nome:</label></td>
			                                    <td>
	                    							<select id="soflow<?php echo $Parte->getPartes_id(); ?>" class="comb" name="parte_pessoa">
	                        							<option value = "<?php echo $Pessoa->getPessoas_id();?>"><?php echo $Pessoa->getPessoas_nome(); ?></option>
	<?php   											if(count($Pessoas_geral) > 0){
	                            							foreach($Pessoas_geral as $pessoa){
	                            								if($pessoa->getPessoas_id() != $Pessoa->getPessoas_id()){
	?>
	                                							<option value="<?php echo $pessoa->getPessoas_id();?>"><?php echo $pessoa->getPessoas_nome(); ?></option>
	<?php       												}
															}
	                        							}
	?>
	                    							</select>
	                							</td>
	                						</tr>
	                						<tr>
	                							<td width="15%"><label>Parte:</label></td>
	                							<td id="Parte">
													<input type="text" name="parte_p" value="<?php echo $Parte->getPartes_tipo();?>" id="parte_p<?php echo $Parte->getPartes_id(); ?>" class="text" placeholder="Digite a parte no processo" size="10" required/>
												</td>
			                                </tr>
			                                <tr>
			                                    <td colspan="3" align="center">
			                                        <button type="button" onclick="alteraParte(<?php echo $Parte->getPartes_id();?>)">Alterar Dados</button>
			                                        <button type="reset" class="gravar">Limpar</button>
			                                        <button type="button" onclick="excluiParte(<?php echo $Parte->getPartes_id();?>)" style="background-color: red; border-color: red">Excluir</button>
			                                    </td>
			                                </tr>
			                            </table>
			                        </form>
			                    </div>
		                    	<div id="mascara"></div>
		                	</td>    	
		        		</tr>
	<?php 			}
	        	}
	        }else{
	        	return false;
	        }
    	}
    }
?>