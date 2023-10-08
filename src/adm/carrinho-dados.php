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


$con = new ConexaoDB();

$query2 = "select * from carrinhos where pk_id_car = $id;";

$result2 = $con->executQuery($query2);
$linha2 = mysqli_fetch_assoc($result2);

$query3 = "select pk_id_jogador, nome from jogadores where pk_id_jogador = '" . $linha2['fk_id_jogador'] . "';";

$result3 = $con->executQuery($query3);
$linha3 = mysqli_fetch_assoc($result3);

$query = "select jogos.* from jogos
join car_compra_jogo on jogos.pk_id_jogo = car_compra_jogo.fk_id_jogo
join carrinhos on car_compra_jogo.fk_id_car = carrinhos.pk_id_car
where carrinhos.pk_id_car = $id;";

$result = $con->executQuery($query);

while ($linha = mysqli_fetch_assoc($result)) {
    $dados[] = $linha;
}

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
    <title>Area do jogador</title>

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

        <h1>Jogos do carrinho de ID: <?php echo $id; ?></h1>
        <hr>
        <h2>Data da compra <?php echo dataFormatoBr($linha2['data_compra']); ?></h2>
        <h2>Carrinho do jogador: <?php echo $linha3['nome']; ?> - ID: <?php echo $linha3['pk_id_jogador']; ?></h2>

        <br>

        <?php
        if (mysqli_num_rows($result) != 0) {

            while ($linha = mysqli_fetch_assoc($result)) {
                $dados[] = $linha;
            }

        ?>

            <table class='table table-striped'>
                <thead>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Preço</td>
                    <td>Lançamento</td>
                </thead>
                <?php
                for ($i = 0; $i < sizeof($dados); $i++) {
                    echo "<tr>";
                    echo "<td> " . $dados[$i]['pk_id_jogo'] . " </td>";
                    echo "<td> " . $dados[$i]['nome'] . " </td>";
                    echo "<td> " . $dados[$i]['preco'] . " </td>";
                    echo "<td> " . dataFormatoBr($dados[$i]['data_lancamento']) . " </td>";
                    echo "<td><a href='jogo-dados.php?id=" . $dados[$i]['pk_id_jogo'] . "' class='btn btn-outline-primary'>Ver todos os dados do jogo</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

        <?php
        } else {
            echo "<h1>Algo de errado não esta certo! Nenhum jogo encontrado no carrinho!</h1> Provavelmente o(s) jogo(s) comprados nesse carrinho foram apagador apagados da base de dados";
        } ?>

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