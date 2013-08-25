<?php
    if(isset($_POST["uname"]) || isset($_POST["pass"])){
        session_start();
        require_once 'sql_get.php';
        require_once 'virtualTime.php';
        $VT=new virtualTime();
        $rrt=json_decode(dat_sql("select * from korisnik where uname='".$_POST['uname']."' and  pass='".$_POST['pass']."' and blokiran=0 and (zamrznuto<'".$VT->getTime()."' or zamrznuto='0000-00-00 00:00:00');"),true);
        if(sizeof($rrt) ==1){ 
            if(isset($_POST["pamti"]) && $_POST["pamti"]==true){
                include 'cookieTime.php';
                setKolacic('muzej_name',$_POST["uname"]);
                setKolacic('muzej_pass',$_POST["pass"]);
            }
            $_SESSION['uname']=$_POST["uname"];
            $RZ=json_decode(dat_sql("select tip_id,korisnik_id from korisnik where uname='".$_POST["uname"]."';"),true);
            $_SESSION['tip']=$RZ[0]['tip_id'];
            $_SESSION['korisnik_id']=$RZ[0]['korisnik_id'];
            header( 'Location: ../index.php?id=Kpocetna');
            exit();
        }
        else {
            if(!isset($_SESSION['logE']))
                $_SESSION['logE']=1;
            else 
                $_SESSION['logE']=$_SESSION['logE']+1;
            if($_SESSION['logE']>=3){
                $rez=json_decode(dat_sql("select korisnik_id as id from korisnik where uname='".$_POST["uname"]."';"),true);
                if($rez[0]<>''){
                    ins_sql("update korisnik set blokiran=1 where uname=".$_POST["uname"].";");
                    ins_sql("insert into zahtjev values(".$rez[0]['id'].",4);");
                }
            }
            header( 'Location: ../index.php?id=prijava');
        }
    }
?>