<?php
    session_start();
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select eksponat_id from eksponat where naziv='".$_POST['naziv']."';"),true);
    require_once 'virtualTime.php';
    $VT=new virtualTime();
    if(sizeof($rez)>0){
        $_SESSION['nece']=$rez[0]['eksponat_id'];
        header( 'Location: ../index.php?id=Deksponat');
    exit();
    }
    else{
        if(isset($_POST['javno']))
            $bol=1;
        else
            $bol=0;
        $target_Path = '../slike/eksponati/';
        $path_info = pathinfo($_FILES["slika"]["name"]);
        $fileExtension = $path_info['extension'];
        $target_path = $target_Path . basename( $path_info['filename'].'.'.$fileExtension); 
        move_uploaded_file($_FILES['slika']['tmp_name'], $target_path);
        ins_sql("insert into eksponat values(default,'".$_POST['soba']."','".$_POST['naziv']."','".nl2br($_POST['opis'])."','".$VT->getTime()."',".$bol.",0,'".$_POST['od']."','".$_POST['do']."','".$path_info['filename'].".".$fileExtension."','".$_POST['autor']."','".$_POST['tag']."',".$_SESSION['korisnik_id'].");");
        $idi=json_decode(dat_sql("select odjel_id,naziv from soba where soba_id=".$_POST['soba'].";"),true);
        $odi=json_decode(dat_sql("select k.mail from korisnik k,pretplata p where k.korisnik_id=p.korisnik and p.odjel=".$idi[0]['odjel_id'].";"),true);
        for ($i = 0; $i < sizeof($odi); $i++) {
            mail($odi[$i]['mail'],'Pretplata Muzej','Dostupni su novi sadržaji u odjelu '.$idi[0]['naziv'].'. Moguče ih je pregledati na sljedećoj poveznici: http://arka.foi.hr/WebDiP/2012_projekti/WebDiP2012_024/index.php?id=soba&soba='.$_POST['soba']);
        }
        header( 'Location: ../index.php?id=soba&soba='.$_POST['soba']);exit();}?>