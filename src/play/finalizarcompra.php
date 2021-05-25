<?php

session_start();

require_once '../server/verificaloginjogador.php';

require_once "../server/ClassJogo.php";

if(!isset($_SESSION['session_carrinho'])){

    header('location: jogador.php');
    exit();

}else if(empty( unserialize($_SESSION['session_carrinho']) )){
    
    header('location: jogador.php');
    exit();

}

require_once '../server/ConexaoBD.php';

$con = new ConexaoDB();

$id = $_SESSION['idJogador'];
$query =  "insert into carrinhos values (default,$id,'" . date("Y-m-d") . "');";

$con->executQuery($query);

$result = $con->executQuery("select pk_id_car from carrinhos order by pk_id_car desc limit 1;");
$tupla = mysqli_fetch_assoc($result);
$idCar = $tupla['pk_id_car'];

$query = "insert into car_compra_jogo values ";

$arrayCarrinho = unserialize($_SESSION['session_carrinho']);

for ($i=0; $i < sizeof($arrayCarrinho); $i++) { 

    if($i ==  (sizeof($arrayCarrinho)-1) ){
        $query .= ("(default,$idCar,". $arrayCarrinho[$i]->getId() .");");
    }else{
        $query .= ("(default,$idCar,". $arrayCarrinho[$i]->getId() ."),");
    }
    
}

$con->executQuery($query);

$_SESSION['session_carrinho'] = serialize(array());






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
      
      <h1>Sua compra foi realizada com sucesso!</h1>
      <h2>Para visualizar seus jogo adquiridos, <a href="formlogin.php">clique aqui</a> para ir para seu perfil.</h2>

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