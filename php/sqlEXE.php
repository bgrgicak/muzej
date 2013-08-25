<?php
    require 'sql_get.php';
    session_start();
    if(strtok($_POST['upit'], " ")=='select' || strtok($_POST['upit'], " ")=='show'){
        $_SESSION['sql']=json_decode(dat_sql($_POST['upit']),true);
    } 
    else{
        $_SESSION['sql1']=ins_sql($_POST['upit']);
    }
    
header('Location: ../index.php?id=Umuzej');exit();
?>