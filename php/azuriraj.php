<?php
    session_start();
    $sql='Update korisnik set ';
    if($_POST['ime']!=null){
        $sql=$sql."ime='".$_POST['ime']."', ";
    }
    if($_POST['prezime']!=null)
        $sql=$sql."prezime='".$_POST['prezime']."', ";
    if($_POST['grad']!=null)
        $sql=$sql."grad='".$_POST['grad']."', ";
    if($_POST['mail']!=null)
        $sql=$sql."mail='".$_POST['mail']."', ";
    if($_POST['uname']!=null)
        $sql=$sql."uname='".$_POST['uname']."', ";
    if($_POST['pass']!=null)
        $sql=$sql."pass='".$_POST['pass']."', ";
    if($_POST['ime']!=null)
        $sql=$sql."about='".$_POST['about']."', ";
    if($_POST['rodendan']!=null)
        $sql=$sql."rodenje='".$_POST['rodendan']."', ";
    if($_POST['spol']!=null)
        $sql=$sql."spol='".$_POST['spol']."', ";
    if($_POST["news"]!=null)
        $sql=$sql."pretplati='".$_POST['news']."' ";
    $sql=$sql." where uname='".$_SESSION['uname']."';";
    if($_POST['uname']!=null){
        $_COOKIE['muzej_name']=$_POST['uname'];
        $_SESSION['uname']=$_POST['uname'];
    }
    include 'sql_get.php';
    ins_sql($sql);
    header('Location: ../index.php?id=Kpocetna');
    exit();
?>