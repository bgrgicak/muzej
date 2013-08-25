<?php
        function setZahtjev($id)
        {
            ins_sql("insert into zahtjev values(".$id.",1);");
        }
        function dropZahtjev($id)
        {
            ins_sql("delete from zahtjev where korisnik=".$id." and zahtjev=1;");}
        function getZahtjev()
        {
            return json_decode(dat_sql("select korisnik from zahtjev where zahtjev=1;"),true);
        }
?>