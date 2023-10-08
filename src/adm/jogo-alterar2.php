<?php
session_start();
require_once "../server/verificaloginadm.php";

require_once '../server/ConexaoBD.php';

if (!isset($_GET['id'])) {
    header('location: jogador-lista.php');
    exit();
} else if (empty($_GET['id'])) {
    header('location: jogador-lista.php');
    exit();
}

$id = $_GET['id'];

$query = "select * from jogos where pk_id_jogo = $id;";

$con = new ConexaoDB();

$result = $con->executQuery($query);
$dados = mysqli_fetch_assoc($result);

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
        <h2>Alterar dados do jogo - ID: <?php echo $dados['pk_id_jogo']; ?></h2>
        <hr>
        <form action="jogo-alterar3.php" method="post" enctype="multipart/form-data">

            <input type="hidden" value="<?php echo $dados['pk_id_jogo']; ?>" name="id">

            <div class="form-group">
                <label for="input-nome">Nome: </label><br>
                <input id="input-nome" type="text" name="nome" required maxlength="200" placeholder="Digite o nome do jogo" autofocus value="<?php echo $dados['nome']; ?>">
                <?php
                if (isset($_SESSION['nomeJaRegistrado'])) {
                    echo '<div class="alert alert-danger"> O nome já esta registrado </div>';
                    unset($_SESSION['nomeJaRegistrado']);
                }
                ?>
            </div>

            <div class="form-group">
                <label for="input-preco">Preço:</label><br>
                <input type="number" step=".01" min="0" max="9999999" placeholder="Preço" name="preco" id="input-preco" required value="<?php echo $dados['preco']; ?>">
            </div>

            <div class="form-group">
                <label for="input-req">Requisitos:</label>
                <textarea class="form-control" placeholder="Digite aqui os requisitos do jogo" name="requisitos" id="input-req" required><?php echo $dados['requisitos']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="input-descricao">Descrição:</label>
                <textarea class="form-control" placeholder="Digite aqui a descrição do jogo" name="descricao" id="input-descricao" required><?php echo $dados['descricao']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="input-sys">Sistema:</label>
                <textarea class="form-control" placeholder="Digite aqui o/os sistemas disponiveis do jogo" name="sistema" id="input-sys" required><?php echo $dados['sistema']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="input-data">Data de lançamento</label>
                <input type="date" name="data_lancamento" id="input-sys" required value="<?php echo $dados['data_lancamento']; ?>">
            </div>

            <div class="form-group">
                <label for="input-img">Arquivo de imagem do jogo na dimensão 800x600 no formato .png:</label><br>
                <h3>Caso não queira alterar a atual imagem, deixar o campo abaixo vazio</h3>
                <input type="file" class="form-control-file border" name="arquivo">
                <?php
                if (isset($_SESSION['imgFormatoErro'])) {
                    echo '<div class="alert alert-danger"> o formato da imagem deve ser PNG </div>';
                    unset($_SESSION['imgFormatoErro']);
                }
                ?>
            </div>

            <input type="submit" class="btn btn-primary" value="Alterar">
        </form>
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