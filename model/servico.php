<?php
    require "suporte.php"; // requerindo suporte
    require "entidades.php"; // incluindo entidades
    
    session_start(); //inicia a sessao do login
    class Servico{
//------------------------- OBJETOS -----------------------------------------------------------

        static function objUsuarios($usr){ // objeto Usuarios
            $usuario = new Usuarios(); //instanciando
            $usuario->setUsuarios_id($usr["usuarios_id"]);
            $usuario->setUsuarios_nome($usr["usuarios_nome"]);
            $usuario->setUsuarios_senha($usr["usuarios_senha"]);
            $usuario->setUsuarios_grupo($usr["usuarios_grupo"]);
            $usuario->setUsuarios_del($usr["usuarios_del"]);
            
            return $usuario;
        }
        
        static function objPessoas($pa){ //objeto Pessoas
            $pessoa = new Pessoas(); //instanciando
            $pessoa->setPessoas_id($pa["pessoas_id"]);
            $pessoa->setUsuarios_id($pa["usuarios_id"]);
            $pessoa->setPessoas_cpf_cnpj($pa["pessoas_cpf_cnpj"]);
            $pessoa->setPessoas_rg($pa["pessoas_rg"]);
            $pessoa->setPessoas_nome($pa["pessoas_nome"]);
            $pessoa->setPessoas_datanasc($pa["pessoas_datanasc"]);
            $pessoa->setPessoas_email($pa["pessoas_email"]);
            $pessoa->setPessoas_tel($pa["pessoas_tel"]);
            $pessoa->setPessoas_sexo($pa["pessoas_sexo"]);
            $pessoa->setPessoas_oab($pa["pessoas_oab"]);
            $pessoa->setPessoas_endereco($pa["pessoas_endereco"]);
            $pessoa->setPessoas_del($pa["pessoas_del"]);
            
            return $pessoa;
        }

        static function objIndices($pa){
            $indice = new Indices();
            $indice->setIndices_id($pa["indices_id"]);
            $indice->setIndices_desc($pa["indices_desc"]);
            $indice->setIndices_del($pa["indices_del"]);

            return $indice;
        }

        static function objVaras($pa){
            $vara = new Varas();
            $vara->setVaras_id($pa["varas_id"]);
            $vara->setVaras_nome($pa["varas_nome"]);
            $vara->setVaras_del($pa["varas_del"]);

            return $vara;
        }

        static function objProcessos($pa){
            $processos = new Processos();

            $processos->setProcessos_id($pa["processos_id"]);
            $processos->setProcessos_num($pa["processos_num"]);
            $processos->setProcessos_acao($pa["processos_acao"]);
            $processos->setProcessos_ordem($pa["processos_ordem"]);
            $processos->setVaras_id($pa["varas_id"]);
            $processos->setProcessos_oficial($pa["processos_oficial"]);
            $processos->setProcessos_juiz($pa["processos_juiz"]);
            $processos->setProcessos_apensos($pa["processos_apensos"]);
            $processos->setProcessos_valor($pa["processos_valor"]);
            $processos->setProcessos_senha($pa["processos_senha"]);
            $processos->setProcessos_data($pa["processos_data"]);
            $processos->setProcessos_procurador($pa["processos_procurador"]);
            $processos->setProcessos_desembargador($pa["processos_procurador"]);
            $processos->setProcessos_del($pa["processos_del"]);

            return $processos;
        }

        static function objPartes($partes){
            $parte = new Partes();
            $parte->setPartes_id($partes["partes_id"]);
            $parte->setPessoas_id($partes["pessoas_id"]);
            $parte->setProcessos_id($partes["processos_id"]);
            $parte->setPartes_tipo($partes["partes_tipo"]);
            $parte->setPartes_del($partes["partes_del"]);

            return $parte;
        }

        static function objIndicesProcesso($ind){
            $indicesprocesso = new IndicesProcesso();
            $indicesprocesso->setIndicesProcesso_id($ind["indicesProcesso_id"]);
            $indicesprocesso->setIndices_id($ind["indices_id"]);
            $indicesprocesso->setProcessos_id($ind["processos_id"]);
            $indicesprocesso->setIndice_del($ind["indice_del"]);

            return $indicesprocesso;
        
        }

        static function objAndamentos($and){
            $andamento = new Andamentos();
            $andamento->setAndamentos_id($and["andamentos_id"]);
            $andamento->setProcessos_id($and["processos_id"]);
            $andamento->setTipos_andamento_id($and["tipos_andamento_id"]);
            $andamento->setAndamentos_com($and["andamentos_com"]);
            $andamento->setAndamentos_data($and["andamentos_data"]);
            $andamento->setAndamentos_del($and["andamentos_del"]);

            $sql2 = "SELECT * FROM arquivos WHERE andamentos_id = ? ";
            $param = $and["andamentos_id"];
            $query = Database::retornaParam($sql2, $param);
            
            if($query){
                for($i=0;$i<count($query);$i++){
                    $arquivo[$i] = Servico::objArquivos($query[$i]);
                }
                $andamento->setArquivos($arquivo);
            }
            return $andamento;
        }

        static function objArquivos($arq){
            $arquivo = new Arquivos();
            $arquivo->setArquivos_id($arq["arquivos_id"]);
            $arquivo->setAndamentos_id($arq["andamentos_id"]);
            $arquivo->setArquivos_nome($arq["arquivos_nome"]);
            $arquivo->setArquivos_tipo($arq["arquivos_tipo"]);
            $arquivo->setArquivos_tamanho($arq["arquivos_tamanho"]);
            $arquivo->setArquivos_arq($arq["arquivos_arq"]);
            $arquivo->setArquivos_del($arq["arquivos_del"]);
            
            return $arquivo;
        }

        static function objTipos_andamentos($tipo){
            $tipos_andamento = new Tipos_andamento();
            $tipos_andamento->setTipos_andamento_id($tipo["tipos_andamento_id"]);
            $tipos_andamento->setTipos_andamento_desc($tipo["tipos_andamento_desc"]);
            $tipos_andamento->setTipos_andamento_del($tipo["tipos_andamento_del"]);

            return $tipos_andamento;
        }
//------------------------- FUNÇÕES LOGIN -----------------------------------------------------

        static function login($loginParam){ // funcao utilizada para fazer login no sistema
            $message = "Login";
            try{
                $sql = "SELECT * FROM usuarios WHERE usuarios_nome = ? AND usuarios_senha = ?"; //string SELECT
                $param = array($loginParam[0],md5($loginParam[1])); // cria os parametros (?, ?) enviados pelo array
                $query = Database::selecionarParam($sql,$param); // executa a query
                if($query){ // se encontrou
                    $_SESSION['login'] = serialize(Servico::objUsuarios($query[0])); // seta na SESSION['login'] o objeto Usuarios
                    Servico::logs($message);
                    return true; //retorna verdadeiro para conferencia
                }
                else{
                    return false;
                }
            }
            catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function logout(){ // funcao de logout
            $message = "Logout";
            try{
                if(isset($_SESSION['login'])){
                    Servico::logs($message);
                    session_destroy();
                    return true;
                }else{
                    return false;
                }
            }
            catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
//------------------------- FUNÇÕES DE CADASTRO USUARIO/PESSOA --------------------------------
        static function cadastro($arrayUser){ // nesta funcao é passada um array com os dados para alimentar o objeto Usuarios
            $newUser = Servico::objUsuarios($arrayUser); //instancia um novo objeto do tipo Usuarios
            $senhaMD5 = md5($newUser->getUsuarios_senha()); // transforma a senha para md5
            $newUser->setUsuarios_senha($senhaMD5); // seta a nova senha
                    
            $sql = "INSERT INTO `juridico`.`usuarios` (`usuarios_nome`, 
                                                        `usuarios_senha`, 
                                                        `usuarios_grupo`, 
                                                        `usuarios_del`) 
                                                        VALUES (?,?,?,?);";  //string para INSERT
            $param = array($newUser->getUsuarios_nome(), 
                           $newUser->getUsuarios_senha(),
                           $newUser->getUsuarios_grupo(),
                           $newUser->getUsuarios_del(), //parametros que alimentam os valores da string (?,?,?,?)
                    );
            try{ // tenta Inserir
                $a = Database::executarParamID($sql, $param); // executa a funcao da classe Database
                if($a){
                    $message = "Tabela: Usuarios; CRUD: INSERT; usuarios_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);

            }
        }

        static function cadastroPessoa($pessoa){
            $newPessoa = Servico::objPessoas($pessoa);
            $sql = "INSERT INTO `juridico`.`pessoas` (`usuarios_id`, `pessoas_cpf_cnpj`, `pessoas_rg`, `pessoas_nome`, `pessoas_datanasc`, `pessoas_email`, `pessoas_tel`, `pessoas_sexo`, `pessoas_oab`, `pessoas_endereco`, `pessoas_del`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";        
            $param = array($newPessoa->getUsuarios_id(),
                           $newPessoa->getPessoas_cpf_cnpj(),
                           $newPessoa->getPessoas_rg(),
                           $newPessoa->getPessoas_nome(),
                           $newPessoa->getPessoas_datanasc(),
                           $newPessoa->getPessoas_email(),
                           $newPessoa->getPessoas_tel(),
                           $newPessoa->getPessoas_sexo(),
                           $newPessoa->getPessoas_oab(),
                           $newPessoa->getPessoas_endereco(),
                           $newPessoa->getPessoas_del(),
                     );
            try{
                $a = Database::executarParamID($sql, $param);
                if($a){
                    $message = "Tabela: Pessoas; CRUD: INSERT; pessoas_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        static function alterarPessoa($pessoa){
            $newPessoa = Servico::objPessoas($pessoa);
            $sql = "UPDATE pessoas SET pessoas_cpf_cnpj = ?, pessoas_rg = ?, pessoas_nome = ?, pessoas_datanasc = ?, pessoas_email = ?, pessoas_tel = ?, pessoas_sexo = ?, pessoas_oab = ?, pessoas_endereco = ? WHERE pessoas_id = ?";
            $param = array($newPessoa->getPessoas_cpf_cnpj(),
                           $newPessoa->getPessoas_rg(),
                           $newPessoa->getPessoas_nome(),
                           $newPessoa->getPessoas_datanasc(),
                           $newPessoa->getPessoas_email(),
                           $newPessoa->getPessoas_tel(),
                           $newPessoa->getPessoas_sexo(),
                           $newPessoa->getPessoas_oab(),
                           $newPessoa->getPessoas_endereco(),
                           $newPessoa->getPessoas_id());
            try{
                $a = Database::executarParam($sql, $param);
                if($a){
                    $message = "Tabela: Pessoas; CRUD: UPDATE; pessoas_id = ".$newPessoa->getPessoas_id();
                    Servico::logs($message);
                    return true;
                }
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        // ---------------- exclusao logica de pessoa ----------------- //
        static function excluiPessoa($pessoa){
            try{
                $sql = "UPDATE pessoas SET pessoas_del = 'S' WHERE pessoas_id = ?";
                $param = $pessoa;
                return $query = Database::validarParam($sql, $param);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
// ------------------------ INDICE ------------------------------------------------------------
        static function cadastroIndice($indice){
            $newIndice = Servico::objIndices($indice);
            $param = array($newIndice->getIndices_desc(),
                           $newIndice->getIndices_del());
            $sql = "INSERT INTO indices (indices_desc, indices_del) VALUES (?,?)";
            try{
                $a = Database::executarParamID($sql, $param);
                if($a){
                    $message = "Tabela: Indices; CRUD: INSERT; indices_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        static function alterarIndice($indice){
            $newPessoa = Servico::objIndices($indice);
            $sql = "UPDATE indices SET indices_desc = ? WHERE indices_id = ?";
            $param = array($newPessoa->getIndices_desc(),
                           $newPessoa->getIndices_id());
            try{
                $a = Database::executarParam($sql, $param);
                if($a){
                    $message = "Tabela: Indices; CRUD: UPDATE; indices_id = ".$newPessoa->getIndices_id();
                    Servico::logs($message);
                    return true;
                }
            }
            catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaIndice($param){
            $sql = "SELECT * FROM indices WHERE indices_desc LIKE ? AND indices_del = ? ORDER BY indices_desc";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function checkIndice($param){
            $sql = "SELECT * FROM indices WHERE indices_desc = ?";
            try{
                return $query = Database::validarParam($sql,$param); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function excluiIndice($indices){
            try{
                $sql = "UPDATE indices SET indices_del = 'S' WHERE indices_id = ?";
                return $query = Database::validarParam($sql, $indices);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function SelecionarIndices(){
            $sql = "SELECT * FROM indices WHERE indices_del = 'N' ORDER BY indices_desc";
            try{
                $line = Database::selecionar($sql);
                if($line){
                    for($i = 0; $i<count($line);$i++){
                        $indices[$i] = Servico::objIndices($line[$i]);
                    }
                    return $indices;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function SelecionarAllIndices(){
            $sql = "SELECT * FROM indices ORDER BY indices_desc";
            try{
                $line = Database::selecionar($sql);
                if($line){
                    for($i = 0; $i<count($line);$i++){
                        $indices[$i] = Servico::objIndices($line[$i]);
                    }
                    return $indices;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
// ------------------------ VARAS -------------------------------------------------------------
        static function cadastroVara($vara){
            $newIndice = Servico::objVaras($vara);
            $param = array($newIndice->getVaras_nome(),
                           $newIndice->getVaras_del());
            $sql = "INSERT INTO varas (varas_nome, varas_del) VALUES (?,?)";
            try{
                $a = Database::executarParamID($sql, $param);
                if($a){
                    $message = "Tabela: Varas; CRUD: INSERT; varas_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        static function alterarVara($varas){
            $newPessoa = Servico::objVaras($varas);
            $sql = "UPDATE varas SET varas_nome = ? WHERE varas_id = ?";
            $param = array($newPessoa->getVaras_nome(),
                           $newPessoa->getVaras_id());
            try{
                $a = Database::executarParam($sql, $param);
                if($a){
                    $message = "Tabela: Varas; CRUD: UPDATE; varas_id = ".$newPessoa->getVaras_id();
                    Servico::logs($message);
                    return true;
                }
            }
            catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function checkVaras($param){
            $sql = "SELECT * FROM varas WHERE varas_nome = ?";
            try{
                return $query = Database::validarParam($sql,$param); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function SelecionarVaras(){
            $sql = "SELECT * FROM varas WHERE varas_del = 'N' ORDER BY varas_nome";
            try{
                $line = Database::selecionar($sql);
                if($line){
                    for($i = 0; $i<count($line);$i++){
                        $varas[$i] = Servico::objVaras($line[$i]);
                    }
                    return $varas;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function selecionaVara($vara){
            $sql = "SELECT * FROM varas WHERE varas_id = ?";
            try{
                return $query = Database::retornaParam($sql, $vara);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaVaras($param){
            $sql = "SELECT * FROM varas WHERE varas_nome LIKE ? AND varas_del = ? ORDER BY varas_nome";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function excluiVara($vara){
            try{
                $sql = "UPDATE varas SET varas_del = 'S' WHERE varas_id = ?";
                return $query = Database::validarParam($sql, $vara);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
//------------------------- FUNÇÕES PROCESSO --------------------------------------------------
        static function cadastroProcesso($arrayP){ // nesta funcao é passada um array com os dados para alimentar o objeto Usuarios
            
            $newProcesso = Servico::objProcessos($arrayP); //instancia um novo objeto do tipo Usuarios
            $sql = "INSERT INTO `juridico`.`processos` (`processos_num`, `processos_acao`, `processos_ordem`, `varas_id`, `processos_oficial`, `processos_juiz`, `processos_apensos`, `processos_valor`, `processos_senha`, `processos_data`, `processos_desembargador`, `processos_procurador`, `processos_del`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $param = array($newProcesso->getProcessos_num(),
                           $newProcesso->getProcessos_acao(),
                           $newProcesso->getProcessos_ordem(),
                           $newProcesso->getVaras_id(),
                           $newProcesso->getProcessos_oficial(),
                           $newProcesso->getProcessos_juiz(),
                           $newProcesso->getProcessos_apensos(),
                           $newProcesso->getProcessos_valor(),
                           $newProcesso->getProcessos_senha(),
                           $newProcesso->getProcessos_data(),
                           $newProcesso->getProcessos_desembargador(),
                           $newProcesso->getProcessos_procurador(),
                           $newProcesso->getProcessos_del(),
                     );
            try{
                $a = Database::executarParamID($sql, $param);
                if($a){
                    $message = "Tabela: Processos; CRUD: INSERT; processos_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        static function alterarProcesso($processo){
            $newProc = Servico::objProcessos($processo);
            $sql = "UPDATE processos 
                    SET processos_num = ?, processos_acao = ?, processos_ordem = ?, 
                        varas_id = ?, processos_oficial = ?, processos_juiz = ?, 
                        processos_valor = ?, processos_senha = ?, processos_data = ?, 
                        processos_desembargador = ?, processos_procurador = ?, processos_apensos = ? 
                        WHERE processos_id = ?";
            
            $param = array($newProc->getProcessos_num(),
                           $newProc->getProcessos_acao(),
                           $newProc->getProcessos_ordem(),
                           $newProc->getVaras_id(),
                           $newProc->getProcessos_oficial(),
                           $newProc->getProcessos_juiz(),
                           $newProc->getProcessos_valor(),
                           $newProc->getProcessos_senha(),
                           $newProc->getProcessos_data(),
                           $newProc->getProcessos_desembargador(),
                           $newProc->getProcessos_procurador(),
                           $newProc->getProcessos_apensos(),
                           $newProc->getProcessos_id());            
            try{
                $a = Database::executarParam($sql, $param);
                if($a){
                    $message = "Tabela: Processos; CRUD: UPDATE; processos_id = ".$newProc->getProcessos_id();
                    Servico::logs($message);
                    return true;
                }
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        static function excluiProcesso($processo){
            try{
                $sql = "UPDATE processos SET processos_del = 'S' WHERE processos_id = ?";
                return $query = Database::validarParam($sql, $processo);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function SelecionarProcessos(){
            $sql = "SELECT * FROM processos WHERE processos_del = 'N' ORDER BY processos_num";
            try{
                $line = Database::selecionar($sql);
                if($line){
                    for($i = 0; $i<count($line);$i++){
                        $processos[$i] = Servico::objProcessos($line[$i]);
                    }
                    return $processos;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaProcessoID($id){
            $sql = "SELECT * FROM processos WHERE processos_id = ? AND upper(processos_del) = 'N'";
            try{
                $line = Database::retornaParam($sql, $id);
                if($line){
                    return Servico::objProcessos($line[0]);
                }else{
                    return false;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
//------------------------- PARTES PROCESSO ---------------------------------------------------
        static function cadastroPartes($partes){
            $newPartes = Servico::objPartes($partes);
            $param = array($newPartes->getPessoas_id(),
                           $newPartes->getPartes_tipo());
            $sql = "INSERT INTO partes (pessoas_id, processos_id, partes_tipo, partes_del) 
                    VALUES (?,(SELECT processos_id FROM processos ORDER BY processos_id DESC LIMIT 1),?,\"N\")";
            
            try{
                $a = Database::executarParamID($sql, $param);
                if($a){
                    $message = "Tabela: Partes; CRUD: INSERT; partes_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }

        }

        static function consultaParteNumero($idProc){
            $sql = "SELECT processos_id 
                    FROM processos 
                    WHERE processos_num 
                    LIKE ? 
                    AND processos_del = 'N'";
            try{
                $query = Database::retornaParam($sql, $idProc);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $sql2 = "SELECT * 
                                FROM partes 
                                WHERE processos_id = ? 
                                AND partes_del = 'N'";
                        $query2 = Database::retornaParam($sql2, $query[$i]['processos_id']);

                        if($query2){
                            for($j=0;$j<count($query2);$j++){
                                $retorno[][$j] = Servico::objPartes($query2[$j]);
                            }
                        }
                    }
                    return $retorno;
                }
            }catch(Exception $e){
                return die("Erro: ".$e);
            }
        }

        static function consultaParte($idProc){
            $sql = "SELECT * 
                    FROM partes 
                    WHERE partes_tipo
                    LIKE ? 
                    AND partes_del = 'N'";
            try{
                $query = Database::retornaParam($sql, $idProc);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $retorno[][$i] = Servico::objPartes($query[$i]);
                    }
                    return $retorno;
                }
            }catch(Exception $e){
                return die("Erro: ".$e);
            }
        }

        static function consultaPartePessoa($idPessoa){
            $sql = "SELECT * 
                    FROM partes 
                    WHERE pessoas_id = ? 
                    AND partes_del = 'N'";
            try{
                $query = Database::retornaParam($sql, $idPessoa);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $retorno[][$i] = Servico::objPartes($query[$i]);
                    }
                    return $retorno;
                }
            }catch(Exception $e){
                return die("Erro: ".$e);
            }
        }

        static function alterarParte($parte){
            $newPartes = Servico::objPartes($parte);
            $sql = "UPDATE partes SET pessoas_id = ?, partes_tipo = ? WHERE partes_id = ?";
            $param = array($newPartes->getPessoas_id(),
                           $newPartes->getPartes_tipo(),
                           $newPartes->getPartes_id());
            try{
                $a = Database::executarParam($sql, $param);
                if($a){
                    $message = "Tabela: Partes; CRUD: UPDATE; partes_id = ".$newPartes->getPartes_id();
                    Servico::logs($message);
                    return true;
                }
            }
            catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaParteID($id){
            $sql = "SELECT DISTINCT * FROM partes WHERE processos_id = ? AND partes_del = 'N'";
            try{
                $line = Database::retornaParam($sql, $id);
                if($line){
                    $i = 0;
                    foreach($line as $andamento){
                        $andamentos[$i] = Servico::objPartes($andamento);
                        $i++;
                    }
                    return $andamentos;
                }else{
                    return false;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function excluiParte($parte){
            try{
                $sql = "UPDATE partes SET partes_del = 'S' WHERE partes_id = ?";
                return $query = Database::validarParam($sql, $parte);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function cadastraPartes($parametros){
            $sql = "INSERT INTO partes (pessoas_id, processos_id, partes_tipo, partes_del) VALUES (?,?,?,?)";
            $processo_id    = $parametros['processo'];
            $pessoas        = $parametros['pessoas'];
            $partes         = $parametros['partes'];
            try{
                for($i=0;$i<count($pessoas);$i++){
                    $param = array($pessoas[$i], $processo_id, $partes[$i], "N");
                    $query = Database::executarParamID($sql, $param);
                }
                if(!$query){
                    return false;
                }else{
                    $message = "Tabela: Partes; CRUD: INSERT; partes_id = ".$query;
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                die($e);
            }
        }
// ------------------------ CONSULTAS PROCESSOS -----------------------------------------------
        static function consultaPartesProcesso($idProc){
            $sql = "SELECT * 
            FROM partes 
            WHERE processos_id = ? 
            AND partes_del = 'N'";
            try{
                $query = Database::retornaParam($sql, $idProc);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $retorno[$i] = Servico::objPartes($query[$i]);
                    }
                    return $retorno;
                }
            }catch(Exception $e){
                return die("Erro: ".$e);
            }
        }     
//------------------------- FUNÇÕES INDICES PROCESSO ------------------------------------------
        static function cadastroIndicesProcesso($indicesProcesso){
            $newIndicesProcesso = Servico::objIndicesProcesso($indicesProcesso);
            $param = array($newIndicesProcesso->getIndices_id(),
                            $newIndicesProcesso->getIndice_del());
            $sql = "INSERT INTO indicesprocesso (indices_id, processos_id, indice_del) VALUES (?,(SELECT processos_id FROM processos ORDER BY processos_id DESC LIMIT 1),?)";
            
            try{
                $a = Database::executarParamID($sql, $param);
                if($a){
                    $message = "Tabela: IndicesProcesso; CRUD: INSERT; indicesprocesso_id = ".$a;
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }

        }

        static function consultaIndiceID($id){
            $sql = "SELECT DISTINCT indices_desc 
                    FROM indices AS ind 
                    INNER JOIN indicesprocesso AS i 
                    ON i.processos_id = ? 
                    AND i.indices_id = ind.indices_id
                    WHERE ind.indices_del = 'N'";
            try{
                return $line = Database::retornaParam($sql, $id);
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function cadastrarIndices($parametros){
            $sql = "INSERT INTO indicesprocesso (indices_id, processos_id, indice_del) VALUES (?,?,?)";
            $processo_id    = $parametros['processo'];
            $indices        = $parametros['indices'];
            try{
                for($i=0;$i<count($indices);$i++){
                    $param = array($indices[$i], $processo_id, "N");
                    $query = Database::executarParamID($sql, $param);
                }
                if(!$query){
                    return false;
                }else{
                    $message = "Tabela: IndicesProcesso; CRUD: INSERT; indicesprocesso_id = ".$query;
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                die($e);
            }
        }

        static function consultaIndicesData($datas){
            $sql = "SELECT * FROM processos WHERE processos_data BETWEEN ? AND ? AND processos_del = 'N'";
            try{
                $processos = Database::selecionarParam($sql,$datas);
                if($processos){
                    $sql2 = "SELECT * FROM indicesprocesso WHERE processos_id = ? AND indice_del = 'N'";
                    $i=0;
                    foreach($processos as $processo){
                        $indicesProcesso = Database::retornaParam($sql2, $processo['processos_id']);

                        if($indicesProcesso){
                            foreach ($indicesProcesso as $indiceProcesso) {
                                $indices[$i] = Servico::objIndicesProcesso($indiceProcesso);
                                $i++;
                            }
                        }
                    }
                    if(count($indices) > 0){
                       return $indices;
                    }
                }
                return false;
            }catch(Exception $e){
                die($e);
            }
        }
// ------------------------ VERIFICAÇÃO PARA CADASTRO DE USUARIOS E PESSOAS -------------------
        


        static function verificaLogin($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM usuarios WHERE usuarios_nome = ?";

            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function verificaCPF($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_cpf_cnpj = ?";

            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function verificaEmail($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_email = ?";

            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function verificaRG($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_rg = ?";

            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function verificaTel($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_tel = ?";

            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
// ------------------------ CONSULTAS PESSOAS -------------------------------------------------
        static function consultaNome($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_nome LIKE ? AND pessoas_del = ? ORDER BY pessoas_nome";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaCPF($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_cpf_cnpj LIKE ? AND pessoas_del = ? ORDER BY pessoas_cpf_cnpj";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
        static function consultaRG($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_rg LIKE ? AND pessoas_del = ? ORDER BY pessoas_rg";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function SelecionarPessoas(){
            $sql = "SELECT * FROM pessoas WHERE pessoas_del = 'N' ORDER BY pessoas_nome";
            try{
                $line = Database::selecionar($sql);
                if($line){
                    for($i = 0; $i<count($line);$i++){
                        $pessoas[$i] = Servico::objPessoas($line[$i]);
                    }
                    return $pessoas;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function selecionaPessoas($id){
            $sql = "SELECT * FROM pessoas WHERE pessoas_id = ?";
            try{
                $query = Database::retornaParam($sql, $id);
                if($query){
                    $retorno = Servico::objPessoas($query[0]);
                }
                return $retorno;
            }catch(Exception $e){
                return false;
            }
        }
// ------------------------ CONSULTAS PROCESSOS -----------------------------------------------
        static function verificaProcesso($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM processos WHERE processos_num = ?";
            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function verificaOrdem($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM processos WHERE processos_ordem = ?";
            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaProcessoNumero($param){ //utilizada para validacao de campos
            $obj = null;
            $sql = "SELECT * FROM processos WHERE processos_num LIKE ? AND processos_del = ? ORDER BY processos_num";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                $query = Database::SelecionarParam($sql,$parame); //retorna
                if($query > 0){
                    for($i=0 ; $i < count($query) ; $i++){
                        $obj[$i] = Servico::objProcessos($query[$i]);
                    }
                    return $obj;
                }else{
                    return $query;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaProcessoOrdem($param){ //utilizada para validacao de campos
            $obj = null;
            $sql = "SELECT * FROM processos WHERE processos_ordem LIKE ? AND processos_del = ? ORDER BY processos_num";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                $query = Database::SelecionarParam($sql,$parame); //retorna
                if($query > 0){
                    for($i=0 ; $i < count($query) ; $i++){
                        $obj[$i] = Servico::objProcessos($query[$i]);
                    }
                    return $obj;
                }else{
                    return $query;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaProcessoVara($param){ //utilizada para validacao de campos
            $obj = null;
            $sql = "SELECT * FROM processos WHERE varas_id LIKE ? AND processos_del = ? ORDER BY processos_num";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                $query = Database::SelecionarParam($sql,$parame); //retorna 
                if($query > 0){
                    for($i=0 ; $i < count($query) ; $i++){
                        $obj[$i] = Servico::objProcessos($query[$i]);
                    }
                    return $obj;
                }else{
                    return $query;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaProcessoParte($param){ //utilizada para validacao de campos
            $obj = null;
            $sql = "SELECT processos_id FROM partes WHERE pessoas_id = ? AND partes_del = ?";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                $query = Database::SelecionarParam($sql,$parame); //retorna 
                if($query > 0){
                    for($i = 0; $i < count($query) ; $i++){
                        $sql1 = "SELECT * FROM processos WHERE processos_id = ? AND processos_del = ?";
                        $delete1 = "N";
                        $parame1 = array($query[$i]['processos_id'],$delete1);
                        $result = Database::SelecionarParam($sql1, $parame1);
                        $obj[$i] = Servico::objProcessos($result[0]);
                    }
                    return $obj;
                }else{
                    return $query;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaProcessoIndice($param){ //utilizada para validacao de campos
            $obj = null;
            $sql = "SELECT processos_id FROM indicesprocesso WHERE processos_id = ? AND indice_del = ?";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                $query = Database::SelecionarParam($sql,$parame); //retorna 
                if($query > 0){
                    for($i = 0; $i < count($query) ; $i++){
                        $sql1 = "SELECT * FROM processos WHERE processos_id = ? AND processos_del = ?";
                        $delete1 = "N";
                        $parame1 = array($query[$i]['processos_id'],$delete1);
                        $result = Database::SelecionarParam($sql1, $parame1);
                        $obj[$i] = Servico::objProcessos($result[0]);
                    }
                    return $obj;
                }else{
                    return $query;
                }
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function selecionaProcesso($id){
            $sql = "SELECT * FROM processos WHERE processos_id = ?";
            try{
                $query = Database::retornaParam($sql, $id);
                if($query){
                    $retorno = Servico::objProcessos($query[0]);
                }else{
                    $retorno = false;
                }
                return $retorno;
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
        
        static function selecionaProcessoAndamento($id){
            $sql = "SELECT * FROM andamentos WHERE processos_id = ? AND andamentos_del = 'N' ORDER BY andamentos_data DESC";
            try{
                $query = Database::retornaParam($sql, $id);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $andamentos[$i] = Servico::objAndamentos($query[$i]);
                    }                    
                }else{
                    $andamentos = false;
                }
                return $andamentos;
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }

        }
// ------------------------ FUNÇÕES ANDAMENTOS ------------------------------------------------
        static function cadastrarAndamentos($param){
            $sql = "INSERT INTO `andamentos` (`processos_id`, `tipos_andamento_id`, `andamentos_com`, `andamentos_data`, `andamentos_del`) VALUES (?, ?, ?, ?, ?)";
            $andamentos = Servico::objAndamentos($param);
            $andamento = array(
                $andamentos->getProcessos_id(),
                $andamentos->getTipos_andamento_id(),
                $andamentos->getAndamentos_com(),
                $andamentos->getAndamentos_data(),
                $andamentos->getAndamentos_del()
            );
            try{
                $query = Database::executarParamID($sql,$andamento);
                if($query){
                    $message = "Tabela: Andamentos; CRUD: INSERT; andamentos_id = ".$query;
                    Servico::logs($message);
                    return true;
                }else{
                    echo "erro:".$query;
                }
            }catch(Exception $e){
                echo $e;
            }
        }

        static function cadastrarArquivos($param){
            $sql = "INSERT INTO `arquivos` (andamentos_id, `arquivos_nome`, `arquivos_tipo`, `arquivos_tamanho`, `arquivos_arq`, `arquivos_del`) VALUES ((SELECT andamentos_id FROM andamentos ORDER BY andamentos_id DESC LIMIT 1), ?, ?, ?, ?, 'N')";
            $arquivos = Servico::objArquivos($param);
            $arquivo = array($arquivos->getArquivos_nome(),
                             $arquivos->getArquivos_tipo(),
                             $arquivos->getArquivos_tamanho(),
                             $arquivos->getArquivos_arq());
            try{
                $query = Database::cadastraArquivo($sql, $arquivo);
                if($query){
                    $message = "Tabela: Arquivos; CRUD: INSERT; arquivos_id = ".$query;
                    Servico::logs($message);
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e;
            }
        }

        static function selecionarArquivos($id){
            $sql = "SELECT * FROM arquivos WHERE arquivos_id = ?";
            try{
                $query = Database::retornaParam($sql, $id);
                if($query){
                    return $query;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e;
            }
        }

        static function alterarAndamentos($param){
            $sql = "UPDATE andamentos SET tipos_andamento_id = ?, andamentos_com = ?, andamentos_data = ? WHERE andamentos_id = ?;";
            try{
                $andamento = Servico::objAndamentos($param);
                $and_param = array($andamento->getTipos_andamento_id(),
                                    $andamento->getAndamentos_com(),
                                    $andamento->getAndamentos_data(),
                                    $andamento->getAndamentos_id());
                $a = Database::executarParam($sql, $and_param);
                if($a){
                    $message = "Tabela: Andamentos; CRUD: UPDATE; andamentos_id = ".$andamento->getAndamentos_id();
                    Servico::logs($message);
                    return true;
                }
            }catch(Exception $e){
                echo $e;
            }
        }

        static function alterarArquivos($param, $ids){
            $sql = "INSERT INTO `arquivos` (andamentos_id, `arquivos_nome`, `arquivos_tipo`, `arquivos_tamanho`, `arquivos_arq`, `arquivos_del`) VALUES (?, ?, ?, ?, ?, 'N')";
            $arquivos = Servico::objArquivos($param);
            $arquivo = array($arquivos->getAndamentos_id(),
                             $arquivos->getArquivos_nome(),
                             $arquivos->getArquivos_tipo(),
                             $arquivos->getArquivos_tamanho(),
                             $arquivos->getArquivos_arq());
            try{
                $query = Database::alterarArquivo($sql, $arquivo);
                if($query){
                    $message = "Tabela: Arquivos; CRUD: INSERT; arquivos_id = ".$query;
                    Servico::logs($message);
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e;
            }
        }

        static function excluirArquivos($andamentos_id, $ids){
            try{
                $sqlDelete = "DELETE FROM arquivos WHERE andamentos_id = ? ";
                if(isset($ids)){
                    foreach($ids as $id){
                        $sqlDelete .= " AND arquivos_id != ? ";
                        $message = "Tabela: Arquivos; CRUD: DELETE; arquivos_ids = ".$id;
                        Servico::logs($message);
                    }
                    array_unshift($ids, $andamentos_id);
                    $query = Database::executarParam($sqlDelete, $ids);
                    if($query){
                        return true;
                    }
                }else{
                    $query = Database::validarParam($sqlDelete, $andamentos_id);
                    if($query){
                        $message = "Tabela: Arquivos; CRUD: DELETE ALL; andamentos_id = ".$andamentos_id;
                        Servico::logs($message);
                        return true;
                    }
                }
            }catch(Exception $e){
                echo $e;
            }
        }

        static function consultaAndamentosData($datas){
            $sql = "SELECT * FROM ANDAMENTOS WHERE andamentos_data BETWEEN ? AND ?";
            try{
                $query = Database::selecionarParam($sql, $datas);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $result[$i] = Servico::objAndamentos($query[$i]);
                    }
                    return $result;
                }
            }catch(Exception $e){
                die($e);
            }
        }
// ------------------------ FUNÇÕES TIPOS_ANDAMENTOS ------------------------------------------
        static function SelecionarTipos_andamento(){
            $sql = "SELECT * FROM tipos_andamento";
            try{
                $query = Database::selecionar($sql);
                if($query){
                    for($i=0;$i<count($query);$i++){
                        $tipos_andamento[$i] =  Servico::objTipos_andamentos($query[$i]);
                    }
                    return $tipos_andamento;
                }
            }catch(Exception $e){
                die($e);
            }
        }
// ------------------------ FUNÇÕES LOGS ------------------------------------------------------

        static function logs($tipo){
            if(isset($_SESSION['login'])){
                try{
                    $user = unserialize($_SESSION['login']);
                    $id = $user->getUsuarios_id();
                    return Database::logs($id, $tipo);
                }catch(Exception $e){
                    die($e);
                }
            }else{
                return false;
            }
        }
    }
?>