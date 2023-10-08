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

function dataFormatoBr($data){
    $dataArray = explode("-",$data);
    return $dataArray[2]."/".$dataArray[1]."/".$dataArray[0];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogos</title>

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

        <h2>Dados do jogo</h2>
        <hr>
        <h3>ID: <?php echo $dados['pk_id_jogo'] ; ?></h3>
        <br>
        <h3>Nome: <?php echo $dados['nome'] ; ?></h3>
        <br>
        <h3>Preço: <?php echo $dados['preco'] ; ?></h3>
        <br>
        <h3>Sistema: <?php echo $dados['sistema'] ; ?></h3>
        <br>
        <h3>Descrição:</h3>
        <p> <?php echo $dados['descricao'] ; ?> </p>
        <br>
        <h3>Requisitos:</h3>
        <p> <?php echo $dados['requisitos'] ; ?> </p>
        <br>
        <h3>Lançamento: <?php echo dataFormatoBr($dados['data_lancamento']) ; ?></h3>
        <br>
        <h3>Imagem do jogo:</h3>
        <img src="../img-games/<?php echo $dados['pk_id_jogo'] ; ?>.png" alt="NOT FOUND" width="800px">

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