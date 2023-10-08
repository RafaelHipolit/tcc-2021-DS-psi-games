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


    <?php
    require_once "../server/ConexaoBD.php";
    $con = new ConexaoDB();

    $nomeArq = $_FILES['arquivo']['name'];
    //echo "$nomeArq";
    $explode = explode(".", $nomeArq);
    $extensao = $explode[sizeof($explode) - 1];
    //echo $extensao;

    if ($extensao != "png") {
        $_SESSION['imgFormatoErro'] = true;
        $con->fecharConexao();
        header('location: jogo-cadastrar1.php');
        exit();
    }

    $nome = mysqli_real_escape_string($con->getConexao(), $_POST["nome"]);
    $preco = mysqli_real_escape_string($con->getConexao(), $_POST["preco"]);
    $req = mysqli_real_escape_string($con->getConexao(), $_POST["requisitos"]);
    $desc = mysqli_real_escape_string($con->getConexao(), $_POST["descricao"]);
    $sys = mysqli_real_escape_string($con->getConexao(), $_POST["sistema"]);
    $data = mysqli_real_escape_string($con->getConexao(), $_POST["data_lancamento"]);

    $query = "select nome from jogos where nome = '" . $nome . "';";
    $result =  $con->executQuery($query);

    if (mysqli_num_rows($result) != 0) {
        $_SESSION['nomeJaRegistrado'] = true;
        $con->fecharConexao();
        header('location: jogo-cadastrar1.php');
        exit();
    }


    $query = "insert into jogos values (default,$preco,'$nome','$req','$desc','$sys','$data');";

    $con->executQuery($query);

    $result = $con->executQuery("select pk_id_jogo from jogos order by pk_id_jogo desc limit 1;");
    $tupla = mysqli_fetch_assoc($result);
    $id = $tupla['pk_id_jogo'];

    if (file_exists("../img-games/$id.png")) {
        //echo "existe";
        unlink("../img-games/$id.png");
    }

    move_uploaded_file($_FILES['arquivo']['tmp_name'], "../img-games/$id.$extensao");

    $con->fecharConexao();

    ?>
    <br>
    <h2>
    <main class="container-fluid">
        <p> O jogo cadastrado com sucesso</p>
    </main>
    </h2>


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