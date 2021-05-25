<?php

session_start();

$jogadorLogado = false;
$jogadorNome = "";

if (isset($_SESSION['idJogador'])) {
  $jogadorLogado = true;
  $jogadorNome = $_SESSION['nickname'];
}

$query = "select pk_id_jogo, nome, preco, sistema from jogos;";
if(isset($_GET['n'])){
  $query = "select pk_id_jogo, nome, preco, sistema from jogos where nome like '%".$_GET['n']."%';";
}

require_once '../server/ConexaoBD.php';

$con = new ConexaoDB();

$result = $con->executQuery($query);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PSI GAMES</title>

  <link rel="stylesheet" href="../css/cssGeral.css">
  <link rel="stylesheet" href="../css/cssProcuraJogo.css">

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

        <div id="btnlogin-pc" <?php
                              if ($jogadorLogado) {
                                echo 'style= "width: auto; padding: 0px 10px;" ';
                              }
                              ?>>
          <a href="formlogin.php">
            <?php
            if ($jogadorLogado) {
              echo "Olá " . $jogadorNome;
            } else {
              echo "Entrar";
            }
            ?>
          </a>
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

      <div id="bar-procura-jogos">
        <form action="" method="get" class="formbarproc">
          <input class="inputtext" type="text" name="n" value="<?php if (isset($_GET['n'])) { echo $_GET['n']; } ?>" placeholder="Digite aqui o nome do jogo">
          <input type="submit" style="display: none;">
        </form>
        <button class="btnsubmit">
          <img class="lupa" src="../img/Vector_search_icon.png" alt="LUPA"> <span id="procurar"> Procurar </span>
        </button>
      </div>

      <?php

      if(mysqli_num_rows($result) != 0){

        while ($linha = mysqli_fetch_assoc($result)) {
          $dados[] = $linha;
        }                                                      

        for ($i = 0; $i < sizeof($dados); $i++) {
          # code...
      ?>

        <div id="jogo-<?php echo $dados[$i]['pk_id_jogo'] ?>" class="jogo">
          <img src="../img/img_jogo_modelo.png" alt="NOT FOUND">
          <div id="nome"> <?php echo $dados[$i]['nome'] ?> </div>
          <div id="preco"> <?php if($dados[$i]['preco'] == 0.0){ echo "Gratuito"; }else { echo $dados[$i]['preco']; } ?> </div>
          <div id="system"> Sistema: <?php echo $dados[$i]['sistema'] ?> </div>
          <div id="preco-mobile"> <?php if($dados[$i]['preco'] == 0.0){ echo "Gratuito"; }else { echo $dados[$i]['preco']; } ?> </div>
        </div>

      <?php 
        }// fecha FOR
      
      }else{
        echo "Nenhum jogo encontrado com o nome ".$_GET['n'];
      }
      ?>




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

  <script>
    var btn = document.getElementsByClassName("btnsubmit")[2];
    var input = document.getElementsByClassName("inputtext")[2];

    btn.addEventListener("click", Procurar);

    function Procurar() {
      if (input.value == "") {
        window.location.assign("procurajogo.php");
      } else {
        window.location.assign("procurajogo.php?n=" + input.value);
      }

    }

    <?php   
    if(mysqli_num_rows($result) != 0){
      for ($i = 0; $i < sizeof($dados); $i++) {
        echo "var jogo".$dados[$i]['pk_id_jogo']." = document.getElementById('jogo-".$dados[$i]['pk_id_jogo']."');";

        echo "jogo".$dados[$i]['pk_id_jogo'].".addEventListener('click', goPageJogo".$dados[$i]['pk_id_jogo']."  );";

        echo "function goPageJogo".$dados[$i]['pk_id_jogo']."() {
          window.location.assign('jogo.php?id=".$dados[$i]['pk_id_jogo']."');
        }";
      }
    }
    ?>



    




  </script>
</body>

</html>