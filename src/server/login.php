<?php

require_once 'ConexaoBD.php';

session_start();

if(isset($_SESSION['idJogador'])){
    header('location: ../play/jogador.php');
    exit();
}

if(isset($_SESSION['idAdm'])){
    header('location: ../adm/administrador.php');
    exit();
}

if(empty($_POST["email"]) || empty($_POST["senha"])){
    header('location: ../play/formlogin.php');
    exit();
}

$con = new ConexaoDB();

$email = mysqli_real_escape_string($con->getConexao(), $_POST["email"]);
$senha = mysqli_real_escape_string($con->getConexao(), $_POST["senha"]);

$query = "select pk_id_jogador, nome, nickname from jogadores where email = '$email' and senha = '$senha';";

$result = $con->executQuery($query);

$numLinha = mysqli_num_rows($result);

$dados = mysqli_fetch_assoc($result);

//var_dump($dados);

if($numLinha == 1){

    $_SESSION['idJogador'] = $dados['pk_id_jogador'];
    $_SESSION['nomeJogador'] = $dados['nome'];
    $_SESSION['nickname'] = $dados['nickname'];
    header('location: ../play/jogador.php');

    $con->fecharConexao();
    exit();

} else {

    //Verifica se é funcionario

    $query2 = "select pk_id_adm, nome from administradores where email = '$email' and senha = '$senha';";
    $result2 = $con->executQuery($query2);

    $numLinha2 = mysqli_num_rows($result2);

    $dados2 = mysqli_fetch_assoc($result2);

    if ($numLinha2 == 1) {

        $_SESSION['idAdm'] = $dados2['pk_id_adm'];
        $_SESSION['nomeAdm'] = $dados2['nome'];
        header('location: ../adm/administrador.php');
        //echo "func encotrado " .$_SESSION['nomeAdm'];

        $con->fecharConexao();
        exit();

    }else{

        $_SESSION['userNaoEncontrado'] = true;
        header('location: ../play/formlogin.php');

        $con->fecharConexao();
        exit();
    }  
}

//echo $numLinha;

$con->fecharConexao();
