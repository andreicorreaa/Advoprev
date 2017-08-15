<?php
    include_once('../model/servico.php');
    include_once('../view/exclusaoView.php');    

    $acao = $_REQUEST["action"];

    switch ($acao) {
    	case 'excluiPessoa':
			$param = $_POST['id'];
        	$a = Servico::excluiPessoa($param);
        	return exclusaoView::respostaExclusao($a);   	
    		break;
    	case 'excluiIndice':
    		$param = $_POST['id'];
        	$a = Servico::excluiIndice($param);
        	return exclusaoView::respostaExclusao($a);
    		break;
    	
        case 'excluiVara':
            $param = $_POST['id'];
            $a = Servico::excluiVara($param);
            return exclusaoView::respostaExclusao($a);
            break;

    	default:
    		# code...
    		break;
    }
?>