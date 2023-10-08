<?php

session_start();

require_once "../server/verificaloginadm.php";

require_once '../server/ConexaoBD.php';

$query = "select carrinhos.*, jogadores.nome, jogadores.pk_id_jogador from carrinhos
join jogadores on carrinhos.fk_id_jogador = jogadores.pk_id_jogador;";

$con = new ConexaoDB();

$result = $con->executQuery($query);

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

        <h2>Todos os registros de carrinhos</h2>OBS.: Um registro de carrinho é um registo de compra efetuada
        <hr>

        <?php

        if (mysqli_num_rows($result) != 0) {

            while ($linha = mysqli_fetch_assoc($result)) {
                $dados[] = $linha;
            }

        ?>

            <table class='table table-striped'>
                <thead>
                    <td>ID carrinho</td>
                    <td>Data da compra</td>
                    <td>ID do comprador</td>
                    <td>Nome do comprador</td>
                </thead>
                <?php
                for ($i = 0; $i < sizeof($dados); $i++) {
                    echo "<tr>";
                    echo "<td> " . $dados[$i]['pk_id_car'] . " </td>";
                    echo "<td> " . dataFormatoBr($dados[$i]['data_compra']) . " </td>";
                    echo "<td> " . $dados[$i]['pk_id_jogador'] . " </td>";
                    echo "<td> " . $dados[$i]['nome'] . " </td>";
                    echo "<td><a href='carrinho-dados.php?id=" . $dados[$i]['pk_id_car'] . "' class='btn btn-outline-primary' >Jogos do carrinho</a></td>";
                    echo "</tr>";
                }

                ?>
            </table>

        <?php
        }else{//fecha IF
            echo "<h1>Ainda nenhuma compra foi efetuada</h1>";

        }
         
        ?>

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