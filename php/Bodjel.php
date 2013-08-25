<?php
    require_once 'sql_get.php';
    ins_sql('delete from odjel where odjel_id='.$_GET['odjel']);
    header( 'Location: ../index.php?id=odjel');
    exit();
?>