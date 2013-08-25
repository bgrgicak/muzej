<?php
    
    require_once 'sql_get.php';
    ins_sql('delete from galeria where korisnik_id='.$_GET['korisnik'].' and eksponat_id='.$_GET['eksponat'].';');
    header('Location: ../index.php?id=galerija');
    exit();
?>