<?php
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select soba_id,slika from eksponat where eksponat_id=".$_GET['eksponat'].";"),true);
    ins_sql('delete from eksponat where eksponat_id='.$_GET['eksponat']);
    unlink('../slike/eksponati/'.$rez[0]['slika']);
    header( 'Location: ../index.php?id=soba&soba='.$rez[0]['soba_id']);
    exit();
?>