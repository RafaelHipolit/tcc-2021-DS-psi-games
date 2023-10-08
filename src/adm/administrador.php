<?php

session_start(); // inicia o sistema de sessao - usado para autentificar o login

require_once "../server/verificaloginadm.php"; // faca o require_once desse arquivo para permitir que somente que quem ja esteja logado como ADM possa entrar nessa pagina
// - ATENÇÃO PARA ISSO FUNCIONAR VC TEM QUE TER CHAMADO ANTES O session_start()

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seção do ADM</title>


    <!-- Import do CSS do Bootstrap LOCAL -->
    <!--  <link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">  -->

    <!-- Latest compiled and minified CSS -->
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

        <h1>Administradores</h1>
        <hr>
        <a href="adm-cadastrar1.php" class="btn btn-primary">Cadastrar</a>
        <a href="adm-listar.php" class="btn btn-primary">Listar todos</a>
        <a href="adm-consulta.php" class="btn btn-primary">Consultar por nome(alterar/excluir)</a>
        <a href="adm-alterar1.php" class="btn btn-primary">Alterar(por ID)</a>
        <a href="adm-exclui1.php" class="btn btn-primary">Excluir(por ID)</a>
        <br><br><br><br>

        <h1>Jogadores</h1>
        <hr>
        <a href="jogador-cadastrar1.php" class="btn btn-primary">Cadastrar</a>
        <a href="jogador-lista.php" class="btn btn-primary">Listar todos</a>
        <a href="jogador-consulta.php" class="btn btn-primary">Consultar por nome(alterar/excluir/carrinhos)</a>
        <a href="jogador-alterar1.php" class="btn btn-primary">Alterar(por ID)</a>
        <a href="jogador-exclui1.php" class="btn btn-primary">Excluir(por ID)</a>
        <br><br><br><br>

        <h1>Jogos</h1>
        <hr>
        <a href="jogo-cadastrar1.php" class="btn btn-primary">Cadastrar</a>
        <a href="jogo-listar.php" class="btn btn-primary">Listar todos</a>
        <a href="jogo-consulta.php" class="btn btn-primary">Consultar por nome(alterar/excluir/Registros de compras)</a>
        <a href="jogo-alterar1.php" class="btn btn-primary">Alterar(por ID)</a>
        <a href="jogo-excluir1.php" class="btn btn-primary">Excluir(por ID)</a>
        <br><br><br><br>

        <h1>Carrinhos</h1>OBS.: Um registro de carrinho é um registo de compra efetuada
        <hr>
        <a href="carrinho-lista.php" class="btn btn-primary">Listar todos carrinho</a>
        <br><br>

        <!--
        <ul>

            <li><a href="#"><button type="button" class="btn btn-secondary btn-lg">
                        <h1>Admin</h1>
                    </button></a></br></li>

            <ul>
                <li><a href="adm-cadastrar1.php">cadastrar</li></a>
                <li><a href="adm-listar.php">listar</li></a>
                <li><a href="adm-consulta.php">consultar</li></a>
                <li><a href="adm-alterar1.php">alterar</li></a>
                <li><a href="adm-exclui1.php">excluir</li></a>
            </ul>
        </ul>
        <ul>
            <li><a href="#"><button type="button" class="btn btn-secondary btn-lg">
                        <h1>Jogadores</h1>
                    </button></a></br></li>
            <ul>
                <li><a href="#">cadastrar</li></a>
                <li><a href="#">listar</li></a>
                <li><a href="jogador-consulta.php">consultar</li></a>
                <li><a href="#">alterar</li></a>
                <li><a href="#">excluir</li></a>
            </ul>
        </ul>
        <ul>
            <li><a href="#"><button type="button" class="btn btn-secondary btn-lg">
                        <h1>Jogos</h1>
                    </button></a></br></li>
            <ul>
                <li><a href="#">cadastrar</li></a>
                <li><a href="#">listar</li></a>
                <li><a href="jogo-consulta.php">consultar</li></a>
                <li><a href="#">alterar</li></a>
                <li><a href="#">excluir</li></a>
            </ul>

        </ul>

        -->


        <br>
        <a class="btn btn-outline-dark" href="../server/logout.php">DESLOGAR</a>

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