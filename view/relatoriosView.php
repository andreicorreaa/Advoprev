<?php
	class relatoriosView{ //classe View da pagina relatorios
		function Processo($processo, $partes, $indices, $andamentos){			
?>			
        	<input type="button" id="btn-imprime" onclick="javascript: Imprimir()" value="Imprimir">
        	<link href="css/relatorios.css" rel="stylesheet" type="text/css" media="print"/>
			<div id="relatorioProcesso" style="background-color: white">
				<center>
					<h1>FUNPREV</h1>
					<!--
					<span class="subtitulo">F I C H A  &nbsp; P R O C E S S U A L</span>
					<br>
					<br>
					<span class="subtitulo" style="text-decoration: none;">ATIVO</span>
					<br>
					<span class="subtitulo" style="text-decoration: none; font-weight: normal;">TRIBUNAL</span>
					<br>
					<span class="subtitulo" style="text-decoration: none; font-weight: normal;">ARQUIVO</span>
					<br>
					<br>
					-->
					<span class="subtitulo">D A D O S  &nbsp;  D O &nbsp; P R O C E S S O</span>
					<br>
					<br>
					<table class="tab-r" cellpadding="0">
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Ação:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_acao(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Nº do processo:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_num(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Data do processo:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_data(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Ordem:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_ordem(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Vara:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php 
									$vara = Servico::selecionaVara($processo->getVaras_id());
									if($vara){
										echo $vara[0]['varas_nome'];
									}
								?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Oficial:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_oficial(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Desembargador/<br>Ministro:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_desembargador(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Procurador:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_procurador(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Juiz:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_juiz(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Senha:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php echo $processo->getProcessos_senha(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Valor da Causa:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								R$ <?php echo $processo->getProcessos_valor(); ?>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Indíces:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<?php 
									for($i=0;$i<count($indices);$i++){
										echo "<b><i>".$indices[$i]['indices_desc']."</i></b> - ";
									}
								?>
							</td>
						</tr>
					</table>
					<br>
<?php 				if($partes){ 
?>
						<span class="subtitulo">P A R T E S</span>
						<br>
<?php
						for($i=0;$i<count($partes);$i++){ 
							$pessoa = Servico::selecionaPessoas($partes[$i]->getPessoas_id()) 
?>
							<table class="tab-r" cellpadding="0">
								<tr>
									<td width="15%" class="back-forte">
										<b><i>Parte:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<b><?php echo $partes[$i]->getPartes_tipo(); ?></b>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>Nome:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_nome(); ?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>CPF/CNPJ:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_cpf_cnpj(); ?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>RG:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_rg(); ?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>Data Nasc:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_datanasc(); ?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>Email:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_email(); ?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>Sexo:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_sexo(); ?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>OAB:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php 
											echo $pessoa->getPessoas_oab(); 
										?>
									</td>
								</tr>
								<tr>
									<td width="15%" class="back-forte">
										<b><i>Fone:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_tel(); ?>
									</td>
								</tr>

								<tr>
									<td width="15%" class="back-forte">
										<b><i>Endereço:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php
											$ch = curl_init('http://viacep.com.br/ws/'.$pessoa->getPessoas_cep().'/json/');
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											$result = curl_exec($ch);
											$endereco = json_decode($result);
											if(is_object($endereco)){
												echo $endereco->logradouro . " - ";
												echo $endereco->bairro . " - ";
												echo $endereco->localidade . " - ";
												echo $endereco->uf . " - ";
												echo $endereco->cep;
											}else{
												echo $pessoa->getPessoas_cep();
											}
										?>
									</td>
								</tr>

								<tr>
									<td width="15%" class="back-forte">
										<b><i>Complemento:</i></b>
									</td>
									<td width="85%" class="back-fraco">
										<?php echo $pessoa->getPessoas_complemento(); ?>
									</td>
								</tr>
								<br>
							</table>
<?php	 				} 
					}else{
?>
						<center>
							<hr>
							<h2>Não existem partes para esse processo</h2>
						</center>
<?php						
					}	
?>
					<br>
<?php 				
					if($andamentos){
?>						<span class="subtitulo">A N D A M E N T O S</span>
						<br><br>
<?php
						for($i=0;$i<count($andamentos);$i++){
							if(!$i == 0){
?>
								<hr>
<?php							
							}
							$tipos_andamento = Servico::SelecionarTipos_andamento();
?>
							<table class="tab-r" cellpadding="0">
								<tr>
									<td width="85%" class="back-fraco">
										<b><?php echo date('d/m/Y',strtotime($andamentos[$i]->getAndamentos_data())); ?></b>
<?php
										foreach ($tipos_andamento as $t_a) {
											if($t_a->getTipos_andamento_id() == $andamentos[$i]->getTipos_andamento_id()){
												echo " - ".$t_a->getTipos_andamento_desc();
												break;
											}
										}
?>
									</td>
								</tr>
								<tr>
									<td width="85%" class="back-fraco">
										<p><?php echo $andamentos[$i]->getAndamentos_com(); ?></p>
									</td>
								</tr>
							</table>
							<br>
<?php 					} 
					}else{
?>
						<center>
							<hr>
							<h2>Não existem andamentos para esse processo</h2>
						</center>
<?php
					}
?>
				</center>
			</div>
<?php	}




		function Andamentos($andamentos){
			if(!$andamentos == false){
?>
				<input type="button" id="btn-imprime" onclick="javascript: ImprimirAndamento()" value="Imprimir">
        		<link href="css/relatorios.css" rel="stylesheet" type="text/css" media="print"/>

        		<div id="relatorioAndamento" style="background-color: white">
        			<center>
        				<table class="tb-a">
        					<thead>
        						<th width="15%">ID Andamento</th>
        						<th width="25%">Tipo do Andamento</th>
        						<th width="30%">Nº Processo</th>
        						<th width="30%">Data do Andamento</th>
        					</thead>
        					<tbody>
<?php
							$tipos_andamento = Servico::SelecionarTipos_andamento();
							$processos = Servico::SelecionarProcessos();
							foreach($andamentos as $andamento){
?>								
        						<tr>
        							<td><?php echo $andamento->getAndamentos_id(); ?></td>
        							<td><?php 
        								foreach ($tipos_andamento as $t_a) {
											if($t_a->getTipos_andamento_id() == $andamento->getTipos_andamento_id()){
												echo $t_a->getTipos_andamento_desc();
												break;
											}
										} ?>
									</td>
									<td><?php 
										foreach ($processos as $processo) {
											if($processo->getProcessos_id() == $andamento->getProcessos_id()){
												echo $processo->getProcessos_num();
												break;
											}
										} ?>
									</td>
									<td><?php echo date('d/m/Y',strtotime($andamento->getAndamentos_data())); ?></td>
        						</tr>
<?php 						}
?>
							<td class="tb-total" colspan="4">Total de andamentos: <?php echo count($andamentos) ?></td>
        					</tbody>
        				</table>
        			</center>
        		</div>
<?php		}else{
?>
				<h1>Não foram encontrados registros para esse período de tempo</h1>
<?php		
			}
		}

		function Indices($indicesProcessos){
			$indices = Servico::SelecionarAllIndices();
			$processos = Servico::SelecionarProcessos();
			if($indicesProcessos){
?>
				<input type="button" id="btn-imprime" onclick="javascript: ImprimirIndice()" value="Imprimir">
        		<link href="css/relatorios.css" rel="stylesheet" type="text/css" media="print"/>

        		<div id="relatorioIndice" style="background-color: white">
	        		<center>
						<table class="tb-a">
							<thead>
								<th width="15%">ID Indice</th>
								<th width="25%">Descrição</th>
								<th width="30%">Nº Processo</th>
								<th width="30%">Data do Processo</th>
							</thead>
							<tbody>
<?php
								foreach($indicesProcessos as $indiceProcesso){
?>
								<tr>
									<td>
<?php 									
										echo $indiceProcesso->getIndices_id();
?>
									</td>
									<td>
<?php 									
										foreach ($indices as $indice) {
											if($indiceProcesso->getIndices_id() == $indice->getIndices_id()){
												echo $indice->getIndices_desc();
												break;
											}
										}
?>
									</td>
									<td>
<?php 									
										foreach ($processos as $processo) {
											if($indiceProcesso->getProcessos_id() == $processo->getProcessos_id()){
												echo $processo->getProcessos_num();
												break;
											}
										}
?>
									</td>
									<td>
<?php 									
										foreach ($processos as $processo) {
											if($indiceProcesso->getProcessos_id() == $processo->getProcessos_id()){
												echo date('d/m/Y',strtotime($processo->getProcessos_data()));
												break;
											}
										}
?>
									</td>
								</tr>
<?php
								}
?>
							<tr>
								<td class="tb-total" colspan="4">
									<p>Total de indices encontrados: <?php echo count($indicesProcessos); ?></p>
								</td>
							</tr>
							<tr>
								<td class="tb-total" colspan="2">
									<p>Total por Assunto/Indíce:</p>
								</td>
								<td class="tb-total-oco" colspan="2">
<?php
								$indices_id = null;
								$todos_indices_id = null;
								// PEGAR INDICES RETORNADOS NA CONSULTA
								foreach($indicesProcessos as $indiceProcesso){
									if($indices_id == null){
										$indices_id = array($indiceProcesso->getIndices_id());
									}else{
										if(!(in_array($indiceProcesso->getIndices_id(), $indices_id))){
											array_push($indices_id,$indiceProcesso->getIndices_id());
										}
									}

									if($todos_indices_id == null){
										$todos_indices_id = array($indiceProcesso->getIndices_id());
									}else{
										array_push($todos_indices_id,$indiceProcesso->getIndices_id());
									}
								}
								// QNT DE VEZES QUE O INDICE APARECE
								$qt_in_array = array_count_values($todos_indices_id);
								$qnt_ocorrencias = null;
								foreach($indices_id as $id){
									$qnt_ocorrencias[$id] = $qt_in_array[$id];
									foreach ($indices as $indice) {
										if($id == $indice->getIndices_id()){
											echo $indice->getIndices_desc().": ".$qt_in_array[$id]."<br>";
											break;
										}
									}
								}
?>
								</td>
							</tr>
							</tbody>
						</table>
					</center>
        		</div>
<?php
			}else{
				echo "<h1>Não foram encontrados registros para esse período de tempo</h1>";
			}
		}
	}
?>