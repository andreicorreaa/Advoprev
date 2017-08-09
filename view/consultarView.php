<?php
	class consultarView{ //classe View da pagina login
		static function respostaConsulta($resposta){
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta){
				foreach($resposta as $val){
        		?>	
		            <tr>
		                <script type="text/javascript" src="modal/modal.js"></script>
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

		static function respostaAlteracao($resposta){
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta > 0){
				echo true;
			}
			else{
				echo false;
			}
		}

	}

?>