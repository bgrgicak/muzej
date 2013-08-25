<?php
    require 'virtualTime.php';
    $VT=new virtualTime();
    if($_POST['vrijeme']<>'')
        $VT->setTime($_POST['vrijeme']);
    header( 'Location: ../index.php?id=Umuzej');exit();
?>