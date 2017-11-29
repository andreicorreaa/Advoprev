<?php
    include_once('../model/servico.php');
    include_once('../view/alteraView.php');    

    $acao = $_REQUEST["action"];

    switch ($acao) {
    	case 'alterarPessoa':
			$loginParam = array("pessoas_id"        =>(int)$_POST['id'],
                            "usuarios_id"           =>null,
                            "pessoas_cpf_cnpj"      =>(string)$_POST['cpf_cnpj'],
                            "pessoas_rg"            =>Nulo($_POST['rg']),
                            "pessoas_nome"          =>strtoupper($_POST['nome']),
                            "pessoas_datanasc"      =>$_POST['data'],
                            "pessoas_email"         =>Nulo($_POST['email']),
                            "pessoas_tel"           =>Nulo($_POST['telefone']),
                            "pessoas_sexo"          =>$_POST['sexo'],
                            "pessoas_oab"           =>Nulo($_POST['oab']),
                            "pessoas_cep"           =>$_POST['cep'],
                            "pessoas_complemento"   =>Nulo($_POST['complemento']),
                            "pessoas_numero"        =>Nulo($_POST['numero']),
                            "pessoas_estadocivil"   =>Nulo($_POST['estadocivil']),
                            "pessoas_profissao"     =>Nulo($_POST['profissao']),
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
                        "processos_ordem"           =>Nulo($_POST['ordem']),
                        "varas_id"                  =>$_POST['vara'],
                        "processos_data"            =>$_POST['data'],
                        "processos_apensos"         =>Nulo($_POST['apensos']),
                        "processos_oficial"         =>$_POST['oficial'],
                        "processos_juiz"            =>$_POST['juiz'],
                        "processos_valor"           =>Nulo($money1),
                        "processos_senha"           =>Nulo($_POST['senha']),
                        "processos_desembargador"   =>Nulo($_POST['desembargador']),
                        "processos_procurador"      =>NUlo($_POST['procurador']),
                        "processos_assistencia"     =>$_POST['assistencia'],
                        "processos_observacoes"     =>Nulo($_POST['observacoes']),
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

        case 'alteraTipo':
            $param = array( "tipos_andamento_id"    =>(int)$_POST['id'],
                            "tipos_andamento_desc"  =>(String)$_POST['desc'],
                            "tipos_andamento_del"   =>"N");
            $a = Servico::alterarTipo($param);
            return alteraView::respostaAlteracao($a);
            break;

        case 'alteraUsuario':
            $param = array( "usuarios_id"           =>(int)$_POST['id'],
                            "usuarios_nome"         =>(String)$_POST['nome'],
                            "usuarios_senha"        =>md5($_POST['senha']),
                            "usuarios_grupo"        =>(int)$_POST['grupo'],
                            "usuarios_del"          =>"N");
            $a = Servico::alterarUsuario($param);
            return alteraView::respostaAlteracao($a);
            break;

    	default:
    		# code...
    		break;
    }

    function Nulo($value){
        if($value == ""){
            return null;
        }else{
            return $value;
        }
    }
?>