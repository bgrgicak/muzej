<?php
		function getKolacic($name)
		{
                    if (isset($_COOKIE[$name])){
                        return $_COOKIE[$name];
                    }
                    return null;
		}
                function setKolacic($name,$val)
		{
                    setcookie($name,$val,time()+60*60*24*7,'/');
		}
	
?>