<?php
    require "suporte.php"; // requerindo suporte
    require "entidades.php"; // incluindo entidades
    
    class Servico{
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
            $pessoa->setPessoas_cpf($pa["pessoas_cpf"]);
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

        static function logout(){ // funcao de logout
            try{
                session_start();
                if(isset($_SESSION['login'])){
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

        //funcao de cadastro
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
                return $a = Database::executarParam($sql, $param); // executa a funcao da classe Database
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);

            }
        }

        static function cadastroPessoa($pessoa){
            $newPessoa = Servico::objPessoas($pessoa);
            $sql = "INSERT INTO `juridico`.`pessoas` (`usuarios_id`, `pessoas_cpf`, `pessoas_rg`, `pessoas_nome`, `pessoas_datanasc`, `pessoas_email`, `pessoas_tel`, `pessoas_sexo`, `pessoas_oab`, `pessoas_endereco`, `pessoas_del`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";        
            $param = array($newPessoa->getUsuarios_id(),
                           $newPessoa->getPessoas_cpf(),
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
                return Database::executarParam($sql, $param);
            }

            catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }

        static function cadastroIndice($indice){
            $newIndice = Servico::objIndices($indice);
            $param = array($newIndice->getIndices_desc(),
                           $newIndice->getIndices_del());
            $sql = "INSERT INTO indices (indices_desc, indices_del) VALUES (?,?)";
            try{
                return Database::executarParam($sql, $param);
            }catch(Exception $e){
                die("Erro: ". $e->getMessage);
            }
        }


        static function alterarPessoa($pessoa){
            $newPessoa = Servico::objPessoas($pessoa);
            $sql = "UPDATE pessoas SET pessoas_cpf = ?, pessoas_rg = ?, pessoas_nome = ?, pessoas_datanasc = ?, pessoas_email = ?, pessoas_tel = ?, pessoas_sexo = ?, pessoas_oab = ?, pessoas_endereco = ? WHERE pessoas_id = ?";
            $param = array($newPessoa->getPessoas_cpf(),
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
                return Database::executarParam($sql, $param);
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

        static function login($loginParam){ // funcao utilizada para fazer login no sistema
            try{
                $sql = "SELECT * FROM usuarios WHERE usuarios_nome = ? AND usuarios_senha = ?"; //string SELECT
                $param = array($loginParam[0],md5($loginParam[1])); // cria os parametros (?, ?) enviados pelo array
                $query = Database::selecionarParam($sql,$param); // executa a query
                if($query){ // se encontrou
                    session_start(); //inicia a sessao do login
                    $_SESSION['login'] = serialize(Servico::objUsuarios($query[0])); // seta na SESSION['login'] o objeto Usuarios
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
// ------------- verificação para cadastro de Usuarios e Pessoas ------------------ 
        


        static function verificaLogin($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM usuarios WHERE usuarios_nome = ?";

            try{
                return $query = Database::validarParam($sql,$param); //retorna se existe ou nao o valor
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function verificaCPF($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_cpf = ?";

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
// ------------------- CONSULTAS -------------------------------
        static function consultaNome($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_nome LIKE ? AND pessoas_del = ?";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

        static function consultaCPF($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_cpf LIKE ? AND pessoas_del = ?";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
        static function consultaRG($param){ //utilizada para validacao de campos
            $sql = "SELECT * FROM pessoas WHERE pessoas_rg LIKE ? AND pessoas_del = ?";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }
        ///////////////////// ASSUNTOS
        static function consultaIndice($param){
            $sql = "SELECT * FROM indices WHERE indices_desc LIKE ? AND indices_del = ?";
            $delete = "N";
            $parame = array($param,$delete);
            try{
                return $query = Database::SelecionarParam($sql,$parame); //retorna 
            }catch(Exception $e){
                return die("Erro: ". $e->getMessage);
            }
        }

    }
