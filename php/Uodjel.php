<?php
    require_once 'sql_get.php';
    if(isset($_POST['javno']))
        $bol=1;
    else
        $bol=0;
    ins_sql("update odjel set naziv='".$_POST['naziv']."', opis='".nl2br($_POST['opis'])."', javno=".$bol.", od='".$_POST['od']."', do='".$_POST['do']."', tag='".$_POST['tag']."' where odjel_id=".$_POST['odjel_id'].";");
    header( 'Location: ../index.php?id=odjel');
    exit();
?>