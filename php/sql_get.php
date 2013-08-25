<?php
function dat_sql($sql){
    $mysqli = new mysqli("localhost", "WebDiP2012_024", "admin_iJJn", "WebDiP2012_024");

    if ($mysqli->connect_errno) {
        echo "Neuspješno spajanje: %s\n", $mysqli->connect_error;
    }
    else{
        $mysqli->query("SET NAMES utf8_general_ci");
        $mysqli->query("SET CHARACTER SET utf8_general_ci");
        $mysqli->query("SET COLLATION_CONNECTION='utf8_general_ci'");
        $sth = $mysqli->query($sql);
        $rows = array();
        while($r = mysqli_fetch_assoc($sth)) {
            $rows[] = array_map('utf8_encode', $r);
        }
        $mysqli->close();
        return json_encode($rows);
    }

    $mysqli->close();
    return null;
}
function ins_sql($sql){
    $mysqli = new mysqli("localhost", "WebDiP2012_024", "admin_iJJn", "WebDiP2012_024");

    if ($mysqli->connect_errno) {
        echo "Neuspješno spajanje: %s\n", $mysqli->connect_error;
    }
    else{
        $mysqli->query("SET NAMES utf8_general_ci");
        $mysqli->query("SET CHARACTER SET utf8_general_ci");
        $mysqli->query("SET COLLATION_CONNECTION='utf8_general_ci'");
        $sth = $mysqli->query($sql);
        return $sth;
    }

    $mysqli->close();
    return null;
}
?>