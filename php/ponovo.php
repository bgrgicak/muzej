<?php
    require 'sql_get.php';
    require 'virtualTime.php';
    $TM=new virtualTime();
    ins_sql("update korisnik set datum_reg='".$TM->getTime()."' where uname='".$_GET['uname']."';");
    $headers = "Content-Type: text/plain;charset=UTF-8 \n";
    mail($_POST['mail'],'Muzej, potvrda mail adrese','Poštovani 
        Molimo vas da odlaskom na poveznicu aktivirate svoji korisnički račun
        http://arka.foi.hr/WebDiP/2012_projekti/WebDiP2012_024/php/potvrda.php?uname='.$_POST['uname'],$headers);
    header('Location: ../index.php');
    exit();
?>