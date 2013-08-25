<?php
    session_start();
    if(!isset($_SESSION['kosarica'])){
        $ara=array($_GET['id']);
        $_SESSION['kosarica']= $ara;}
    else {
        array_push($_SESSION['kosarica'],$_GET['id']);
        
    }
    header('Location: ../index.php?id=kosarica');
    exit();
?>