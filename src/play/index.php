<?php

session_start();

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
          <li><a href="../../index">HOME</a></li>
          <li><a href="procurajogo">JOGOS</a></li>
          <li><a href="">INFO</a></li>
        </ul>
      </nav>

    </header>
  </div>

  <div id="backMain">
    <main>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas accusamus mollitia, commodi enim doloribus ipsum? Assumenda optio dignissimos necessitatibus quod blanditiis beatae iure quibusdam inventore tempora veritatis! Error, modi praesentium.
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, dolorum doloribus, ad amet suscipit vel corporis blanditiis placeat incidunt dignissimos, nam fuga aspernatur doloremque impedit eius recusandae cum nihil officia.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
      <br><br><br><br><br><br><br><br><br><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sint! Fugiat, autem velit? Quo temporibus fugiat officia possimus modi autem reiciendis dolores, iusto beatae, asperiores ut necessitatibus incidunt hic nobis.
        
      <div id="caixa">
      </div>

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
