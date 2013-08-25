<?php
        $rez=$_POST;
        require 'sql_get.php';
        require 'virtualTime.php';
        $VT=new virtualTime();
        foreach ($rez as $key => $value) {
            if($value<>''){
                ins_sql("update korisnik set zamrznuto='9999-12-31 23:59:59' where korisnik_id=".$key.";");
            }
            ins_sql("delete from zahtjev where zahtjev=3 and korisnik=".$key.";");
        }
        header('Location: ../index.php?id=Kpocetna');   
        exit();
?>