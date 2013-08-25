<?php
        session_start();
        require 'sql_get.php';
        $kki=json_decode(dat_sql("select korisnik_id from korisnik where uname='".$_SESSION["uname"]."';"),true);
        $kki=$kki[0]['korisnik_id'];
	$sql="insert into komentar values(default,now(),".$kki.",".$_SESSION['eksponat'].",'".$_POST['komentar']."');";
	ins_sql($sql);
	$e=$_SESSION['eksponat'];
	unset($_SESSION['eksponat']);
	header( 'Location: ../index.php?id=eksponat&eksponat='.$e);
    exit();
?>