<?php
session_start();
require_once "../server/verificaloginadm.php"
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>listar adm</title>
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
        <h1>Listar administradores</h1>
        <hr>


        <?php
        require_once "../server/ConexaoBD.php";
        $con = new ConexaoDB();
        $query = "select pk_id_adm, nome, email from administradores;";

        $result = $con->executQuery($query);

        if (mysqli_num_rows($result) != 0) {

            echo "<table class='table table-striped'>";
            echo "<thead>
            <td> ID </td>
            <td> Nome </td>
            <td> Email </td>
            </thead>";

            while ($linha = mysqli_fetch_assoc($result)) {
                echo "<tr>";

                echo "<td>" . $linha['pk_id_adm'] . "</td>";
                echo "<td>" . $linha['nome'] . "</td>";
                echo "<td>" . $linha['email'] . "</td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h1>Algo de estranho aconteceu! Nenhum Administrador cadastrado!</h1>";
        }


        $con->fecharConexao();


        ?>

        <a class="btn btn-secondary" href="administrador.php">Retornar</a>


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