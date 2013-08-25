<?php
    require 'sql_get.php';
    session_start();
    ins_sql('insert into pretplata values('.$_SESSION['korisnik_id'].','.$_GET['odjel'].');');
    header('Location: ../index.php?id=odjel');exit();
?>
