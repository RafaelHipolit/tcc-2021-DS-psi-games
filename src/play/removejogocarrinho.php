<?php

session_start();

require_once '../server/verificaloginjogador.php';

if(isset($_GET['id'])){
    $query = "select * from jogos where pk_id_jogo = '".$_GET['id']."';";
}else{
    header('location: jogador.php');
    exit();
}

require_once '../server/ConexaoBD.php';

$con = new ConexaoDB();

$result = $con->executQuery($query);

if(mysqli_num_rows($result) == 0){
    header('location: jogador.php');
    exit();
}

$dados = mysqli_fetch_assoc($result);

require_once "../server/ClassJogo.php";


if(!isset($_SESSION['session_carrinho'])){

    header('location: jogador.php');
    exit();

}else if(empty( unserialize($_SESSION['session_carrinho']) )){
    
    header('location: jogador.php');
    exit();

}

$arrayCarrinhoNovo = array();

$arrayCarrinhoAtual = unserialize($_SESSION['session_carrinho']);
for ($i=0; $i < sizeof($arrayCarrinhoAtual); $i++) { 

    if( $arrayCarrinhoAtual[$i]->getId() != $dados['pk_id_jogo']){
        $arrayCarrinhoNovo[] = $arrayCarrinhoAtual[$i];
    }

}

$_SESSION['session_carrinho'] = serialize($arrayCarrinhoNovo);


header('location: jogador.php');
exit();


?>