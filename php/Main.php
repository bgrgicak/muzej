<?php
    function prijava(){
        if(isset($_SESSION['logE'])){
            echo 'Pogrešno ste unjeli lozinku, korisničko ime ili vam je račun blokiran!';
            if($_SESSION['logE']>=3)
                unset($_SESSION['logE']);
        }
        echo '<form action="php/provjera.php" method="post">
                 <table class="centar">';
                    if(getKolacic('muzej_name')!=null)
                            echo '
                    <tr>
                        <td><div class="labela">Korisničko ime</div></td>
                        <td><input type="text" name="uname" value="'.getKolacic('muzej_name').'"></input></td>
                    </tr><tr>
                        <td><div class="labela">Lozinka</div></td>
                        <td><input type="password" name="pass" value="'.getKolacic('muzej_pass').'"></input></td>
                    </tr>';
                        else 
                            echo '
                    <tr>
                        <td><div class="labela">Korisničko ime</div></td>
                        <td><input type="text" name="uname"></input></td>
                    </tr><tr>
                        <td><div class="labela">Lozinka</div></td>
                        <td><input type="password" name="pass"></input></td>
                    </tr>';
                        
                   
                        echo ' <tr><td><div class="labela">zapamti</div></td>';
                        if(getKolacic('muzej_name')!=null)
                            echo '<td><input type="checkbox" name="pamti" checked></input></td>';
                        else 
                            echo '<td><input type="checkbox" name="pamti"></input></td>';
                        
                    echo '</tr>
                    <tr>
                        <td><input type="submit" value="Prijava"></input></td><td><a href="index.php?id=zaboravio" class="button4">Zaboravili ste lozinku?</a></td>
                    </tr>
                  </table>
              </form>';
    }
    function registracija(){
        echo '<form action="php/registracija.php" method="post" enctype="multipart/form-data">
                 <table class="centar">
                    <tr>
                        <td><label >Ime: </label></td>
                        <td><input type="text" id="ime" name="ime" required placeholder="Vaše ime"></input></td>
                        <td><label class="error" id="imeL"></label>
                    </tr>
                    <tr>
                        <td><label>Prezime: </label></td>
                        <td><input type="text" id="prezime" name="prezime" required placeholder="Vaše prezime"></input></td>
                        <td><label class="error" id="prezL"></label>
                    </tr>
                    <tr>
                        <td><label >Grad: </label></td>
                        <td class="ui-widget"><input id="grad" size="20" maxlength="40" name="grad" required placeholder="Vaše prebivalište"></td>
                    </tr>
                    <tr>
                        <td><label >Mail: </label></td>
                        <td><input type="email" id="mail" name="mail" required placeholder="Vaš e-mail"></input></td>
                        <td><label class="error" id="mailL"></label>
                    </tr>
                    <tr>
                        <td><label >Korisničko ime: </label></td>
                        <td><input type="text" name="uname" id="uname"  required pattern="[^]{6,}" placeholder="Vaša novo korisničko ime"></input></td>
                        <td><label class="error" id="unameL"></label>
                    </tr>
                    <tr>
                        <td><label >Šifra: </label></td>
                        <td><input type="password" name="pass" id="pass"  required pattern="[^]{6,}" placeholder="Vaša nova šifra" ></input></td>
                        <td><label class="error" id="passL"></label>
                    </tr>
                    <tr>
                        <td><label >Ponovite šifru: </label></td>
                        <td><input type="password" name="pass2" id="pass2"  required placeholder="Vaša ponovljena šifra"></input></td>
                    </tr>
                    <tr>
                        <td><label >Telefonski broj: </label></td>
                        <td><input type="text" name="telefon"  required pattern="\d{3}[\ ]\d{6,7}" placeholder="Vaša broj XXX XXXXXXX" ></input></td>
                        <td><label class="error" id="teL"></label>
                    </tr>
                    <tr>
                        <td><label >O vama: </label></td>
                        <td><textarea name="about" rows="12"  placeholder="O vama"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="rodendan">Datum rođenja:</label></td>
                        <td><input type="date" name="rodendan" id="rodendan" required></td>
                    </tr>

                    <tr>
                        <td><label for="spol">Spol:</label></td>
                        <td>
                            <select name="spol" id="spol"  >
                                <option value="0" selected>Odabir</option>
                                <option value="M">M</option>
                                <option value="F">Ž</option>
                            </select>
                        </td>
                        <td><label id="spolL"></label></td>
                    </tr>
                    
                    <tr>
                        <td><label for="slika">Vaša profilna slika:</label></td>
                        <td><input type="file" accept="image/*" name="slika"></td>
                    </tr>';
        require 'virtualTime.php';
                $VT=new virtualTime(); 
                $sad=$VT->getTime();
                $rez=  json_decode(dat_sql("SELECT naziv,odjel_id FROM odjel  WHERE (odjel.do>'".$sad."' or odjel.do is null or odjel.do='0000-00-00')   and (odjel.od<'".$sad."' or odjel.od is null or odjel.od='0000-00-00')"),true);
                for ($i = 0; $i < sizeof($rez); $i++) {
                    echo '<tr>
                        <td><label for="news">Pretplatite se na '.$rez[$i]['naziv'].'</label></td>
                        <td><input type="checkbox" name="news'.$rez[$i]['odjel_id'].'" value="'.$rez[$i]['odjel_id'].'" id="news"></td>
                    </tr>';
                }
                
                    echo '<tr>
                                <td>
                                      <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6LeuR8ISAAAAAMe37NNLGSMfi3-p4ffi3MIiclY-"></script>
                                      <noscript>
                                              <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LeuR8ISAAAAAMe37NNLGSMfi3-p4ffi3MIiclY-" height="300" width="500" frameborder="0"></iframe><br/>
                                              <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
                                              <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
                                      </noscript>
                              </td>
                            </tr>
                    <tr>
                        <td><label for="uvjet">Prihvaćam uvjete uporabe:</label></td>
                        <td><input type="checkbox" name="uvjet" id="uvjet"></td>
                    </tr>
                    <tr>
                        <td></td><br><td><input type="submit" value="Registracija"></input></td>
                    </tr>
                  </table>
              </form><br><br><br><br><br><br><br>';
        
    }
    function Jodjel(){
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            $rez=json_decode(dat_sql("SELECT naziv,opis,odjel_id FROM odjel WHERE javno =1 and (odjel.do>'".$sad."' or odjel.do is null or odjel.do='0000-00-00')   and (odjel.od<'".$sad."' or odjel.od is null or odjel.od='0000-00-00')"),true);
            echo '<table class="centar1">';
            echo '<tr>';
            for($i=0;$i<sizeof($rez);$i++){
                if( $i % 3==0 && $i!=0)
                    echo '</tr><br><br><tr>';
                $sl=json_decode(dat_sql("select eksponat.slika from eksponat,soba where eksponat.soba_id=soba.soba_id and soba.odjel_id=".$rez[$i]['odjel_id']." and eksponat.javno=1;"),true);
                echo '<td><a href="index.php?id=Jsoba&odjel=';
                echo $rez[$i]['odjel_id'];
                echo '" class="button6">';
                echo '<img src="./slike/eksponati/'.$sl[rand(0,(sizeof($sl)-1))]['slika'].'" class="slika"></img>';
                echo '</a><br>';
                echo '<label style="font-weight: bold;">'.$rez[$i]["naziv"].'</label><br>';
                echo $rez[$i]["opis"];
                echo '</td>';
            }
            echo '</tr></table>';
    }
    function odjel(){
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            if(isset($_SESSION['tip']) && ($_SESSION['tip']==2 || $_SESSION['tip']==3))
                $rez=json_decode(dat_sql('SELECT naziv,opis,odjel_id,kreirao FROM odjel'),true);
            else
                $rez=json_decode(dat_sql("SELECT naziv,opis,odjel_id,kreirao FROM odjel  WHERE (odjel.do>'".$sad."' or odjel.do is null or odjel.do='0000-00-00')   and (odjel.od<'".$sad."' or odjel.od is null or odjel.od='0000-00-00')"),true);
            echo '<table class="centar1">';
            echo '<tr>';
            for($i=0;$i<sizeof($rez);$i++){
                if( $i % 3==0 && $i!=0)
                    echo '</tr><br><br><tr>';
                $sl=json_decode(dat_sql("select eksponat.slika from eksponat,soba where eksponat.soba_id=soba.soba_id and soba.odjel_id=".$rez[$i]['odjel_id'].";"),true);
                echo '<td><a href="index.php?id=odjel&odjel=';
                echo $rez[$i]['odjel_id'];
                echo '" class="button6">';
                echo '<img src="./slike/eksponati/'.$sl[rand(0,(sizeof($sl)-1))]['slika'].'" class="slika"></img>';
                echo '</a><br>';
                echo '<label style="font-weight: bold;">'.$rez[$i]["naziv"].'</label><br>';
                echo $rez[$i]["opis"]; 
                $ima=json_decode(dat_sql("select * from pretplata where korisnik=".$_SESSION['korisnik_id']." and odjel=".$rez[$i]["odjel_id"].";"),true);
                if(sizeof($ima)==0)
                    echo '<br><br><a href="php/pretplati.php?odjel='.$rez[$i]['odjel_id'].'"  class="button3">Pretplati se</a>';
                    if($rez[$i]['kreirao']==$_SESSION['korisnik_id'] || $_SESSION['tip']==3){
                        echo '<br><a href="index.php?id=Uodjel&odjel='.$rez[$i]['odjel_id'].'"  class="button3">Uredi odjel</a>';
                        echo '<a href="php/Bodjel.php?odjel='.$rez[$i]['odjel_id'].'"  class="button3">Briši odjel</a>';}
                echo '</td>';
            }
            echo '</tr></table>';
    }
    function sobe(){
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            if(isset($_SESSION['tip']) && ($_SESSION['tip']==2 || $_SESSION['tip']==3))
                $sql="SELECT naziv,soba_id,opis,kreirao FROM soba  WHERE odjel_id=".$_GET['odjel'].";";
            else 
                $sql="SELECT naziv,soba_id,opis,kreirao FROM soba  WHERE odjel_id=".$_GET['odjel']."  and (soba.do>'".$sad."' or soba.do is null or soba.do='0000-00-00')   and (soba.od<'".$sad."' or soba.od is null or soba.od='0000-00-00');";
            $rez=json_decode(dat_sql($sql),true);
            echo '<table class="centar1">';
            echo '<tr>';
            for($i=0;$i<sizeof($rez);$i++){
                if( $i % 3==0 && $i!=0)
                    echo '</tr><tr>';
                $sl=json_decode(dat_sql("select slika from eksponat where soba_id=".$rez[$i]['soba_id'].";"),true);
                echo '<td><a href="index.php?id=soba&soba='.$rez[$i]['soba_id'].'" class="button6">';
                echo '<img src="./slike/eksponati/'.$sl[rand(0,(sizeof($sl)-1))]['slika'].'" class="slika"></img>';
                echo '</a><br>';
                echo '<label style="font-weight: bold;">'.$rez[$i]["naziv"].'</label><br>';
                echo $rez[$i]["opis"];
                    if($rez[$i]['kreirao']==$_SESSION['korisnik_id'] || $_SESSION['tip']==3){
                        echo '<br><br><a href="index.php?id=Usoba&soba='.$rez[$i]['soba_id'].'"  class="button3">Uredi sobu</a>';
                        echo '<a href="php/Bsoba.php?soba='.$rez[$i]['soba_id'].'"  class="button3">Briši sobu</a>';}
                echo '</td>';
            }
            echo '</tr></table>';
        
    }
    function soba(){
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            if(isset($_SESSION['tip']) && ($_SESSION['tip']==2 || $_SESSION['tip']==3)){
                    $rez=json_decode(dat_sql("SELECT eksponat.naziv,eksponat.opis,eksponat.slika,eksponat.eksponat_id,eksponat.kreirao FROM eksponat WHERE eksponat.soba_id=".$_GET['soba'].";"),true);
            }
            else{
                $rez=json_decode(dat_sql("SELECT eksponat.naziv,eksponat.opis,eksponat.slika,eksponat.eksponat_id,eksponat.kreirao FROM eksponat WHERE eksponat.soba_id=".$_GET['soba']."  and (eksponat.do>'".$sad."' or eksponat.do is null or eksponat.do='0000-00-00')   and (eksponat.od<'".$sad."' or eksponat.od is null or eksponat.od='0000-00-00');"),true);
            }
                echo '<table class="centar1">';
            echo '<tr>';
            for($i=0;$i<sizeof($rez);$i++){
                if( $i % 3==0 && $i!=0)
                    echo '</tr><tr>';
                echo '<td><a href="index.php?id=eksponat&eksponat=';
                echo $rez[$i]['eksponat_id'];
                echo '" >';
                echo '<img src="./slike/eksponati/'.$rez[$i]['slika'].'" class="slika"></img>';
                echo '</a><br>';
                echo '<label   class="button6">'.$rez[$i]["naziv"].'</label><br>';
                echo $rez[$i]["opis"];
                    if($rez[$i]['kreirao']==$_SESSION['korisnik_id'] || $_SESSION['tip']==3){
                        echo "<br><br><a href='index.php?id=Ueksponat&eksponat=".$rez[$i]['eksponat_id']."' class='button2'>Uredi eksponat</a>";
                        echo "<a href='php/Beksponat.php?eksponat=".$rez[$i]['eksponat_id']."' class='button2'>Briši eksponat</a>";
                    }
                echo '</td>';
            }
            echo '</tr></table>';
        
    }
    function Jsoba(){
            $VT=new virtualTime; 
            $sad=$VT->getTime();
            $rez=json_decode(dat_sql("SELECT eksponat.naziv,eksponat.opis,eksponat.slika,eksponat.eksponat_id FROM eksponat , soba  WHERE soba.odjel_id='".$_GET['odjel']."' and soba.soba_id=eksponat.soba_id and eksponat.javno =1  and (eksponat.do>'".$sad."' or eksponat.do is null or eksponat.do='0000-00-00')   and (eksponat.od<'".$sad."' or eksponat.od is null or eksponat.od='0000-00-00');"),true);
            echo '<table class="centar1">';
            echo '<tr>';
            for($i=0;$i<sizeof($rez);$i++){
                if( $i % 3==0 && $i!=0)
                    echo '</tr><tr>';
                echo '<td><a href="index.php?id=Jeksponat&eksponat=';
                echo $rez[$i]['eksponat_id'];
                echo '">';
                echo '<img src="./slike/eksponati/'.$rez[$i]['slika'].'" class="slika"></img>';
                echo '</a><br>';
                echo '<label   class="button6">'.$rez[$i]["naziv"].'</label><br>';
                echo $rez[$i]["opis"];
                echo '</td>';
            }
            echo '</tr></table>';
        
    }
    function Jeksponat(){
        $rez=json_decode(dat_sql("SELECT * from eksponat where eksponat_id=".$_GET["eksponat"].";"),true);
        echo '<table class="centar1" style="border-spacing:60px;">';
            echo '<tr>';
                echo '<td>';
                echo '<img src="./slike/eksponati/'.$rez[0]['slika'].'" class="slikaV"></img>';
                echo '<br>';
                echo '<label   class="button6">Naziv djela:'.$rez[0]["naziv"].'</label>';
                echo '<label>Autor: '.$rez[0]["autor"].'</label><br><br>';
                echo '<label>Opis: '.$rez[0]["opis"].'</label>';
                echo '</td>';
            echo '</tr>';
        echo '</table>';
        
    }function eksponat(){
        $rez=json_decode(dat_sql("SELECT * from eksponat where eksponat_id=".$_GET["eksponat"].";"),true);
        $rezi=json_decode(dat_sql("SELECT * from eksponat where eksponat_id<>".$_GET["eksponat"]." and soba_id=".$rez[0]['soba_id'].";"),true);
        echo '
        <script type="text/javascript" src="js/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen">';
        echo '<table class="centar1" style="border-spacing:60px;">';
            echo '<tr>';
                echo '<td>';          
                echo '<a class="fancybox" rel="group" href="./slike/eksponati/'.$rez[0]['slika'].'"><img src="./slike/eksponati/'.$rez[0]['slika'].'" class="slikaV"  alt="'.$rez[0]["naziv"].'"></img></a>';
                for ($j = 0; $j < sizeof($rezi); $j++) {
                    echo '<a class="fancybox" hidden rel="group" href="./slike/eksponati/'.$rezi[$j]['slika'].'"><img src="./slike/eksponati/'.$rezi[$j]['slika'].'" class="slikaV"  alt="'.$rezi[$j]["naziv"].'"></img></a>';
                }
                echo '<br>';
                echo '<label   class="button6">Naziv djela:'.$rez[0]["naziv"].'</label>';
                echo '<label>Autor:&nbsp '.$rez[0]["autor"].'</label><br><br>';
                if($rez[0]["opis"]<>"")
                    echo '<label>Opis:&nbsp '.$rez[0]["opis"].'</label>';
                echo '</td>';
                echo '<td class="omot">';
                if($rez[0]['kreirao']==$_SESSION['korisnik_id'] || $_SESSION['tip']==3){
                        echo "<br><a href='index.php?id=Ueksponat&eksponat=".$rez[0]['eksponat_id']."' class='button2'>Uredi eksponat</a><br>";
                        echo "<a href='php/Beksponat.php?eksponat=".$rez[0]['eksponat_id']."' class='button2'>Briši eksponat</a><br>";
                        echo '<a href="index.php?id=veza&eksponat='.$_GET["eksponat"].'" class="button2">Uredi poveznice</a><br><br>';
                }
                echo '<a href="index.php?id=suveniri&eksponat='.$_GET["eksponat"].'" class="button2">Suveniri</a>';
                echo '<br><a href="index.php?id=galerija&eksponat='.$_GET["eksponat"].'" class="button2">Dodaj u galeriju</a><br><br>';
                $rez2=json_decode(dat_sql("SELECT label,url from veza where eksponat_id=".$_GET["eksponat"].";"),true);
                for($i=0;$i<sizeof($rez2);$i++){
                    echo '<a href="';
                    echo $rez2[$i]['url'];
                    echo '" class="button2" target="_blank">';
                    echo $rez2[$i]['label'].'</a><br>';
                }
                echo '</td>';
            echo '</tr>';
        echo '</table>';
        echo '<label style="margin-left:20%;">Ocjenite eksponat:&nbsp&nbsp</label>';
        for($i=1;$i<6;$i++){
            echo '<a href="php/bodovi.php?bod='.$i.'&eksponat='.$rez[0]["eksponat_id"].'"><img src="slike/star.png" class="star"></img></a>';
        }
        echo '<label>&nbsp&nbspOcjena:&nbsp'.round($rez[0]['ocjena'],2).'</label>';
        echo '<form action="php/komentarD.php" method="post">';
        echo '<table class="centar" name="Komentari">';
            echo '<td>';
                echo '<tr class="centar"></td><td><td>Komentari</td></tr>';
                    $RR=json_decode(dat_sql("SELECT korisnik.uname,komentar.tekst,korisnik.slika,korisnik.korisnik_id from komentar,korisnik where eksponat_id=".$_GET["eksponat"]." and korisnik.korisnik_id=komentar.korisnik_id;"),true);
                    for($k=0;$k<sizeof($RR);$k++){
                        echo '<tr><td><img src="slike/korisnici/'.$RR[$k]['slika'].'" class="slikaM"></img>'.$RR[$k]['uname'].'</td><td></td><td>'.$RR[$k]['tekst'].'</td><td><a href="php/prijavi.php?korisnik='.$RR[$k]['korisnik_id'].'&eksponat='.$_GET["eksponat"].'" class="button4">prijavi</a></td></tr>';
                    }
                $_SESSION["eksponat"]=$_GET['eksponat'];
                echo '<br><br><tr><td></td><td><input type="text" name="komentar" palceholder="Unesite svoj komentar"></input></td><td><input type="submit" value="Komentiraj"></input></td></tr>';
            echo '</td>';
        echo '</table></form>';
        
    }
    function obrada(){
        $sql="select * from korisnik where uname='".$_SESSION['uname']."';";
        $rez=json_decode(dat_sql($sql),true);
        echo '<form action="php/azuriraj.php" method="post" enctype="multipart/form-data">
                 <table class="centar">
                    <tr>
                        <td><div class="labela">Ime: </div></td>
                        <td><input type="text" name="ime" value="'.$rez[0]['ime'].'"></input></td>
                        <td><div class="error" id="imeL"></div>
                    </tr>
                    <tr>
                        <td><div class="labela">Prezime: </div></td>
                        <td><input type="text" name="prezime" value="'.$rez[0]['prezime'].'"></input></td>
                        <td><div class="error" id="prezL"></div>
                    </tr>
                    <tr>
                        <td><div class="labela">Grad: </div></td>
                        <td><input id="grad" size="20" maxlength="40" name="grad" value="'.$rez[0]['grad'].'"></td>
                    </tr>
                    <tr>
                        <td><div class="labela">Mail: </div></td>
                        <td><input type="email" name="mail" value="'.$rez[0]['mail'].'"></input></td>
                        <td><div class="error" id="mailL"></div>
                    </tr>
                    <tr>
                        <td><div class="labela">Korisničko ime: </div></td>
                        <td><input type="text" name="uname" pattern="[^]{6,}" value="'.$rez[0]['uname'].'"></input></td>
                        <td><div class="error" id="unameL"></div>
                    </tr>
                    <tr>
                        <td><div class="labela">Šifra: </div></td>
                        <td><input type="password" name="pass"  pattern="[^]{6,}" value="'.$rez[0]['pass'].'"></input></td>
                        <td><div class="error" id="passL"></div>
                    </tr>
                    <tr>
                        <td><div class="labela">Ponovite Šifru: </div></td>
                        <td><input type="password" name="pass2" placeholder="Vaša ponovljena šifra"></input></td>
                    </tr>
                    <tr>
                        <td><div class="labela">Telefonski broj: </div></td>
                        <td><input type="text" name="telefon"  pattern="\d{3}[\ ]\d{6,7}" value="'.$rez[0]['telefon'].'"></input></td>
                        <td><div class="error" id="teL"></div>
                    </tr>
                    <tr>
                        <td><div class="labela">O vama: </div></td>
                        <td><textarea name="about" rows="12">'.$rez[0]['about'].'</textarea></td>
                    </tr>

                    <tr>
                        <td><label for="spol">Spol:</label></td>
                        <td>
                            <select name="spol" id="spol"  >
                                <option value="M" ';
                                if($rez[0]["spol"]=='M')
                                    echo "selected";
                                echo '>M</option>
                                <option value="F" ';
                                if($rez[0]["spol"]=='F')
                                    echo "selected";
                                echo '>Ž</option>
                            </select>
                        </td>
                        <td><label id="spolL"></label></td>
                    </tr>
                    
                    <tr>
                        <td><label for="uvjet">Vaša profilna slika:</label></td>
                        <td><input type="file" accept="image/*" name="slika"></td>
                    </tr>
                    
                    <tr>
                        <td><label for="news">Pretplatite se</label></td>
                        <td><input type="radio" name="news" id="news" checked>Da
                        <input type="radio" name="news" id="news1">Ne</td>
                    </tr>
                    <tr>
                        <td></td><br><td><input type="submit" value="Ažuriraj"></input></td>
                    </tr>
                  </table>
              </form><br><br><br><br><br><br><br>';
        
        
    }
    function suveniri(){
        $rez=json_decode(dat_sql("SELECT * from suvenir where eksponat_id=".$_GET["eksponat"].";"),true);
        echo '<script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
    echo '<table id="ludaTAB">';
    echo '<thead><tr><th>Suvenir</th><th>cijena</th></tr></thead><tbody id="ludaTAB">';
            for($i=0;$i<sizeof($rez);$i++){
                echo '<tr><td>';
                
                echo '<img src="./slike/suveniri/'.$rez[$i]['slika'].'"></img>';
                echo '<br>';
                echo $rez[$i]["naziv"].'<br><br>';
                echo $rez[$i]["opis"];
                
                echo '</td><td>'.$rez[$i]["cijena"];
                    echo '<br><br><a href="php/dodajKos.php?id='.$rez[$i]['suvenir_id'];
                echo '" class="button2">Dodajte u košaricu</a>';
                if($rez[$i]['kreirao']==$_SESSION['korisnik_id'] || $_SESSION['tip']==3){
                        echo '<br><br><a href="index.php?id=Usuvenir&suvenir='.$rez[$i]['suvenir_id'].'"  class="button3">Uredi suvenir</a>';
                        echo '<a href="php/Bsuvenir.php?suvenir='.$rez[$i]['suvenir_id'].'"  class="button3">Briši suvenir</a>';}
                 echo '</td></tr>';
            }
         echo '</tbody></table>';
        
    }
    function kosarica(){
            if(isset($_SESSION['kos']) && $_SESSION['kos']==1){
                echo '<label class="centar">Vaša kupnja je uspješno izvršena</label>';
                unset($_SESSION['kos']);
            }
            else if(isset($_SESSION['kosarica'])){
                
       echo '<script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
    echo '<table id="ludaTAB">';
    echo '<thead><tr><th>Suvenir</th></tr></thead><tbody id="ludaTAB">';
                for($i=0;$i<sizeof($_SESSION['kosarica']);$i++){
                    $rez=json_decode(dat_sql("SELECT * from suvenir where suvenir_id=".$_SESSION["kosarica"][$i].";"),true);
                    echo '<tr><td>';
                    echo '<img src="./slike/suveniri/'.$rez[0]['slika'].'"></img>';
                    echo '<br>';
                    echo $rez[0]["naziv"].'<br><br>';
                    echo $rez[0]["opis"];
                    echo '<br><br><a href="php/makniKos.php?id='.$i.'" class="button2">Ukloni iz košarice</a>';
                    echo '</td></tr>';
                    
       echo '</tbody></table>';
            }}
            else
                echo 'Vaša košarica je prazna';
    }
    function galerija(){
         echo '
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
    echo '<table id="ludaTAB">';
    echo '<thead><tr><th>Slika</th></tr></thead><tbody id="ludaTAB">';
            if(isset($_GET['Kid']))    
                $rez=json_decode(dat_sql("select korisnik_id as id from korisnik where korisnik_id=".$_GET['Kid'].";"),true);
            else
                $rez=json_decode(dat_sql("select korisnik_id as id from korisnik where uname='".$_SESSION['uname']."';"),true);
            if(isset($_GET['eksponat'])){
                ins_sql("insert into galeria value (".$rez[0]['id'].",".$_GET['eksponat'].");");
            }
            $rez2=json_decode(dat_sql("select * from galeria where korisnik_id=".$rez[0]['id'].";"),true);
            if(sizeof($rez2)>0)
                for($i=0;$i<sizeof($rez2);$i++){
                    if(isset($_SESSION['tip']))
                        $rez=json_decode(dat_sql("SELECT * from eksponat where eksponat_id=".$rez2[$i]['eksponat_id'].";"),true);
                    else
                        $rez=json_decode(dat_sql("SELECT * from eksponat where eksponat_id=".$rez2[$i]['eksponat_id']." and javno=1;"),true);
                    if($rez[0]<>''){
                        echo '<tr>';
                        echo '<td>';
                        if(isset($_GET['Kid']))
                            echo '<a href="index.php?id=Jeksponat&eksponat='.$rez[0]['eksponat_id'].'"><img src="./slike/eksponati/'.$rez[0]['slika'].'" class="slikaV"></img></a>';
                        else {
                            echo '<a href="index.php?id=eksponat&eksponat='.$rez[0]['eksponat_id'].'"><img src="./slike/eksponati/'.$rez[0]['slika'].'" class="slikaV"></img></a>';
                        }
                        if(!isset($_GET['Kid']))
                        echo '<br><br><a href="php/makniGal.php?eksponat='.$rez2[$i]["eksponat_id"].'&korisnik='.$rez2[$i]["korisnik_id"].'" class="button2">Ukloni iz galerije</a>';
                        echo '</td></tr>';
                    }
                }
            else
                echo 'Vaša galerija je prazna';
            
        echo '</tbody></table>';
    }
    function kustosZ(){
        include 'kustosZahtjev.php';
        setZahtjev($_SESSION['korisnik_id']);
        echo '<table class="centar1"><td><tr>Vaš zahtjev je uspješno zaprimljen</tr></td></table>';
    }
    function Dodjel(){
        if(isset($_SESSION['nece'])){
            echo 'Naziv odjela koji ste unjeli već postoji';
            echo '<a href="index.php?id=Uodjel&odjel='.$_SESSION['nece'].'" class="button6"> Uredi odjel</a>';
            unset($_SESSION['nece']);
        }
        echo '<form action="php/Nodjel.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv odjela: </label></td>
                <td><input type="text" name="naziv" placeholder="Naziv novog odjela"></input></td>
                <td><div class="error" id="odjelL"></div>';
            echo '</tr>';
            echo '<tr>
                        <td><label class="labela">O odjelu: </label></td>
                        <td><textarea name="opis" rows="12"  placeholder="O odjelu"></textarea></td>
                    </tr>
                  <tr>
                        <td><label class="labela">Ključne rijeći: </label></td>
                        <td><input type="text" name="tag" placeholder="TAG1,TAG2,...,TAGn"></input></td>
                    </tr>
                    <tr>
                       <td><label for="javno" class="labela">Javno:</label></td>
                       <td><input type="checkbox" name="javno" id="javno"></td>
                  </tr>
                  
                    <tr>
                        <td><label for="od" class="labela">Dostupno od:</label></td>
                        <td><input type="date" name="od" id="od"></td>
                    </tr>
                    <tr>
                        <td><label for="do" class="labela">Dostupno do:</label></td>
                        <td><input type="date" name="do" id="do"></td>
                    </tr>   
                  <tr>
                      <td></td><td><input type="submit" value="Kreiraj"></input></td>
                  </tr>';
        echo '</table></form>';
    }
    function Uodjel(){
        require_once 'sql_get.php';
        $rez=json_decode(dat_sql("select * from odjel where odjel_id='".$_GET['odjel']."';"),true);
        echo '<form action="php/Uodjel.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv odjela: </label></td>
                <input type="hidden" name="odjel_id" value="'.$_GET['odjel'].'"></input>
                <td><input type="text" name="naziv" value="'.$rez[0]['naziv'].'"></input></td>
                <td><div class="error" id="odjelL"></div>';
            echo '</tr>';
            echo '<tr>
                        <td><label class="labela">O odjelu: </label></td>
                        <td><textarea name="opis" rows="15">'.preg_replace('#<br\s*?/?>#i', "\n",$rez[0]['opis']).'</textarea></td>
                    </tr>
                    <tr>
                        <td><label class="labela">Ključne rijeći: </label></td>
                        <td><input type="text" name="tag" value="'.$rez[0]['tag'].'"></input></td>
                    </tr>
                    <tr>
                       <td><label for="javno" class="labela">Javno:</label></td>';
                       if($rez[0]['javno']==0)
                           echo '<td><input type="checkbox" name="javno" id="javno"></td>';
                       else
                           echo '<td><input type="checkbox" name="javno" id="javno" checked></td>';
                  echo '</tr>
                       <tr>
                        <td><label for="od" class="labela">Dostupno od:</label></td>
                        <td><input type="date" name="od" id="od" value="'.$rez[0]['od'].'"></td>
                    </tr>
                    <tr>
                        <td><label for="do" class="labela">Dostupno do:</label></td>
                        <td><input type="date" name="do" id="do"  value="'.$rez[0]['do'].'"></td>
                    </tr>     
                  <tr>
                      <td></td><td><input type="submit" value="Pohrani promjene"></input></td>
                  </tr>';
        echo '</table></form>';
    }
    function Dsoba(){
        if(isset($_SESSION['nece'])){
            echo 'Naziv sobe koji ste unjeli već postoji';
            echo '<a href="index.php?id=Usoba&odjel='.$_SESSION['nece'].'"> Uredi sobu</a>';
            unset($_SESSION['nece']);
        }
        echo '<form action="php/Nsoba.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv soba: </label></td>
                <input type="hidden" name="odjel" value="'.$_GET['odjel'].'"></input>
                <td><input type="text" name="naziv" placeholder="Naziv nove sobe"></input></td>
                <td><div class="error" id="sobaL"></div>';
            echo '</tr>';
            echo '<tr>
                        <td><label class="labela">O sobi: </label></td>
                        <td><textarea name="opis" rows="12"  placeholder="O sobi"></textarea></td>
                    </tr>
                  <tr>
                        <td><label class="labela">Ključne riječi: </label></td>
                        <td><input type="text" name="tag" placeholder="TAG1,TAG2,...,TAGn"></input></td>
                    </tr>
                    
                    <tr>
                        <td><label for="od" class="labela">Dostupno od:</label></td>
                        <td><input type="date" name="od" id="od"></td>
                    </tr>
                    <tr>
                        <td><label for="do" class="labela">Dostupno do:</label></td>
                        <td><input type="date" name="do" id="do"></td>
                    </tr>   
                  <tr>
                      <td></td><td><input type="submit" value="Kreiraj"></input></td>
                  </tr>';
        echo '</table></form>';
    }
    function Usoba(){ 
        require_once 'sql_get.php';
        $rez=json_decode(dat_sql("select * from soba where soba_id='".$_GET['soba']."';"),true);
        echo '<form action="php/Usoba.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv soba: </label></td>
                <input type="hidden" name="soba_id" value="'.$_GET['soba'].'"></input>
                <td><input type="text" name="naziv" value="'.$rez[0]['naziv'].'"></input></td>
                <td><div class="error" id="sobaL"></div>';
            echo '</tr>';
            echo '<tr>
                        <td><label class="labela">O sobi: </label></td>
                        <td><textarea name="opis" rows="12"  >'.preg_replace('#<br\s*?/?>#i', "\n",$rez[0]['opis']).'</textarea></td>
                    </tr>
                  <tr>
                        <td><label class="labela">Ključne riječi: </label></td>
                        <td><input type="text" name="tag" value="'.$rez[0]['tag'].'"></input></td>
                    </tr>
                     <tr>
                        <td><label for="od" class="labela">Dostupno od:</label></td>
                        <td><input type="date" name="od" id="od" value="'.$rez[0]['od'].'"></td>
                    </tr>
                    <tr>
                        <td><label for="do" class="labela">Dostupno do:</label></td>
                        <td><input type="date" name="do" id="do"  value="'.$rez[0]['do'].'"></td>
                    </tr>     
                  <tr>
                      <td></td><td><input type="submit" value="Pohrani promjene"></input></td>
                  </tr>';
        echo '</table></form>';
    }
    function Deksponat(){
        if(isset($_SESSION['nece'])){
            echo 'Naziv eksponata koji ste unjeli već postoji';
            echo '<a href="index.php?id=Ueksponat&eksponat='.$_SESSION['nece'].'"> Uredi eksponat</a>';
            unset($_SESSION['nece']);
        }
        echo '<form action="php/Neksponat.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv eksponata: </label></td>
                <input type="hidden" name="soba" value="'.$_GET['soba'].'"></input>
                <td><input type="text" name="naziv" placeholder="Naziv novog eksponata"></input></td>
                <td><div class="error" id="eksponatL"></div></td>';
            echo '</tr>';
            echo '
                  <tr>
                        <td><label class="labela">Autor: </label></td>
                        <td><input type="text" name="autor" placeholder="autor djela"></input></td>
                  </tr>
                <tr>
                        <td><label class="labela">O eksponatu: </label></td>
                        <td><textarea name="opis" rows="12"  placeholder="O eksponatu"></textarea></td>
                    </tr>
                  <tr>
                        <td><label class="labela">Ključne rijeći: </label></td>
                        <td><input type="text" name="tag" placeholder="TAG1,TAG2,...,TAGn"></input></td>
                  </tr>
                    <tr>
                       <td><label for="javno" class="labela">Javno:</label></td>
                       <td><input type="checkbox" name="javno" id="javno"></td>
                  </tr>
                    <tr>
                        <td><label for="od" class="labela">Dostupno od:</label></td>
                        <td><input type="date" name="od" id="od"></td>
                    </tr>
                    <tr>
                        <td><label for="do" class="labela">Dostupno do:</label></td>
                        <td><input type="date" name="do" id="do"></td>
                    </tr>                   
                    <tr>
                        <td><label for="skila" class="labela">Slika eksponata:</label></td>
                        <td><input type="file" accept="image/*" name="slika"></td>
                    </tr>
                  <tr>
                      <td></td><td><input type="submit" value="Kreiraj"></input></td>
                  </tr>';
        echo '</table></form>';
        
    }
    function Ueksponat(){
        require_once 'sql_get.php';
        $rez=json_decode(dat_sql("select * from eksponat where eksponat_id=".$_GET['eksponat'].";"),true);
        echo '<form action="php/Ueksponat.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv eksponata: </label></td>
                <input type="hidden" name="eksponat" value="'.$_GET["eksponat"].'"></input>
                <td><input type="text" name="naziv" value="'.$rez[0]["naziv"].'"></input></td>
                <td><div class="error" id="eksponatL"></div></td>';
            echo '</tr>';
            echo '
                  <tr>
                        <td><label class="labela">Autor: </label></td>
                        <td><input type="text" name="autor" value="'.$rez[0]["autor"].'"></input></td>
                  </tr>
                <tr>
                        <td><label class="labela">O eksponatu: </label></td>
                        <td><textarea name="opis" rows="12">'.preg_replace('#<br\s*?/?>#i', "\n",$rez[0]['opis']).'</textarea></td>
                    </tr>
                  <tr>
                        <td><label class="labela">Ključne rijeći: </label></td>
                        <td><input type="text" name="tag" value="'.$rez[0]['tag'].'"></input></td>
                  </tr>
                    <tr>
                       <td><label for="javno" class="labela">Javno:</label></td>';
                       if($rez[0]['javno']==0)
                           echo '<td><input type="checkbox" name="javno" id="javno"></td>';
                       else
                           echo '<td><input type="checkbox" name="javno" id="javno" checked></td>';
                  echo '</tr>
                    <tr>
                        <td><label for="od" class="labela">Dostupno od:</label></td>
                        <td><input type="date" name="od" id="od" value="'.$rez[0]['od'].'"></td>
                    </tr>
                    <tr>
                        <td><label for="do" class="labela">Dostupno do:</label></td>
                        <td><input type="date" name="do" id="do"  value="'.$rez[0]['do'].'"></td>
                    </tr>                   
                  <tr>
                      <td></td><td><input type="submit" value="Pohrani promjene"></input></td>
                  </tr>';
        echo '</table></form>';
        
    }
    function search(){
        if($_GET['search']<>''){
            echo '
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
                $rez=json_decode(dat_sql("select odjel_id,naziv,opis from odjel where upper(naziv) like upper('%".$_GET['search']."%') or  upper(opis) like upper('%".$_GET['search']."%') or upper(tag) like upper('%".$_GET['search']."%');"),true);
                $rez1=json_decode(dat_sql("select soba_id,naziv,opis from soba where upper(naziv) like upper('%".$_GET['search']."%') or upper( opis) like upper('%".$_GET['search']."%') or upper(tag) like upper('%".$_GET['search']."%');"),true);
                $rez2=json_decode(dat_sql("select eksponat_id,naziv,opis from eksponat where upper(naziv) like upper('%".$_GET['search']."%') or  upper(opis) like upper('%".$_GET['search']."%') or upper(autor) like upper('%".$_GET['search']."%') or upper(tag) like upper('%".$_GET['search']."%');"),true);
                echo '<label class="centar">Rezultati pretraživanja (ukupno:'.(sizeof($rez)+sizeof($rez2)).')</label>';
                echo '<table id="ludaTAB">';
                echo '<thead><tr><th>Naziv</th><th>Opis</th></tr></thead><tbody id="ludaTAB">';
                for ($i = 0; $i < sizeof($rez); $i++) {
                    echo '<tr><td><a href="index.php?id=odjel&odjel='.$rez[$i]["odjel_id"].'">'.$rez[$i]["naziv"].'</a>
                        </td><td>'.$rez[$i]["opis"].'</td></tr>';          
                }
                for ($i = 0; $i < sizeof($rez1); $i++) {
                    echo '<tr><td><a href="index.php?id=soba&soba='.$rez1[$i]["soba_id"].'">'.$rez1[$i]["naziv"].'</a>
                        </td><td>'.$rez1[$i]["opis"].'</td></tr>';          
                }
                for ($i = 0; $i < sizeof($rez2); $i++) {
                    echo '<tr><td><a href="index.php?id=eksponat&eksponat='.$rez2[$i]["eksponat_id"].'">'.$rez2[$i]["naziv"].'</a>
                        </td><td>'.$rez2[$i]["opis"].'</td></tr>';          
                }
                echo '</tbody></table>';
        }
        else {
            echo 'Unesite traženi pojam';
        }
    }
    function Jsearch(){
        if($_GET['Jsearch']<>''){
            echo '
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
                $rez=json_decode(dat_sql("select odjel_id,naziv,opis from odjel where (upper(naziv) like upper('%".$_GET['Jsearch']."%') or  upper(opis) like upper('%".$_GET['Jsearch']."%') or upper(tag) like upper('%".$_GET['Jsearch']."%')) and javno=1;"),true);
                $rez2=json_decode(dat_sql("select eksponat_id,naziv,opis from eksponat where (upper(naziv) like upper('%".$_GET['Jsearch']."%') or  upper(opis) like upper('%".$_GET['Jsearch']."%') or upper(autor) like upper('%".$_GET['Jsearch']."%') or upper(tag) like upper('%".$_GET['Jsearch']."%')) and javno=1;"),true);
                echo '<label class="centar">Rezultati pretraživanja (ukupno:'.(sizeof($rez)+sizeof($rez2)).')</label>';
                echo '<table id="ludaTAB">';
                echo '<thead><tr><th>Naziv</th><th>Opis</th></tr></thead><tbody id="ludaTAB">';
                for ($i = 0; $i < sizeof($rez); $i++) {
                    echo '<tr><td><a href="index.php?id=Jodjel&odjel='.$rez[$i]["odjel_id"].'">'.$rez[$i]["naziv"].'</a></td>
                        <td>'.$rez[$i]["opis"].'</td></tr>';          
                }
                for ($i = 0; $i < sizeof($rez2); $i++) {
                    echo '<tr><td><a href="index.php?id=Jeksponat&eksponat='.$rez2[$i]["eksponat_id"].'">'.$rez2[$i]["naziv"].'</a></td>
                        <td>'.$rez2[$i]["opis"].'</td></tr>';          
                }
                echo '</tbody></table>';
        }
        else {
            echo 'Unesite traženi pojam';
        }
    }
    function bitKus(){
        require 'php/kustosZahtjev.php';
        $rez=getZahtjev();
        if(sizeof($rez)>0){
        echo '<form action="php/zahKUS.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>';
            echo '<tr><td>Odaberite koje korisnike odobriti</td></tr>';
            for ($i = 0;$i < sizeof($rez);$i++) {
                $rr=json_decode(dat_sql("select uname from korisnik where korisnik_id=".$rez[$i]['korisnik'].";"),true);
                echo '<tr><td>'.$rr[0]['uname'].'&nbsp&nbsp&nbsp
                            <input type="radio" name="'.$rez[$i]['korisnik'].'" id="news" value="1">Da</input>
                            <input type="radio" name="'.$rez[$i]['korisnik'].'" id="news" value="0" checked>Ne
                        </input></td></tr>';
            }
            echo '<td><input type="submit" value="Odobri zahtjeve"></input></td>';
            echo '</tr></table>';
        }
        $rez=json_decode(dat_sql("select korisnik from zahtjev where zahtjev=2"),true);
        if(sizeof($rez)>0){
        echo '<form action="php/zamrznuti.php" method="post" enctype="multipart/form-data"><table class="centar"><tr>';
            echo '<tr><td>Odaberite koje korisnike privremeno zamrznuti</td></tr>';
            for ($i = 0;$i < sizeof($rez);$i++) {
                $rr=json_decode(dat_sql("select uname from korisnik where korisnik_id=".$rez[$i]['korisnik'].";"),true);
                echo '<tr><td>'.$rr[0]['uname'].'&nbsp&nbsp&nbsp
                        <input type="time" name="'.$rez[$i]['korisnik'].'">Zamrzni</input></td></tr>';
            }
            echo '<td><input type="submit" value="Zamrznuti"></input></td>';
            echo '</tr></table>';
        }
        
        $rez=json_decode(dat_sql("select korisnik from zahtjev where zahtjev=3"),true);
        if(sizeof($rez)>0){
        echo '<form action="php/deaktivirati.php" method="post" enctype="multipart/form-data"><table class="centar"><tr>';
            echo '<tr><td>Odaberite koje korisnike deaktivirati</td></tr>';
            for ($i = 0;$i < sizeof($rez);$i++) {
                $rr=json_decode(dat_sql("select uname from korisnik where korisnik_id=".$rez[$i]['korisnik'].";"),true);
                echo '<tr><td>'.$rr[0]['uname'].'&nbsp&nbsp&nbsp
                        <input type="checkbox" name="'.$rez[$i]['korisnik'].'">Deaktivirati</input></td></tr>';
            }
            echo '<td><input type="submit" value="Zamrznuti"></input></td>';
            echo '</tr></table>';
        }
        
        $rez=json_decode(dat_sql("select korisnik from zahtjev where zahtjev=4"),true);
        if(sizeof($rez)>0){
        echo '<form action="php/AKaktivirati.php" method="post" enctype="multipart/form-data"><table class="centar"><tr>';
            echo '<tr><td>Odaberite koje korisnike aktivirati</td></tr>';
            for ($i = 0;$i < sizeof($rez);$i++) {
                $rr=json_decode(dat_sql("select uname from korisnik where korisnik_id=".$rez[$i]['korisnik'].";"),true);
                echo '<tr><td>'.$rr[0]['uname'].'&nbsp&nbsp&nbsp
                        <input type="checkbox" name="'.$rez[$i]['korisnik'].'">Aktivirati</input></td></tr>';
            }
            echo '<td><input type="submit" value="Aktivirati"></input></td>';
            echo '</tr></table>';
        }
    }
    function Ukorisnik(){
        $rez=json_decode(dat_sql("select uname,korisnik_id from korisnik"),true);
        $sql="select * from tip;";
        $rez1=json_decode(dat_sql($sql),true);
        echo '<form action="php/AUkorisnik" method="post" id="brisi" enctype="multipart/form-data"><table class="centar1"><tr>';
        echo '<tr><td>Uređivanje podataka korisnika</td></tr><tr>
                <td><label for="korisnik">Korisnik:</label><select name="korisnik" id="korisnik"  >';
        for($i=0;$i<sizeof($rez);$i++) {
            echo '<option value="'.$rez[$i]['korisnik_id'].'">'.$rez[$i]['uname'].'</option>';
        }
        echo '</select><label id="korisnikL"></label></td></tr>';
        echo'<td><label for="tip">Tip korisnika:</label><select name="tip" id="tip"  >';
        for($i=0;$i<sizeof($rez1);$i++) {
            echo '<option value="'.$rez1[$i]['tip_id'].'">'.$rez1[$i]['naziv'].'</option>';
        }
        echo '</select><label id="tipL"></label></td></tr>';
        
        echo'<td><label for="blok">Blokiran:</label><select name="blok" id="blok"  >';
        echo '<option id="blok" value="0">Ne</option>';
        echo '<option id="blok" value="1">Da</option>';
        echo '</select><label id="blokL"></label></td></tr>';
            
        echo '<td><input type="submit"  name="TP"  value="Uredi"></input><input type="submit"  name="TP"  value="Pregled podataka"></input><input type="submit"  name="TP"  value="Briši"></input></td></tr></table>';
    }
    function Dsuvenir(){
        if(isset($_SESSION['nece'])){
            echo 'Naziv suvenira koji ste unjeli već postoji';
            echo '<a href="index.php?id=Usuvenir&suvenir='.$_SESSION['nece'].'"> Uredi suvenir</a>';
            unset($_SESSION['nece']);
        }
        echo '<form action="php/Nsuvenir.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv suvenira: </label></td>
                <input type="hidden" name="eksponat" value="'.$_GET['eksponat'].'"></input>
                <td><input type="text" name="naziv" placeholder="Naziv novog suvenira"></input></td>
                <td><div class="error" id="nazivL"></div></td>';
            echo '</tr>';
            echo '
                <tr>
                        <td><label class="labela">O suveniru: </label></td>
                        <td><textarea name="opis" rows="12"  placeholder="O suveniru"></textarea></td>
                    </tr>                  
                    <tr>
                        <td><label for="slika" class="labela">Slika suvenira:</label></td>
                        <td><input type="file" accept="image/*" name="slika"></td>
                    </tr>               
                    <tr>
                        <td><label for="cijena" class="labela">Cijena suvenira:</label></td>
                        <td><input type="text" name="cijena"></td>
                    </tr>
                  <tr>
                      <td></td><td><input type="submit" value="Kreiraj"></input></td>
                  </tr>';
        echo '</table></form>';
        
    }
    function Usuvenir(){require_once 'sql_get.php';
        $rez=json_decode(dat_sql("select * from suvenir where suvenir_id=".$_GET['suvenir'].";"),true);
        echo '<form action="php/Usuvenir.php" method="post" enctype="multipart/form-data"><table class="centar1"><tr>
                <td><label class="labela">Naziv suvenira: </label></td>
                <input type="hidden" name="eksponat" value="'.$_GET['suvenir'].'"></input>
                <input type="hidden" name="eksponat" value="'.$rez[0]["eksponat_id"].'"></input>
                <td><input type="text" name="naziv" value="'.$rez[0]["naziv"].'"></input></td>
                <td><div class="error" id="nazivL"></div></td>';
            echo '</tr>';
            echo '
                <tr>
                        <td><label class="labela">O suveniru: </label></td>
                        <td><textarea name="opis" rows="12">'.$rez[0]["opis"].'</textarea></td>
                    </tr>                 
                    <tr>
                        <td><label for="cijena" class="labela">Cijena suvenira:</label></td>
                        <td><input type="text" name="cijena" value="'.$rez[0]["cijena"].'"></td>
                    </tr>  
                  <tr>
                      <td></td><td><input type="submit" value="Uredi"></input></td>
                  </tr>';
        echo '</table></form>';
        
    }
    function Uveze(){
        require_once 'sql_get.php';
        $rez=json_decode(dat_sql("select * from veza where eksponat_id=".$_GET['eksponat'].";"),true);
        echo '<form action="php/Uveza.php" method="post" enctype="multipart/form-data"><table class="centar"><tr>';
                    echo '<br><br><tr><td><label class="labela">Naziv poveznice: </label></td>
                    <input type="hidden" name="eksponat" value="'.$_GET['eksponat'].'"></input>
                    <td><input type="text" name="label" placeholder="unesite naziv poveznice"></input></td>';  
                    echo '<td><label class="labela">Poveznica: </label></td>
                    <td><input type="text" name="url" placeholder="unesite poveznicu"></input></td></tr>';  
                for($i=0;$i<sizeof($rez);$i++){
                    echo '<tr><td><label class="labela">Naziv poveznice: </label></td>
                    <input type="hidden" name="veza_id'.$i.'" value="'.$rez[$i]["veza_id"].'"></input>
                    <td><input type="text" name="label'.$i.'" value="'.$rez[$i]["label"].'"></input></td>';  
                    echo '<td><label class="labela">Poveznica: </label></td>
                    <td><input type="text" name="url'.$i.'" value="'.$rez[$i]["url"].'"></input></td>';  
                    echo '<td><label class="labela">Briši: </label></td>
                    <td><input type="checkbox" name="brisi'.$i.'"></input></td></tr>';
                }
              echo '<tr>
                  <td></td><td></td><td><input type="submit" value="Pohrani"></input></td>
              </tr>';
        echo '</table></form>';
    }
    function Akpregled(){
        $rez=json_decode(dat_sql("select * from korisnik where korisnik_id=".$_GET['korisnik'].";"),true);
        echo '<table class="centar">';
        foreach ($rez[0] as $key => $value) {
            echo '<tr><td>'.$key.': '.$value.'</td></tr>';
        }
        echo '</table>';
        
    }
    function Umuzej(){
        if($_SESSION['tip']==3){
            require 'virtualTime.php';
    $VT=new virtualTime();echo '<label class="centar">Trenutno virtualno vrijeme je: '.$VT->getTime().'</label>';
            echo '<br><br><form action="php/timeUP.php" method="post" enctype="multipart/form-data"><table class="centar">';
                    echo '<tr><td><label class="labela">Pomak vremena: </label></td>
                    <td><input type="number" name="vrijeme" rows="2"  placeholder="koliko sati"></textarea><input type="submit" value="Pomakni vrijeme"></td></tr>';
        
        echo '</table></form>';
                    echo '<br><br><form action="php/sqlEXE.php" method="post" enctype="multipart/form-data"><table class="centar">';
                    echo '<tr><td><label class="labela">sql upit: </label></td>
                    <td><textarea name="upit" rows="2"  placeholder="Unesite upit"></textarea><input type="submit" value="Izvrši"></td></tr>';
                    if(isset($_SESSION['sql'])){
                        $rez=  $_SESSION['sql'];
                        for ($i = 0; $i < sizeof($rez); $i++) 
                            foreach ($rez[$i] as $key => $value) 
                            echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
                        unset($_SESSION['sql']);
                    }
                    else if(isset($_SESSION['sql1'])){
                        $rez=  $_SESSION['sql1'];
                        if($rez==1)
                        echo '<tr><td>Uspjeh!</td></tr>';
                        else
                        echo '<tr><td>'.$rez.'</td></tr>';
                        unset($_SESSION['sql1']);
                    }
        echo '</table></form>';
    }}
