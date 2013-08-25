<?php
	require 'sql_get.php';
        $brj=json_decode(dat_sql("select opomena from korisnik where korisnik_id=".$_GET['korisnik'].";"),true);
        $br=$brj[0]['opomena'];
        $br++;
        ins_sql("update korisnik set opomena=".$br." where korisnik_id=".$_GET['korisnik'].";");
        ins_sql("insert into zahtjev values(".$_GET['korisnik'].",2);");
        if($br>=3)
            ins_sql("insert into zahtjev values(".$_GET['korisnik'].",3);");
        header('Location: ../index.php?id=eksponat&eksponat='.$_GET["eksponat"]);
?>