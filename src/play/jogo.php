<?php

session_start();

$jogadorLogado = false;
$jogadorNome = "";

if (isset($_SESSION['idJogador'])) {
  $jogadorLogado = true;
  $jogadorNome = $_SESSION['nickname'];
}


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

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PSI GAMES</title>

  <link rel="stylesheet" href="../css/cssGeral.css">
  <link rel="stylesheet" href="../css/cssJogo.css">

</head>

<body>
  <div id="backHeader">
    <header>
      <div id="headerbar">

        <div id="btnmenu-mobile">≡</div>

        <h1 id="logo"><img src="../img/psigames_logo.png" alt=""></h1>

        <div id="barprocura-pc">
          <form action="procurajogo.php" method="get" class="formbarproc">
            <input class="inputtext" type="text" name="n">
            <input type="submit" style="display: none;">
          </form>
          <button class="btnsubmit">
            <img class="lupa" src="../img/Vector_search_icon.png" alt="LUPA">
          </button>
        </div>

        <div id="btnlogin-pc" <?php if ($jogadorLogado) { echo 'style= "width: auto; padding: 0px 10px;" '; } ?>>
          <a href="formlogin.php"> <?php if ($jogadorLogado) { echo "Olá " . $jogadorNome; } else { echo "Entrar"; } ?> </a>
        </div>

        <div id="btnlogin-mobile">
          <img src="../img/perfil_icon_branco.png" width="40px">
        </div>

      </div>

      <div id="barprocura-mobile">
        <form action="procurajogo.php" method="get" class="formbarproc">
          <input class="inputtext" type="text" name="n" placeholder="Digite aqui o nome do jogo">
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
      <!-- Main =========================================== -->
      <div id="img-jogo"><img src="../img/img_jogo_modelo.png" alt="NOT FOUND"></div>
      <div id="dados">

        <div id="info-main">
          <div id="nome"> <?php echo $dados['nome']; ?> </div>
          <div id="preco"> <?php if($dados['preco'] == 0.0){ echo "Gratuito"; }else { echo $dados['preco']; } ?> </div>

          <?php
          $encontrouNoCar = false;

          if(isset($_SESSION['idJogador'])){
            
            $idJogador = $_SESSION['idJogador'];
            $idJogo = $_GET['id'];
            $query = "select jogos.nome from jogos
            join car_compra_jogo on jogos.pk_id_jogo = car_compra_jogo.fk_id_jogo
            join carrinhos on car_compra_jogo.fk_id_car = carrinhos.pk_id_car
            join jogadores on carrinhos.fk_id_jogador = jogadores.pk_id_jogador
            where jogadores.pk_id_jogador = $idJogador and jogos.pk_id_jogo = $idJogo;";
            $result = $con->executQuery($query);

            if(mysqli_num_rows($result) == 0){

              if(!isset($_SESSION['session_carrinho'])){

                echo "<a id='add-car' href='addjogocarrinho.php?id=".$dados['pk_id_jogo']." '>Adicionar ao carrinho</a>";

              }else{

                require_once "../server/ClassJogo.php";
                $arrayCarrinho = unserialize($_SESSION['session_carrinho']);
                for ($i=0; $i < sizeof($arrayCarrinho); $i++) { 
                  
                  if( $arrayCarrinho[$i]->getId() == $idJogo){
                    echo "<div id='jogo-em-car'>Jogo em carrinho</div>";
                    $encontrouNoCar = true;
                    break;
                  }
                }

                if(!$encontrouNoCar){
                  echo "<a id='add-car' href='addjogocarrinho.php?id=".$dados['pk_id_jogo']." '>Adicionar ao carrinho</a>";
                }

              }
              
            }else{
              echo "<div id='adquirido'>Jogo adquirido</div>";
            }


            
          }else{
            echo "<div id='nao-logado'>Para adquirir o jogo entre na sua conta primeiro</div>";
          }
          ?>

          
          
          

          

          <?php
          
          ?>

          



        </div>
       
        <div id="system" class="item-info">Sistema: <?php echo $dados['sistema']; ?></div>
        <div id="requisitos" class="item-info">
            Requisitos: <br>
            <?php echo $dados['requisitos']; ?>
        </div>
        <div id="desc" class="item-info">
           Descrição: <br>
          <?php echo $dados['descricao']; ?>
        </div>
        <div id="lanc" class="item-info" >Lancado em: <?php echo $dados['data_lancamento']; ?></div>
      </div>
      


    </main>
  </div>

  <footer>
    <a href="https://github.com/cp2-dc-info-projeto-final/psi-games">Acesse o codigo da plataforma no GitHub</a>
    <a href="index.php">| 𝜓 〉GAMES</a>
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
    $msgLogado = "Olá " . $jogadorNome . "<br><br> Clique aqui para entrar no seu perfil";
    $msgNaoLogado = "Você não esta logado <br><br> Clique aqui para <br> Entrar na sua conta <br> ou criar uma";
    ?>
    <a href="formlogin.php"> <?php if ($jogadorLogado) {
                                echo $msgLogado;
                              } else {
                                echo $msgNaoLogado;
                              } ?> </a>

    <div id="loginlateral-fechar">
      FECHAR <br> MENU <br> LATERAL
    </div>
  </div>

  <script src="../js/jsGeral.js"></script>
</body>

</html>