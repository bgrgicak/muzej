<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" href="../css/temaPHP.css" type="text/css" />
<?php
   $conn=new mysqli(localhost, WebDiP2012_024, admin_iJJn, WebDiP2012_024);
   if ($conn->connect_error) {
        echo $conn->connect_error;
    } else {
        $conn->set_charset("utf8");
        $sql = "SELECT * FROM korisnik;";
        $rs = $conn->query($sql);
        if ($rs) {
            echo '<!DOCTYPE html><html><head></head><body>';
            echo "<table class='centar'>";
            echo "<tr><td>ime</td><td>prezime</td><td>Korisničko ime</td><td>lozinka</td><td>tip</td></tr>";
            $korisnici = array();
            while ($red = $rs->fetch_assoc()) {
                $korisnici[] = $red;
            }
            foreach($korisnici as $ko)
                echo "<tr><td>".$ko['ime']."</td><td>".$ko['prezime']."</td><td>".$ko['uname']."</td><td>".$ko['pass']."</td><td>".$ko['tip_id']."</td></tr>";
            
            echo "</table>";
            echo '</body></html>';
        }
        else {
                echo $conn->error . " upit:" . $sql;
            }
    }
    mysqli_close($conn);
    
?>