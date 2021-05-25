<?php

class ConexaoDB
{

    private $NOME_SERVIDOR = "localhost";
    private $NOME_USUARIO = "root";
    private $SENHA = "";
    private $NOME_BD = "psigamesbd";

    private $conexaoAberta = false;
    private $conDB;

    public function __construct()
    {
        $this->conDB = new mysqli($this->NOME_SERVIDOR, $this->NOME_USUARIO, $this->SENHA, $this->NOME_BD);
        $this->conDB->set_charset("utf8");

        if ($this->conDB->connect_errno) {
            $this->conDB->close();
            die("Não foi possivel conectar-se com o banco de dados" . $this->conDB->connect_error);
        }
        //echo 'Conectado com sucesso';
        $this->conexaoAberta = true;
    }

    public function executQuery($sqlComando)
    {

        if(!$this->conexaoAberta){
            //echo "A conexão não esta aberta";
            return;
        }

        $result = $this->conDB->query($sqlComando);
        if (!$result) {
            $this->conDB->close();
            echo "Erro ao executar a query: $sqlComando";
            echo $this->conDB->error;
            exit();
        }
        //echo 'Query executada com sucesso';

        return $result;
    }

    public function fecharConexao()
    {
        if(!$this->conexaoAberta){
            //echo "A conexão não esta aberta";
            return;
        }

        $this->conDB->close();

    }

    public function getConexao()
    {
        return $this->conDB;
    }

}
