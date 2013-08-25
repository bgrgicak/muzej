<?php
    session_start();
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select naziv,odjel_id from odjel where naziv='".$_POST['naziv']."';"),true);
    require_once 'virtualTime.php';
    $VT=new virtualTime();
    if(sizeof($rez)>0){
        $_SESSION['nece']=$rez[0]['soba_id'];header( 'Location: ../index.php?id=Dsoba');exit();}
    else{
        ins_sql("insert into soba values(default,".$_POST['odjel'].",'".$_POST['naziv']."','".$VT->getTime()."','".nl2br($_POST['opis'])."','".$_POST['tag']."',".$_SESSION['korisnik_id'].",'".$_POST['od']."','".$_POST['do']."');");
        $idi=json_decode(dat_sql("select o.odjel_id,o.naziv,s.soba_id from soba s,odjel o where s.naziv='".$_POST['naziv']."';"),true);
        $odi=json_decode(dat_sql("select k.mail from korisnik k,pretplata p where k.korisnik_id=p.korisnik and p.odjel=".$idi[0]['odjel_id'].";"),true);
        for ($i = 0; $i < sizeof($odi); $i++) {
            mail($odi[$i]['mail'],'Pretplata Muzej','Dostupni su novi sadržaji u odjelu '.$idi[0]['naziv'].'. Moguče ih je pregledati na sljedećoj poveznici: http://arka.foi.hr/WebDiP/2012_projekti/WebDiP2012_024/index.php?id=soba&soba='.$idi[0]['soba_id']);
        }
        header( 'Location: ../index.php?id=soba&soba='.$idi[0]['soba_id']);exit();
    }?>