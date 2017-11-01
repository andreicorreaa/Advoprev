<?php
    include_once('../model/servico.php');
    include_once('../view/exclusaoView.php');    

    $acao = $_REQUEST["action"];

    switch ($acao) {
    	case 'excluiPessoa'    :
			$param = $_POST['id'];
        	$a = Servico::excluiPessoa($param);
        	return exclusaoView::respostaExclusao($a);   	
    		break;
    	case 'excluiIndice'    :
    		$param = $_POST['id'];
        	$a = Servico::excluiIndice($param);
        	return exclusaoView::respostaExclusao($a);
    		break;  	
        case 'excluiVara'      :
            $param = $_POST['id'];
            $a = Servico::excluiVara($param);
            return exclusaoView::respostaExclusao($a);
            break;
        case 'excluiProcesso'  :
            $param = $_POST['id'];
            $a = Servico::excluiProcesso($param);
            return exclusaoView::respostaExclusao($a);
            break;
        case 'excluiParte'     :
            $param = $_POST['id'];
            $a = Servico::excluiParte($param);
            return exclusaoView::respostaExclusao($a);
            break;

        case 'excluiTipo'      :
            $param = $_POST['id'];
            $a = Servico::excluiTipo($param);
            return exclusaoView::respostaExclusao($a);
            break;

        case 'excluiUsuario'   :
            $param = $_POST['id'];
            $a = Servico::excluiUsuario($param);
            return exclusaoView::respostaExclusao($a);
            break;
            
    	default:
    		# code...
    		break;
    }
?>