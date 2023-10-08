<?php
session_start();
require_once "../server/verificaloginadm.php";

$admNome = $_POST["nome"];
$admEmail = $_POST["email"];

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
    if ( !(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) )){
    header('location: adm-cadastrar1.php');
    exit();
}

if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["senha"])){
    header('location: adm-cadastrar1.php');
    exit();
}

$nome = mysqli_real_escape_string($con->getConexao(), $_POST["nome"]);
$email = mysqli_real_escape_string($con->getConexao(), $_POST["email"]);
$senha = mysqli_real_escape_string($con->getConexao(), md5($_POST["senha"]));

$query = "select nome from administradores where email = '" . $email . "';";
$result =  $con->executQuery($query);

if(mysqli_num_rows($result) != 0){
    $_SESSION['emailJaExiste'] = true;
    $con->fecharConexao();
    header('location: adm-cadastrar1.php');
    exit();
}
$query = "select nome from jogadores where email = '" . $email . "';";
$result =  $con->executQuery($query);

if(mysqli_num_rows($result) != 0){
    $_SESSION['emailJaExiste'] = true;
    $con->fecharConexao();
    header('location: adm-cadastrar1.php');
    exit();
}

$query = "insert into administradores values (default,'" . $nome . "','" . $email . "','" . $senha . "');";

$con->executQuery($query);

$con->fecharConexao();

?>
<main class="container-fluid">
<h1><p> O seguinte usuário foi cadastrado com sucesso</p></h1>
    Nome: <?php echo $admNome; ?><br />
    email: <?php echo $admEmail; ?><br />
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