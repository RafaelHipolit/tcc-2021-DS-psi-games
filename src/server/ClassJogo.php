<?php
class Jogo{

    private $id;
    private $nome;
    private $preco;

    public function __construct($id, $nome, $preco)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPreco()
    {
        return $this->preco;
    }



}

?>