<?php
        $rez=$_POST;
        require 'kustosZahtjev.php';
        require 'sql_get.php';
        foreach ($rez as $key => $value) {
            if($value==1){
                ins_sql("update korisnik set tip_id=2 where korisnik_id=".$key."");
            }
            dropZahtjev($key);
        }
        header('Location: ../index.php?id=Kpocetna');   
        exit();
?>