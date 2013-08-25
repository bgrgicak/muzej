<?php
        $rez=$_POST;
        require 'sql_get.php';
        require 'virtualTime.php';
        $VT=new virtualTime();
        foreach ($rez as $key => $value) {
            if($value<>''){
                ins_sql("update korisnik set zamrznuto=addtime('".$VT->getTime()."','".$value.":00') where korisnik_id=".$key.";");
            }
            ins_sql("delete from zahtjev where zahtjev=2 and korisnik=".$key.";");
        }
        header('Location: ../index.php?id=Kpocetna');   
        exit();
?>