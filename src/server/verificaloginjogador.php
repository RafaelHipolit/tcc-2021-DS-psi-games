<?php

if(!isset($_SESSION['idJogador'])){
    header('location: ../play/formlogin.php');
    exit();
}

?>