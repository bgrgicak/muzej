<?php
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select ocjena from eksponat where eksponat_id=".$_GET['eksponat'].";"),true);
    $bod=($rez[0]['ocjena']+$_GET['bod'])/2;
    ins_sql("update eksponat set ocjena=".$bod." where eksponat_id=".$_GET['eksponat'].";");
    header("Location: ../index.php?id=eksponat&eksponat=".$_GET['eksponat']);
    exit();
?>