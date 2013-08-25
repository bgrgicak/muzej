<?php
        require_once 'sql_get.php';
        $rrz=json_decode(dat_sql("select * from korisnik where uname='".$_POST['uname']."' or mail='".$_POST["mail"]."';"),true); 
        if($_POST["pass"]==$_POST["pass2"] && strlen($_POST['uname'])>=6 && strlen($_POST['pass'])>=6 && sizeof($rrz)==0 && isset($_POST['uvjet'])){
            $target_Path = '../slike/korisnici/';
            $path_info = pathinfo($_FILES["slika"]["name"]);
            $fileExtension = $path_info['extension'];
            $target_path = $target_Path . basename( $path_info['filename'].'.'.$fileExtension); 
            move_uploaded_file($_FILES['slika']['tmp_name'], $target_path);
            require_once 'virtualTime.php';
            $TM=new virtualTime();
            ins_sql("insert into korisnik values (default,
                '".$_POST["grad"]."',1,
                '".$_POST["ime"]."',
                '".$_POST["prezime"]."',
                '".$_POST["mail"]."',
                '".$_POST["uname"]."',
                '".$_POST["pass"]."',
                '".$_POST["telefon"]."',
                '".$_POST["about"]."',
                '".$_POST["rodendan"]."',
                '".$TM->getTime()."',
                '".$_POST["spol"]."',
                1,'0000-00-00 00:00:00',0,'".$path_info['filename'].".".$fileExtension."');");
            $rz=json_decode(dat_sql("select korisnik_id from korisnik where uname='".$_POST['uname']."';"),true);
            $headers = "Content-Type: text/plain;charset=UTF-8 \n";
            mail($_POST['mail'],'Muzej, potvrda mail adrese','Poštovani 
                Molimo vas da odlaskom na poveznicu aktivirate svoji korisnički račun
                http://arka.foi.hr/WebDiP/2012_projekti/WebDiP2012_024/php/potvrda.php?korisnik='.$rz[0]['korisnik_id'],$headers);
            $VT=new virtualTime();    
            $sad=$VT->getTime();
            $rez=  json_decode(dat_sql("SELECT naziv,odjel_id FROM odjel  WHERE (odjel.do>'".$sad."' or odjel.do is null or odjel.do='0000-00-00')   and (odjel.od<'".$sad."' or odjel.od is null or odjel.od='0000-00-00')"),true);
            for ($i = 0; $i < sizeof($rez); $i++) {
                if(isset($_POST['news'.$rez[$i]['odjel_id']])){
                ins_sql("insert into pretplata values(".$rz[0]['korisnik_id'].",".$_POST['news'.$rez[$i]['odjel_id']].");");
                }
            }
    header('Location: ../index.php');
    exit();
        }
        else{
            session_start();
            $_SESSION['err']=1;
            header('Location: ../index.php?id=reg');exit();
}
?>