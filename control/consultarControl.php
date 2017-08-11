<?php
    include_once('../model/servico.php');
    include_once('../view/consultarView.php');    

    $acao = $_REQUEST["action"];
    
    switch ($acao) {
        case 'pesNome':
            $param = "%".$_POST['nome']."%"; //NOME
            $a = Servico::consultaNome($param);
            return consultarView::respostaConsultaPessoa($a);
            break;

        case 'pesCPF':
            $param = "%".$_POST['cpf']."%"; //CPF
            $a = Servico::consultaCPF($param);
            return consultarView::respostaConsultaPessoa($a);
            break;

        case 'pesRG':
            $param = "%".$_POST['rg']."%"; //RG
            $a = Servico::consultaRG($param);
            return consultarView::respostaConsultaPessoa($a);
            break;

        case 'pesIndice':
            $param = "%".$_POST['desc']."%"; //INDICE
            $a = Servico::consultaIndice($param);
            return consultarView::respostaIndice($a);
            break;

        case 'checkIndice':
            $param = "%".$_POST['desc']."%"; //VERIFICAÇÃO PARA CADASTRO DE INDICE
            $a = Servico::consultaIndice($param);
            return consultarView::respostaIndiceBusca($a);
            break;

        default:
            # code...
            break;
    }
?>