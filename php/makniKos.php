<?php
    session_start();
    $pom=array();
    for($i=0;$i<sizeof($_SESSION['kosarica']);$i++)
        if($i!=$_GET['id'])
            array_push($pom,$_SESSION['kosarica'][$i]);
    $_SESSION['kosarica']=$pom;
    if(sizeof($_SESSION['kosarica'])<=0){
        unset($_SESSION['kosarica']);
    }
    header('Location: ../index.php?id=kosarica');
    exit();
?>