<?php
	class LoginView{ //classe View da pagina login
		static function respostaAutenticacao($resposta){
		
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta){
				echo true;
			}
			else{
				echo 'Erro ao efetuar o login. Dados incorretos!';
				//retorna para o arquivo login.js
			}
		}

	}

?>