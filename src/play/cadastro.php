<?php

require_once '../server/ConexaoBD.php';

session_start();

if(isset($_SESSION['idJogador'])){
    header('location: ../play/jogador.php');
    exit();
}

if(isset($_SESSION['idAdm'])){
    header('location: ../adm/administrador.php');
    exit();
}

if ( !(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['nickname']) && isset($_POST['senha']) )){
    header('location: formcadastro.php');
    exit();
}

if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["nickname"]) || empty($_POST["senha"])){
    header('location: formcadastro.php');
    exit();
}

$con = new ConexaoDB();

$nome = mysqli_real_escape_string($con->getConexao(), $_POST["nome"]);
$nickname = mysqli_real_escape_string($con->getConexao(), $_POST["nickname"]);
$email = mysqli_real_escape_string($con->getConexao(), $_POST["email"]);
$senha = mysqli_real_escape_string($con->getConexao(), md5($_POST["senha"]));

$query = "select nome from jogadores where nome = '$nome';";
$result =  $con->executQuery($query);

if(mysqli_num_rows($result) != 0){
    $_SESSION['nomeJaExiste'] = true;
    $con->fecharConexao();
    header('location: formcadastro.php');
    exit();
}

$query = "select nome from jogadores where email = '" . $email . "';";
$result =  $con->executQuery($query);

if(mysqli_num_rows($result) != 0){
    $_SESSION['emailJaExiste'] = true;
    $con->fecharConexao();
    header('location: formcadastro.php');
    exit();
}

$query = "select nome from administradores where email = '" . $email . "';";
$result =  $con->executQuery($query);

if(mysqli_num_rows($result) != 0){
    $_SESSION['emailJaExiste'] = true;
    $con->fecharConexao();
    header('location: formcadastro.php');
    exit();
}

$query = "insert into jogadores values (default,'" . $nome . "','" . $nickname . "','" . $email . "','" . $senha . "');";

$con->executQuery($query);

$con->fecharConexao();



$jogadorLogado = false;
$jogadorNome = "";

if(isset($_SESSION['idJogador'])){
  $jogadorLogado = true;
  $jogadorNome = $_SESSION['nickname'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PSI GAMES</title>

  <link rel="stylesheet" href="../css/cssGeral.css">

</head>

<body>
  <div id="backHeader">
    <header>
      <div id="headerbar">

        <div id="btnmenu-mobile">≡</div>

        <h1 id="logo">| 𝜓 〉GAMES</h1>

        <div id="barprocura-pc">
          <form action="procurajogo.php" method="get" class="formbarproc">
            <input class="inputtext" type="text" name="n">
            <input type="submit" style="display: none;">
          </form>
          <button class="btnsubmit">
            <img class="lupa" src="../img/Vector_search_icon.png" alt="LUPA">
          </button>
        </div>

        <div id="btnlogin-pc" <?php if($jogadorLogado){ echo 'style= "width: auto; padding: 0px 10px;" '; } ?> >
          <a href="formlogin.php"> <?php if($jogadorLogado){ echo "Olá ".$jogadorNome; } else { echo "Entrar"; } ?> </a>
        </div>

        <div id="btnlogin-mobile">
          <img src="../img/perfil_icon_branco.png" width="40px">
        </div>

      </div>

      <div id="barprocura-mobile">
        <form action="procurajogo.php" method="get" class="formbarproc">
          <input class="inputtext" type="text" name="n">
          <input type="submit" style="display: none;">
        </form>
        <button class="btnsubmit">
          <img class="lupa" src="../img/Vector_search_icon.png" alt="LUPA">
        </button>
      </div>

      <nav>
        <ul>
          <li><a href="index.php">HOME</a></li>
          <li><a href="procurajogo.php">JOGOS</a></li>
          <li><a href="">INFO</a></li>
        </ul>
      </nav>

    </header>
  </div>

  <div id="backMain">
    <main>
      
      <h1>Conta criada com sucesso!</h1>
      <h2>Para acessar sua conta, <a href="formlogin.php">clique aqui</a> para entrar.</h2>

    </main>
  </div>

  <footer>
    <a href="https://github.com/cp2-dc-info-projeto-final/psi-games">Acesse o codigo da plataforma no GitHub</a>
    <a href="index.php">| 𝜓 〉GAMES | psi-games</a>
  </footer>


  <div id="menulateral">
    <nav>
      <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="procurajogo.php">JOGOS</a></li>
        <li><a href="">INFO</a></li>
      </ul>
    </nav>

    <div id="menulateral-fechar">
      FECHAR <br> MENU <br> LATERAL
    </div>

  </div>


  <div id="loginlateral">
    <?php
    $msgLogado = "Olá ". $jogadorNome. "<br><br> Clique aqui para entrar no seu perfil";
    $msgNaoLogado = "Você não esta logado <br><br> Clique aqui para <br> Entrar na sua conta <br> ou criar uma";
    ?>
    <a href="formlogin.php"> <?php if($jogadorLogado){ echo $msgLogado; } else { echo $msgNaoLogado; } ?> </a>

    <div id="loginlateral-fechar">
      FECHAR <br> MENU <br> LATERAL
    </div>
  </div>

  <script src="../js/jsGeral.js"></script>  

</body>

</html>