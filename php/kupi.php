<?php
    session_start();
    unset($_SESSION['kosarica']);
    $_SESSION['kos']=1;
    header('Location: ../index.php?id=kosarica');
    exit();
?>