<?php
session_start();
require_once "../server/verificaloginadm.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


        <h2>Cadastrar um Jogador</h2>
        <hr>


        <form action="jogador-cadastrar2.php" method="post">

            <label for="email">Nome: </label>
            <input class="lblinput" type="text" name="nome" required maxlength="300" placeholder="Digite aqui seu nome" autofocus>

            <h2 style="color: red;">
                <?php
                if (isset($_SESSION['nomeJaExiste'])) {
                    echo '<p style="color: red;"> Esse nome já esta sendo usado </p>';
                    unset($_SESSION['nomeJaExiste']);
                }
                ?>
            </h2>

            <label for="email">Nickname: </label>
            <input class="lblinput" type="text" name="nickname" required maxlength="300" placeholder="Digite aqui seu nickname"></br>

            <label for="email">Email:</label>
            <input class="lblinput" type="email" name="email" required maxlength="300" placeholder="Digite aqui seu e-mail">

            <h2 style="color: red;">
                <?php
                if (isset($_SESSION['emailJaExiste'])) {
                    echo '<p style="color: red;"> Esse email já esta sendo usado </p>';
                    unset($_SESSION['emailJaExiste']);
                }
                ?>
            </h2>

            <label for="senha">Senha:</label>
            <input class="lblinput" type="password" name="senha" required maxlength="300" placeholder="Digite aqui sua senha">

            <br>
            <input id="btnLogar" type="submit" class="btn btn-primary" value="Criar">
        </form>

        <br><br>
        <a class="btn btn-secondary" href="administrador.php">Retornar</a>

    </main>

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