<?php

require_once '../server/ConexaoBD.php';

$query = "select pk_id_adm from administradores where email = 'admin@admin';";

$con = new ConexaoDB();

$result = $con->executQuery($query);

if(mysqli_num_rows($result) == 0){
    $query = "insert into administradores values (default,'admin','admin@admin','" . md5("admin") . "');";
}else{
    $dados = mysqli_fetch_assoc($result);
    $query = "update administradores set senha = '" . md5("admin") . "' where pk_id_adm = ". $dados['pk_id_adm'] .";";
}

$con->executQuery($query);

echo "FOI!";

?>