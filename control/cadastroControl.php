<?php
    include_once('../model/servico.php');
    include_once('../view/cadastroView.php');    

    $acao = $_REQUEST["action"];

    if($acao == "cadIndice"){
        $param = array("indices_id" => null, 
                       "indices_desc"=>$_POST['desc'],
                       "indices_del"=>"N");
        $a = Servico::cadastroIndice($param); // chama a funcao para verificação na classe servico
        return cadastroView::respostaCadastro($a);


    }else if($acao == "cadastroProcesso"){
        $aux1 = false; //variavel para checar se existe partes
        $aux2 = false; //variavel para checar se existe indices
        $money = str_replace(".", "", $_POST['valor']);
        $money1 = str_replace(",", ".", $money);

        $param = array("processos_id"               => null,
                        "processos_num"             => $_POST['numero'],
                        "processos_acao"            => $_POST['acao'],
                        "processos_ordem"           => $_POST['ordem'],
                        "varas_id"                  => $_POST['vara'],
                        "processos_oficial"         => $_POST['oficial'],
                        "processos_juiz"            => $_POST['juiz'],
                        "processos_apensos"         => $_POST['apensos'],
                        "processos_valor"           => $money1,
                        "processos_senha"           => $_POST['senha'],
                        "processos_data"            => $_POST['data'],
                        "processos_procurador"      => $_POST['procurador'],
                        "processos_desembargador"   => $_POST['desembargador'],
                        "processos_del"             => "N");

        for($i = 0; $i < count($_POST['nome']); $i++){ //pegando partes selecionados na view
            if($_POST['nome'][$i] != "" && $_POST['desc'][$i] != ""){
                $tipo[$i] = $_POST['desc'][$i];
                $parte[$i] = $_POST['nome'][$i];
                $aux1 = true;
            }
        }
        for($i = 0; $i < count($_POST['indices']); $i++){ // pegando indices selecionados na view
            if($_POST['indices'][$i] != ""){
                $indice[$i] = $_POST['indices'][$i];
                $aux2 = true;
            }
        }
        $retorno = 0; //variavel para resposta da view
        $retorno1 = 0; // ||
        try{
            $a = Servico::cadastroProcesso($param); //cadastra o processo
            if($a){ //verifica se o processo foi inserido com sucesso, se sim, continua para inserção de indices e partes
                if($aux1 == true){ //se existe partes
                    for($i = 0; $i < count($tipo); $i++){
                        $param1 = array("partes_id"     => null,
                                        "pessoas_id"    => $parte[$i],
                                        "processos_id"  => null,
                                        "partes_tipo"   => $tipo[$i],
                                        "partes_del"    => "N");
                        try{
                            $retorno = Servico::cadastroPartes($param1);
                        }catch(Exception $e){
                            return $e;
                        }
                    }
                }
                if($aux2 == true){ //se existe indices
                    for($i = 0; $i < count($indice); $i++){
                        $param2 = array("indicesprocesso_id"    =>null,
                                        "indices_id"            => $indice[$i],
                                        "processos_id"          => null,
                                        "indice_del"            =>"N");
                        try{
                            $retorno1 = Servico::cadastroIndicesProcesso($param2);
                        }catch(Exception $e){
                            return $e;
                        }
                    }
                }
            }
            return cadastroView::respostaCadastroProcesso($a, $retorno, $retorno1);
        }catch(Exception $e){
            return $e;
        }
    }else if($acao == "cadVara"){
        $param = array("varas_id" => null, 
                       "varas_nome"=>$_POST['desc'],
                       "varas_del"=>"N");
        $a = Servico::cadastroVara($param); // chama a funcao para verificação na classe servico
        return cadastroView::respostaCadastro($a);
    }else if($acao == "cad"){
        $grupo = "2"; //usuario gerente
        $loginParam = array("usuarios_id"=> null,
        					"usuarios_nome"=>$_POST['nome'],
        					"usuarios_senha"=>$_POST['senha'], 
        					"usuarios_grupo"=>$grupo, 
        					"usuarios_del" => "N");

        $a = Servico::cadastro($loginParam);
        return cadastroView::respostaCadastro($a);

    }else if($acao == "ver"){ //verificacao de dados
        $param = $_POST['nome'];
        $a = Servico::verificaLogin($param); // chama a funcao para verificação na classe servico
        return cadastroView::respostaVerificacao($a); // pede para a view retornar um valor bool para o javascript
    }else if($acao == "verCPF"){
        $param = $_POST['aux'];
        $a = Servico::verificaCPF($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "verEmail"){
        $param = $_POST['aux'];
        $a = Servico::verificaEmail($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "verRG"){
        $param = $_POST['aux'];
        $a = Servico::verificaRG($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "verTEL"){
        $param = $_POST['aux'];
        $a = Servico::verificaTel($param);
        return cadastroView::respostaVerificacao($a);
    }
    else if($acao == "cadastro"){
        $loginParam = array("pessoas_id"=>null,
                            "usuarios_id"=>null,
                            "pessoas_cpf_cnpj"=>$_POST['cpf_cnpj'],
                            "pessoas_rg"=>$_POST['rg'],
                            "pessoas_nome"=>$_POST['nome'],
                            "pessoas_datanasc"=>$_POST['data'],
                            "pessoas_email"=>$_POST['email'],
                            "pessoas_tel"=>$_POST['telefone'],
                            "pessoas_sexo"=>$_POST['sexo'],
                            "pessoas_oab"=>$_POST['oab'],
                            "pessoas_endereco"=>$_POST['endereco'],
                            "pessoas_del"=> "N");
        $a = Servico::cadastroPessoa($loginParam);
        return cadastroView::respostaCadastro($a);
    }else if($acao == "verNProcesso"){
        $param = $_POST['aux'];
        $a = Servico::verificaProcesso($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "verNOrdem"){
        $param = $_POST['aux'];
        $a = Servico::verificaOrdem($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "cadastrarPartes"){
        $param = array( "processo"  => $_POST['processo'],
                        "pessoas"    => $_POST['pessoas'],
                        "partes"     => $_POST['partes']);
        $a = Servico::cadastraPartes($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "cadastrarIndices"){
        $param = array( "processo"  => $_POST['processo'],
                        "indices"   => $_POST['indices']);
        $a = Servico::cadastrarIndices($param);
        return cadastroView::respostaVerificacao($a);
    }else if($acao == "cadTipo"){
        $param = $_POST['desc'];
        $a = Servico::cadastrarTipos($param);
        return cadastroView::respostaVerificacao($a);
    }
?>