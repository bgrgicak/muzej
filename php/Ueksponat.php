<?php
    require_once 'sql_get.php';
    if(isset($_POST['javno']))
        $bol=1;
    else
        $bol=0;
    ins_sql("update eksponat set naziv='".$_POST['naziv']."', opis='".nl2br(htmlspecialchars(stripslashes($_POST['opis'])))."', javno=".$bol.", od='".$_POST['od']."', do='".$_POST['do']."', autor='".$_POST['autor']."', tag='".$_POST['tag']."' where eksponat_id=".$_POST['eksponat'].";");
    header( 'Location: ../index.php?id=eksponat&eksponat='.$_POST['eksponat']);
    exit();
?>