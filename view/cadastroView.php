<?php
	class cadastroView{ //classe View da pagina login
		static function respostaCadastro($resposta){
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta){
				echo true;
			}
			else{
				echo 'Erro ao efetuar o cadastro. Dados incorretos!';
				//retorna para o arquivo login.js
			}
		}

		static function respostaVerificacao($resposta){
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta > 0){
				echo true;
			}
			else{
				echo false;
			}
		}

		static function respostaCadastroProcesso($processo, $partes, $indices){
			if($processo){
				echo true;
			}else{
				echo false;
			}
		}

	}

?>