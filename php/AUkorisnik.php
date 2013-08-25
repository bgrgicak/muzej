<?php
require 'sql_get.php';
if($_POST['TP']=='Uredi'){
    ins_sql("update korisnik set tip_id=".$_POST['tip'].", blokiran=".$_POST['blok']." where korisnik_id=".$_POST['korisnik'].";");
header('Location: ../index.php?id=Kpocetna');exit();
}
 elseif ($_POST['TP']=='Pregled podataka') {
header('Location: ../index.php?id=Akpregled&korisnik='.$_POST['korisnik']);exit();
}
else{
    ins_sql("delete from korisnik where korisnik_id=".$_POST['korisnik'].";");
header('Location: ../index.php?id=Kpocetna');exit();
}
?>