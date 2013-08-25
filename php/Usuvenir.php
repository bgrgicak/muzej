<?php
    require_once 'sql_get.php';
    ins_sql("update suvenir set naziv='".$_POST['naziv']."',opis='".nl2br($_POST['opis'])."' cijena=".$_POST['cijena']." where suvenir_id=".$_POST['suvenir']."");
    header( 'Location: ../index.php?id=suveniri&eksponat='.$_POST['eksponat']);exit();
?>