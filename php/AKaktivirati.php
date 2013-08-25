<?php
        $rez=$_POST;
        require 'sql_get.php';
        require 'virtualTime.php';
        $VT=new virtualTime();
        foreach ($rez as $key => $value) {
            if($value<>''){
                ins_sql("update korisnik set blokiran=0 where korisnik_id=".$key.";");
            }
            ins_sql("delete from zahtjev where zahtjev=4 and korisnik=".$key.";");
        }
        header('Location: ../index.php?id=Kpocetna');   
        exit();
?>