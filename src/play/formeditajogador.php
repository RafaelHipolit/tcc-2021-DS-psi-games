<?php

session_start();

require_once "../server/verificaloginjogador.php";


$jogadorLogado = false;
$jogadorNome = "";

if (isset($_SESSION['idJogador'])) {
  $jogadorLogado = true;
  $jogadorNome = $_SESSION['nickname'];
}

$id = $_SESSION['idJogador'];

require_once "../server/ConexaoBD.php";
$con = new ConexaoDB();
$query = "select nome, nickname, email from jogadores where pk_id_jogador = ". $id .";";
$result = $con->executQuery($query);

$linha = mysqli_fetch_assoc($result);
$email = $linha['email'];

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
        <h1>Edite seus dados</h1>
        <form action="editajogador.php" method="post">

          <h2>Nome: <?php echo $linha['nome']; ?></h2>

          <h3>*Não é possivel mudar o nome depois da conta criada</h3>

          <label for="email">Nickname: </label> 
          <input class="lblinput" type="text" name="nickname" required  maxlength="300" placeholder="Digite aqui seu novo apelido" autofocus value="<?php echo $linha['nickname']; ?>">

          <label for="email">Email:</label> 
          <input class="lblinput" type="email" name="email" required  maxlength="300" placeholder="Digite aqui seu novo e-mail" value="<?php echo $linha['email']; ?>">

          <h2 style="color: red;">
          <?php
          if (isset($_SESSION['emailJaExiste'])) {
            echo '<p style="color: red;"> Esse email já esta sendo usado </p>';
            unset($_SESSION['emailJaExiste']);
          }
          ?>
          </h2>

          <label for="check-alt-senha">
            <input type="checkbox" name="ALTSENHA" value="TRUE" id="check-alt-senha"> Alterar senha
          </label>
          <div id="campo-senha" style="display: none;">
            <label for="senha">Senha:</label>
            <input class="lblinput" type="password" id="input-senha" name="senha"  maxlength="300" placeholder="Digite aqui sua nova senha">
          </div>
          
          
          <input id="btnLogar" type="submit" value="Alterar">
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

  <script>

    var ativado = false;
    var check = document.getElementById("check-alt-senha");
    var inputSenha = document.getElementById("input-senha");
    var campoSenha = document.getElementById("campo-senha");
    inputSenha.disabled = true;
    check.addEventListener('change', ev);

    function ev() {
        if (ativado) {
            ativado = false;
            inputSenha.disabled = true;
            inputSenha.required = false;
            campoSenha.style.display = "none";
        } else {
            ativado = true;
            inputSenha.disabled = false;
            inputSenha.required = true;
            campoSenha.style.display = "block";
        }
        //alert(ativado);
    }


  </script>

  <script src="../js/jsGeral.js"></script>

</body>

</html>