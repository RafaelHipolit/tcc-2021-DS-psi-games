<?php

session_start();

session_destroy();

header('location: ../play/formlogin.php');
exit();
?>