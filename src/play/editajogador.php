<?php

session_start();

require_once "../server/verificaloginjogador.php";

$id = $_SESSION['idJogador'];

if(!( isset($_POST['nickname']) && isset($_POST['email']) )){
    header('location: formeditajogador.php');
    exit();
}else if( empty($_POST['nickname']) || empty($_POST['email']) ){
    header('location: formeditajogador.php');
    exit();
}

require_once "../server/ConexaoBD.php";
$con = new ConexaoDB();

$novoNickname = mysqli_real_escape_string($con->getConexao(), $_POST['nickname']);
$novoEmail = mysqli_real_escape_string($con->getConexao(), $_POST['email']);

$query = "select pk_id_jogador from jogadores where email = '". $novoEmail ."';";
$result = $con->executQuery($query);
$linha = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) != 0 && $linha['pk_id_jogador'] != $id){
    $_SESSION['emailJaExiste'] = true;
    header('location: formeditajogador.php');
    exit();
}

$query = "update jogadores set email = '$novoEmail', nickname = '$novoNickname' where pk_id_jogador = $id;";
$con->executQuery($query);

$_SESSION['nickname'] = $novoNickname;

if(isset($_POST['ALTSENHA'])){
    $novoSenha = mysqli_real_escape_string($con->getConexao(), md5($_POST['senha']));
    $query = "update jogadores set senha = '$novoSenha' where pk_id_jogador = $id;";
    $con->executQuery($query);
}

header('location: jogador.php');
exit();

?>