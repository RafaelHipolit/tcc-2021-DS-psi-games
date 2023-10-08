<?php
session_start();
require_once "../server/verificaloginadm.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Alterar jogador2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <h3 class="page-header">Seção do Administrador - Administrador logado: <?php echo $_SESSION['nomeAdm']; ?></h3>
    </nav>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="administrador.php">Pagina principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../server/logout.php">DESLOGAR</a>
            </li>
        </ul>
    </nav>
    <br>
    <main class="container-fluid">

    <h2>Alterar jogador</h2>
    <hr>
    <?php

    $codigo = $_GET["id"];
    //$sql = "SELECT * FROM Produto WHERE codproduto = $codigo"; //o nosso é JOGO, não Produto
    $sql = "SELECT * FROM jogadores WHERE pk_id_jogador = '$codigo';";
    //NÃO FAZ ASSIM:
    //$consulta = mysqli_query($mysqli, $sql); // FORMA COMO O PROFESSOR FAZ
    //FAZER ASSIM:
    require_once '../server/ConexaoBD.php';
    $con = new ConexaoDB();
    $consulta = $con->executQuery($sql); // forma como fazemos no nosso projetoF
    if (mysqli_num_rows($consulta) == 0)
        echo "Esse jogador não existe";
    else {
        $linha = mysqli_fetch_array($consulta);
        $n = $linha["nome"];
        $d = $linha["nickname"];
        $q = $linha["email"];
    ?>
        <form method="POST" action="jogador-alterar3.php">
            nome: <br />
            <input type="text" size="50" name="nome" required value="<?php echo $n; ?>" /><br /><br />
            nicknome: <br />
            <input type="text" size="50" name="nickname" required value="<?php echo $d; ?>" /><br /><br />
            email: <br />
            <input type="email" size="50" name="email" required value="<?php echo $q; ?>" /><br /><br />
            <h2 style="color: red;">
          <?php
          if (isset($_SESSION['emailJaExiste'])) {
            echo '<p style="color: red;"> Esse email já está sendo usado </p>';
            unset($_SESSION['emailJaExiste']);
          }
          ?>
          </h2>
          <p>Para não alterar a senha, deixe o campo abaixo em branco </p>
            senha: <br />
            <input type="password" size="25" name="senha" /><br /><br />
            <input type="hidden" name="id" value="<?php echo $codigo; ?>" />
            <input type="submit" class="btn btn-primary" value="Alterar Jogador" />
        </form>
    <?php 
    }
    ?>
    <br /><br /><a href="jogador-alterar1.php" class="btn btn-secondary">Retornar</a>
    </main>
    <!-- Import do jQuery + JS do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script> -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>