<?php
    session_start();
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select suvenir_id from suvenir where naziv='".$_POST['naziv']."';"),true);
    if(sizeof($rez)>0){
        $_SESSION['nece']=$rez[0]['suvenir_id'];
        header( 'Location: ../index.php?id=Dsuvenir');
    exit();
    }
    else{
        $target_Path = '../slike/suveniri/';
        $path_info = pathinfo($_FILES["slika"]["name"]);
        $fileExtension = $path_info['extension'];
        $target_path = $target_Path . basename( $path_info['filename'].'.'.$fileExtension); 
        move_uploaded_file($_FILES['slika']['tmp_name'], $target_path);
        ins_sql("insert into suvenir values(default,'".$_POST['eksponat']."','".$_POST['naziv']."','".nl2br($_POST['opis'])."','".$path_info['filename'].".".$fileExtension."',".$_SESSION['korisnik_id'].");");header( 'Location: ../index.php?id=suveniri&eksponat='.$_POST['eksponat'],$_POST['cijena']);exit();}    
?>