<?php
    require 'sql_get.php';
    $rez=json_decode(dat_sql("select uname, pass from korisnik where mail='".$_POST['mail']."'"),true);
    if(sizeof($rez)>0){
        $headers = "Content-Type: text/plain;charset=UTF-8 \n"; 
        mail($_POST['mail'],'podaci za prijavu','Podaci za prijavu su:
            Korisnicko ime: '.$rez[0]['uname'].'
            Lozinka: '.$rez[0]['pass'].'
            Ponovite prijavu: http://arka.foi.hr/WebDiP/2012_projekti/WebDiP2012_024/index.php?id=prijava',$headers);
    }
    header('Location: ../index.php?id=prijava');
    exit();
?>
