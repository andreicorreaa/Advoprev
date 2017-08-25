<?php
    include_once('../model/servico.php');
    include_once('../view/alteraView.php');    

    $acao = $_REQUEST["action"];

    switch ($acao) {
    	case 'alterarPessoa':
			$loginParam = array("pessoas_id"=>(int)$_POST['id'],
                            "usuarios_id"=>null,
                            "pessoas_cpf"=>(string)$_POST['cpf'],
                            "pessoas_rg"=>(string)$_POST['rg'],
                            "pessoas_nome"=>(string)$_POST['nome'],
                            "pessoas_datanasc"=>$_POST['data'],
                            "pessoas_email"=>(string)$_POST['email'],
                            "pessoas_tel"=>(string)$_POST['telefone'],
                            "pessoas_sexo"=>$_POST['sexo'],
                            "pessoas_oab"=>(string)$_POST['oab'],
                            "pessoas_endereco"=>(string)$_POST['endereco'],
                            "pessoas_del"=> "N");
			$a = Servico::alterarPessoa($loginParam);
    	    return alteraView::respostaAlteracao($a);    	
    		break;
    	case 'alteraIndice':
    		$param = array("indices_id"=>(int)$_POST['id'],
                        "indices_desc"=>(String)$_POST['desc'],
                        "indices_del"=>"N");
        	$a = Servico::alterarIndice($param);
        	return alteraView::respostaAlteracao($a);
    		break;
    	
        case 'alteraVara':
            $param = array("varas_id"=>(int)$_POST['id'],
                        "varas_nome"=>(String)$_POST['desc'],
                        "varas_del"=>"N");
            $a = Servico::alterarVara($param);
            return alteraView::respostaAlteracao($a);
            break;

    	default:
    		# code...
    		break;
    }
?>