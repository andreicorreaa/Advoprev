<?php
	class relatoriosView{ //classe View da pagina login
		function Processo($processo, $partes, $indices, $andamentos){
?>			
        	<link href="css/relatorios.css" rel="stylesheet" type="text/css" media="print"/>
			<div id="relatorioProcesso" style="background-color: white">
				<center>
					<h1>FUNPREV</h1>
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
					<span class="subtitulo">D A D O S  &nbsp;  D O &nbsp; P R O C E S S O</span>
					<br>
					<br>
					<table class="tab-r" cellpadding="0">
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Ação:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								DE CONCESSÃO DO BENEFÍCIO DE PENSÃO POR MORTE
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Nº do processo:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								071.01.2012.017640 - CUMPRIMENTO DE SENTENÇA ...
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Ordem:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								632/2012
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Vara:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								2ª VARA DA FAZENDA PÚBLICA
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Oficial:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								Marize
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Juiz:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								Dra. Elaine Cristina Storino Leoni
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Senha:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								-
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Valor da Causa:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								R$ NÃO ATRIBUIU
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Indíces:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								teste; teste; mais um teste; isto é um indice;
							</td>
						</tr>
					</table>
					<br>
					<span class="subtitulo">P A R T E S</span>
					<br>
<?php 				for($i=0;$i<4;$i++){ ?>
					<table class="tab-r" cellpadding="0">
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Parte:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<b>AUTOR</b>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Nome:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								ALZIRA MASSONI AFONSO
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>CPF:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								067.814.958-52
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>RG:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								19.811.595 SSP/SP
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Data Nasc:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								13/01/1980
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Email:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								teste@teste.com
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Sexo:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								M
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>OAB:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								123/12
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Fone:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								14 3322-8899
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Endereço:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								Rua Marcelo Mariuzzo n. 1-555, Bauru/SP
							</td>
						</tr>
						<br>
					</table>
<?php 				} ?>
					<br>
					<span class="subtitulo">A N D A M E N T O S</span>
					<br><br>
<?php 				for($i=0;$i<3;$i++){ ?>
					<table class="tab-r" cellpadding="0">
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Tipo do andamento:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<b>Finalização</b>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Data do andamento:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<b>19/09/2017</b>
							</td>
						</tr>
						<tr>
							<td width="15%" class="back-forte">
								<b><i>Comentários:</i></b>
							</td>
							<td width="85%" class="back-fraco">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum turpis ac tortor pretium finibus. Suspendisse cursus orci sed augue sodales finibus. Maecenas est risus, rhoncus eget leo a, vulputate laoreet metus. Vestibulum euismod pellentesque lacus a lacinia. Nunc viverra elementum quam at rhoncus. Aliquam accumsan quam ligula, sit amet ultrices tellus pretium sit amet. Integer congue sagittis ultrices.

								Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis ullamcorper urna id ex varius, nec vehicula sapien fermentum. Nulla facilisi. Aenean a ex eget ex varius tempus. Sed vel sagittis leo. Aliquam aliquet imperdiet urna vitae dictum. Pellentesque fringilla metus id elit viverra, nec molestie enim tempor. Quisque ullamcorper odio a ante lobortis, id vulputate sapien mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed feugiat lobortis molestie. Proin mollis eleifend enim, non pharetra tortor accumsan quis. Donec sapien dui, congue et augue quis, viverra volutpat magna. Nullam dolor justo, ultricies quis aliquet in, rutrum id massa. Fusce ut gravida tellus.

								Nunc mollis viverra maximus. Integer ullamcorper justo mollis, iaculis arcu pretium, auctor elit. Nullam tincidunt dolor ligula, eleifend varius arcu malesuada id. Morbi bibendum hendrerit sagittis. Fusce suscipit, nisi in luctus tristique, quam arcu blandit ante, vel varius diam magna at justo. Integer vel mi non nisi tempus sodales quis elementum erat. Vivamus sollicitudin eleifend lacus, et lobortis ex egestas sit amet. Cras ullamcorper scelerisque est egestas eleifend. Duis augue enim, accumsan sit amet felis nec, tempor pulvinar arcu.

								Vestibulum bibendum auctor nulla sit amet gravida. Proin varius, diam sit amet maximus porttitor, neque sapien accumsan est, et venenatis ante dolor sit amet enim. Suspendisse nec arcu mollis, vehicula nisl sit amet, dapibus tellus. Integer tristique dui eget mauris porttitor ornare. Integer mattis nec ex a venenatis. Vestibulum dictum aliquet gravida. In auctor ante finibus nibh malesuada porta. Morbi sit amet risus velit.

								Nunc vulputate urna nunc, vel iaculis felis elementum eu. Donec egestas convallis nisl vel vestibulum. Curabitur vehicula orci ac mi vestibulum posuere. Proin ut egestas sem. Nunc commodo dolor eget sagittis vulputate. Sed blandit scelerisque risus convallis tincidunt. Sed vel purus leo. Etiam venenatis maximus vestibulum.
								</p>
							</td>
						</tr>
					</table>
					<br>
<?php 				} ?>
				</center>
			</div>
<?php	}
	}

?>