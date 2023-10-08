<?php
session_start();
require_once "../server/verificaloginadm.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>excluir adm2</title>
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
    <h2>Excluir administrador</h2>
    <hr>
    <?php
    $codigo = $_GET["id"];
    $sql = "SELECT* FROM administradores WHERE pk_id_adm = '$codigo';";
    require_once '../server/ConexaoBD.php';
    $con = new ConexaoDB();
    $consulta = $con->executQuery($sql);
    if (mysqli_num_rows($consulta) == 0)
        echo "Esse administrador não existe";
    else {
        $linha = mysqli_fetch_array($consulta);
        $n = $linha["nome"];
        $d = $linha["email"];
        echo "<h2>Voce REALMENTE quer excluir o administrador?</h2></br>";
        echo"ID: $codigo</br>";
        echo "Nome: $n</br>";
        echo "email: $d</br>"; 
        echo"<a href='adm-exclui3.php?id=$codigo' class='btn btn-danger'>Excluir</a>";
    }
    ?>
    
    <br /><br /><a href="adm-exclui1.php">cancelar</a>
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