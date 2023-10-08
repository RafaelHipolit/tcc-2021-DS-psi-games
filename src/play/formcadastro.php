<?php

session_start();

if (isset($_SESSION['idJogador'])) {
  header('location: jogador.php');
  exit();
}

if (isset($_SESSION['idAdm'])) {
  header('location: ../adm/administrador.php');
  exit();
}


$jogadorLogado = false;
$jogadorNome = "";

if (isset($_SESSION['idJogador'])) {
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
  <link rel="stylesheet" href="../css/cssFormLogin.css">

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

        <div id="btnlogin-pc" <?php if ($jogadorLogado) {
                                echo 'style= "width: auto; padding: 0px 10px;" ';
                              } ?>>
          <a href="formlogin.php"> <?php if ($jogadorLogado) {
                                      echo "Olá " . $jogadorNome;
                                    } else {
                                      echo "Entrar";
                                    } ?> </a>
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
      <!-- Main =========================================== -->

      <div id="formLogin" style="padding-bottom: 70px;">
        <h1>Crie sua conta</h1>
        <form action="cadastro.php" method="post">

          <label for="email">Nome: </label> 
          <p style="color: red;">* depois de criada a conta, você não poderar alterar seu nome</p>
          <input class="lblinput" type="text" name="nome" required  maxlength="300" placeholder="Digite aqui seu nome" autofocus>

          <h2 style="color: red;">
          <?php
          if (isset($_SESSION['nomeJaExiste'])) {
            echo '<p style="color: red;"> Esse nome já esta sendo usado </p>';
            unset($_SESSION['nomeJaExiste']);
          }
          ?>
          </h2>

          <label for="email">Nickname: </label> 
          <input class="lblinput" type="text" name="nickname" required  maxlength="300" placeholder="Digite aqui seu apelido" autofocus>

          <label for="email">Email:</label> 
          <input class="lblinput" type="email" name="email" required  maxlength="300" placeholder="Digite aqui seu e-mail" >

          <h2 style="color: red;">
          <?php
          if (isset($_SESSION['emailJaExiste'])) {
            echo '<p style="color: red;"> Esse email já esta sendo usado </p>';
            unset($_SESSION['eamilJaExiste']);
          }
          ?>
          </h2>
          
          <label for="senha">Senha:</label>
          <input class="lblinput" type="password" name="senha" required  maxlength="300" placeholder="Digite aqui sua senha">
          
          <input id="btnLogar" type="submit" value="Criar">
        </form>
        
        
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