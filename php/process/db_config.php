<?php
$conf["db"]["sqlhost"] = "localhost";
$conf["db"]["sqluser"] = "root";
$conf["db"]["sqldb"] = "lutherbog";
$conf["db"]["sqlpassword"] = "root";

mysql_connect($conf["db"]["sqlhost"],$conf["db"]["sqluser"],$conf["db"]["sqlpassword"]) or die ("Keine Verbindung mˆglich");
mysql_select_db($conf["db"]["sqldb"]) or die ("Die Datenbank existiert nicht");
mysql_query("SET NAMES 'utf8'");
?>