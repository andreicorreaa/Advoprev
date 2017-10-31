<?php
    include_once('../model/servico.php');
    include_once('../view/consultarView.php');
    include_once('../view/relatoriosView.php');    

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
            $param = $_POST['desc']; //VERIFICAÇÃO PARA CADASTRO DE INDICE
            $a = Servico::checkIndice($param);
            return consultarView::respostaBusca($a);
            break;

        case 'pesVara':
            $param = "%".$_POST['desc']."%"; //INDICE
            $a = Servico::consultaVaras($param);
            return consultarView::respostaVaras($a);
            break;

        case 'checkVara':
            $param = $_POST['desc']; //VERIFICAÇÃO PARA CADASTRO DE varas
            $a = Servico::checkVaras($param);
            return consultarView::respostaBusca($a);
            break;

        case 'pesProcesso':
            $opcao = $_POST['tipo'];
            if($opcao == 1){
                $param = "%".$_POST['campo']."%"; //PESQUISA POR NUMERO
                $a = Servico::consultaProcessoNumero($param);
                return consultarView::respostaProcesso($a);
            }else if($opcao == 2){
                $param = "%".$_POST['campo']."%"; //PESQUISA POR ODEM
                $a = Servico::consultaProcessoOrdem($param);
                return consultarView::respostaProcesso($a);
            }else if($opcao == 3){
                $param = $_POST['campo']; //PESQUISA POR VARA
                $a = Servico::consultaProcessoVara($param);
                return consultarView::respostaProcesso($a);
            }else if($opcao == 4){
                $param = $_POST['campo']; //PESQUISA POR PARTE
                $a = Servico::consultaProcessoParte($param);
                return consultarView::respostaProcesso($a);
            }else if($opcao == 5){
                $param = $_POST['campo']; //PESQUISA POR INDICE
                $a = Servico::consultaProcessoIndice($param);
                return consultarView::respostaProcesso($a);
            }
            break;

        case 'pesParte':
            $opcao = $_POST['tipo'];
            if($opcao == 1){
                $param = "%".$_POST['campo']."%"; //PESQUISA POR NUMERO
                $a = Servico::consultaParteNumero($param);
                //return($a);
                return consultarView::respostaParte($a);
            }else if($opcao == 2){
                $param = "%".$_POST['campo']."%"; //PESQUISA POR PARTE
                $a = Servico::consultaParte($param);
                return consultarView::respostaParte($a);
            }else if($opcao == 3){
                $param = $_POST['campo']; //PESQUISA POR USUARIO
                $a = Servico::consultaPartePessoa($param);
                return consultarView::respostaParte($a);
            }            
            break;

        case 'pesProcessoA':
            $param = $_POST['aux'];
            $a = Servico::selecionaProcessoAndamento($param);
            return consultarView::respostaAndamento($a, $param);
            break;

        case 'pesProcessoR':
            $param      = $_POST['aux'];
            $processo   = Servico::consultaProcessoID($param);
            $partes     = Servico::consultaParteID($param);
            $indices    = Servico::consultaIndiceID($param);
            $andamentos = Servico::selecionaProcessoAndamento($param);
            $apensos    = Servico::selecionarApensosProcesso($param);

            return relatoriosView::Processo($processo, $partes, $indices, $andamentos, $apensos);
            break;

        case 'pesProcessoP':
            $param = $_POST['aux'];
            $a = Servico::consultaProcessoID($param);
            return consultarView::respostaBusca($a);
            break;

        case 'pesAndamentoR':
            $param = array($_POST['data_inicio'], $_POST['data_final']);
            $a = Servico::consultaAndamentosData($param);
            return relatoriosView::Andamentos($a);
            break;

        case 'pesIndiceR':
            $param = array($_POST['data_inicio'], $_POST['data_final']);
            $a = Servico::consultaIndicesData($param);
            return relatoriosView::Indices($a);
            break;

        case 'checkTipo':
            $param = $_POST['desc'];
            $a = Servico::checkTipo($param);
            return consultarView::respostaBusca($a);

        case 'pesTipo':
            $param = "%".$_POST['desc']."%";
            $a = Servico::consultaTipo($param);
            return consultarView::consultaTipos($a);

        default:
            # code...
            break;
    }
?>