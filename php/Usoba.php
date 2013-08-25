<?php
    require_once 'sql_get.php';
    $rez=json_decode(dat_sql("select odjel_id from soba where soba_id=".$_POST['soba_id'].";"),true);
    ins_sql("update soba set naziv='".$_POST['naziv']."', opis='".nl2br(htmlspecialchars(stripslashes($_POST['opis'])))."', od='".$_POST['od']."', do='".$_POST['do']."', tag='".$_POST['tag']."' where soba_id=".$_POST['soba_id'].";");
    header('Location: ../index.php?id=odjel&odjel='.$rez[0]['odjel_id']);   
    exit();
?>
