<?php
    include_once('../model/servico.php');
    include_once('../view/cadastroView.php');    

    $acao = $_REQUEST["action"];

    if($acao == "cad"){
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
                            "pessoas_cpf"=>$_POST['cpf'],
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
    }
?>