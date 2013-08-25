<?php
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select * from suvenir where suvenir_id=".$_GET['suvenir'].";"),true);
    ins_sql('delete from suvenir where suvenir_id='.$_GET['suvenir']);
    unlink('../slike/suveniri/'.$rez[0]['slika']);
    header( 'Location: ../index.php?id=suveniri&eksponat='.$rez[0]['eksponat_id']);
    exit();
?>