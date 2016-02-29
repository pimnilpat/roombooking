<?php
$server = '';
$user = '';
$password='';
$dbname='roombooking';
$link=mysql_connect($server, $user, $password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
?>
