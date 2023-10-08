<?php

session_start();

require_once '../server/verificaloginjogador.php';

if(isset($_GET['id'])){
    $query = "select * from jogos where pk_id_jogo = '".$_GET['id']."';";
}else{
    header('location: procurajogo.php');
    exit();
}

require_once '../server/ConexaoBD.php';

$con = new ConexaoDB();

$result = $con->executQuery($query);

if(mysqli_num_rows($result) == 0){
    header('location: procurajogo.php');
    exit();
}

$dados = mysqli_fetch_assoc($result);

require_once "../server/ClassJogo.php";

$Jogo = new Jogo($dados['pk_id_jogo'], $dados['nome'], $dados['preco']);

if(isset($_SESSION['session_carrinho'])){

  $arrayCarrinho = unserialize($_SESSION['session_carrinho']);
  for ($i=0; $i < sizeof($arrayCarrinho); $i++) { 
    
    if( $arrayCarrinho[$i]->getId() == $dados['pk_id_jogo']){
      header('location: procurajogo.php');
      exit();
    }

  }
 
  $arrayCarrinho[] = $Jogo;
  $_SESSION['session_carrinho'] = serialize($arrayCarrinho);

}else{

  $arrayCarrinho[] = $Jogo;
  $_SESSION['session_carrinho'] = serialize($arrayCarrinho);

}





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

        <img id="logo" src="../img/logo_psiGAMES.png" alt="PSI GAMES">

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
        </ul>
      </nav>

    </header>
  </div>

  <div id="backMain">
    <main>
      
      <h1>Jogo <?php echo $dados['nome']; ?> adicionado ao seu carrinho.</h1>
      <h2>Para visualizar seu carrinho, <a href="jogador.php">clique aqui</a> para ir para seu perfil.</h2>
      <br>
      <br>
      <h2><a href="procurajogo.php" style="color: white;">Continuar adicionando jogos ao carrinho</a></h2>

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