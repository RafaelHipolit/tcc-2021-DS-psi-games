<?php
session_start();
require_once "../server/verificaloginadm.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>excluir jogador3</title>
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
        <h2>Excluir jogador</h2>

        <hr>

        <?php

        require_once '../server/ConexaoBD.php';
        $con = new ConexaoDB();

        $id = $_POST["id"];

        $query = "select car_compra_jogo.* from car_compra_jogo
        where car_compra_jogo.fk_id_jogo = $id;";

        $result = $con->executQuery($query);

        if(mysqli_num_rows($result) != 0){

            while ($linha = mysqli_fetch_assoc($result)) {
                $idCompras[] = $linha['pk_id_compra'];
            }
    
            for ($j = 0; $j < sizeof($idCompras); $j++) {
    
                $query = "delete from car_compra_jogo where pk_id_compra = " . $idCompras[$j] . ";";
                $con->executQuery($query);
            }

        }    

        $sql = "DELETE FROM jogos WHERE pk_id_jogo = '$id';";

        $con->executQuery($sql);

        ?>

        <h1> O Jogo foi excluido com sucesso!</h1>

        <br /><br /><a href="administrador.php" class="btn btn-secondary">Retonar a pagina principal</a>

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