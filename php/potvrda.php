<?php
	require 'sql_get.php';
        require 'virtualTime.php';
        $TM=new virtualTime();
        $rez=json_decode(dat_sql("select DATE_ADD(datum_reg, INTERVAL 24 HOUR ) as dt from korisnik where korisnik_id='".$_GET['korisnik']."';"),true);
        if($rez[0]['dt']>$TM->getTime()){
            ins_sql('update korisnik set blokiran=0');
            header('Location: ../index.php?id=prijava');
    exit();
        }
        else{
            echo 'isteklo vam je vrijeme za aktivaciju';
            echo '<br><a href="ponovo.php?korisnik="'.$_GET['korisnik'].'">Ponovo pošalji mail</a>';
        }
?>