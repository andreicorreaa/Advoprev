<?php
	class exclusaoView{ //classe View da pagina login
		static function respostaExclusao($resposta){
			/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
			exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
			if($resposta > 0){
				echo true;
			}
			else{
				return $resposta;
			}
		}
		
	}
?>