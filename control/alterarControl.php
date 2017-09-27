<?php
    include_once('../model/servico.php');
    include_once('../view/alteraView.php');    

    $acao = $_REQUEST["action"];

    switch ($acao) {
    	case 'alterarPessoa':
			$loginParam = array("pessoas_id"        =>(int)$_POST['id'],
                            "usuarios_id"           =>null,
                            "pessoas_cpf_cnpj"      =>(string)$_POST['cpf_cnpj'],
                            "pessoas_rg"            =>(string)$_POST['rg'],
                            "pessoas_nome"          =>(string)$_POST['nome'],
                            "pessoas_datanasc"      =>$_POST['data'],
                            "pessoas_email"         =>(string)$_POST['email'],
                            "pessoas_tel"           =>(string)$_POST['telefone'],
                            "pessoas_sexo"          =>$_POST['sexo'],
                            "pessoas_oab"           =>(string)$_POST['oab'],
                            "pessoas_endereco"      =>(string)$_POST['endereco'],
                            "pessoas_del"           => "N");
			$a = Servico::alterarPessoa($loginParam);
    	    return alteraView::respostaAlteracao($a);    	
    		break;
    	case 'alteraIndice':
    		$param = array("indices_id"             =>(int)$_POST['id'],
                        "indices_desc"              =>(String)$_POST['desc'],
                        "indices_del"               =>"N");
        	$a = Servico::alterarIndice($param);
        	return alteraView::respostaAlteracao($a);
    		break;
    	
        case 'alteraVara':
            $param = array("varas_id"               =>(int)$_POST['id'],
                        "varas_nome"                =>(String)$_POST['desc'],
                        "varas_del"                 =>"N");
            $a = Servico::alterarVara($param);
            return alteraView::respostaAlteracao($a);
            break;

        case 'alteraProcesso':
            $money = str_replace(".", "", $_POST['valor']);
            $money1 = str_replace(",", ".", $money);
            $param = array("processos_id"           =>(int)$_POST['id'],
                        "processos_num"             =>(String)$_POST['numero'],
                        "processos_acao"            =>$_POST['acao'],
                        "processos_ordem"           =>$_POST['ordem'],
                        "varas_id"                  =>$_POST['vara'],
                        "processos_data"            =>$_POST['data'],
                        "processos_apensos"         =>$_POST['apensos'],
                        "processos_oficial"         =>$_POST['oficial'],
                        "processos_juiz"            =>$_POST['juiz'],
                        "processos_valor"           =>$money1,
                        "processos_senha"           =>$_POST['senha'],
                        "processos_desembargador"   =>$_POST['desembargador'],
                        "processos_procurador"      =>$_POST['procurador'],
                        "processos_del"             =>null,
                        );
            $a = Servico::alterarProcesso($param);
            return alteraView::respostaAlteracao($a);
            break;

        case 'alteraParte':
            $param = array("partes_id"              =>(int)$_POST['id_proc'],
                        "processos_id"              =>null,
                        "pessoas_id"                =>(int)$_POST['pessoa'],
                        "partes_tipo"               =>(String)$_POST['parte'],
                        "partes_del"                =>"N");
            $a = Servico::alterarParte($param);
            return alteraView::respostaAlteracao($a);
            break;

    	default:
    		# code...
    		break;
    }
?>