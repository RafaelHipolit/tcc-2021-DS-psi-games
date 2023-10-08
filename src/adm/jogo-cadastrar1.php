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
        <h2>Cadastrar novo jogo</h2>
        <hr>
        <form action="jogo-cadastrar2.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="input-nome">Nome: </label><br>
                <input class="form-control" type="text" name="nome" required maxlength="200" placeholder="Digite o nome do jogo" autofocus>
                <?php
                if (isset($_SESSION['nomeJaRegistrado'])) {
                    echo '<div class="alert alert-danger"> O nome já esta registrado </div>';
                    unset($_SESSION['nomeJaRegistrado']);
                }
                ?>
            </div>

            <div class="form-group">
                <label for="input-preco">Preço:</label><br>
                <input type="number" class="form-control" step=".01" min="0" max="9999999" placeholder="Preço" name="preco" id="input-preco" required>
            </div>

            <div class="form-group">
                <label for="input-req">Requisitos:</label>
                <textarea class="form-control" placeholder="Digite aqui os requisitos do jogo" name="requisitos" id="input-req" required></textarea>
            </div>

            <div class="form-group">
                <label for="input-descricao">Descrição:</label>
                <textarea class="form-control" placeholder="Digite aqui a descrição do jogo" name="descricao" id="input-descricao" required></textarea>
            </div>

            <div class="form-group">
                <label for="input-sys">Sistema:</label>
                <textarea class="form-control" placeholder="Digite aqui o/os sistemas disponiveis do jogo" name="sistema" id="input-sys" required></textarea>
            </div>

            <div class="form-group">
                <label for="input-data">Data de lançamento</label>
                <input type="date" name="data_lancamento" id="input-sys" required value="<?php echo date("Y-m-d"); ?>">
            </div>

            <div class="form-group">
                <label for="input-img">Arquivo de imagem do jogo na dimensão 800x600 no formato .png:</label><br>
                <input type="file" class="form-control-file border" name="arquivo" required>
                <?php
                if (isset($_SESSION['imgFormatoErro'])) {
                    echo '<div class="alert alert-danger"> o formato da imagem deve ser PNG </div>';
                    unset($_SESSION['imgFormatoErro']);
                }
                ?>
            </div>

            <input type="submit" class="btn btn-primary" value="Cadastrar">
        </form>

        <br><br>
        <a href="administrador.php" class="btn btn-secondary">Retornar</a>

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