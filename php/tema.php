<?php
function tema(){
    include 'php/cookieTime.php';
    include 'php/sql_get.php';
        echo '<html class="HTML">';
            echo '<head>';
               //echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">';
                    //echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">';
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="stylesheet" href="css/temaPHP.css" type="text/css" />';
                 echo '<title>Muzej</title>';
            echo '</head>';
            echo '<body class="BODY">';
                echo "<div id='box' class='box'>";
                    echo '<header id="menuTop" class="menuTop">';
                        if(!isset($_GET["search"]) && !isset($_GET["Kid"]) && (!isset($_GET["id"])  || $_GET["id"]=='odjavio' ||  $_GET["id"]=='reg' || $_GET["id"]=='prijava' || $_GET["id"]=='Jeksponat' || $_GET["id"]=='Jsoba' || $_GET["id"]=='Jodjel' || isset($_GET["Jsearch"]))){
                            echo "<a href='index.php' class='button1'>Početna</a>";
                        }
                        else{
                            echo "<a href='index.php?id=Kpocetna' class='button1'>Početna</a>";
                        }
                        echo '<form action="index.php" method="get">';
                        if(!isset($_GET["search"]) && (!isset($_GET["id"]) || $_GET["id"]=='reg' || $_GET["id"]=='prijava' || $_GET["id"]=='odjavio' || $_GET["id"]=='Jodjel' || isset($_GET["Jsearch"]) || $_GET["id"]=='Jeksponat'  || $_GET["id"]=='Jsoba'))
                            echo "<input type='text' name='Jsearch' class='searchINP'>";
                        else {
                            echo "<input type='text' name='search' class='searchINP'>";
                        }
                        echo "<input type='submit' value='Traži' src='slike/search.png' class='searchBTN'>";
                        echo '</form>';
                        if(!isset($_GET["search"]) && (!isset($_GET["id"]) || isset($_GET["Kid"]) || $_GET["id"]=='zaboravio' || $_GET["id"]=='reg' || $_GET["id"]=='odjavio' || $_GET["id"]=='prijava' || $_GET["id"]=='Jodjel' || $_GET["id"]=='Jeksponat' || $_GET["id"]=='Jsoba' || isset($_GET["Jsearch"])))
                            echo "<a href='index.php?id=prijava' class='topUNAME'>Prijava</a>";
                        else {
                            if(isset($_SESSION['kosarica']))
                                echo "<a href='index.php?id=kosarica' class='topKOS'>Košarica</a>";
                            echo "<a href='index.php?id=obrada' class='topUNAME'>".$_SESSION['uname']."</a>";
                            if($_GET['id']<>'odjavio')
                            echo "<a href='php/odjava.php' class='topUNAME1'>Odjava</a>";
                        }
                        if($_SESSION['tip']==3){
                            $rez=json_decode(dat_sql("select zahtjev from zahtjev;"),true);
                            if(sizeof($rez)>0)
                                echo "<a href='index.php?id=bitiKus' class='topZAH'>".sizeof($rez)."</a>";
                        }
                    echo '</header>';
                    //LEFT MENI OVDJE
                    echo '<nav id="menuLeft" class="menuLeft">';
                        require_once 'leftMenu.php';
                        if ((!isset($_GET["id"]) ||  $_GET["id"]=='zaboravio' || $_GET['id']=='odjavio' || isset($_GET["Kid"])) && !isset($_GET["search"]) )
                            javno('main');
                        elseif (isset($_GET["search"])) {
                            korisnik('search');
                        }
                        else if(!isset ($_GET["search"]) && ( isset($_GET["id"]) && ($_GET["id"]=='prijava' || $_GET["id"]=='reg' || $_GET["id"]=='Jsearch' || $_GET["id"]=='Jodjel' || $_GET["id"]=='Jsoba'  || $_GET["id"]=='Jeksponat' ))){
                            javno($_GET["id"]);
                        }
                        else if ($_GET["id"]== 'veza' || $_GET["id"]== 'Kpocetna' || $_GET["id"]== 'Umuzej'  || $_GET["id"]=='Akpregled' || isset ($_GET["search"]) || $_GET['id']=='odjel' || $_GET['id']=='soba' || $_GET['id']=='eksponat' || $_GET['id']=='kosarica' || $_GET['id']=='suveniri' || $_GET['id']=='obrada' || $_GET['id']=='galerija' || $_GET['id']=='kustosZ' || $_GET['id']=='Dodjel'  || $_GET['id']=='Uodjel'  || $_GET['id']=='Dsoba'  || $_GET['id']=='Usoba' || $_GET['id']=='Deksponat'  || $_GET['id']=='Ueksponat' || $_GET['id']=='Ukorisnik'  || $_GET['id']=='Auredi' || $_GET['id']=='Dsuvenir' || $_GET['id']=='Usuvenir' || $_GET['id']=='bitiKus') {
                                korisnik($_GET["id"]);
                        }
                    echo '</nav>';

                    echo '<section id="main" class="main">';
                        require_once 'php/Main.php';
                        if((!isset($_GET["id"]) || $_GET["id"]=='odjavio') && !isset($_GET["Jsearch"]) && !isset($_GET["search"])){
                            pocetna();
                        }
                        else if(isset($_GET["id"])){
                            if($_GET["id"]=='prijava') {
                                      prijava();
                            }
                            else if($_GET["id"]=='reg') {
                                registracija();
                            }
                            else if($_GET["id"]==='Jodjel'){
                                Jodjel();
                            }
                            elseif ($_GET["id"]=='Jsoba') {
                                Jsoba();
                            }
                            elseif ($_GET["id"]=='Jeksponat')
                                Jeksponat();
                            if ($_GET["id"]=='Kpocetna') {
                                Kpocetna();
                            }
                            elseif ($_GET["id"]=='odjel') {
                                if(isset($_GET['odjel']))
                                    sobe();
                                else    
                                    odjel();
                            
                            }
                            elseif ($_GET["id"]=='soba') {
                                soba();
                            }
                            elseif ($_GET["id"]=='eksponat') {
                                eksponat();
                            }
                            elseif ($_GET["id"]=='obrada') {
                                obrada();
                            }
                            elseif ($_GET["id"]=='suveniri') {
                                suveniri();
                            }
                            elseif ($_GET["id"]=='kosarica') {
                                kosarica();
                            }
                            elseif ($_GET["id"]=='galerija') {
                                galerija();
                            }
                            elseif ($_GET["id"]=='kustosZ') {
                                kustosZ();
                            }
                            elseif ($_GET["id"]=='Dodjel') {
                                Dodjel();
                            }
                            elseif ($_GET["id"]=='Uodjel') {
                                Uodjel();
                            }
                            elseif ($_GET["id"]=='Dsoba') {
                                Dsoba();
                            }
                            elseif ($_GET["id"]=='Usoba') {
                                Usoba();
                            }
                            elseif ($_GET["id"]=='Deksponat') {
                                Deksponat();
                            }
                            elseif ($_GET["id"]=='Ueksponat') {
                                Ueksponat();
                            }
                            elseif ($_GET["id"]=='bitiKus') {
                                bitKus();
                            }
                            elseif ($_GET["id"]=='Ukorisnik') {
                                Ukorisnik();
                            }
                            elseif ($_GET["id"]=='Dsuvenir') {
                                Dsuvenir();
                            }
                            elseif ($_GET["id"]=='Usuvenir') {
                                Usuvenir();
                            }
                            elseif ($_GET["id"]== 'veza') {
                                Uveze();
                            }
                            elseif ($_GET["id"]=='Akpregled') {
                                Akpregled();
                            }
                            elseif ($_GET["id"]== 'Umuzej') {
                                Umuzej();
                            }
                            elseif($_GET["id"]=='zaboravio'){
                                zaboravio();
                            }
                        }
                        else if(isset ($_GET['search'])){
                            search();}
                        else if(isset ($_GET['Jsearch']))
                            Jsearch();
                        
                    echo'</section>';

                    echo '<footer id="foot" class="foot"><a href="dokumentacija.html" class="button8">Berislav Grgičak</a>';
                    if(isset($_GET['id']) && $_GET['id']=='kosarica' &&  $_GET["id"]<>'zaboravio')
                        echo '<a href="php/kupi.php" class="button7">Kupi</a>';
                    else if(isset($_GET['id']) && $_GET['id']=='galerija' && !isset($_GET['Kid']))
                        echo '<a href="https://www.facebook.com/sharer/sharer.php?u=http://arka.foi.hr/WebDiP/2012_projekti/WebDiP2012_024/php/face.php?kor='.$_SESSION['korisnik_id'].'" class="button7" target="_blank">Share</a>';
                    echo '</pre></footer>';


                echo "</div>"; 
        echo '</body>';

    }    