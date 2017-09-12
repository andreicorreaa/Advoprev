<?php
	include_once('../model/servico.php');
	include_once('../view/cadastroView.php');

	// configuração para aceitar arquivos até 16MB (porém só será permitido 8MB)
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time', '300');
	ini_set('max_input_time', '300');
	ini_set('max_file_uploads', '60');
	ini_set('post_max_size', '16M');
	ini_set('upload_max_filesize', '16M');

	$contem_arquivo = false;
	if(isset($_FILES['arquivo'])){
		$contem_arquivo = true;
		$arquivos = reArrayFiles($_FILES['arquivo']);
		$allowed = "(doc|docx|pdf|png|jpg|jpeg|xls|odt|xlsx|ods)";
		if($arquivos[0]['error'] == '4'){
			$contem_arquivo = false;
		}
		if($contem_arquivo == true){
			foreach($arquivos as $arquivo){
				if($arquivo['size'] >= 8388608){
					echo "1";
					return;
				}else if(!preg_match("/\.".$allowed."$/i", $arquivo['name'])){
					echo "2";
					return;
				}
			}
		}
	}
	if($_POST['and_tipo'] == "" || $_POST['and_com'] == "" || $_POST['and_data'] == "" || $_POST['processos_id'] == ""){
		echo "3";
		return;
	}
	
	$and_tipo 		= $_POST['and_tipo'];
	$and_com  		= $_POST['and_com'];
	$and_data 		= $_POST['and_data'];
	$processos_id	= $_POST['processos_id'];

	try{
		$param = array(
			"andamentos_id" 	=> null,
			"processos_id"  	=> $processos_id,
			"andamentos_tipo"	=> $and_tipo,
			"andamentos_com"	=> $and_com,
			"andamentos_data"	=> $and_data,
			"andamentos_del" 	=> 'N'
		);
		$a = Servico::cadastrarAndamentos($param);
		if($a){
			if($contem_arquivo){
				foreach($arquivos as $arquivo){
					$fileName = $arquivo['name'];
					$tmpName  = $arquivo['tmp_name'];
					$fileSize = $arquivo['size'];
					$fileType = $arquivo['type'];

					$content  = file_get_contents($tmpName);

					if(!get_magic_quotes_gpc()){
					    $fileName = addslashes($fileName);
					}
					$param = array("arquivos_id"		=> null,
								   "andamentos_id"		=> null,
								   "arquivos_nome"		=> $fileName,
								   "arquivos_tipo"		=> $fileType,
								   "arquivos_tamanho" 	=> $fileSize,
								   "arquivos_arq"		=> $content,
								   "arquivos_del"		=> "N");
					$b = Servico::cadastrarArquivos($param);
				}
				if($b){
						echo "4";
					}
			}else{
				echo "5";
			}
		}else{
			echo "6";
		}
	}catch(Exception $e){
		return $e;
	}
	
	function reArrayFiles(&$file_post) {
		    $file_ary = array();
		    $file_count = count($file_post['name']);
		    $file_keys = array_keys($file_post);

		    for ($i=0; $i<$file_count; $i++) {
		        foreach ($file_keys as $key) {
		            $file_ary[$i][$key] = $file_post[$key][$i];
		        }
		    }
		    return $file_ary;
		}
?>