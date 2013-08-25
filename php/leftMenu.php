<?php
    function javno($id){
        echo "<br><a href='index.php?id=Jodjel' class='button2'>Odjeli</a><br>";
        if($id=='Jodjel' || $id=='Jsoba' || $id=='Jeksponat'){
            include 'virtualTime.php';
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            $rez=json_decode(dat_sql("SELECT odjel_id,naziv FROM odjel WHERE javno =1  and (odjel.do>'".$sad."' or odjel.do is null or odjel.do='0000-00-00')   and (odjel.od<'".$sad."' or odjel.od is null or odjel.od='0000-00-00')"),true);
            if($id=='Jeksponat')
                $sob=json_decode(dat_sql('SELECT s.odjel_id FROM eksponat e,soba s WHERE e.soba_id=s.soba_id and e.eksponat_id='.$_GET['eksponat'].';'),true);
            for($i=0;$i<sizeof($rez);$i++){
                echo '<a href="index.php?id=Jsoba&odjel=';
                echo $rez[$i]['odjel_id'];
                echo '" class="button3">  ';
                echo $rez[$i]['naziv'];
                echo '</a><br>';
                
            }
        }
        if($id=='prijava')
            echo "<a href='index.php?id=reg' class='button2'>Registracija</a><br>";
        else if($id=='reg')
            echo "<a href='index.php?id=prijava' class='button2'>Prijava</a><br>";
        else {
            echo "<a href='index.php?id=reg' class='button2'>Registracija</a><br>";
            echo "<a href='index.php?id=prijava' class='button2'>Prijava</a><br>";
        }
    }
    function korisnik($id){
        echo "<br><a href='index.php?id=odjel' class='button2'>Odjeli</a><br>";
        if($id=='odjel' || $id=='soba' || $id=='eksponat' || $id=='suveniri'){
            include 'virtualTime.php';
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            if(isset($_SESSION['tip']) && ($_SESSION['tip']==2 || $_SESSION['tip']==3))
                $rez=json_decode(dat_sql('SELECT naziv,opis,odjel_id,kreirao FROM odjel'),true);
            else
                $rez=json_decode(dat_sql("SELECT naziv,opis,odjel_id,kreirao FROM odjel  WHERE (odjel.do>'".$sad."' or odjel.do is null or odjel.do='0000-00-00')   and (odjel.od<'".$sad."' or odjel.od is null or odjel.od='0000-00-00')"),true);
            if($id=='soba')
                $sob=json_decode(dat_sql('SELECT s.soba_id,s.odjel_id FROM soba s WHERE s.soba_id='.$_GET['soba'].';'),true);
            else if($id=='eksponat' || $id=='suveniri')
                $sob=json_decode(dat_sql('SELECT s.soba_id,s.odjel_id FROM soba s,eksponat e WHERE s.soba_id=e.soba_id and e.eksponat_id='.$_GET['eksponat'].';'),true);
            for($i=0;$i<sizeof($rez);$i++){
                echo '<a href="index.php?id=odjel&odjel=';
                echo $rez[$i]['odjel_id'];
                echo '" class="button3">  ';
                echo $rez[$i]['naziv'];
                echo '</a><br>';
                if($id=='odjel' && isset($_GET['odjel']) && $rez[$i]['odjel_id']==$_GET['odjel']){
                    $sad=$VT->getTime();
                    if(isset($_SESSION['tip']) && ($_SESSION['tip']==2 || $_SESSION['tip']==3))
                        $sql="SELECT soba.naziv,soba.soba_id FROM soba  WHERE soba.odjel_id=".$rez[$i]['odjel_id']." ;";
                    else
                        $sql="SELECT soba.naziv,soba.soba_id FROM soba  WHERE soba.odjel_id=".$rez[$i]['odjel_id']."  and (soba.do>'".$sad."' or soba.do is null or soba.do='0000-00-00')   and (soba.od<'".$sad."' or soba.od is null or soba.od='0000-00-00');";
                    $rez2=json_decode(dat_sql($sql),true);
                    for($j=0;$j<sizeof($rez2);$j++){
                        echo '<a href="index.php?id=soba&soba=';
                        echo $rez2[$j]['soba_id'];
                        echo '" class="button4">  ';
                        echo $rez2[$j]['naziv'];
                        echo '</a><br>';
                    }
                }
                if(($id=='soba' || $id=='eksponat' || $id=='suveniri') && $rez[$i]['odjel_id']==$sob[0]['odjel_id'] ){
                    $VTT=new virtualTime; 
                    $sad=$VTT->getTime();
                    $sql="SELECT soba.naziv,soba.soba_id FROM soba  WHERE soba.odjel_id=".$rez[$i]['odjel_id'].";";
                    $rez2=json_decode(dat_sql($sql),true);
                    for($j=0;$j<sizeof($rez2);$j++){
                        echo '<a href="index.php?id=soba&soba=';
                        echo $rez2[$j]['soba_id'];
                        echo '" class="button4">  ';
                        echo $rez2[$j]['naziv'];
                        echo '</a><br>';
                    }
                }
            }
        }
        if(isset($_SESSION['tip'])){
                echo "<a href='index.php?id=galerija' class='button2'>Galerija</a><br>";
                if($_SESSION['tip']==1)
                    echo "<a href='index.php?id=kustosZ' class='button2'>Želim biti kustos</a><br>";
            
            if($_SESSION['tip']==2 || $_SESSION['tip']==3){
                echo "<a href='index.php?id=Dodjel' class='button2'>Dodaj odjel</a><br>";
                if(isset($_GET['soba']))
                    echo "<a href='index.php?id=Deksponat&soba=".$_GET['soba']."' class='button2'>Dodaj eksponat</a><br>";
                else if(isset($_GET['odjel']))
                    echo "<a href='index.php?id=Dsoba&odjel=".$_GET['odjel']."' class='button2'>Dodaj sobu</a><br>";
                else if(isset($_GET['eksponat']) && $_GET['id']=='suveniri')
                    echo "<a href='index.php?id=Dsuvenir&eksponat=".$_GET['eksponat']."' class='button2'>Dodaj suvenir</a><br>";
            }
            if($_SESSION['tip']==3){
                echo "<a href='index.php?id=Ukorisnik' class='button2'>Uredi korisnike</a><br>";
                echo "<a href='index.php?id=Umuzej' class='button2'>SQL i vrijeme</a><br>";
                
            }
        }
    }
?>

                   