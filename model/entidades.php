<?php
    class Usuarios{ //ENCAPSULAMENTO USUARIOS
        private $usuarios_id;
        private $usuarios_nome;
        private $usuarios_senha;
        private $usuarios_grupo;
        private $usuarios_del = "N";

        public function setUsuarios_id($value){
            $this->usuarios_id = $value;
        }
        public function getUsuarios_id(){
            return $this->usuarios_id;
        }
        public function getUsuarios_nome(){
            return $this->usuarios_nome;
        }
        public function setUsuarios_nome($value){
           $this->usuarios_nome = $value;
        }
        public function getUsuarios_senha(){
            return $this->usuarios_senha;
        }
        public function setUsuarios_senha($value){
            $this->usuarios_senha = $value;
        }
        public function setUsuarios_grupo($value){
            $this->usuarios_grupo = $value;
        }
        public function getUsuarios_grupo(){
            return $this->usuarios_grupo;
        }
        public function getUsuarios_del(){
            return $this->usuarios_del;
        }
        public function setUsuarios_del($value){
            $this->usuarios_del = $value;
        }      
    }

    class Varas{ //ENCAPSULAMENTO INDICES
        private $varas_id;
        private $varas_nome;
        private $varas_del = "N";

        public function setVaras_id($value){
            $this->varas_id = $value;
        }
        public function getVaras_id(){
            return $this->varas_id;
        }
        public function getVaras_nome(){
            return $this->varas_nome;
        }
        public function setVaras_nome($value){
           $this->varas_nome = $value;
        }
        public function getVaras_del(){
            return $this->varas_del;
        }
        public function setVaras_del($value){
            $this->varas_del = $value;
        }      
    }

    class Indices{ //ENCAPSULAMENTO INDICES
        private $indices_id;
        private $indices_desc;
        private $indices_del = "N";

        public function setIndices_id($value){
            $this->indices_id = $value;
        }
        public function getIndices_id(){
            return $this->indices_id;
        }
        public function getIndices_desc(){
            return $this->indices_desc;
        }
        public function setIndices_desc($value){
           $this->indices_desc = $value;
        }
        public function getIndices_del(){
            return $this->indices_del;
        }
        public function setIndices_del($value){
            $this->indices_del = $value;
        }      
    }


    class Pessoas{ // ENCAPSULAMENTO PESSOAS
        private $pessoas_id;
        private $usuarios_id;
        private $pessoas_cpf;
        private $pessoas_rg;
        private $pessoas_nome;
        private $pessoas_datanasc;
        private $pessoas_email;
        private $pessoas_tel;
        private $pessoas_sexo;
        private $pessoas_oab;
        private $pessoas_endereco;
        private $pessoas_del = "N";

        public function setPessoas_id($value){
            $this->pessoas_id = $value;
        }
        public function getPessoas_id(){
            return $this->pessoas_id;
        }
        public function setUsuarios_id($value){
            $this->usuarios_id = $value;
        }
        public function getUsuarios_id(){
            return $this->usuarios_id;
        }
        public function setPessoas_cpf($value){
            $this->pessoas_cpf = $value;
        }
        public function getPessoas_cpf(){
            return $this->pessoas_cpf;
        }
        public function setPessoas_rg($value){
            $this->pessoas_rg = $value;
        }
        public function getPessoas_rg(){
            return $this->pessoas_rg;
        }
        public function setPessoas_nome($value){
            $this->pessoas_nome = $value;
        }
        public function getPessoas_nome(){
            return $this->pessoas_nome;
        }
        public function setPessoas_datanasc($value){
            $this->pessoas_datanasc = $value;
        }
        public function getPessoas_datanasc(){
            return $this->pessoas_datanasc;
        }
        public function setPessoas_email($value){
            $this->pessoas_email = $value;
        }
        public function getPessoas_email(){
            return $this->pessoas_email;
        }
        public function setPessoas_tel($value){
            $this->pessoas_tel = $value;
        }
        public function getPessoas_tel(){
            return $this->pessoas_tel;
        }
        public function setPessoas_sexo($value){
            $this->pessoas_sexo = $value;
        }
        public function getPessoas_sexo(){
            return $this->pessoas_sexo;
        }
        public function setPessoas_oab($value){
            $this->pessoas_oab = $value;
        }
        public function getPessoas_oab(){
            return $this->pessoas_oab;
        }
        public function setPessoas_endereco($value){
            $this->pessoas_endereco = $value;
        }
        public function getPessoas_endereco(){
            return $this->pessoas_endereco;
        }        
        public function setPessoas_del($value){
            $this->pessoas_del = $value;
        }
        public function getPessoas_del(){
            return $this->pessoas_del;
        }
    }

    class Processos{
        private $processos_id;
        private $processos_num;
        private $processos_acao;
        private $processos_ordem;
        private $varas_id;
        private $processos_oficial;
        private $processos_juiz;
        private $processos_apencos = null;
        private $processos_valor;
        private $processos_senha;
        private $processos_data;
        private $processos_del = "N";

        public function setProcessos_id($value){
            $this->processos_id = $value;
        }
        public function getProcessos_id(){
            return $this->processos_id;
        }
        public function setProcessos_num($value){
            $this->processos_num = $value;
        }
        public function getProcessos_num(){
            return $this->processos_num;
        }
        public function setProcessos_acao($value){
            $this->processos_acao = $value;
        }
        public function getProcessos_acao(){
            return $this->processos_acao;
        }
        public function setProcessos_ordem($value){
            $this->processos_ordem = $value;
        }
        public function getProcessos_ordem(){
            return $this->processos_ordem;
        }
        public function setVaras_id($value){
            $this->varas_id = $value;
        }
        public function getVaras_id(){
            return $this->varas_id;
        }
        public function setProcessos_oficial($value){
            $this->processos_oficial = $value;
        }
        public function getProcessos_oficial(){
            return $this->processos_oficial;
        }
        public function setProcessos_juiz($value){
            $this->processos_juiz = $value;
        }
        public function getProcessos_juiz(){
            return $this->processos_juiz;
        }
        public function setProcessos_apencos($value){
            $this->processos_apencos = $value;
        }
        public function getProcessos_apencos(){
            return $this->processos_apencos;
        }
        public function setProcessos_valor($value){
            $this->processos_valor = $value;
        }
        public function getProcessos_valor(){
            return $this->processos_valor;
        }
        public function setProcessos_senha($value){
            $this->processos_senha = $value;
        }
        public function getProcessos_senha(){
            return $this->processos_senha;
        }
        public function setProcessos_data($value){
            $this->processos_data = $value;
        }
        public function getProcessos_data(){
            return $this->processos_data;
        }        
        public function setProcessos_del($value){
            $this->processos_del = $value;
        }
        public function getProcessos_del(){
            return $this->processos_del;
        }
    }

    class Partes{
        private $partes_id;
        private $pessoas_id;
        private $processos_id;
        private $partes_tipo;
        private $partes_del = "N";

        public function setPartes_id($value){
            $this->partes_id = $value;
        }
        public function getPartes_id(){
            return $this->partes_id;
        }
        public function setPessoas_id($value){
            $this->pessoas_id = $value;
        }
        public function getPessoas_id(){
            return $this->pessoas_id;
        }
        public function setProcessos_id($value){
            $this->processos_id = $value;
        }
        public function getProcessos_id(){
            return $this->processos_id;
        }
        public function setPartes_tipo($value){
            $this->partes_tipo = $value;
        }
        public function getPartes_tipo(){
            return $this->partes_tipo;
        }
        public function setPartes_del($value){
            $this->partes_del = $value;
        }
        public function getPartes_del(){
            return $this->partes_del;
        }
    }

    class IndicesProcesso{
        private $indicesProcesso_id;
        private $indices_id;
        private $processos_id;
        private $indice_del;

        public function setIndicesProcesso_id($value){
            $this->indicesProcesso_id = $value;
        }
        public function getIndicesProcesso_id(){
            return $this->indicesProcesso_id;
        }
        public function setIndices_id($value){
            $this->indices_id = $value;
        }
        public function getIndices_id(){
            return $this->indices_id;
        }
        public function setProcessos_id($value){
            $this->Processos_id = $value;
        }
        public function getProcessos_id(){
            return $this->Processos_id;
        }
        public function setIndice_del($value){
            $this->indice_del = $value;
        }
        public function getIndice_del(){
            return $this->indice_del;
        }
    }
?>