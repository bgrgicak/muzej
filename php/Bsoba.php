<?php
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select odjel_id from soba where soba_id=".$_GET['soba'].";"),true);
    ins_sql('delete from soba where soba_id='.$_GET['soba']);
    header( 'Location: ../index.php?id=odjel&odjel='.$rez[0]['odjel_id']);
    exit();
?>