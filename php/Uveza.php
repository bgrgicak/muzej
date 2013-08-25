<?php
    require 'sql_get.php';
    if($_POST['label']<>'' && $_POST['url']<>''){
        ins_sql("insert into veza values(default,".$_POST['eksponat'].",'".$_POST['label']."','".$_POST['url']."');");
    }
    for ($i = 0; $i < (sizeof($_POST)-2); $i++) {
        if(isset($_POST['brisi'.$i]))
            ins_sql("delete from veza where veza_id=".$_POST['veza_id'.$i].";");
        else if($_POST['label'.$i]<>'' && $_POST['url'.$i]<>''){
            ins_sql("update veza set label='".$_POST['label'.$i]."', url='".$_POST['url'.$i]."' where veza_id=".$_POST['veza_id'.$i].";");
        }
    }header( 'Location: ../index.php?id=veza&eksponat='.$_POST['eksponat']);exit();?>