function zaboravio(){
    echo '<br><br><br><form action="php/saljiPASS" method="post" ><table class="centar">
        <tr><td><label>Slanje podataka na e-mail</label></td></tr>
        <tr><td><input type="text" name="mail" placeholder="vaš e-mail"></input></td></tr>
        <tr><td><input type="submit" value="pošalji"></input></td></tr>
    </table></form>';
}
function Kpocetna(){
    $rez=  json_decode(dat_sql("SELECT naziv,eksponat_id,ocjena,slika FROM eksponat order by ocjena desc"),true);
    echo '<br><table class="centar1"><tr><td>Dobrodošli u Muzej moderne umjetnosti</td></tr>';
    echo '<tr><td>Pregled najpopularnijih sadržaja</td></tr></table>';
     echo '
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
    echo '<table id="ludaTAB">';
    echo '<thead><tr><th>Naziv</th><th>ocjena</th></tr></thead><tbody id="ludaTAB">';
    for ($i = 0; $i < sizeof($rez); $i++) {
        echo '<tr><td><a href="index.php?id=eksponat&eksponat='.$rez[$i]["eksponat_id"].'"><img src="./slike/eksponati/'.$rez[$i]['slika'].'" class="slika"  alt="'.$rez[$i]["naziv"].'"></img></a>
            </td><td>'.$rez[$i]["ocjena"].'</td></tr>';          
    }
    echo '</tbody></table>';
}
function pocetna(){
    $rez=  json_decode(dat_sql("SELECT naziv,eksponat_id,ocjena,slika FROM eksponat where javno=1 order by ocjena desc"),true);
    echo '<br><table class="centar1"><tr><td>Dobrodošli u Muzej moderne umjetnosti</td></tr>';
    echo '<tr><td>Pregled najpopularnijih sadržaja</td></tr></table>';
     echo '
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" media="screen">';
    echo '<table id="ludaTAB">';
    echo '<thead><tr><th>Naziv</th><th>ocjena</th></tr></thead><tbody id="ludaTAB">';
    for ($i = 0; $i < sizeof($rez); $i++) {
        echo '<tr><td><a href="index.php?id=Jeksponat&eksponat='.$rez[$i]["eksponat_id"].'"><img src="./slike/eksponati/'.$rez[$i]['slika'].'" class="slika"  alt="'.$rez[$i]["naziv"].'"></img></a>
            </td><td>'.$rez[$i]["ocjena"].'</td></tr>';          
    }
    echo '</tbody></table>';
}
?>