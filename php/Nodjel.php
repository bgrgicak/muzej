<?php session_start();
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select naziv,odjel_id from odjel where naziv='".$_POST['naziv']."';"),true);
    require_once 'virtualTime.php';
    $VT=new virtualTime();
    if(sizeof($rez)>0){
        $_SESSION['nece']=$rez[0]['odjel_id'];header('Location: ../index.php?id=Dodjel');exit();}
    else{
        if(isset($_POST['javno']))
            $bol=1;
        else
            $bol=0;
    ins_sql("insert into odjel values(default,'".$_POST['naziv']."','".nl2br($_POST['opis'])."','".$VT->getTime()."',".$bol.",'".$_POST['tag']."',".$_SESSION['korisnik_id'].",'".$_POST['od']."','".$_POST['do']."');");header( 'Location: ../index.php?id=odjel&odjel='.$rez[0]['odjel_id']);exit();}?>