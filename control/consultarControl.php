<?php
    include_once('../model/servico.php');
    include_once('../view/consultarView.php');    

    $acao = $_REQUEST["action"];

    if($acao == "pesNome"){ ////////////////////////////////////PESQUISAS PESSOAS
    	$param = "%".$_POST['nome']."%";
        $a = Servico::consultaNome($param);
        return consultarView::respostaConsulta($a);
    }else if($acao == "pesCPF"){
        $param = "%".$_POST['cpf']."%";
        $a = Servico::consultaCPF($param);
        return consultarView::respostaConsulta($a);
    }else if($acao == "pesRG"){
        $param = "%".$_POST['rg']."%";
        $a = Servico::consultaRG($param);
        return consultarView::respostaConsulta($a);
    }else if($acao == "alterar"){ //////////////////////////// ALTERAÇÃO DE CADASTROS PESSOAS
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
        return consultarView::respostaAlteracao($a);
    }else if($acao == "exc"){
        $param = $_POST['id'];
        $a = Servico::excluiPessoa($param);
        return consultarView::respostaAlteracao($a);
    }else if($acao == "pesIndice"){ ///////////////////////////////////// PESQUISA INDICES
        $param = "%".$_POST['desc']."%";
        $a = Servico::consultaIndice($param);
        return consultarView::respostaIndice($a);
    }else if($acao == "checkIndice"){
        $param = "%".$_POST['desc']."%";
        $a = Servico::consultaIndice($param);
        return consultarView::respostaIndiceBusca($a);
    }
?>