<?php

session_start();

require_once "../server/verificaloginadm.php";

require_once '../server/ConexaoBD.php';

if (isset($_GET['nome'])) {

    $query = "select pk_id_adm, nome, email from administradores where nome like '%" . $_GET['nome'] . "%';";
} else {
    $query = "select pk_id_adm, nome, email from administradores;";
}

$con = new ConexaoDB();

$result = $con->executQuery($query);

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

        <form action="adm-consulta.php" method="get">
            <label for="nome-adm">Nome do administrador:</label>
            <input type="text" name="nome" value="<?php if (isset($_GET['nome'])) {
                                                        echo $_GET['nome'];
                                                    } ?>" id="nome-adm">
            <input type="submit" class="btn btn-info" value="Buscar">
        </form>

        <p>Para visualizar todos os administradores deixe o campo acima em branco e clique em "Buscar"</p>

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
                    <td>Email</td>
                </thead>
                <?php
                for ($i = 0; $i < sizeof($dados); $i++) {
                    echo "<tr>";
                    echo "<td> " . $dados[$i]['pk_id_adm'] . " </td>";
                    echo "<td> " . $dados[$i]['nome'] . " </td>";
                    echo "<td> " . $dados[$i]['email'] . " </td>";
                    echo "<td><a href='adm-alterar2.php?id=" . $dados[$i]['pk_id_adm'] . " ' class='btn btn-outline-primary' >Alterar dados</a></td>";
                    echo "<td><a href='adm-exclui2.php?id=" . $dados[$i]['pk_id_adm'] . " ' class='btn btn-outline-danger' >Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

        <?php
        } else {
            if(isset($_GET['nome'])){
                echo "Nenhum administrador encontrado com o nome " . $_GET['nome'];
            }else{
                echo "<h1>Algo de estranho aconteceu! Nenhum Administrador cadastrado!</h1>";
            }
            
        }
        ?>

        <br><br>
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