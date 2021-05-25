<?php

session_start(); // inicia o sistema de sessao - usado para autentificar o login

require_once "../server/verificaloginadm.php"; // faca o require_once desse arquivo para permitir que somente que quem ja esteja logado como ADM possa entrar nessa pagina
// - ATENÇÃO PARA ISSO FUNCIONAR VC TEM QUE TER CHAMADO ANTES O session_start()

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seção do ADM</title>


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



        <ul>
            <li><a href="area-adm.php"><button type="button" class="btn btn-secondary btn-lg">admin</button></a></br></li>
            <li><a href="area-jogador.php"><button type="button" class="btn btn-secondary btn-lg">jogadores</button></a></br></li>
            <li><a href="area-jogos"><button type="button" class="btn btn-secondary btn-lg">jogos</button></a></br></li>
        </ul>




        <a href="area-adm.php" class="btn btn-secondary btn-lg">admin</a>
        <a href="area-jogador.php" class="btn btn-secondary btn-lg">jogadores</a>
        <a href="area-jogos" class="btn btn-secondary btn-lg">jogos</a>

        <p>Exemplo abaixo - apagar depois</p>


        <?php


        // EXEMPLO DE COMO FAZER UMA CONEXAO COM O BANCO DE DADOS E EXECUTAR COMANDOS SQL

        require_once "../server/ConexaoBD.php"; // inclui o arquivo que faz a conexão

        $con = new ConexaoDB(); // realiza a conexao - aqui endiante vc esta conectado com o bando de dados pela variavel $con

        $query = "select pk_id_adm, nome, email from administradores;"; // comando SQL para ser executado

        $result = $con->executQuery($query); // executa o comando, SE tiver dados para retonar as informcoes vao para a variavel $result
        // ATENÇÃO a variavel $result é um array complexo e não podemos pega os resultados acessando ele diretamente - temos que utilizar metodos para pegar os dados que queremos do $result

        //var_dump($result);

        $numLinha = mysqli_num_rows($result); // retorna o numero de linhas da dados 

        // COMO PEGA OS INFORMAÇOES DO $result - forma que normalmente se faz:

        while ($linha = mysqli_fetch_assoc($result)) {
            echo "ID :" . $linha['pk_id_adm'] . "<br>";
            echo "Nome :" . $linha['nome'] . "<br>";
            echo "Email :" . $linha['email'] . "<br>";
            echo "=======================================<br>";
        }

        // - forma como EU (rafael) gosto de fazer

        echo "<br><br><br>";

        $result = $con->executQuery($query);

        while ($linha = mysqli_fetch_assoc($result)) {
            $dados[] = $linha;
        }

        for ($i = 0; $i < sizeof($dados); $i++) {
            echo "ID :" . $dados[$i]['pk_id_adm'] . "<br>";
            echo "Nome :" . $dados[$i]['nome'] . "<br>";
            echo "Email :" . $dados[$i]['email'] . "<br>";
            echo "=======================================<br>";
        }

        // ATENÇÃO!!!!!!!!!
        // DEPOIS QUE VC NÃO FOR MAIS FAZER REQUERIMENTOS DO BANCO DE DADOS, NÃO ESQUEÇA DE FECHAR A CONEXAO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $con->fecharConexao(); // fecha a conexao com o banco de dados



        ?>

        <br>
        <a href="../server/logout.php">DESLOGAR</a>

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