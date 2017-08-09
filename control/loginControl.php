<?php
    include_once('../model/servico.php'); //importa a classe servico
    include_once('../view/loginView.php'); //importa a View login

    $acao = $_REQUEST["action"]; // pega o parametro enviado pelo arquivo login.js

    switch($acao){ // seleciona o parametro

        case 'login':{ // fazer login
            $loginParam = array($_POST['nome'], $_POST['senha']); // seta os parametros para enviar a classe servico
            $a = Servico::login($loginParam); // chama a classe servico
            return LoginView::respostaAutenticacao($a); // envia a conferencia para a view
        } break;

        case 'logout':{ //fazer logout
            if(Servico::logout()){
                header('location: ../index.php');
            }
        } break;

        default:
            return null;
    }
?>