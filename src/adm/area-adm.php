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
    <title>area do adm</title>
</head>
<body>

<h1>Listar administradores</h1>


<?php
require_once "../server/ConexaoBD.php"; 
    $con = new ConexaoDB(); 
    $query = "select * from administradores;";
    $result = $con->executQuery($query); 
    //$numLinha = mysqli_num_rows($result); 
    //echo"Cadastrar administrador</br>" ;    
    //echo"Listar administradores";
    //echo "</br></br></br>";
    //$result = $con->executQuery($query);    
   
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
/*
while ($linha = mysqli_fetch_assoc($result)) {
    $dados[] = $linha;
}
for ($i = 0; $i < sizeof($dados); $i++) {
    echo "ID :" . $dados[$i]['pk_id_adm'] . "<br>";
    echo "Nome :" . $dados[$i]['nome'] . "<br>";
    echo "Email :" . $dados[$i]['email'] . "<br>";
    echo "=======================================<br>";
}

*/
echo "</br></br></br>";
echo"consultar por id";
printf("<input type='text' name='id'/>");

$sql = "SELECT * FROM administradores WHERE pk_id_adm = $codigo";

//$consulta = mysqli_query($mysqli, $sql);

$con = new ConexaoDB(); 
$consulta = $con->executQuery($sql);

if (mysqli_num_rows($consulta) == 0)
    echo "Administrados não cadastrado com esse ID";
else
{
 $linha = mysqli_fetch_array($consulta);
 $n = $linha["nome"];
 $d = $linha["email"];
 echo "Nome: $n<br />";
 echo "E-mail: $d<br />";
}
echo "</br></br></br>";
echo"altenar administrador";

echo "</br></br></br>";
echo"Excluir administradores"; //ainda em construção

$con->fecharConexao();
?>

<a href="http://localhost/psi-games/src/adm/administrador.php">Retornar</a>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
