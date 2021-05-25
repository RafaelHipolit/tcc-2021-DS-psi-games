<?php

session_start();

require_once '../server/verificaloginjogador.php';

// por enquanto deixa ai
$jogadorLogado = false;
$jogadorNome = "";

if (isset($_SESSION['idJogador'])) {
  $jogadorLogado = true;
  $jogadorNome = $_SESSION['nickname'];
}



$id = $_SESSION['idJogador'];
$nome = $_SESSION['nomeJogador'];
$nick = $_SESSION['nickname'];

require_once "../server/ConexaoBD.php";
$con = new ConexaoDB();
$query = "select email from jogadores where pk_id_jogador = ". $id .";";
$result = $con->executQuery($query);

$linha = mysqli_fetch_assoc($result);
$email = $linha['email'];


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSI GAMES</title>

    <link rel="stylesheet" href="../css/cssGeral.css">
    <link rel="stylesheet" href="../css/cssJogador.css">

</head>

<body>
    <div id="backHeader">
        <header>
            <div id="headerbar">

                <div id="btnmenu-mobile">≡</div>

                <h1 id="logo">| 𝜓 〉GAMES</h1>

                <div id="barprocura-pc">
                    <form action="procurajogo.php" method="get" class="formbarproc">
                        <input class="inputtext" type="text" name="n">
                        <input type="submit" style="display: none;">
                    </form>
                    <button class="btnsubmit">
                        <img class="lupa" src="../img/Vector_search_icon.png" alt="LUPA">
                    </button>
                </div>

                <div id="btnlogin-pc" <?php if ($jogadorLogado) {
                                            echo 'style= "width: auto; padding: 0px 10px;" ';
                                        } ?>>
                    <a href="formlogin.php"> <?php if ($jogadorLogado) { echo "Olá " . $jogadorNome; } else { echo "Entrar"; } ?> </a>
                </div>

                <div id="btnlogin-mobile">
                    <img src="../img/perfil_icon_branco.png" width="40px">
                </div>

            </div>

            <div id="barprocura-mobile">
                <form action="procurajogo.php" method="get" class="formbarproc">
                    <input class="inputtext" type="text" name="n">
                    <input type="submit" style="display: none;">
                </form>
                <button class="btnsubmit">
                    <img class="lupa" src="../img/Vector_search_icon.png" alt="LUPA">
                </button>
            </div>

            <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="procurajogo.php">JOGOS</a></li>
                    <li><a href="">INFO</a></li>
                </ul>
            </nav>

        </header>
    </div>

    <div id="backMain">
        <div id="gabiarra"></div>
        <div id="back-profile">
            <div id="profile">
                <img id="perfilIcon" src="../img/perfil_icon_branco.png" alt="LUPA">
                <div id="dados">
                    <h1>Olá <?php echo $nick ?></h1>
                    <h2>Nome: <?php echo $nome ?></h2>
                    <h2>Email: <?php echo $email ?></h2>
                    <a class="btn" id="btn-editar" href="formeditajogador.php">Editar dados</a>
                    <a class="btn" id="btn-logout" href="../server/logout.php">DESLOGAR</a>
                </div>
            </div>
        </div>

        <main>

            <div class="car-titulo">Meus jogos</div>
            <div id="jogos">                            
                <?php

                $id = $_SESSION['idJogador'];
                $query = "select jogos.nome from jogos
                join car_compra_jogo on jogos.pk_id_jogo = car_compra_jogo.fk_id_jogo
                join carrinhos on car_compra_jogo.fk_id_car = carrinhos.pk_id_car
                join jogadores on carrinhos.fk_id_jogador = jogadores.pk_id_jogador
                where jogadores.pk_id_jogador = $id;";
                $result = $con->executQuery($query);

                if(mysqli_num_rows($result) != 0){

                    while ($linha = mysqli_fetch_assoc($result)) {
                        $dados[] = $linha;
                    }                                                      
            
                    for ($i = 0; $i < sizeof($dados); $i++) {
                    # code...
                ?>
                  
                        <div class="jogo">
                            <img src="../img/img_jogo_modelo.png" alt="">
                            <div class="jogo-nome">  <?php echo $dados[$i]['nome']; ?> </div>                       
                        </div>
                        
                <?php 
                    }// fecha FOR
                
                }else{
                    echo "<h2>Você ainda não possui nenhum jogo.</h2>";
                }
                ?>
            </div> 
            




            <br><br><br>  
            <div class="car-titulo">Meu Carrinho</div>                           
            <div id="carrinho-atual">

                <?php
                require_once "../server/ClassJogo.php";
                
                $precoTotal = 0;
                if(isset($_SESSION['session_carrinho'])){
                    
                    if(!empty( unserialize($_SESSION['session_carrinho']) )){

                        $arrayCarrinho = unserialize($_SESSION['session_carrinho']);
                        for ($i=0; $i < sizeof($arrayCarrinho); $i++) {                                        

                ?>
                    
                            <div class="jogo">
                                <img src="../img/img_jogo_modelo.png" alt="">
                                <div class="jogo-nome"> <?php echo $arrayCarrinho[$i]->getNome(); ?> </div>
                                <div class="jogo-preco"> <?php echo $arrayCarrinho[$i]->getPreco(); ?> </div>
                                <?php $precoTotal += $arrayCarrinho[$i]->getPreco(); ?>
                                <a class="jogo-remover" href="removejogocarrinho.php?id=<?php echo $arrayCarrinho[$i]->getId(); ?>">Remover</a>                        
                            </div>
                         
                <?php
                        }// fecha FOR

                ?>
                
                        <div class="finalizar">
                            Valor total: R$<?php echo $precoTotal ?>
                            <a href="finalizarcompra.php" id="btn-finalizar">Finalizar compra</a>                         
                        </div>
                
                <?php

                    }else{
                        echo "<h2>Você ainda não possui nenhum jogo no carrinho</h2>";
                    }

                    
                }else{
                    echo "<h2>Você ainda não possui nenhum jogo no carrinho</h2>";
                }
                
                ?>

            </div>





            <br><br><br><br>
            <h1>Meus Carrinhos anteriores</h1>
            <div id="carrinhos-ant">

            <?php
            $precoTotal = 0;

            $id = $_SESSION['idJogador'];
            $query = "select carrinhos.pk_id_car, carrinhos.data_compra from carrinhos
            join jogadores on carrinhos.fk_id_jogador = jogadores.pk_id_jogador
            where jogadores.pk_id_jogador = $id;";
            $result = $con->executQuery($query);

            if(mysqli_num_rows($result) != 0){

                while ($linha = mysqli_fetch_assoc($result)) {
                    $dados2[] = $linha;
                }  
 
                for ($i = 0; $i < sizeof($dados2); $i++) {
                # code...
                $precoTotal = 0;
            ?>      
                    <br>
                    <div class="car-titulo">Carrinho de <?php echo $dados2[$i]['data_compra']; ?></div>
                    <div class="cars-ant">

                    <?php
                    $id = $_SESSION['idJogador'];
                    $query = "select jogos.pk_id_jogo, jogos.nome, jogos.preco from jogos
                    join car_compra_jogo on jogos.pk_id_jogo = car_compra_jogo.fk_id_jogo
                    join carrinhos on car_compra_jogo.fk_id_car = carrinhos.pk_id_car
                    where carrinhos.pk_id_car = ".$dados2[$i]['pk_id_car'].";";
                    $result = $con->executQuery($query);

                    
                    while ($linha = mysqli_fetch_assoc($result)) {
                        $dados3[] = $linha;
                    }                                                      

                    for ($j = 0; $j < sizeof($dados3); $j++) {
                    # code...
                    ?>
                    
                        <div class="jogo">               
                            <img src="../img/img_jogo_modelo.png" alt="">
                            <div class="jogo-nome"> <?php echo $dados3[$j]['nome']; ?> </div>
                            <div class="jogo-preco"> <?php echo $dados3[$j]['preco']; ?> </div>
                            <?php $precoTotal += $dados3[$j]['preco']; ?>                        
                        </div>
                            
                    <?php 
                    }// fecha FOR
                    ?>



                        <div class="finalizar">
                            Valor total: R$<?php echo $precoTotal ?><br>
                            Data da compra: <?php echo $dados2[$i]['data_compra']; ?>                    
                        </div>                       
                    </div>  
                
            <?php 
                unset($dados3);
                }// fecha FOR

            }else{
                echo "Você ainda não fez nenhuma compra.";
            }
            ?>


            </div>                           
        </main>
    </div>

    <footer>
        <a href="https://github.com/cp2-dc-info-projeto-final/psi-games">Acesse o codigo da plataforma no GitHub</a>
        <a href="index.php">| 𝜓 〉GAMES</a>
    </footer>


    <div id="menulateral">
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="procurajogo.php">JOGOS</a></li>
                <li><a href="">INFO</a></li>
            </ul>
        </nav>

        <div id="menulateral-fechar">
            FECHAR <br> MENU <br> LATERAL
        </div>

    </div>


    <div id="loginlateral">
        <?php
        $msgLogado = "Olá " . $jogadorNome . "<br><br> Clique aqui para entrar no seu perfil";
        $msgNaoLogado = "Você não esta logado <br><br> Clique aqui para <br> Entrar na sua conta <br> ou criar uma";
        ?>
        <a href="formlogin.php"> <?php if ($jogadorLogado) {
                                        echo $msgLogado;
                                    } else {
                                        echo $msgNaoLogado;
                                    } ?> </a>

        <div id="loginlateral-fechar">
            FECHAR <br> MENU <br> LATERAL
        </div>
    </div>

    <script src="../js/jsGeral.js"></script>

</body>

</html>